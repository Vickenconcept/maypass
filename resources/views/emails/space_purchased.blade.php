<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace Purchase Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">

    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 3px rgba(0,0,0,0.1);">

        <h2 style="color: #333333; text-align: center;">Thank You for Your Purchase!</h2>

        <p style="color: #555555; font-size: 16px;">Dear {{ $data['name'] }},</p>

        <p style="color: #555555; font-size: 16px;">
            We are pleased to inform you that your purchase of a workspace has been successfully completed. Below are the details of your booking:
        </p>

        <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
            <tr>
                <th style="text-align: left; padding: 8px; background-color: #f2f2f2;">Workspace Name</th>
                <td style="padding: 8px;">{{ $data['space_name'] }}</td>
            </tr>
            
            <tr>
                <th style="text-align: left; padding: 8px; background-color: #f2f2f2;">Price per Day</th>
                <td style="padding: 8px;"># {{ $data['price_per_day'] }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 8px; background-color: #f2f2f2;">Total Days</th>
                <td style="padding: 8px;">{{ $data['days_count'] }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 8px; background-color: #f2f2f2;">Total Amount</th>
                <td style="padding: 8px;"># {{ $data['total_amount'] }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 8px; background-color: #f2f2f2;">Payment Method</th>
                <td style="padding: 8px;">{{ $data['payment_method'] }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 8px; background-color: #f2f2f2;">Booking Reference</th>
                <td style="padding: 8px;">{{ $data['reference'] }}</td>
            </tr>
        </table>

        <p style="color: #555555; font-size: 16px; margin-top: 20px;">
            We look forward to welcoming you to your workspace. If you have any questions or need further assistance, feel free to contact us at <a href="mailto:support@yourcompany.com" style="color: #0066cc;">support@yourcompany.com</a>.
        </p>

        <p style="color: #555555; font-size: 16px;">
            Best regards,<br>
            The Workspace Team
        </p>

    </div>

</body>

</html>
