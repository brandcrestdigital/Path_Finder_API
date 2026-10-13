<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Mi Profile</title>
</head>
<body style="margin:0;padding:0;background:#f8f9fc;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f8f9fc;padding:40px 0;">
    <tr>
        <td align="center">

            <table width="650" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.08);">

                <!-- Header -->
                <tr>
                    <td align="center" style="background:linear-gradient(135deg,#FC6C26,#e55a1a);padding:40px;color:#ffffff;">
                        <h1 style="margin:0;font-size:32px;font-weight:800;">MI PROFILE</h1>
                        <p style="margin:10px 0 0;font-size:17px;opacity:0.95;">Connect Beyond Contacts</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:45px 40px;">

                        <h2 style="color:#1f2937;margin-top:0;">🎉 Welcome, {{ $employee->name }}!</h2>

                        <p style="font-size:16px;color:#374151;line-height:1.6;">
                            Your staff account has been created successfully.
                        </p>

                        <div style="background:#f8fafc;border:1px solid #e5e7eb;border-radius:12px;padding:25px;margin:25px 0;">
                            <p style="margin:0 0 12px 0;"><strong>Email:</strong> {{ $employee->email }}</p>
                            <p style="margin:0;"><strong>Temporary Password:</strong></p>
                            <p style="background:#ffffff;border:1px solid #e5e7eb;padding:12px 16px;border-radius:8px;font-family:monospace;margin:8px 0 0 0;">
                                {{ $password }}
                            </p>
                        </div>

                        <p style="color:#374151;font-size:16px;">
                            Please login and change your password immediately for security.
                        </p>

                        <!-- CTA Button -->
                        <div style="text-align:center;margin:35px 0;">
                            <a href="{{ url('/employee/login') }}" 
                               style="background:#FC6C26;color:#ffffff;padding:16px 36px;border-radius:50px;text-decoration:none;font-weight:700;font-size:17px;display:inline-block;">
                                Login to Your Account
                            </a>
                        </div>

                        <p style="color:#64748b;">
                            If you have any questions or need assistance getting started, feel free to reach out to the team.
                        </p>

                        <p style="margin-top:40px;text-align:center;color:#64748b;">
                            Welcome aboard!<br>
                            <strong>Team Mi Profile</strong>
                        </p>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>