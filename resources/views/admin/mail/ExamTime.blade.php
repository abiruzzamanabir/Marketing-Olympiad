<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Exam Time</title>
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
            background-image: linear-gradient(rgb(255, 255, 255, 0.8), rgb(255, 255, 255, 0.8)), url("https://bbf.digital/marketing-olympiad/public/frontend/assets/images/logo.png");
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
        <img src="https://bbf.digital/marketing-olympiad/public/storage/logo/logo.png" alt="" />
        <p>Dear <strong>{{ $name }}</strong>,</p>
        <p>
            We are pleased to inform you that the online exam for Marketing Olympiad is scheduled for <b>{{ $start_time }}</b>. The exam will be conducted through our online platform and the exam will be closed on <b>{{ $end_time }}</b>.
        </p>
        {{-- <div class="details">
            <ul>
                <li><span>Start Time:</span> &nbsp;{{ $start_time }}</li>
                <li><span>End Time:</span> &nbsp;{{ $end_time }}</li>
            </ul>
        </div> --}}
        <p>Please ensure that you have a stable internet connection</p>
        <p>We would also like to remind you that any attempt to cheat or plagiarize during the exam will result in immediate disqualification.</p>
        <p>If you have any questions or concerns, please do not hesitate to contact us.</p>
        <p>Best regards,<br /><strong>Marketing Olympiad Team.</strong></p>
    </div>
</body>

</html>
