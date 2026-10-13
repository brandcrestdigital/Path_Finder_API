<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mi Profile Invoice #{{ $invoiceNo }}</title>
</head>
<body style="margin:0;padding:0;background:#f8f9fc;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f8f9fc;padding:40px 0;">
    <tr>
        <td align="center">

            <table width="700" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.08);">

                <!-- Header -->
                <tr>
                    <td align="center" style="background:linear-gradient(135deg,#FC6C26,#e55a1a);padding:40px;color:#ffffff;">
                        <h1 style="margin:0;font-size:32px;font-weight:800;">MI PROFILE</h1>
                        <p style="margin:8px 0 0;font-size:17px;opacity:0.95;">Connect Beyond Contacts</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding:45px 40px;">

                        <h2 style="color:#1f2937;margin-top:0;">
                            Invoice #{{ $invoiceNo }}
                        </h2>

                        <p style="font-size:16px;color:#374151;">
                            Hi <strong>{{ $purchase->organization->name }}</strong>,
                        </p>

                        <p style="font-size:16px;color:#374151;">
                            Your Mi Profile invoice has been generated successfully.
                        </p>

                        <!-- Invoice Summary -->
                        <h3 style="color:#FC6C26;margin:35px 0 15px 0;">Invoice Summary</h3>

                        <table width="100%" cellpadding="12" cellspacing="0" style="border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;background:#fafafa;">
                            <tr style="background:#f8fafc;">
                                <td width="45%"><strong>Invoice Number</strong></td>
                                <td>{{ $invoiceNo }}</td>
                            </tr>
                            <tr>
                                <td><strong>Order ID</strong></td>
                                <td>#{{ $purchase->id }}</td>
                            </tr>
                            <tr style="background:#f8fafc;">
                                <td><strong>Access Type</strong></td>
                                <td>Digital Business Card</td>
                            </tr>
                            <tr>
                                <td><strong>Quantity</strong></td>
                                <td>{{ $purchase->total_cards }} Cards</td>
                            </tr>
                            <tr style="background:#f8fafc;">
                                <td><strong>Validity</strong></td>
                                <td>{{ $purchase->validity_days }} Days</td>
                            </tr>
                            <tr>
                                <td><strong>Invoice Date</strong></td>
                                <td>{{ $purchase->start_date }}</td>
                            </tr>
                            <tr style="background:#f8fafc;">
                                <td><strong>Due Date</strong></td>
                                <td>{{ $purchase->expiry_date }}</td>
                            </tr>
                            <tr>
                                <td><strong>Payment Status</strong></td>
                                <td>
                                    <span style="background:#dcfce7;color:#166534;padding:4px 12px;border-radius:20px;font-size:14px;">
                                        {{ ucfirst($purchase->payment_status ?? 'Paid') }}
                                    </span>
                                </td>
                            </tr>
                        </table>

                        <br>

                        <!-- Amount Details -->
                        <h3 style="color:#FC6C26;margin:35px 0 15px 0;">Amount Details</h3>

                        <table width="100%" cellpadding="12" cellspacing="0" style="border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;background:#fafafa;">
                            <tr style="background:#f8fafc;">
                                <td width="45%"><strong>Subtotal</strong></td>
                                <td>₹{{ number_format($purchase->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tax / GST</strong></td>
                                <td>₹{{ number_format($purchase->gst_amount, 2) }}</td>
                            </tr>
                            <tr style="background:#f8fafc;">
                                <td><strong>Discount</strong></td>
                                <td>₹{{ number_format($purchase->discount_amount ?? 0, 2) }}</td>
                            </tr>
                            <tr style="background:#f0fdf4;font-size:18px;">
                                <td><strong>Total Amount</strong></td>
                                <td>
                                    <strong>₹{{ number_format($purchase->total_amount, 2) }}</strong>
                                </td>
                            </tr>
                        </table>

                        <br><br>

                        <!-- Download Section -->
                        <h3 style="color:#FC6C26;">Download Your Invoice</h3>
                        <p style="font-size:16px;color:#374151;">
                            You can view or download your invoice using the link below:
                        </p>

                        <div style="text-align:center;margin:25px 0;">
                            <a href="{{ $downloadUrl }}" 
                               style="background:#FC6C26;color:#ffffff;padding:14px 32px;border-radius:50px;text-decoration:none;font-weight:700;display:inline-block;">
                                📄 Download Invoice
                            </a>
                        </div>

                        @if(!empty($paymentLink))
                        <div style="background:#fef3c7;padding:18px;border-radius:10px;margin:20px 0;text-align:center;">
                            <strong>Payment Pending?</strong><br>
                            <a href="{{ $paymentLink }}" style="color:#FC6C26;font-weight:600;">
                                Complete Payment Now →
                            </a>
                        </div>
                        @endif

                        <p style="color:#374151;">
                            Your Mi Profile access is ready. Start building your digital identity and connect smarter.
                        </p>

                        <p style="color:#374151;">
                            Need help? Reach us at 
                            <a href="mailto:{{ $supportEmail }}" style="color:#FC6C26;">{{ $supportEmail }}</a>
                        </p>

                        <br>

                        <p style="text-align:center;color:#64748b;">
                            Team Mi Profile<br>
                            <strong>Connect Beyond Contacts.</strong>
                        </p>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>