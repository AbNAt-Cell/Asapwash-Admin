<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Deletion Request Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background: #f7fafc;
            padding: 30px;
            border: 1px solid #e3e8ee;
        }

        .footer {
            background: #32325d;
            color: #8898aa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            border-radius: 0 0 5px 5px;
        }

        .info-box {
            background: white;
            border-left: 4px solid #5e72e4;
            padding: 15px;
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background: #5e72e4;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }

        ul {
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Data Deletion Request Received</h1>
    </div>

    <div class="content">
        <p>Dear {{ $request->name }},</p>

        <p>We have received your request to delete your personal data from our system. This email confirms that your
            request has been successfully submitted.</p>

        <div class="info-box">
            <h3 style="margin-top: 0;">Request Details:</h3>
            <p><strong>Name:</strong> {{ $request->name }}</p>
            <p><strong>Email:</strong> {{ $request->email }}</p>
            @if($request->phone)
                <p><strong>Phone:</strong> {{ $request->phone }}</p>
            @endif
            <p><strong>Account Type:</strong> {{ ucfirst(str_replace('_', ' ', $request->user_type)) }}</p>
            <p><strong>Request ID:</strong> #{{ $request->id }}</p>
            <p><strong>Submitted:</strong> {{ $request->created_at->format('F d, Y \a\t h:i A') }}</p>
        </div>

        <h3>What Happens Next?</h3>
        <ul>
            <li><strong>Review Process:</strong> Our team will review your request within 3-5 business days</li>
            <li><strong>Verification:</strong> We may contact you to verify your identity</li>
            <li><strong>Processing Time:</strong> Your data will be deleted within 30 days</li>
            <li><strong>Confirmation:</strong> You will receive a final confirmation email once the deletion is complete
            </li>
        </ul>

        <h3>Important Information:</h3>
        <ul>
            <li>Once your data is deleted, it cannot be recovered</li>
            <li>Some information may be retained for legal or regulatory compliance</li>
            <li>You will no longer be able to access your account after deletion</li>
        </ul>

        <p style="margin-top: 30px;">If you did not submit this request or wish to cancel it, please contact us
            immediately at <a href="mailto:support@asapwash.cloud">support@asapwash.cloud</a></p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
</body>

</html>