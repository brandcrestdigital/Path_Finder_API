<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Account Updated - Mi Profile</title>
</head>
<body style="margin:0;padding:0;background:#f8f9fc;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f8f9fc;padding:40px 0;">
    <tr>
        <td align="center">
            <table width="650" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.08);">
                
                <tr>
                    <td style="background:linear-gradient(135deg, #FC6C26, #e55a1a);padding:40px;text-align:center;color:#ffffff;">
                        <h1 style="margin:0;font-size:28px;">MI PROFILE</h1>
                        <p style="margin:10px 0 0;">Account Update Notification</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:45px;">
                        <h2 style="color:#1f2937;">Hello {{ $details['name'] }},</h2>
                        
                        <p>Your account details have been successfully updated.</p>
                        
                        <p><strong>Updated Fields:</strong></p>
                        <ul>
                            @foreach($details['changes'] as $change)
                                <li><strong>{{ $change }}</strong></li>
                            @endforeach
                        </ul>

                        @if($details['isPasswordChanged'])
                        <div style="background:#fef3c7;padding:15px;border-radius:8px;margin:20px 0;">
                            <strong>New Temporary Password:</strong> {{ $details['newPassword'] }}
                            <br><br>
                            <strong>Please change your password immediately after logging in.</strong>
                        </div>
                        @endif

                        <p>If you did not request this change, please contact support immediately.</p>

                        <div style="text-align:center;margin:30px 0;">
                            <a href="{{ env('REACT_APP_URL') }}/login" 
                               style="background:#FC6C26;color:white;padding:14px 32px;border-radius:50px;text-decoration:none;font-weight:bold;">
                                Login to Dashboard
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>