<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Profile Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 620px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #FC6C26, #ff8a3d);
            color: white;
            padding: 25px 30px;
            text-align: center;
        }
        .logo {
            width: 70px;
            height: 70px;
            margin-bottom: 12px;
        }
        .content {
            padding: 35px 30px;
        }
        h1 {
            margin: 0 0 8px 0;
            font-size: 24px;
        }
        .subtitle {
            margin: 0;
            opacity: 0.95;
            font-size: 15px;
        }
        .info-box {
            background: #f9f9f9;
            border-left: 5px solid #FC6C26;
            padding: 20px;
            margin: 25px 0;
            border-radius: 6px;
        }
        .label {
            font-weight: 600;
            color: #555;
            display: block;
            margin-bottom: 4px;
            font-size: 13px;
        }
        .value {
            color: #222;
            font-size: 15px;
            word-break: break-all;
        }
        .report-box {
            background: #fffaf0;
            border: 1px solid #ffe4c4;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        footer {
            background: #f8f8f8;
            padding: 20px;
            text-align: center;
            color: #777;
            font-size: 13px;
            border-top: 1px solid #eee;
        }
        a {
            color: #FC6C26;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
    <img src="https://miprofile.in/wp-content/uploads/2026/06/Logo-11-06-Png-black-orange-transparent.png" 
         alt="MI Profile Logo" 
         class="logo"
         style="width: 75px; height: 75px; border-radius: 12px; background: white; padding: 8px;">
    <h1>New Profile Report</h1>
    <p class="subtitle">A user has reported a profile</p>
</div>

        <!-- Content -->
        <div class="content">
            <div class="info-box">
                <span class="label">Reporter Name</span>
                <span class="value">{{ $data['reporter_name'] ?? 'N/A' }}</span>
            </div>

            <div class="info-box">
                <span class="label">Reported Profile</span>
                <span class="value">
                    <a href="{{ $data['reported_profile_url'] ?? '#' }}" target="_blank">
                        {{ $data['reported_profile_url'] ?? 'N/A' }}
                    </a>
                </span>
            </div>

            <div class="info-box">
                <span class="label">Organization Email</span>
                <span class="value">{{ $data['organization_email'] ?? 'N/A' }}</span>
            </div>

            <!-- Report Details -->
            <div class="report-box">
                <p style="margin:0 0 8px 0; font-weight:600; color:#d97706;">Report Details:</p>
                <p style="margin:0; line-height:1.6; color:#444;">
                    {{ $data['report_details'] ?? 'No details provided.' }}
                </p>
            </div>

            <p style="text-align:center; margin-top:30px; color:#666; font-size:14px;">
                This report was submitted via your Digital Card System.
            </p>
        </div>

        <!-- Footer -->
        <footer>
            © {{ date('Y') }} MI Profile • All Rights Reserved<br>
            Report Received on: {{ now()->format('d F Y, h:i A') }}
        </footer>
    </div>
</body>
</html>