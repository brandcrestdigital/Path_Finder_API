



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoiceNo }}</title>

<style>
    @page {
        margin: 0;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'DejaVu Sans', 'Helvetica', 'Arial', sans-serif;
        color: #1e293b;
        font-size: 12px;
        line-height: 1.7;
        background: #ffffff;
    }

    /* ========== TOP ACCENT BAR ========== */
    .top-accent {
        width: 100%;
        height: 6px;
        background: #007979;
    }

    /* ========== MAIN CONTAINER ========== */
    .page-container {
        padding: 30px 40px 20px 40px;
    }

    /* ========== HEADER ========== */
    .header-table {
        width: 100%;
        margin-bottom: 20px;
    }

    .header-table td {
        vertical-align: middle;
        border: none;
    }

    .logo-cell {
        width: 55%;
    }

    .logo-cell img {
        width: 200px;
        height: auto;
    }

    .invoice-badge {
        display: inline-block;
        background: #007979;
        color: #ffffff;
        font-size: 32px;
        font-weight: 700;
        letter-spacing: 6px;
        padding: 14px 28px;
        border-radius: 6px;
        text-align: center;
    }

    .invoice-badge-sub {
        font-size: 10px;
        letter-spacing: 4px;
        display: block;
        font-weight: 400;
        margin-top: 2px;
        opacity: 0.9;
    }

    /* ========== META CARD ========== */
    .meta-table-outer {
        width: 100%;
    }

    .meta-table-outer td {
        width: 50%;
        border: none;
        vertical-align: top;
        padding: 0;
    }

    .meta-table-outer td.meta-gap {
        width: 15px;
    }

    .meta-card {
        border: 1px solid #dce5ec;
        border-left: 4px solid #007979;
        background: #f8fafb;
        border-radius: 6px;
        padding: 14px 18px;
    }

    .meta-card table {
        width: 100%;
    }

    .meta-card td {
        border: none;
        padding: 3px 0;
        font-size: 12px;
    }

    .meta-card .label {
        color: #64748b;
        font-weight: 600;
        width: 90px;
    }

    .meta-card .value {
        color: #1e293b;
        font-weight: 600;
    }

    .status-paid {
        display: inline-block;
        background: #d1fae5;
        color: #065f46;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 14px;
        border-radius: 20px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .status-unpaid {
        display: inline-block;
        background: #fee2e2;
        color: #991b1b;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 14px;
        border-radius: 20px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    /* ========== DIVIDER ========== */
    .section-divider {
        border: none;
        border-top: 1px solid #e2e8f0;
        margin: 22px 0;
    }

    /* ========== BILLING BOXES ========== */
    .billing-table {
        width: 100%;
    }

    .billing-table td {
        vertical-align: top;
        border: none;
        padding: 0;
    }

    .billing-table td.bill-col {
        width: 48%;
    }

    .billing-table td.bill-gap {
        width: 4%;
    }

    .billing-box {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
        padding: 20px 22px;
    }

    .billing-box .box-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: #007979;
        margin-bottom: 14px;
        padding-bottom: 10px;
        border-bottom: 2px solid #007979;
        display: inline-block;
    }

    .billing-box .company-name {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .billing-box p {
        margin: 2px 0;
        color: #475569;
    }

    .billing-box .info-row {
        margin-top: 8px;
    }

    .billing-box .info-row strong {
        color: #334155;
    }

    .gst-badge-premium {
        display: inline-block;
        background: #007979;
        color: #ffffff;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        padding: 6px 14px;
        border-radius: 4px;
        margin-top: 12px;
        text-transform: uppercase;
    }

    /* ========== ITEMS TABLE ========== */
    .items-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
        table-layout: fixed;
    }

    .items-table thead th {
        background: #007979;
        color: #ffffff;
        padding: 12px 16px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .items-table thead th.th-desc {
        text-align: left;
        border-radius: 6px 0 0 0;
    }

    .items-table thead th.th-qty {
        text-align: center;
    }

    .items-table thead th.th-price {
        text-align: right;
    }

    .items-table thead th.th-amount {
        text-align: right;
        border-radius: 0 6px 0 0;
    }

    .items-table tbody td {
        padding: 13px 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 12px;
        color: #334155;
    }

    .items-table tbody td.td-desc {
        text-align: left;
    }

    .items-table tbody td.td-qty {
        text-align: center;
    }

    .items-table tbody td.td-price {
        text-align: right;
    }

    .items-table tbody td.td-amount {
        text-align: right;
    }

    .items-table tbody tr:nth-child(even) {
        background: #f8fafc;
    }

    .items-table tbody tr:last-child td {
        border-bottom: 1px solid #e2e8f0;
    }

    .item-description {
        font-weight: 600;
        color: #0f172a;
    }

    .item-meta {
        font-size: 10px;
        color: #94a3b8;
        margin-top: 2px;
    }

    /* ========== SUMMARY TABLE ========== */
    .summary-wrapper {
        margin-top: 20px;
        margin-bottom: 25px;
    }

    .summary-label-badge {
        text-align: right;
        margin-bottom: 8px;
    }

    .summary-label-badge span {
        display: inline-block;
        background: #f8fafb;
        border: 1px solid #e2e8f0;
        padding: 6px 14px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 700;
        color: #007979;
        letter-spacing: 1px;
    }

    .summary-table {
        width: 42%;
        border-collapse: collapse;
        border: 1px solid #e2e8f0;
        table-layout: fixed;
    }

    .summary-table td {
        padding: 11px 18px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 12px;
    }

    .summary-table td.s-label {
        color: #64748b;
        font-weight: 600;
        width: 55%;
        text-align: left;
    }

    .summary-table td.s-value {
        font-weight: 600;
        color: #1e293b;
        width: 45%;
        text-align: right;
    }

    .summary-table .discount-row td {
        color: #059669;
        font-weight: 600;
    }

    .summary-table .gst-row td {
        color: #2563eb;
        font-weight: 600;
    }

    .summary-table .total-row td {
        background: #007979;
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        padding: 14px 18px;
        border-bottom: none;
        letter-spacing: 1px;
    }

    .summary-table .total-row td.s-label,
    .summary-table .total-row td.s-value {
        color: #ffffff;
    }

    .summary-table tr:last-child td {
        border-bottom: none;
    }

    /* ========== AMOUNT IN WORDS ========== */
    .amount-words {
        margin-top: 8px;
        color: #64748b;
        font-size: 11px;
        font-style: italic;
        text-align: left;
    }

    /* ========== FOOTER INFO SECTION ========== */
    .info-section {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
    }

    .info-table {
        width: 100%;
    }


    .summary-wrapper {
    margin-top: 20px;
    margin-bottom: 25px;
    width: 100%;
}

.summary-table {
    width: 320px;      /* Fixed width instead of 42% */
    margin-left: auto; /* Right align */
    border-collapse: collapse;
    border: 1px solid #e2e8f0;
}

    .info-table td {
        vertical-align: top;
        border: none;
        padding: 0;
        width: 50%;
    }

    .info-box-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #007979;
        margin-bottom: 10px;
    }

    .info-box p, .info-box li {
        font-size: 11px;
        color: #64748b;
        margin: 3px 0;
        line-height: 1.6;
    }

    .info-box ul {
        list-style: none;
        padding: 0;
    }

    .info-box ul li::before {
        content: "•";
        color: #007979;
        font-weight: bold;
        margin-right: 8px;
    }

    /* ========== SIGNATURE BLOCK ========== */
    .signature-block {
        margin-top: 30px;
        text-align: right;
    }

    .signature-block .sig-label {
        font-size: 11px;
        color: #64748b;
        margin-bottom: 30px;
    }

    .signature-block .sig-line {
        display: inline-block;
        width: 180px;
        border-bottom: 1px solid #94a3b8;
        margin-bottom: 4px;
    }

    .signature-block .sig-name {
        font-size: 12px;
        font-weight: 700;
        color: #0f172a;
    }

    .signature-block .sig-role {
        font-size: 10px;
        color: #94a3b8;
    }

    /* ========== FINAL FOOTER ========== */
    .final-footer {
        margin-top: 50px;
        padding-top: 18px;
        border-top: 2px solid #007979;
        text-align: center;
        color: #64748b;
        font-size: 11px;
        line-height: 1.8;
    }

    .final-footer .brand-name {
        color: #007979;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 1px;
    }

    .final-footer .tagline {
        color: #94a3b8;
        font-size: 11px;
        font-style: italic;
    }

    .page-number {
        text-align: right;
        font-size: 10px;
        color: #cbd5e1;
        margin-top: 10px;
    }

    .clearfix {
        clear: both;
    }
</style>

</head>

<body>

<!-- TOP ACCENT BAR -->
<div class="top-accent"></div>

<!-- MAIN CONTAINER -->
<div class="page-container">

    @php
        $logo = public_path('images/logo.png');
        $logoBase64 = (file_exists($logo))
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logo))
            : null;
    @endphp

    <!-- ==================== HEADER ==================== -->
    <table class="header-table">
        <tr>
            <td class="logo-cell">
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" alt="Mi Profile">
                @endif
            </td>
            <td style="text-align:right;">
                <div class="invoice-badge">
                    INVOICE
                    <span class="invoice-badge-sub">TAX INVOICE</span>
                </div>
            </td>
        </tr>
    </table>

    <!-- ==================== META INFO CARDS ==================== -->
    <table class="meta-table-outer">
        <tr>
            <td>
                <div class="meta-card">
                    <table>
                        <tr>
                            <td class="label">Invoice No</td>
                            <td class="value">{{ $invoiceNo }}</td>
                        </tr>
                        <tr>
                            <td class="label">Invoice Date</td>
                            <td class="value">{{ $purchase->created_at->format('d M Y') }}</td>
                        </tr>
                        @if(!empty($purchase->start_date))
                        <tr>
                            <td class="label">Period Start</td>
                            <td class="value">{{ \Carbon\Carbon::parse($purchase->start_date)->format('d M Y') }}</td>
                        </tr>
                        @endif
                        @if(!empty($purchase->expiry_date))
                        <tr>
                            <td class="label">Due Date</td>
                            <td class="value">{{ \Carbon\Carbon::parse($purchase->expiry_date)->format('d M Y') }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </td>
            <td class="meta-gap"></td>
            <td>
                <div class="meta-card">
                    <table>
                        <tr>
                            <td class="label">Order ID</td>
                            <td class="value">#{{ $purchase->id }}</td>
                        </tr>
                        <tr>
                            <td class="label">Validity</td>
                            <td class="value">{{ $purchase->validity_days ?? '--' }} Days</td>
                        </tr>
                        <tr>
                            <td class="label">Payment</td>
                            <td class="value">
                                @php $pStatus = $purchase->payment_status ?? 'paid'; @endphp
                                @if(strtolower($pStatus) === 'paid')
                                    <span class="status-paid">PAID</span>
                                @else
                                    <span class="status-unpaid">{{ strtoupper($pStatus) }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <!-- DIVIDER -->
    <hr class="section-divider">

    <!-- ==================== BILLING INFO ==================== -->
    <table class="billing-table">
        <tr>
            <td class="bill-col">
                <div class="billing-box">
                    <span class="box-title">Bill From</span>
                    <div class="company-name">BRAND CREST DIGITAL</div>
                    <p>C3013, Brigade Meadows</p>
                    <p>Kanakapura Road, Bengaluru</p>
                    <p>Karnataka - 560082</p>
                    <div class="info-row">
                        <p><strong>Email:</strong> info.miprofile@gmail.com</p>
                        <p><strong>Phone:</strong> +91 87229 81233</p>
                        <p><strong>GSTIN:</strong> 29AAACT2727Q1ZW</p>
                    </div>
                    <span class="gst-badge-premium">GST Registered</span>
                </div>
            </td>
            <td class="bill-gap"></td>
            <td class="bill-col">
                <div class="billing-box">
                    <span class="box-title">Bill To</span>
                    <div class="company-name">{{ $purchase->organization->name }}</div>
                    <p>{{ $purchase->organization->email }}</p>
                    <p>{{ $purchase->organization->phone }}</p>

                    @if($purchase->coupon_code)
                        <div class="info-row" style="margin-top:14px;">
                            <p>
                                <strong style="color:#059669;">
                                    &#10003; Coupon Applied:
                                </strong>
                                <span style="background:#d1fae5;color:#065f46;padding:3px 10px;border-radius:4px;font-weight:700;font-size:11px;">
                                    {{ strtoupper($purchase->coupon_code) }}
                                </span>
                            </p>
                        </div>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <!-- ==================== ITEMS TABLE ==================== -->
    <br>
    <table class="items-table">
        <thead>
            <tr>
                <th class="th-desc" style="width:46%;">Description</th>
                <th class="th-qty" style="width:12%;">Qty</th>
                <th class="th-price" style="width:20%;">Unit Price</th>
                 <th class="th-price" style="width:20%;">NFC Card</th>
                <th class="th-amount" style="width:22%;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="td-desc">
                    <span class="item-description">Digital Business Card</span>
                    <div class="item-meta">Professional digital identity & networking solution</div>
                </td>
                <td class="td-qty">{{ $purchase->total_cards }}</td>
                <td class="td-price">&#8377;{{ number_format($purchase->price_per_card, 2) }}</td>
                <td class="td-price">&#8377;{{ number_format($purchase->nfc_price_per_card, 2) }}</td>
                <td class="td-amount">&#8377;{{ number_format($purchase->subtotal, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- ==================== SUMMARY ==================== -->
    <div class="summary-wrapper">
        <div class="summary-label-badge">
            <span>INVOICE SUMMARY</span>
        </div>
        <table class="summary-table" >
            <tr>
                <td class="s-label">Subtotal</td>
                <td class="s-value"> ₹ {{ number_format($purchase->subtotal, 2) }}</td>
            </tr>

            @if($purchase->discount_amount > 0)
            <tr class="discount-row">
                <td class="s-label">Discount</td>
                <td class="s-value">- {{ "\u{20B9}" }} {{ number_format($purchase->discount_amount, 2) }}</td>
            </tr>
            <tr>
                <td class="s-label">Taxable Amount</td>
                <td class="s-value">&#8377;{{ number_format($purchase->taxable_amount, 2) }}</td>
            </tr>
            @endif

            <tr class="gst-row">
                <td class="s-label">GST ({{ $purchase->gst_percentage }}%)</td>
                <td class="s-value">&#8377;{{ number_format($purchase->gst_amount, 2) }}</td>
            </tr>

            <tr class="total-row">
                <td class="s-label">TOTAL</td>
                <td class="s-value">&#8377;{{ number_format($purchase->total_amount, 2) }}</td>
            </tr>
        </table>
        <div class="clearfix"></div>

        <!-- AMOUNT IN WORDS -->
        @php
            function numberToWords($num) {
                $ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
                $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

                if ($num == 0) return 'Zero';

                $words = [];

                $crore   = floor($num / 10000000);
                $num    %= 10000000;
                $lakh    = floor($num / 100000);
                $num    %= 100000;
                $thousand = floor($num / 1000);
                $num     %= 1000;
                $hundreds = $num;

                $groups = [
                    ['value' => $crore,   'scale' => 'Crore'],
                    ['value' => $lakh,    'scale' => 'Lakh'],
                    ['value' => $thousand, 'scale' => 'Thousand'],
                    ['value' => $hundreds, 'scale' => ''],
                ];

                foreach ($groups as $group) {
                    $n = $group['value'];
                    if ($n == 0) continue;

                    $part = '';
                    if ($n < 20) {
                        $part = $ones[$n];
                    } elseif ($n < 100) {
                        $part = $tens[floor($n / 10)] . ' ' . $ones[$n % 10];
                    } else {
                        $part = $ones[floor($n / 100)] . ' Hundred ';
                        $rem = $n % 100;
                        if ($rem > 0 && $rem < 20) {
                            $part .= $ones[$rem];
                        } elseif ($rem >= 20) {
                            $part .= $tens[floor($rem / 10)] . ' ' . $ones[$rem % 10];
                        }
                    }
                    $words[] = trim($part) . ($group['scale'] ? ' ' . $group['scale'] : '');
                }

                return trim(implode(' ', $words));
            }

            $amountInWords = numberToWords(floor($purchase->total_amount)) . ' Rupees Only';
        @endphp
        <p class="amount-words">
            Amount in Words: <strong>{{ $amountInWords }}</strong>
        </p>
    </div>

    <!-- ==================== ADDITIONAL INFO ==================== -->
    <div class="info-section">
        <table class="info-table">
            <tr>
                <td style="padding-right:20px;">
                    <div class="info-box">
                        <div class="info-box-title">Terms & Conditions</div>
                        <ul>
                            <li>This is a computer-generated tax invoice.</li>
                            <li>All prices are in Indian Rupees (INR).</li>
                            <li>GST is charged as per applicable tax laws.</li>
                            <li>Payment is due as per the agreed terms.</li>
                            <li>For any billing queries, contact accounts@miprofile.in</li>
                        </ul>
                    </div>
                </td>
                <td style="padding-left:20px;">
                    <div class="info-box">
                        <div class="info-box-title">Payment Details</div>
                        <p><strong>Bank:</strong> HDFC Bank</p>
                        <p><strong>Account Name:</strong> Brand Crest Digital</p>
                        <p><strong>Account No:</strong> 50200075321456</p>
                        <p><strong>IFSC:</strong> HDFC0001234</p>
                        <p><strong>UPI:</strong> brandcrest@hdfcbank</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- ==================== SIGNATURE ==================== -->
    <div class="signature-block">
        <p class="sig-label">For <strong>BRAND CREST DIGITAL</strong></p>
        <div class="sig-line"></div>
        <p class="sig-name">Authorized Signatory</p>
        <p class="sig-role">Accounts Department</p>
    </div>

    <!-- ==================== FOOTER ==================== -->
    <div class="final-footer">
        <p class="brand-name">MI PROFILE</p>
        <p class="tagline">Connect Beyond Contacts</p>
        <p>Thank you for your business. We appreciate your trust in Mi Profile.</p>
    </div>

    <div class="page-number">
        Page 1 of 1
    </div>

</div>

</body>
</html>