<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Webinar Approval</title>
</head>

<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f7fb;padding:40px 15px;">
        <tr>
            <td align="center">

                <table width="650" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.08);">

                    <!-- Header -->
                    <tr>
                        <td align="center"
                            style="background:linear-gradient(135deg,#2563eb,#0f766e);padding:35px;">

                            <h1 style="color:#fff;margin:0;font-size:30px;">
                                🎉 Congratulations!
                            </h1>

                            <p style="color:#eaf3ff;margin-top:10px;font-size:16px;">
                                Your Webinar Registration has been Approved
                            </p>

                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:35px;">

                            <p style="font-size:18px;color:#333;">
                                Hi <strong>{{ $application->full_name }}</strong>,
                            </p>

                            <p style="font-size:15px;line-height:28px;color:#555;">
                                Congratulations! Your registration has been
                                <strong style="color:#16a34a;">Approved</strong>.
                                We are excited to have you join our upcoming webinar.
                            </p>

                            <table width="100%" cellpadding="12" cellspacing="0"
                                style="margin-top:25px;border:1px solid #e5e7eb;border-radius:10px;background:#f8fafc;">

                                <tr>
                                    <td width="35%" style="font-weight:bold;color:#1e3a8a;">
                                        📚 Webinar
                                    </td>
                                    <td style="color:#444;">
                                        {{ $webinar->title }}
                                    </td>
                                </tr>

                                <tr style="background:#fff;">
                                    <td style="font-weight:bold;color:#1e3a8a;">
                                        📅 Date
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($webinar->date)->format('d M Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold;color:#1e3a8a;">
                                        🕒 Time
                                    </td>
                                    <td>
                                        {{ date('h:i A', strtotime($webinar->start_time)) }}
                                        -
                                        {{ date('h:i A', strtotime($webinar->end_time)) }}
                                    </td>
                                </tr>

                                <tr style="background:#fff;">
                                    <td style="font-weight:bold;color:#1e3a8a;">
                                        🎥 Meeting Link
                                    </td>
                                    <td>
                                        <a href="{{ $meetingLink }}"
                                            style="color:#2563eb;text-decoration:none;font-weight:bold;">
                                            {{ $meetingLink }}
                                        </a>
                                    </td>
                                </tr>

                            </table>

                            <div style="text-align:center;margin:40px 0;">

                                <a href="{{ $meetingLink }}"
                                    style="background:#2563eb;
                                    color:#ffffff;
                                    text-decoration:none;
                                    padding:15px 35px;
                                    border-radius:8px;
                                    display:inline-block;
                                    font-size:17px;
                                    font-weight:bold;">

                                    🚀 Join Webinar

                                </a>

                            </div>

                            <div style="background:#eff6ff;
                                border-left:5px solid #2563eb;
                                padding:18px;
                                border-radius:6px;">

                                <strong style="color:#1d4ed8;">
                                    Important Instructions
                                </strong>

                                <ul style="margin-top:10px;color:#555;line-height:28px;padding-left:20px;">
                                    <li>Join the meeting at least <strong>10 minutes early.</strong></li>
                                    <li>Keep your microphone on mute unless speaking.</li>
                                    <li>Use a stable internet connection.</li>
                                    <li>Have a notebook ready for important points.</li>
                                </ul>

                            </div>

                            <p style="margin-top:35px;color:#555;line-height:28px;">
                                We look forward to seeing you in the webinar.
                                If you have any questions, simply reply to this email.
                            </p>

                            <p style="margin-top:30px;color:#333;">
                                Regards,<br>
                                <strong>CareerMentorz Team</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="background:#111827;color:#d1d5db;padding:25px;font-size:13px;">

                            © {{ date('Y') }} CareerMentorz. All Rights Reserved.

                            <br><br>

                            This is an automated email. Please do not reply directly.

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>