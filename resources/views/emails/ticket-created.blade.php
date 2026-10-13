<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Support Ticket</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td>
                <table role="presentation" width="100%" max-width="600px" cellspacing="0" cellpadding="0" style="margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #d97706; padding: 30px 40px; text-align: center;">
                            <!-- Logo -->
                            <img src="https://miprofile.in/wp-content/uploads/2026/06/Logo-11-06-Png-black-orange-transparent.png" 
                                 alt="{{ config('app.name') }}" 
                                 style="max-height: 55px; width: auto;">
                            
                            <h1 style="color: #ffffff; margin: 15px 0 0 0; font-size: 26px;">
                                New Support Ticket
                            </h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="font-size: 18px; color: #d97706;">
                                Hello <strong>{{ $isAdminCopy ? 'Team' : $ticket->user->name ?? 'User' }}</strong>,
                            </p>

                            @if(!$isAdminCopy)
                            <p style="font-size: 16px; color: #d97706; line-height: 1.6;">
                                Thank you for submitting a support ticket. We have received it successfully.
                            </p>
                            @else
                            <p style="font-size: 16px; color: #d97706; font-weight: bold;">
                                A new support ticket has been submitted.
                            </p>
                            @endif

                            <!-- Ticket Details -->
                            <div style="background-color: #f8fafc; padding: 25px; border-radius: 8px; margin: 25px 0; border-left: 5px solid #1e40af;">
                                <h3 style="margin: 0 0 20px 0; color: #1e40af;">Ticket Details</h3>
                                <table style="width: 100%; border-collapse: collapse;">
                                    <tr>
                                        <td style="padding: 8px 0; color: #666666; width: 40%;">Ticket No</td>
                                        <td style="padding: 8px 0; color: #1e40af; font-weight: bold;">{{ $ticket->ticket_no }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #666666;">Subject</td>
                                        <td style="padding: 8px 0; font-weight: bold;">{{ $ticket->subject }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #666666;">Department</td>
                                        <td style="padding: 8px 0;">{{ ucfirst($ticket->department) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #666666;">Urgency</td>
                                        <td style="padding: 8px 0;">{{ ucfirst($ticket->urgency) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; color: #666666;">Status</td>
                                        <td style="padding: 8px 0;"><span style="color: #16a34a; font-weight: bold;">Open</span></td>
                                    </tr>
                                </table>

                                <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 20px 0;">
                                
                                <p style="margin: 0; color: #444444;">
                                    <strong>Message:</strong><br>
                                    {{ $ticket->message }}
                                </p>
                            </div>

                            <!-- Action Button -->
                            {{-- <div style="text-align: center; margin: 35px 0;">
                                <a href="{{ route('admin.tickets.show', $ticket->id) }}" 
                                   style="background-color: #1e40af; color: #ffffff; padding: 15px 35px; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block;">
                                    @if($isAdminCopy)
                                        View Ticket
                                    @else
                                        Track My Ticket
                                    @endif
                                </a>
                            </div> --}}
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f1f5f9; padding: 30px; text-align: center; font-size: 14px; color: #64748b;">
                            <p style="margin: 0;">
                                Best regards,<br>
                                <strong>{{ config('app.name') }} Support Team</strong>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

make logo color