<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsubscribed Successfully</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: white;
            max-width: 420px;
            width: 100%;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            text-align: center;
            padding: 40px 30px;
        }
        .icon {
            font-size: 70px;
            margin-bottom: 20px;
        }
        h1 {
            color: #10b981;
            margin: 0 0 12px 0;
            font-size: 28px;
        }
        p {
            color: #555;
            line-height: 1.6;
            font-size: 16px;
        }
        .phone {
            background: #f1f5f9;
            padding: 12px 20px;
            border-radius: 9999px;
            display: inline-block;
            margin: 20px 0;
            font-weight: 600;
            color: #1e2937;
        }
        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 14px 32px;
            background: #1e2937;
            color: white;
            text-decoration: none;
            border-radius: 9999px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #334155;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">✅</div>
        <h1>You've Been Unsubscribed</h1>
        <p>We will no longer send you WhatsApp messages.</p>
        
        <div class="phone">
            {{ $phone }}
        </div>

        <p style="margin-top: 20px; font-size: 14px; color: #777;">
            You can always re-subscribe later by contacting support.
        </p>

     <a href="https://miprofile.in/" class="btn">Go to Homepage</a>
    </div>
</body>
</html>