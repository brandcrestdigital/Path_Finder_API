<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendPasswordResetOtpJob;
use App\Models\DigitalCard;
use App\Models\User;
use App\Services\WebpService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function sample()
    {
        $samples = \App\Models\sapmle::all();
        return response()->json([
            'success' => true,
            'data'    => $samples,
        ]);
    }

    // User Registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone'    => 'required|digits:10|unique:users,phone',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()->first(),
            ], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'token'   => $token,
            'user'    => $user,
        ]);
    }
    // User Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login'    => 'required|string', // email OR phone
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()->first(),
            ], 422);
        }

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'phone';

        // Fetch user manually
        $user = User::where($loginField, $request->login)->first();

        // User not found
        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

                                     // ❌ Block non-admins explicitly
        if ($user->role != 'user') { // 2 = admin
            return response()->json([
                'success' => false,
                'message' => 'Access denied. User only.',
            ], 403);
        }

        // Password check
        if (! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Generate JWT token manually
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success'    => true,
            'token'      => $token,
            'token_type' => 'Bearer',
            'user'       => $user,
        ]);
    }

    public function admin_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone'    => 'required|digits:10|unique:users,phone',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()->first(),
            ], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'role'     => 'admin',
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'token'   => $token,
            'user'    => $user,
        ]);
    }

    public function admin_login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|string', // email OR phone
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()->first(),
            ], 422);
        }

        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'phone';

        // Fetch user manually
        $user = User::where($loginField, $request->username)->first();

        // User not found
        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        if ($user->role != 'admin') { // 2 = admin
            return response()->json([
                'success' => false,
                'message' => 'Access denied. Admins only.',
            ], 403);
        }

        // Password check
        if (! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Generate JWT token manually
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success'    => true,
            'token'      => $token,
            'token_type' => 'Bearer',
            'user'       => $user,

        ]);
    }

    public function org_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string', // email OR phone
            'password' => 'required|string',
            'role'     => 'required|in:employeer,employee',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        // Detect login field (email or phone)
        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'phone';

        // Fetch user by username + role
        $user = User::where($loginField, $request->username)
            ->where('role', $request->role)
            ->first();

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials or role',
            ], 401);
        }

        // Check password
        if (! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        // Generate JWT token
        $token = JWTAuth::claims([
            'role' => $user->role,
        ])->fromUser($user);

        return response()->json([
            'success'    => true,
            'message'    => 'Login successful',
            'token'      => $token,
            'token_type' => 'Bearer',
            'user'       => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'role'  => $user->role,
            ],
        ]);
    }

    public function sendOtp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::exists('users', 'email'),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()->first(),
            ], 422);
        }

        $otp = rand(100000, 999999);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['otp' => $otp, 'created_at' => now()]
        );

        dispatch(new SendPasswordResetOtpJob($request->email, $otp));

        return response()->json([
            'success' => true,
            'message' => 'OTP senttoyouremail',
        ]);
    }

    public function verifyOtp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required | email',
            'otp'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()->first(),
            ], 422);
        }

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (! $record) {
            return response()->json(['message' => 'Invalid OTP'], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP verified',
        ]);
    }

    public function resetPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'    => 'required | email',
            'otp'      => 'required',
            'password' => 'required | min: 6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()->first(),
            ], 422);
        }

        $record = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (! $record) {
            return response()->json(['message' => 'Invalid OTP'], 422);
        }

        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password resetsuccessfully',
        ]);
    }

    public function profile()
    {
        return response()->json([
            'success' => true,
            'user'    => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        /* ================= VALIDATION ================= */
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        /* ================= UPDATE TEXT FIELDS ================= */
        $user->name  = $request->name;
        $user->email = $request->email ?? $user->email;

        /* ================= IMAGE → WEBP ================= */
        if ($request->hasFile('profile_image')) {

            $file = $request->file('profile_image');

            // 👉 temp source path
            $srcPath = $file->getRealPath();

            // 👉 destination path (storage/app/public/avatars)
            $fileName = Str::uuid() . '.webp';
            $destPath = storage_path('app/public/avatars/' . $fileName);

            // 👉 convert + resize (300x300 optional)
            WebpService::convert(
                $srcPath,
                $destPath,
                70,  // quality
                300, // width
                300  // height
            );

            // 👉 delete old avatar
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // 👉 save relative path
            $user->avatar = 'avatars/' . $fileName;
        }

        $user->save();

        /* ================= RESPONSE ================= */
        return response()->json([
            'success' => true,
            'user'    => [
                'id'     => $user->id,
                'name'   => $user->name,
                'email'  => $user->email,
                'phone'  => $user->phone,
                'avatar' => $user->avatar
                    ? asset('storage/' . $user->avatar)
                    : null,
            ],
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    // ==================== GOOGLE OAUTH (Sign in with Gmail) ====================

    /**
     * Redirect the user to Google for authentication.
     * Frontend calls this → user is redirected to Google → Google redirects back to redirect URL.
     */
    public function redirectToGoogle()
    {
        $scopes = [
            'openid',
            'profile',
            'email',
            'https://www.googleapis.com/auth/calendar',
            'https://www.googleapis.com/auth/calendar.events',
            'https://www.googleapis.com/auth/contacts',
        ];

        return response()->json([
            'success' => true,
            'url'     => Socialite::driver('google')
                ->stateless()
                ->scopes($scopes)
                ->with([
                    'access_type' => 'offline',
                    'prompt'      => 'consent',
                ])
                ->redirect()
                ->getTargetUrl(),
        ]);
    }

    /**
     * Handle the callback from Google.
     * Google sends us the user's info → we log them in or register them.
     * Renders an HTML page that stores the JWT token in localStorage and
     * redirects the browser back to the React application.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            if (! $googleUser || ! $googleUser->email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to get user info from Google.',
                ], 400);
            }

            /**
             * ✅ GMAIL EXISTENCE & ROLE CHECK
             * Only allow login if this Gmail exists AND the account role is 'employee'.
             * Do NOT auto-create new users. Do NOT allow admin/employeer accounts.
             */
            $user = User::where('email', $googleUser->email)->first();

            if (! $user) {
                return response()->view('emails.oauth-callback', [
                    'token'        => null,
                    'user'         => null,
                    'redirect_url' => env('REACT_APP_URL', 'http://localhost:5173'),
                    'error'        => 'This Gmail is not registered in our system. Please contact your admin to get access first.',
                ]);
            }

            $digitalCard = DigitalCard::where('user_id', $user->id)
                ->where('status', 'active')
                ->latest()
                ->first();

            if (! $digitalCard) {
                return response()->view('emails.oauth-callback', [
                    'token'        => null,
                    'user'         => null,
                    'redirect_url' => env('REACT_APP_URL', 'http://localhost:5173'),
                    'error'        => 'No active digital card found. Please contact your administrator.',
                ]);
            }

            if (now()->gt($digitalCard->expires_at)) {
                return response()->view('emails.oauth-callback', [
                    'token'        => null,
                    'user'         => null,
                    'redirect_url' => env('REACT_APP_URL', 'http://localhost:5173'),
                    'error'        => 'Your digital card has expired. Please renew your subscription to continue.',
                ]);
            }

            // ❌ Only allow 'employee' role — reject admin/employeer accounts
            if ($user->role !== 'employee') {
                return response()->view('emails.oauth-callback', [
                    'token'        => null,
                    'user'         => null,
                    'redirect_url' => env('REACT_APP_URL', 'http://localhost:5173'),
                    'error'        => 'Access denied. Only employee accounts can sign in with Google.',
                ]);
            }

            // Link Google account to the existing user
            $user->google_id            = $googleUser->id;
            $user->google_token         = $googleUser->token;
            $user->google_refresh_token = $googleUser->refreshToken;
            $user->avatar               = $user->avatar ?? $googleUser->avatar;
            $user->save();

            // Generate JWT token
            $token = JWTAuth::fromUser($user);

            $userPayload = [
                'id'     => $user->id,
                'name'   => $user->name,
                'email'  => $user->email,
                'avatar' => $user->avatar,
                'role'   => $user->role,
            ];

            $reactAppUrl = env('REACT_APP_URL', 'http://localhost:5173');

            return response()->view('emails.oauth-callback', [
                'token'        => $token,
                'user'         => $userPayload,
                'redirect_url' => $reactAppUrl,
                'error'        => null,
            ]);
        } catch (\Exception $e) {
            Log::error('Google OAuth error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Google authentication failed: ' . $e->getMessage(),
            ], 500);
        }
    }

}
