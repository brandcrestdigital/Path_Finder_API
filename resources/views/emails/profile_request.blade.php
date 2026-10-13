<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Profile Request</title>
</head>
<body style="margin:0;padding:0;background:#f4f7fa;font-family:Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f7fa;padding:30px 0;">
        <tr>
            <td align="center">

                <table width="650" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background:#0f172a;padding:25px;text-align:center;">
                            <h1 style="color:#ffffff;margin:0;font-size:24px;">
                                New Profile Request
                            </h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:30px;">

                            <p style="font-size:16px;color:#374151;margin-bottom:25px;">
                                A new profile request has been submitted through the website.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0">

                                <tr>
                                    <td style="padding:12px;background:#f8fafc;border-bottom:1px solid #e5e7eb;width:35%;">
                                        <strong>Full Name</strong>
                                    </td>
                                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">
                                        {{ $profileRequest->full_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px;background:#f8fafc;border-bottom:1px solid #e5e7eb;">
                                        <strong>Phone Number</strong>
                                    </td>
                                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">
                                        {{ $profileRequest->phone_number }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px;background:#f8fafc;border-bottom:1px solid #e5e7eb;">
                                        <strong>Email Address</strong>
                                    </td>
                                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">
                                        <a href="mailto:{{ $profileRequest->email }}">
                                            {{ $profileRequest->email }}
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px;background:#f8fafc;border-bottom:1px solid #e5e7eb;">
                                        <strong>Company / Brand</strong>
                                    </td>
                                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">
                                        {{ $profileRequest->company_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px;background:#f8fafc;">
                                        <strong>Profiles Required</strong>
                                    </td>
                                    <td style="padding:12px;">
                                        <span style="
                                            background:#dcfce7;
                                            color:#166534;
                                            padding:6px 12px;
                                            border-radius:20px;
                                            font-weight:bold;
                                        ">
                                            {{ $profileRequest->profiles_required }}
                                        </span>
                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f8fafc;padding:20px;text-align:center;color:#6b7280;font-size:13px;">
                            This email was generated automatically from the website inquiry form.
                            <br><br>
                            © {{ date('Y') }} MI Profile
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>