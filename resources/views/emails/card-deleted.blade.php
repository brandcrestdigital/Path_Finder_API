<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Card Deleted</title>
</head>
<body style="margin:0;padding:0;background:#f8f9fc;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f8f9fc;padding:40px 0;">
    <tr>
        <td align="center">
            <table width="650" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.08);">
                
                <tr>
                    <td style="background:linear-gradient(135deg,#FC6C26,#e55a1a);padding:40px;text-align:center;color:#ffffff;">
                        <h1 style="margin:0;">MI PROFILE</h1>
                        <p style="margin:10px 0 0;">Card Deletion Notification</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:45px;">
                        <h2>Hello {{ $details['employer_name'] }},</h2>
                        
                        <p>A staff member's digital card has been deleted.</p>
                        
                        <div style="background:#f8fafc;padding:20px;border-radius:12px;margin:20px 0;">
                            <strong>Deleted User:</strong> {{ $details['deleted_user_name'] }}<br>
                            <strong>Email:</strong> {{ $details['deleted_user_email'] }}
                        </div>

                        <p>This action was performed successfully. The user no longer has access to the Mi Profile system.</p>

                        <p>If this was done by mistake, you can create a new card for the user from the dashboard.</p>

                        <div style="text-align:center;margin:30px 0;">
                            <a href="{{ url('/admin/organizations') }}" 
                               style="background:#FC6C26;color:white;padding:14px 32px;border-radius:50px;text-decoration:none;font-weight:bold;">
                                Go to Dashboard
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