<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class GoogleController extends Controller
{



    public function redirectToGoogle()
    {
        $url = Socialite::driver('google')
            ->stateless()
            ->scopes([
                'openid',
                'profile',
                'email',
                'https://www.googleapis.com/auth/calendar.events',
            ])
            ->with([
                'access_type'            => 'offline',
                'prompt'                 => 'consent',
                'include_granted_scopes' => 'true',
            ])
            ->redirect()
            ->getTargetUrl();

        return response()->json([
            'url' => $url,
        ]);
    }

    public function handleGoogleCallback22(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            \Log::info('Google OAuth Response', [
                'access_token'  => $googleUser->token,
                'refresh_token' => $googleUser->refreshToken,
                'expires_in'    => $googleUser->expiresIn,
            ]);

            $email = strtolower($googleUser->getEmail());

            // Restrict to your specific email only
            if ($email !== 'careermentorz.global@gmail.com') {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied. Unauthorized email address.',
                ], 403);
            }

            $user = User::updateOrCreate([
                'google_id' => $googleUser->getId(),
            ], [
                'name'                    => $googleUser->getName(),
                'email'                   => $googleUser->getEmail(),
                'password'                => null,
                'google_token'            => $googleUser->token,
                'google_refresh_token'    => $googleUser->refreshToken,
                'google_token_expires_at' => now()->addSeconds($googleUser->expiresIn ?? 3600),
                'avatar'                  => $googleUser->getAvatar(),
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'success' => true,
                'message' => 'Google login successful',
                'user'    => $user,
                'token'   => $token,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Google login failed: ' . $e->getMessage(),
            ], 400);
        }
    }
    
    
    public function handleGoogleCallback(Request $request)
{
    try {
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->user();

        \Log::info('Google OAuth Response', [
            'access_token'  => $googleUser->token,
            'refresh_token' => $googleUser->refreshToken,
            'expires_in'    => $googleUser->expiresIn,
        ]);

        $email = strtolower($googleUser->getEmail());

        // Restrict to your specific email only
        if ($email !== 'careermentorz.global@gmail.com') {
            // Redirect back to frontend with error
            $frontendUrl = env('FRONTEND_URL', 'http://localhost:5173');
            return redirect($frontendUrl . '/admin/login?error=unauthorized');
        }

        $user = User::updateOrCreate([
            'google_id' => $googleUser->getId(),
        ], [
            'name'                    => $googleUser->getName(),
            'email'                   => $googleUser->getEmail(),
            'password'                => null,
            'google_token'            => $googleUser->token,
            'google_refresh_token'    => $googleUser->refreshToken,
            'google_token_expires_at' => now()->addSeconds($googleUser->expiresIn ?? 3600),
            'avatar'                  => $googleUser->getAvatar(),
        ]);

        $token = JWTAuth::fromUser($user);

        // ✅ Redirect to frontend instead of returning JSON
        $frontendUrl = env('FRONTEND_URL', 'http://localhost:5173');

        return redirect(
            $frontendUrl . '/admin/google/callback?' . http_build_query([
                'token'   => $token,
                'success' => 'true',
            ])
        );

    } catch (\Exception $e) {
        $frontendUrl = env('FRONTEND_URL', 'http://localhost:5173');
        return redirect(
            $frontendUrl . '/admin/login?error=' . urlencode('Google login failed')
        );
    }
}


  public function me(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (! $user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'user'    => $user,
            ]);

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token has expired',
            ], 401);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token is invalid',
            ], 401);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Authorization token not found',
            ], 401);
        }
    }

}