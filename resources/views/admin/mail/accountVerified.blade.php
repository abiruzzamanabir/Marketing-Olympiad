<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Account Information Update</title>
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            font-size: 16px;
            line-height: 1.4;
            color: #333333;

            padding: 0;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 5px;
            background-image: linear-gradient(rgb(255, 255, 255, 0.8), rgb(255, 255, 255, 0.8)), url("https://marketingolympiad.com/public/frontend/assets/images/logo_without_text.png");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center center;
            background-color: rgba(255, 255, 255, 0.95);
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 25%;
        }

        h1 {
            font-family: "Montserrat", sans-serif;
            font-size: 32px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            color: #333333;
        }

        p {
            margin: 0 0 20px;
            text-align: justify;
        }

        .button {
            display: inline-block;
            padding: 7px 20px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: #ffffff;
            background-color: #cdcdcd;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #cdcdcd;
            color: #000;
        }

        .details {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f5f5f58f;
            border-radius: 5px;
        }

        .details ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .details li {
            margin: 0 0 10px;
            padding: 0;
            font-weight: bold;
        }

        .details li span {
            font-weight: normal;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="{{ route('home.page') }}"><img src="https://marketingolympiad.com/public/storage/logo/logo_text.png" alt="" /></a>
        <h1>Account Verified</h1>
        <p>Dear <strong>{{ $name }}</strong>,</p>
        <p>
            We are writing to inform you that your account with Marketing Olympiad has been successfully verified. We appreciate your cooperation in completing this process.
        </p>
        <p>
            As a verified user, you will now have access to all the features and benefits of our platform. You can start exploring and using our services without any limitations.
        </p>
        <p>
            If you have any questions or concerns regarding your account verification, please do not hesitate to contact our support team at Support@marketingolympiad.com . We are always happy to assist you.
        </p>
        <p>
            Thank you for Participating Marketing Olympiad. We look forward to providing you with an exceptional experience on our platform.
        </p>
        <p>Best regards,<br /><strong>Marketing Olympiad Team.</strong></p>
    </div>
</body>

</html>
