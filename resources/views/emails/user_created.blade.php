<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Service!</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">

    <div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 3px rgba(0,0,0,0.1);">

        <h2 style="color: #333333; text-align: center;">Welcome to [Your Service Name]!</h2>

        <p style="color: #555555; font-size: 16px;">Dear {{ $name }},</p>

        <p style="color: #555555; font-size: 16px;">
            We are thrilled to have you on board! Your account has been successfully created. Below are your login details:
        </p>

        <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
            <tr>
                <th style="text-align: left; padding: 8px; background-color: #f2f2f2;">Email</th>
                <td style="padding: 8px;">{{ $email }}</td>
            </tr>
            <tr>
                <th style="text-align: left; padding: 8px; background-color: #f2f2f2;">Password</th>
                <td style="padding: 8px;">{{ $password }}</td>
            </tr>
        </table>

        <p style="color: #555555; font-size: 16px; margin-top: 20px;">
            Please keep this information safe and do not share it with anyone. You can log in to your account by clicking the button below:
        </p>

        <p style="text-align: center; margin: 20px 0;">
            <a href="{{ url('/login') }}" style="background-color: #0066cc; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Login to Your Account</a>
        </p>

        <p style="color: #555555; font-size: 16px;">
            If you have any questions or need assistance, please don't hesitate to contact us at <a href="mailto:support@yourcompany.com" style="color: #0066cc;">support@yourcompany.com</a>.
        </p>

        <p style="color: #555555; font-size: 16px;">
            Welcome aboard!<br>
            The [Your Service Name] Team
        </p>

    </div>

</body>

</html>
