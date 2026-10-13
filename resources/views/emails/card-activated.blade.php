<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mi Profile Card Activated</title>
</head>

<body style="margin:0;padding:0;background:#f4f7fb;font-family:Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f7fb;padding:40px 15px;">
<tr>
<td align="center">

<table width="650" cellpadding="0" cellspacing="0"
       style="max-width:650px;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 10px 35px rgba(0,0,0,0.1);">

    <!-- Header -->
    <tr>
        <td align="center"
            style="background:linear-gradient(135deg,#FC6C26,#e55a1a);
            padding:45px 30px;color:#ffffff;">

            <h1 style="margin:0;font-size:34px;font-weight:800;letter-spacing:-1px;">
                ✨ Mi Profile
            </h1>

            <p style="margin:12px 0 0;font-size:17px;opacity:0.95;">
                Connect Beyond Contacts
            </p>

        </td>
    </tr>

    <!-- Content -->
    <tr>
        <td style="padding:45px 40px;">

            <h2 style="margin-top:0;color:#1f2937;font-size:26px;">
                🎉 Your Mi Profile Card Is Activated!
            </h2>

            <p style="font-size:16px;color:#374151;line-height:1.6;">
                Hi {{ $data['customer_name'] }},
            </p>

            <p style="font-size:16px;color:#4b5563;line-height:1.6;">
                Your Mi Profile Card is now activated.
                You just unlocked a smarter way to share your identity,
                build your network, and connect beyond contacts.
            </p>

            <div style="
                background:#fff7ed;
                border-left:5px solid #FC6C26;
                padding:20px;
                border-radius:10px;
                margin:28px 0;
                font-size:15.5px;">
                ✅ No printing<br>
                ✅ No waiting<br>
                ✅ No lost visiting cards
            </div>

            <p style="font-size:16px;color:#4b5563;line-height:1.6;">
                Your digital profile is ready to go live.
            </p>

            <!-- Purchase Details -->
            <h3 style="color:#FC6C26;margin:38px 0 16px 0;font-size:20px;">
                Purchase Details
            </h3>

            <table width="100%" cellpadding="14" cellspacing="0"
                   style="border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;background:#fafafa;">

                <tr style="background:#f8fafc;">
                    <td width="42%"><strong>Order ID</strong></td>
                    <td>{{ $data['order_id'] }}</td>
                </tr>

                <tr>
                    <td><strong>Card / Plan Type</strong></td>
                    <td>{{ $data['card_type'] }}</td>
                </tr>

                <tr style="background:#f8fafc;">
                    <td><strong>Payment Status</strong></td>
                    <td style="color:#166534;font-weight:600;">{{ $data['payment_status'] }}</td>
                </tr>

                <tr>
                    <td><strong>Purchase Date</strong></td>
                    <td>{{ $data['purchase_date'] }}</td>
                </tr>

                <tr style="background:#f8fafc;">
                    <td><strong>Validity</strong></td>
                    <td>{{ $data['validity_period'] }}</td>
                </tr>

                <tr>
                    <td><strong>Activation Status</strong></td>
                    <td>
                        <span style="
                        background:#dcfce7;
                        color:#166534;
                        padding:6px 14px;
                        border-radius:30px;
                        font-size:14px;font-weight:600;">
                            {{ $data['activation_status'] }}
                        </span>
                    </td>
                </tr>

            </table>

            <!-- Access -->
            <h3 style="color:#FC6C26;margin:38px 0 16px 0;font-size:20px;">
                Your Mi Profile Access
            </h3>

            <table width="100%" cellpadding="14" cellspacing="0"
                   style="border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;background:#fafafa;">

                <tr style="background:#f8fafc;">
                    <td width="42%"><strong>Profile Setup Link</strong></td>
                    <td>
                        <a href="{{ $data['profile_setup_link'] }}"
                           style="color:#FC6C26;text-decoration:none;font-weight:500;">
                            Setup Profile →
                        </a>
                    </td>
                </tr>

                <tr>
                    <td><strong>Login URL</strong></td>
                    <td>
                        <a href="{{ $data['login_url'] }}"
                           style="color:#FC6C26;text-decoration:none;font-weight:500;">
                            Login
                        </a>
                    </td>
                </tr>

                <tr style="background:#f8fafc;">
                    <td><strong>Username</strong></td>
                    <td>{{ $data['username'] }}</td>
                </tr>

            </table>

            <!-- CTA -->
            <div style="text-align:center;margin:45px 0 35px 0;">

                <a href="{{ $data['profile_setup_link'] }}"
                   style="
                    display:inline-block;
                    background:linear-gradient(135deg,#FC6C26,#e55a1a);
                    color:#ffffff;
                    text-decoration:none;
                    padding:16px 42px;
                    border-radius:50px;
                    font-size:17px;
                    font-weight:700;
                    box-shadow:0 8px 25px rgba(252, 108, 38, 0.35);">
                    🚀 Setup Your Profile Now
                </a>

            </div>

            <!-- Features -->
            <h3 style="color:#1f2937;margin-bottom:18px;">
                What you can do now
            </h3>

            <p style="font-size:15.5px;line-height:1.7;color:#374151;">
                <strong>01. Complete your profile</strong><br>
                Add your name, company details, contact number, logo,
                social links, services, and profile image.
            </p>

            <p style="font-size:15.5px;line-height:1.7;color:#374151;">
                <strong>02. Generate your smart sharing tools</strong><br>
                Use your QR code, digital profile link, NFC-ready profile,
                and Add-to-Contacts option.
            </p>

            <p style="font-size:15.5px;line-height:1.7;color:#374151;">
                <strong>03. Start sharing instantly</strong><br>
                Share your Mi Profile through WhatsApp, email, QR, NFC,
                social media, and business networking groups.
            </p>

            <div style="
                background:#fefce8;
                border-radius:12px;
                padding:22px;
                margin-top:30px;
                text-align:center;
                border:1px solid #fde047;">

                <strong style="color:#854d0e;">Your networking upgrade is live.</strong>

            </div>

            <p style="margin-top:35px;font-size:16px;color:#374151;">
                Your Mi Profile is not just a card.<br>
                It is your smart professional identity.
            </p>

        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td align="center"
            style="background:#1f2937;color:#e5e7eb;padding:32px;font-size:15px;">

            <strong>Team Mi Profile</strong><br>
            Connect Beyond Contacts.

        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>