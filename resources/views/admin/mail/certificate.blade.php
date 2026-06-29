<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Marketing Olympiad Certificate</title>

    <style>
        @font-face {
            font-family: 'greatvibes';
            src: url("{{ public_path('assets/fonts/GreatVibes-Regular.ttf') }}") format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        @page {
            margin: 0;
        }

        body {
            font-family: montserrat, sans-serif;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 297mm;
            height: 210mm;
            position: relative;
            text-align: center;
            overflow: hidden;
        }

        .top-logo {
            width: 180px;
            margin-top: 16px;
            margin-bottom: 50px;
        }

        .content {
            width: 100%;
            text-align: center;
            margin-top: 14px;
        }

        .title {
            font-family: greatvibes;
            font-weight: 400;
            font-size: 48px;
            margin: 0 0 12px;
            line-height: 1;
        }

        .text-line {
            font-size: 23px;
            font-weight: 300;
            margin: 0 0 10px;
            text-align: center;
        }

        .name {
            font-size: 34px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 0 0 12px;
            text-align: center;
            line-height: 1.1;
        }

        .event-name {
            font-size: 28px;
            font-weight: 500;
            margin: 0;
            text-align: center;
            line-height: 1.1;
        }

        .signature-table {
            width: 74%;
            margin: 36px auto 0;
            border-collapse: collapse;
            text-align: center;
        }

        .signature-box {
            width: 50%;
            text-align: center;
            vertical-align: top;
            margin-top: 30px;
        }

        .signature-img {
            width: 110px;
            height: 58px;
            margin: 0 auto 3px;
        }

        .signature-line {
            width: 220px;
            height: 1px;
            background: #333333;
            margin: 0 auto 7px;
        }

        .signature-name {
            font-size: 14px;
            font-weight: bold;
            margin: 0 0 4px;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .signature-title {
            font-size: 11px;
            font-weight: 400;
            margin: 0;
            line-height: 1.25;
            text-transform: uppercase;
        }

        .bottom-panel {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            margin-top: 50px;
            padding: 10px 0 12px;
            text-align: center;

        }

        .partner-panel {
            width: 900px;
            margin: 0 auto;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="page">

        <img class="top-logo" src="{{ $logo }}" alt="Marketing Olympiad Logo">

        <div class="content">
            <h1 class="title">Certificate Of Participation</h1>

            <p class="text-line">This certificate is awarded to</p>

            <h2 class="name">{{ $name }}</h2>

            <p class="text-line">for participating in the</p>

            <h2 class="event-name">MARKETING OLYMPIAD {{ now()->format('Y') }}</h2>

            <table class="signature-table">
                <tr>
                    <td class="signature-box">
                        <img class="signature-img" src="{{ $signatureLeft }}" alt="Signature">

                        <div class="signature-line"></div>

                        <p class="signature-name">DR. SYED FERHAT ANWAR</p>
                        <p class="signature-title">PRESIDENT</p>
                        <p class="signature-title">ASIA MARKETING FEDERATION (AMF)</p>
                    </td>

                    <td class="signature-box">
                        <img class="signature-img" src="{{ $signatureRight }}" alt="Signature">

                        <div class="signature-line"></div>

                        <p class="signature-name">SHARIFUL ISLAM</p>
                        <p class="signature-title">FOUNDER &amp; MANAGING DIRECTOR</p>
                        <p class="signature-title">BANGLADESH BRAND FORUM</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="bottom-panel">
            <img class="partner-panel" src="{{ $partnerPanel }}" alt="Partners">
        </div>

    </div>
</body>

</html>
