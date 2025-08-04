<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mark Your Calendar | Marketing Olympiad</title>
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
        <p>Dear <strong>{{ $name }}</strong>,</p>
        <p>
<<<<<<< HEAD
            Greetings from Marketing Olympiad. Please be informed that the Marketing Olympiad first round is open for participation from <b>{{ $start_time }}</b> to <b>{{ $end_time }}</b>. Please log in to your profile during the participation window to complete your assessment.

=======
            We are delighted to announce that the “Round 1” of Marketing Olympiad is scheduled to start from <b>{{ $start_time }}</b>. “Round 1” will be conducted virtually through our online platform.  Window for participation will close <b>{{ $end_time }}</b>.
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
        </p>
        <p>Please check your device and ensure a stable internet connection to avoid interruptions. </p>
        <p>We would like to emphasize that any form of cheating or plagiarism during the exam will lead to immediate disqualification. Please <a href="https://marketingolympiad.com//#rules">Click Here</a> to go through the Rules & Regulations.</p>
        <p>If you have any concerns, please feel free to reach out to us.</p>
<<<<<<< HEAD
        <b>Please ignore this email if you have already participated.</b>
        <p><br /><br />Best regards,<br /><strong>Marketing Olympiad</strong></p>
=======
        <p>Best regards,<br /><strong>Marketing Olympiad</strong></p>
>>>>>>> e953e31f70933353be58a4715f9c7781ff93376d
    </div>
</body>

</html>
