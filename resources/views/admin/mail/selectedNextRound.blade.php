<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Selected For Next Round</title>
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
            We are pleased to inform you that you have been selected for the next round of examinations for the Marketing Olympiad. Your performance in the previous round was impressive and we believe that you have the potential to succeed in this role.
        </p>
        {{-- <div class="details">
            <ul>
                <li><span>Start Time:</span> &nbsp;{{ $start_time }}</li>
                <li><span>End Time:</span> &nbsp;{{ $end_time }}</li>
            </ul>
        </div> --}}
        <p>The next round of examinations will be held on <b>{{$next_round_date}}</b>.</p>
        <p>If you have any questions or concerns regarding the examination process or any other matter, please do not hesitate to contact us.</p>
        <p>We wish you the best of luck for the next round of examinations and hope to see you join our team soon.</p>
        <p>Best regards,<br /><strong>Marketing Olympiad Team.</strong></p>
    </div>
</body>

</html>
