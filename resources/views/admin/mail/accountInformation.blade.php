<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to Marketing Olympiad!</title>
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
            background-image: linear-gradient(rgb(255, 255, 255, 0.8), rgb(255, 255, 255, 0.8)), url("https://bbf.digital/marketing-olympiad/public/frontend/assets/images/logo_without_text.png");
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
        <img src="https://bbf.digital/marketing-olympiad/public/storage/logo/logo_text.png" alt="" />
        {{-- <h1>Welcome to Marketing Olympiad!</h1> --}}
        <p>Dear <strong>{{ $name }}</strong>,</p>
        <p>
            We are delighted to welcome you to Marketing Olympiad!
        </p>
        <p>
            Your account has been successfully created, and we have generated unique login credentials for you to access
            our services. Please refer to the information below to login, </p>
        <div class="details">
            <ul>
                <li><span>Username: </span> {{ $username }}</li>
                <li><span>Password: </span> {{ $password }}</li>
            </ul>
        </div>
        <p>For account security, we recommend changing your password after logging in for the first time. Simply navigate to the profile section of your account, where you can update your password to something more memorable and secure.</p>
        <p>Should you have any questions, concerns, or require assistance, please don't hesitate to reach out to us. We are here to help!</p>
        <p>Best regards,<br /><strong>Marketing Olympiad</strong></p>
    </div>
</body>

</html>
