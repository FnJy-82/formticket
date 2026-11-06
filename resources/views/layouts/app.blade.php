<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Confirmation</title>
</head>
<body style="margin:0;padding:0;background:#0f0a24;font-family:Arial,Helvetica,sans-serif;color:#0f172a;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#0f0a24;padding:28px 12px;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:100%;max-width:600px;background:#ffffff;border-radius:16px;overflow:hidden;">
                <!-- Header -->
                <tr>
                    <td align="center" style="background:#6d28d9;background-image:linear-gradient(135deg,#1e1b4b,#7c3aed 60%,#db2777);padding:34px 24px;">
                        <div style="font-size:26px;line-height:1.2;font-weight:800;color:#ffffff;">&#127926; {{ config('concert.name') }}</div>
                        <div style="font-size:13px;color:#e9d5ff;margin-top:6px;">Booking Confirmation</div>
                        <div style="margin-top:14px;font-size:13px;color:#ffffff;">
                            {{ config('concert.date_label') }} &middot; {{ config('concert.venue') }}
                        </div>
                    </td>
                </tr>

                <!-- Greeting -->
                <tr>
                    <td style="padding:30px 32px 8px;">
                        <p style="margin:0 0 14px;font-size:16px;">Hello <strong>{{ $booking->full_name }}</strong>!</p>
                        <p style="margin:0;font-size:14px;line-height:1.65;color:#334155;">
                            Thank you for booking tickets to <strong>{{ config('concert.name') }}</strong>.
                            We can't wait to see you at the show! Here is a summary of your booking:
                        </p>
                    </td>
                </tr>

                <!-- Booking code -->
                <tr>
                    <td align="center" style="padding:20px 32px 0;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#faf5ff;border:1px dashed #c4b5fd;border-radius:10px;">
                            <tr>
                                <td align="center" style="padding:14px;">
                                    <div style="font-size:11px;letter-spacing:1.5px;text-transform:uppercase;color:#64748b;">Booking code</div>
                                    <div style="font-size:26px;font-weight:800;letter-spacing:3px;color:#6d28d9;margin-top:4px;">{{ $booking->booking_code }}</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Details -->
                <tr>
                    <td style="padding:18px 32px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-left:4px solid #7c3aed;border-radius:8px;">
                            <tr>
                                <td style="padding:16px 20px;">
                                    <div style="font-size:14px;font-weight:700;margin-bottom:10px;">&#127915; Booking Details</div>
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;">
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;width:120px;">Full Name</td>
                                            <td style="padding:5px 0;font-weight:600;">{{ $booking->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Email</td>
                                            <td style="padding:5px 0;"><a href="mailto:{{ $booking->email }}" style="color:#7c3aed;">{{ $booking->email }}</a></td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Phone</td>
                                            <td style="padding:5px 0;font-weight:600;">{{ $booking->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Birthdate</td>
                                            <td style="padding:5px 0;font-weight:600;">{{ $booking->birthdate->format('F j, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Ticket</td>
                                            <td style="padding:5px 0;font-weight:600;">{{ $booking->ticketLabel() }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Quantity</td>
                                            <td style="padding:5px 0;font-weight:600;">{{ $booking->quantity }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Total</td>
                                            <td style="padding:5px 0;font-weight:800;color:#6d28d9;">{{ $booking->totalFormatted() }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Event</td>
                                            <td style="padding:5px 0;font-weight:600;">{{ config('concert.date_label') }}<br><span style="font-weight:400;color:#64748b;">{{ config('concert.time_label') }}</span></td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Venue</td>
                                            <td style="padding:5px 0;font-weight:600;">{{ config('concert.venue') }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Button -->
                <tr>
                    <td style="padding:4px 32px 0;">
                        <p style="margin:0 0 18px;font-size:14px;line-height:1.65;color:#334155;">
                            To secure your tickets, please confirm your booking by clicking the button below:
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding:0 32px 22px;">
                        <a href="{{ $confirmUrl }}"
                           style="display:inline-block;background:#16a34a;color:#ffffff;text-decoration:none;font-size:15px;font-weight:700;padding:15px 32px;border-radius:8px;">
                            &#127915; Confirm My Booking
                        </a>
                    </td>
                </tr>

                <tr>
                    <td style="padding:0 32px 24px;">
                        <p style="margin:0;font-size:13px;line-height:1.6;color:#334155;">
                            <strong>Important:</strong> Please confirm within {{ config('concert.hold_days') }} days
                            (before {{ $booking->confirmation_expires_at->format('F j, Y') }}).
                            Unconfirmed bookings are released so other fans can get their tickets.
                        </p>
                        <p style="margin:14px 0 0;font-size:12px;line-height:1.6;color:#94a3b8;">
                            If the button doesn't work, copy and paste this link into your browser:<br>
                            <a href="{{ $confirmUrl }}" style="color:#7c3aed;word-break:break-all;">{{ $confirmUrl }}</a>
                        </p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td align="center" style="border-top:1px solid #e2e8f0;padding:20px 32px 26px;font-size:12px;line-height:1.7;color:#94a3b8;">
                        Thank you for choosing {{ config('concert.name') }}!<br>
                        If you have any questions, please contact us at
                        <a href="mailto:{{ $supportEmail }}" style="color:#7c3aed;">{{ $supportEmail }}</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
