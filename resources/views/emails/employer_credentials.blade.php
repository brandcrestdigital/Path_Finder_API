<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>You're Live on Mi Profile</title>
</head>
<body style="margin:0;padding:0;background:#f8f9fc;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f8f9fc;padding:40px 0;">
    <tr>
        <td align="center">

            <table width="680" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.08);">

                <!-- Header -->
                <tr>
                    <td style="background:linear-gradient(135deg, #FC6C26, #e55a1a);padding:40px 30px;text-align:center;color:#ffffff;">
                        <h1 style="margin:0;font-size:32px;font-weight:800;letter-spacing:-1px;">
                            MI PROFILE
                        </h1>
                        <p style="margin:10px 0 0 0;font-size:18px;opacity:0.95;">
                            Connect Beyond Contacts
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:50px 45px;">

                        <h2 style="color:#1f2937;font-size:26px;margin:0 0 20px 0;">
                            🎉 Your Workspace Is Now Live!
                        </h2>

                        <p style="font-size:17px;line-height:1.6;color:#374151;">
                            Hi <strong>{{ $user->name }}</strong>,
                        </p>

                        <p style="font-size:17px;line-height:1.6;color:#374151;">
                            Welcome to Mi Profile, {{ $user->name }}.
                        </p>

                        <p style="font-size:17px;line-height:1.6;color:#374151;">
                            You are now set up with a smarter way to connect, share, meet, and grow your network.
                        </p>

                        <p style="font-size:17px;line-height:1.6;color:#374151;">
                            No more boring visiting cards.<br>
                            No more lost contacts.<br>
                            No more “send me your number again.”
                        </p>

                        <p style="font-size:17px;line-height:1.6;color:#374151;">
                            With Mi Profile, your organization gets a smart digital identity built for modern networking.
                        </p>

                        <!-- Login Details -->
                        <h3 style="color:#FC6C26;margin:35px 0 15px 0;font-size:20px;">
                            Your Login Details
                        </h3>

                        <table width="100%" cellpadding="14" cellspacing="0" style="border-collapse:collapse;border:1px solid #e5e7eb;border-radius:10px;background:#fafafa;">
                            <tr style="background:#f8fafc;">
                                <td width="38%" style="font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">
                                    Login URL
                                </td>
                                <td style="border-bottom:1px solid #e5e7eb;color:#111827;">
                                    {{ env('FRONTEND_URL') }}/login
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb;">
                                    Username
                                </td>
                                <td style="border-bottom:1px solid #e5e7eb;color:#111827;">
                                    {{ $user->email }}
                                </td>
                            </tr>
                            <tr style="background:#f8fafc;">
                                <td style="font-weight:600;color:#374151;">
                                    Temporary Password
                                </td>
                                <td style="color:#111827;font-weight:600;">
                                    {{ $password }}
                                </td>
                            </tr>
                        </table>

                        <div style="background:#fff8e1;border-left:5px solid #ff9800;padding:18px 20px;margin:25px 0;border-radius:8px;">
                            <strong>🔐 For security, please change your password after your first login.</strong>
                        </div>

                        <!-- First 3 Moves -->
                        <h3 style="color:#FC6C26;margin:40px 0 18px 0;font-size:20px;">
                            Your First 3 Moves
                        </h3>

                        <div style="background:#f8fafc;border:1px solid #e5e7eb;padding:20px;margin-bottom:16px;border-radius:12px;">
                            <strong style="color:#FC6C26;font-size:18px;">01. Brand it</strong><br>
                            Add your logo, company details, cover image, and business identity.
                        </div>

                        <div style="background:#f8fafc;border:1px solid #e5e7eb;padding:20px;margin-bottom:16px;border-radius:12px;">
                            <strong style="color:#FC6C26;font-size:18px;">02. Build it</strong><br>
                            Create your first Mi Profile with contact details, social links, QR, NFC-ready profile, files, and meeting booking.
                        </div>

                        <div style="background:#f8fafc;border:1px solid #e5e7eb;padding:20px;border-radius:12px;">
                            <strong style="color:#FC6C26;font-size:18px;">03. Share it</strong><br>
                            Start sharing your profile through WhatsApp, email, QR, NFC, and direct links.
                        </div>

                        <p style="font-size:17px;line-height:1.6;color:#374151;margin:35px 0;">
                            Your digital networking space is ready.
                        </p>

                        <!-- CTA Button -->
                        <div style="text-align:center;margin:35px 0;">
                            <a href="{{ env('REACT_APP_URL') }}/login"
                               style="background:#FC6C26;
                                      color:#ffffff;
                                      text-decoration:none;
                                      padding:16px 40px;
                                      border-radius:50px;
                                      display:inline-block;
                                      font-weight:700;
                                      font-size:17px;
                                      box-shadow:0 6px 20px rgba(252, 108, 38, 0.3);
                                      transition:all 0.3s;">
                                🚀 Enter Your Dashboard Now
                            </a>
                        </div>

                        <p style="font-size:18px;text-align:center;color:#1f2937;font-weight:500;">
                            Let every introduction do more.
                        </p>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background:#f8fafc;padding:35px;text-align:center;color:#64748b;font-size:15px;">
                        <strong style="color:#1f2937;">Team Mi Profile</strong><br><br>
                        Connect Beyond Contacts.
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>