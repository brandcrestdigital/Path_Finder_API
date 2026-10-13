<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Meeting Cancelled</title>
</head>
<body style="margin:0;padding:0;background:#f5f7fa;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f7fa;padding:30px 0;">
    <tr>
        <td align="center">


        <table width="700" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;">

            <tr>
                <td style="background:#dc2626;padding:30px;text-align:center;color:#ffffff;">

                    <h1 style="margin:0;">
                        MI PROFILE
                    </h1>

                    <p style="margin-top:8px;">
                        Connect Beyond Contacts
                    </p>

                </td>
            </tr>

            <tr>
                <td style="padding:35px;">

                    <h2 style="color:#dc2626;">
                        Schedule Update: Meeting Cancelled
                    </h2>

                    <p>
                        Hi <strong>{{ $meeting->requester_name }}</strong>,
                    </p>

                    <p>
                        Your meeting has been cancelled.
                    </p>

                    <p>
                        The scheduled meeting with
                        <strong>{{ $hostName }}</strong>
                        is no longer active in Mi Profile.
                    </p>

                    <p>
                        No confusion.<br>
                        No extra follow-up needed.<br>
                        The update is done.
                    </p>

                    <h3 style="color:#dc2626;">
                        Cancelled Meeting Details
                    </h3>

                    <table width="100%" cellpadding="10" cellspacing="0"
                           style="border-collapse:collapse;border:1px solid #e5e7eb;">

                        <tr style="background:#f8fafc;">
                            <td width="35%">
                                <strong>Meeting Title</strong>
                            </td>
                            <td>{{ $meeting->title }}</td>
                        </tr>

                        <tr>
                            <td>
                                <strong>With</strong>
                            </td>
                            <td>{{ $hostName }}</td>
                        </tr>

                        <tr style="background:#f8fafc;">
                            <td>
                                <strong>Date</strong>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d M Y') }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Time</strong>
                            </td>
                            <td>{{ $meeting->meeting_time }}</td>
                        </tr>

                        <tr style="background:#f8fafc;">
                            <td>
                                <strong>Duration</strong>
                            </td>
                            <td>60 Minutes</td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Time Zone</strong>
                            </td>
                            <td>Asia/Kolkata (IST)</td>
                        </tr>

                        <tr style="background:#f8fafc;">
                            <td>
                                <strong>Meeting Mode</strong>
                            </td>
                            <td>Google Meet</td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Meeting Link / Location</strong>
                            </td>
                            <td>{{ $meeting->meet_link }}</td>
                        </tr>

                        <tr style="background:#fef2f2;">
                            <td>
                                <strong>Status</strong>
                            </td>
                            <td style="color:#dc2626;font-weight:bold;">
                                Cancelled
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Reason</strong>
                            </td>
                            <td>
                                {{ $meeting->cancelled_remarks }}
                            </td>
                        </tr>

                    </table>

                    <br>

                    <h3 style="color:#007979;">
                        Want to schedule again?
                    </h3>

                    <p>
                        You can create a new meeting anytime using the link below:
                    </p>

                    <p style="text-align:center;">
                        <a href="{{ $hostProfileLink  }}"
                           style="background:#007979;
                                  color:#ffffff;
                                  text-decoration:none;
                                  padding:14px 30px;
                                  border-radius:6px;
                                  display:inline-block;
                                  font-weight:bold;">
                            Book New Meeting
                        </a>
                    </p>

                    <br>

                    <p>
                        If this cancellation looks incorrect, please contact us at
                        <a href="mailto:{{ $supportEmail }}">
                            {{ $supportEmail }}
                        </a>.
                    </p>

                </td>
            </tr>

            <tr>
                <td style="background:#f8fafc;padding:25px;text-align:center;color:#666;">

                    <strong>
                        Team Mi Profile
                    </strong>

                    <br><br>

                    Connect Beyond Contacts.

                </td>
            </tr>

        </table>

    </td>
</tr>


</table>

</body>
</html>
