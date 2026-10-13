<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($error) Access Denied @else Signing you in... @endif</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #0a0a0a;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #fff;
        }
        .card {
            background: #1a1a1a;
            border: 1px solid #ea580c40;
            border-radius: 16px;
            padding: 40px;
            text-align: center;
            max-width: 400px;
            box-shadow: 0 0 40px rgba(234, 88, 12, 0.1);
        }
        .spinner {
            width: 48px;
            height: 48px;
            border: 4px solid #ea580c20;
            border-top-color: #ea580c;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 20px;
        }
        .error-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #dc2625;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        h2 { margin: 0 0 8px; font-size: 20px; }
        p { margin: 0; color: #9ca3af; font-size: 14px; }
        .error-title { color: #fca5a5; }
        .error-message { color: #d1d5db; margin-top: 12px; font-size: 13px; line-height: 1.5; }
        .btn-retry {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 24px;
            background: #ea580c;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }
        .btn-retry:hover { background: #c2410c; }
    </style>
</head>
<body>
    @if($error)
    <div class="card">
        <div class="error-icon">!</div>
        <h2 class="error-title">Access Denied</h2>
        <p class="error-message">{{ $error }}</p>
        <a href="{{ $redirect_url ?? 'http://localhost:5173' }}/login" class="btn-retry">Go to Login</a>
    </div>
    @else
    <div class="card">
        <div class="spinner"></div>
        <h2>Signing you in...</h2>
        <p>Redirecting to the application</p>
    </div>

    <script>
        // Pass authentication data via URL query parameters (works across different origins)
        var token = @json($token);
        var user = @json(json_encode($user));
        var redirectUrl = @json($redirect_url ?? 'http://localhost:5173');

        var query = '?token=' + encodeURIComponent(token) +
                    '&user=' + encodeURIComponent(JSON.stringify(user));

        window.location.href = redirectUrl + '/login' + query;
    </script>
    @endif
</body>
</html>
