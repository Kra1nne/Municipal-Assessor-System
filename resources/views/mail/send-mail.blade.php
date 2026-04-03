<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Declaration Request – Municipal Assessor System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap');

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #f0f2f5;
        }

        .email-wrapper {
            max-width: 620px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 32px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .email-header {
            background: linear-gradient(135deg, #0f1623, #1e3a5f);
            padding: 36px 48px;
            color: #fff;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
        }

        .header-tagline h1 {
            font-size: 24px;
            margin-top: 20px;
        }

        .header-tagline p {
            opacity: 0.7;
        }

        /* Body */
        .email-body {
            padding: 40px;
            color: #374151;
        }

        /* Footer */
        .email-footer {
            background: #0f172a;
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            padding: 30px;
            font-size: 12px;
        }

        @media (max-width: 640px) {
            .email-body {
                padding: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="email-wrapper">

        <!-- HEADER -->
        <div class="email-header">
            <div class="logo-text">Municipal Assessor System</div>

            <div class="header-tagline">
                <h1>Tax Declaration Request 📄</h1>
                <p>Assessor Office</p>
            </div>
        </div>

        <!-- BODY -->
        <div class="email-body">

            <p>
                Dear <strong>{{ $email }}</strong>,
            </p>

            <p style="margin-top:10px;">
                Greetings from the Assessor Office.
            </p>

            <p style="margin-top:10px;">
                {{ $description }}
            </p>

            <p style="margin-top:20px;">
                Thank you for your cooperation.
            </p>

            <p style="margin-top:20px;">
                Sincerely,<br>
                <strong>Assessor Office</strong><br>
                Municipal Assessor System
            </p>

        </div>

        <!-- FOOTER -->
        <div class="email-footer">

            <p>
                This is an automated message from <strong style="color:rgba(255,255,255,0.45);">
                Municipal Assessor System</strong>.<br>
                Please do not reply directly to this email.<br>
                © {{ date('Y') }} Municipal Assessor System. All rights reserved.
            </p>

        </div>

    </div>

</body>

</html>