<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Don't Pause Your Digital Presence</title>
</head>
<body style="margin:0;padding:0;background:#f5f7fa;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f7fa;padding:30px 0;">
    <tr>
        <td align="center">

            <table width="700" cellpadding="0" cellspacing="0"
                   style="background:#ffffff;border-radius:10px;overflow:hidden;">

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
                            Don't Pause Your Digital Presence
                        </h2>

                        <p>
                            Hi <strong>{{ $user->name }}</strong>,
                        </p>

                        <p>
                            Your Mi Profile Access is coming up for renewal.
                        </p>

                        <p>
                            Your digital presence, smart sharing tools,
                            profile links, QR access, meeting booking,
                            and business identity are all active right now.
                        </p>

                        <p>
                            Let's keep it that way.
                        </p>

                        <ul>
                            <li>No pause.</li>
                            <li>No missed connections.</li>
                            <li>No starting again.</li>
                        </ul>

                        <h3 style="color:#007979;">
                            Renewal Summary
                        </h3>

                        <table width="100%" cellpadding="10" cellspacing="0"
                               style="border-collapse:collapse;border:1px solid #e5e7eb;">

                            <tr style="background:#f8fafc;">
                                <td width="40%">
                                    <strong>Access Type</strong>
                                </td>
                                <td>
                                    Digital Business Card
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <strong>Quantity</strong>
                                </td>
                                <td>1</td>
                            </tr>

                            <tr style="background:#f8fafc;">
                                <td>
                                    <strong>Current Validity Ends On</strong>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($card->expires_at)->format('d M Y') }}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <strong>Renewal Period</strong>
                                </td>
                                <td>
                                    90 Days
                                </td>
                            </tr>

                            <tr style="background:#f8fafc;">
                                <td>
                                    <strong>Renewal Amount</strong>
                                </td>
                                <td>
                                    ₹{{ $amount ?? '0' }}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <strong>Payment Status</strong>
                                </td>
                                <td>
                                    Paid
                                </td>
                            </tr>

                        </table>

                        <br>

                        <div style="text-align:center;">
                            <a href="{{ $renewalLink ?? env('FRONTEND_URL') }}"
                               style="background:#007979;color:#ffffff;padding:14px 30px;text-decoration:none;border-radius:6px;display:inline-block;">
                                Keep Your Mi Profile Active
                            </a>
                        </div>

                        <br>

                        <h3 style="color:#007979;">
                            What Stays Active After Renewal
                        </h3>

                        <p>
                            <strong>Your Mi Profile Link</strong><br>
                            Continue sharing your profile without changing your link.
                        </p>

                        <p>
                            <strong>Your QR Access</strong><br>
                            Keep using the same QR for instant sharing.
                        </p>

                        <p>
                            <strong>Your Meeting Booking</strong><br>
                            Let people keep booking meetings with you directly.
                        </p>

                        <p>
                            <strong>Your Contact & Business Details</strong><br>
                            Keep your digital identity live, updated, and ready to share.
                        </p>

                        <br>

                        <p>
                            Your Mi Profile is already working for your network.
                        </p>

                        <p>
                            Renew it and keep the connection flow going.
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