<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Confirmation</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#0f172a;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:28px 12px;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:100%;max-width:600px;background:#ffffff;border-radius:14px;overflow:hidden;">
                <!-- Header -->
                <tr>
                    <td align="center" style="background:#2563eb;padding:30px 24px;">
                        <div style="font-size:24px;line-height:1.2;font-weight:700;color:#ffffff;">&#127891; Cloud Computing 2025</div>
                        <div style="font-size:13px;color:#dbeafe;margin-top:6px;">Registration Confirmation</div>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:30px 32px 8px;">
                        <p style="margin:0 0 14px;font-size:16px;">Hello <strong>{{ $registration->full_name }}</strong>!</p>
                        <p style="margin:0;font-size:14px;line-height:1.65;color:#334155;">
                            Congratulations! You have successfully registered for <strong>{{ $registration->course }}</strong>.
                            We're excited to have you join our program!
                        </p>
                    </td>
                </tr>

                <!-- Details -->
                <tr>
                    <td style="padding:20px 32px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border:1px solid #e2e8f0;border-left:4px solid #2563eb;border-radius:8px;">
                            <tr>
                                <td style="padding:16px 20px;">
                                    <div style="font-size:14px;font-weight:700;margin-bottom:10px;">&#128203; Registration Details</div>
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:14px;">
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;width:110px;">Full Name</td>
                                            <td style="padding:5px 0;font-weight:600;">{{ $registration->full_name }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Email</td>
                                            <td style="padding:5px 0;"><a href="mailto:{{ $registration->email }}" style="color:#2563eb;">{{ $registration->email }}</a></td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Birthdate</td>
                                            <td style="padding:5px 0;font-weight:600;">{{ $registration->birthdate->format('F j, Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:5px 0;color:#64748b;">Course</td>
                                            <td style="padding:5px 0;font-weight:600;">{{ $registration->course }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Button -->
                <tr>
                    <td style="padding:6px 32px 0;">
                        <p style="margin:0 0 18px;font-size:14px;line-height:1.65;color:#334155;">
                            To complete your registration and confirm your spot in the program, please click the button below:
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding:0 32px 22px;">
                        <a href="{{ $confirmUrl }}"
                           style="display:inline-block;background:#16a34a;color:#ffffff;text-decoration:none;font-size:15px;font-weight:700;padding:14px 30px;border-radius:8px;">
                            &#127891; Confirm My Registration
                        </a>
                    </td>
                </tr>

                <tr>
                    <td style="padding:0 32px 24px;">
                        <p style="margin:0;font-size:13px;line-height:1.6;color:#334155;">
                            <strong>Important:</strong> Please confirm your registration within 7 days
                            (before {{ $registration->confirmation_expires_at->format('F j, Y') }}) to secure your spot in the program.
                        </p>
                        <p style="margin:14px 0 0;font-size:12px;line-height:1.6;color:#94a3b8;">
                            If the button doesn't work, copy and paste this link into your browser:<br>
                            <a href="{{ $confirmUrl }}" style="color:#2563eb;word-break:break-all;">{{ $confirmUrl }}</a>
                        </p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td align="center" style="border-top:1px solid #e2e8f0;padding:20px 32px 26px;font-size:12px;line-height:1.7;color:#94a3b8;">
                        Thank you for choosing Cloud Computing 2025!<br>
                        If you have any questions, please contact us at
                        <a href="mailto:{{ $supportEmail }}" style="color:#2563eb;">{{ $supportEmail }}</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
