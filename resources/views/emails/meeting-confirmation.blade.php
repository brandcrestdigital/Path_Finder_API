
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Meeting Scheduled via Mi Profile</title>
</head>
<body style="margin:0;padding:0;background:#f5f7fa;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f7fa;padding:30px 0;">
    <tr>
        <td align="center">

            <table width="700" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;">

                <tr>
                    <td style="background:#007979;padding:30px;text-align:center;color:#ffffff;">

                        <h1 style="margin:0;">MI PROFILE</h1>

                        <p style="margin-top:8px;">
                            Connect Beyond Contacts
                        </p>

                    </td>
                </tr>

                <tr>
                    <td style="padding:35px;">

                        <h2 style="color:#007979;">
                            Your Meeting Has Been Scheduled
                        </h2>

                        <p>
                            Hi <strong>{{ $meeting->requester_name }}</strong>,
                        </p>

                        <p>
                            Your meeting has been created successfully.
                        </p>

                        <p>
                            Everything is set.
                        </p>

                        <p>
                            You have scheduled a meeting with
                            <strong>{{ $hostName }}</strong>
                            through Mi Profile.
                        </p>

                        <h3 style="color:#007979;">
                            Meeting Details
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
                                    <strong>Meeting Link</strong>
                                </td>
                                <td>
                                    <a href="{{ $meetLink }}">
                                        {{ $meetLink }}
                                    </a>
                                </td>
                            </tr>

                            <tr style="background:#f8fafc;">
                                <td>
                                    <strong>Agenda</strong>
                                </td>
                                <td>
                                    {{ $meeting->description ?? 'Discussion Meeting' }}
                                </td>
                            </tr>

                        </table>

                        <br>

                      
                        <br>

                        <h3 style="color:#007979;">
                            Need to make a change?
                        </h3>

                       

                        <p>
                            <strong>Cancel Meeting</strong>
                            <br>
                            <a href="{{ $cancelLink }}">
                                {{ $cancelLink }}
                            </a>
                        </p>

                        <br>

                        <p>
                            Before the meeting, you can view
                            <strong>{{ $hostName }}</strong>'s Mi Profile here:
                        </p>

                        <p>
                            <a href="{{ $hostProfileLink }}">
                                {{ $hostProfileLink }}
                            </a>
                        </p>

                        <br>

                        <p>
                            A reminder will be sent before the meeting.
                        </p>

                        <p>
                            See you soon.
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

