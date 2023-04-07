<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Marketing Olympiad Certificate</title>
    <style>
        /*@import url("https://fonts.googleapis.com/css2?family=Great+Vibes&family=montserrat:wght@200;400;500;700&display=swap");*/

        @font-face {
            font-family: 'greatvibes';
            /* {{--            src: url({{ public_path('assets\fonts\GreatVibes-Regular.ttf') }}) format("truetype"); --}} font-weight: 400; // use the matching font-weight here ( 100, 200, 300, 400, etc). */
            /* font-style: normal; // use the matching font-style here */
        }

        body {
            font-family: "greatvibes";
            color: #000000;
            padding: 0;
            margin: 0;
        }

        .container {
            text-align: center;
            width: 100%;
            margin: auto;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 2px solid #009ada ;
            /* border-radius: 5px; */
            /* {{-- background-image: linear-gradient( --}} {{--        rgb(255, 255, 255, 0.8), --}} {{--        rgb(255, 255, 255, 0.8) --}} {{-- ); --}} {{-- url("{{ __DIR__ . '/../../../../public/storage/logo/Marketing-Olympiad-Logo-FINAL.png'}}"); --}} {{-- background-repeat: no-repeat; --}} {{-- background-size: calc(130%); --}} {{-- background-position: left center; --}} {{-- background-color: rgba(255, 255, 255, 0.95); --}} */
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 14%;
        }

        h1 {
            font-size: 80px;
            margin-top: 0;
            margin-bottom: 5px;
            text-align: center;
            color: #000000;
        }

        p {
            margin: 0 0 5px;
            text-align: justify;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: #ffffff;
            background-color: #0085ff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0071d1;
        }

        .details {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f5f5f58f;
            border-radius: 5px;
        }

        .center {
            text-align: center;
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

<body style="font-family:montserrat,sans-serif">
    <div class="container">
        <img width="50px" src="https://bbf.digital/marketing-olympiad/public/storage/logo/logo.png" alt="" />
        <h1 style="font-family: 'greatvibes', cursive; font-weight: 400">
            Certificate Of Participation
        </h1>
        <div style="line-height: 20px">
            <h3 style="
            font-family: 'montserrat', sans-serif;
            font-weight: 200;
            font-size: 25px;
          "
                class="center">
                This certificate is awarded to
            </h3>
            <h2
                style="font-family: 'montserrat', sans-serif; font-weight: 500;font-size: 30px;text-transform: uppercase;"class="center">
                {{ $name }}
            </h2>
            <h3 style="
            font-family: 'montserrat', sans-serif;
            font-weight: 200;
            font-size:25px;
          "
                class="center">
                for participating in the
            </h3>
            <h2 style="
            font-family: 'montserrat', sans-serif;
            font-weight: 500;
            font-size: 25px;
          "
                class="center">
                MARKETING OLYMPIAD
            </h2>
        </div>
        <img style="
          display: block;
          margin-left: auto;
          margin-right: auto;
          width: 100px;
        "
            src="https://bbf.digital/marketing-olympiad/public/storage/logo/signature.png" alt="" />
        <div style="line-height: 5px">
            <h1 style="font-size: 14px">SHARIFUL ISLAM</h1>
            <h4 style="
            font-family: 'montserrat', sans-serif;
            font-weight: 400;
            font-size: 15px;
          "
                class="center">FOUNDER & MANAGING DIRECTOR</h4>
            <h4 style="
            font-family: 'montserrat', sans-serif;
            font-weight: 400;
            font-size: 15px;
          "
                class="center">BANGLADESH BRAND FORUM</h4>
        </div>
        <img style="
          display: block;
          margin-left: auto;
          margin-right: auto;
          width: 300px;
        "
            src="https://bbf.digital/marketing-olympiad/public/storage/logo/logo_panel.png" alt="" />
    </div>
</body>

</html>
