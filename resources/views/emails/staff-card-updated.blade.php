<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Card Updated</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td>
                <table role="presentation" width="100%" max-width="600px" cellspacing="0" cellpadding="0" style="margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    
                    <!-- Logo Header -->
                    <tr>
                        <td style="background-color: #1e40af; padding: 25px 40px; text-align: center;">
                            <!-- Replace with your logo -->
                            <img src="https://yourdomain.com/storage/logo.png" 
                                 alt="{{ config('app.name') }}" 
                                 style="max-height: 60px; width: auto; margin-bottom: 10px;">
                            
                            <h1 style="color: #ffffff; margin: 15px 0 0 0; font-size: 26px; font-weight: 600;">
                                Staff Card Updated
                            </h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 40px 30px;">
                            <p style="font-size: 18px; color: #333333; margin-bottom: 25px;">
                                Hello <strong>{{ $card->name }}</strong>,
                            </p>
                            
                            <p style="font-size: 16px; color: #555555; line-height: 1.6; margin-bottom: 30px;">
                                Your staff card has been successfully updated on our platform.
                            </p>

                            <!-- Details Box -->
                            <div style="background-color: #f8fafc; padding: 25px; border-radius: 8px; margin: 25px 0; border-left: 5px solid #1e40af;">
                                <h3 style="margin: 0 0 20px 0; color: #1e40af;">Updated Information</h3>
                                <table style="width: 100%; border-collapse: collapse; color: #444444;">
                                    <tr>
                                        <td style="padding: 10px 0; width: 38%; color: #666666;">Name</td>
                                        <td style="padding: 10px 0;"><strong>{{ $card->name }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; color: #666666;">Designation</td>
                                        <td style="padding: 10px 0;">{{ $card->designation ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; color: #666666;">Company</td>
                                        <td style="padding: 10px 0;">{{ $card->company_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; color: #666666;">Email</td>
                                        <td style="padding: 10px 0;">{{ $card->company_email ?? $card->email ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; color: #666666;">Phone</td>
                                        <td style="padding: 10px 0;">{{ $card->phone ?? 'N/A' }}</td>
                                    </tr>
                                    @if($card->website)
                                    <tr>
                                        <td style="padding: 10px 0; color: #666666;">Website</td>
                                        <td style="padding: 10px 0;">
                                            <a href="{{ $card->website }}" style="color: #1e40af; text-decoration: none;">Visit Website →</a>
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>

                            <!-- View Button -->
                            <div style="text-align: center; margin: 35px 0;">
                                <a href="{{ route('staff.card.show', $card->slug) }}" 
                                   style="background-color: #1e40af; color: #ffffff; padding: 16px 36px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 16px; display: inline-block;">
                                    View Updated Card
                                </a>
                            </div>

                            <p style="color: #666666; font-size: 15px; line-height: 1.6;">
                                If you did not make this change, please contact our support team immediately.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f1f5f9; padding: 30px; text-align: center; font-size: 14px; color: #64748b; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0 0 8px 0;">
                                Best regards,<br>
                                <strong>{{ config('app.name') }} Team</strong>
                            </p>
                            <p style="margin: 0; font-size: 13px;">
                                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>