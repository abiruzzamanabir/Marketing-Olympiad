<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Round Three</title>
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <style>
        body {
            background-image: linear-gradient(rgba(255, 255, 255, 0.3), rgb(255, 255, 255, 0.3)), url({{ asset('storage/logo/WebBanner.png') }});
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: top right;
            background-size: cover;
        }

        @media (max-width: 769px) {
            body {
                background-position: center right !important;
                background-size: cover !important;
                background-image: url({{ asset('storage/logo/WebBannerM.png') }});
            }
        }
    </style>

<style>
    .modern-public-page {
        --primary: #0d6efd;
        --primary-dark: #0b5ed7;
        --border: #e7edf5;
        --muted: #6b7280;
        --text: #1f2937;
        --shadow: 0 18px 50px rgba(15, 23, 42, 0.10);
    }

    .modern-public-page .container {
        position: relative;
        z-index: 1;
    }

    .modern-public-page .card,
    .modern-public-page .bd,
    .modern-public-page .intro-card,
    .modern-public-page .support-box,
    .modern-public-page .intro-box {
        border: 1px solid var(--border) !important;
        border-radius: 22px !important;
        box-shadow: var(--shadow) !important;
        background: rgba(255, 255, 255, 0.94) !important;
        backdrop-filter: blur(10px);
    }

    .modern-public-page .btn {
        border-radius: 999px !important;
        font-weight: 700;
        padding-left: 22px;
        padding-right: 22px;
    }

    .modern-public-page input,
    .modern-public-page textarea,
    .modern-public-page select,
    .modern-public-page .form-control {
        border-radius: 12px !important;
        border-color: #d9e1ec !important;
        min-height: 44px;
    }

    .modern-public-page label {
        font-weight: 700;
        color: var(--text);
    }

    .modern-public-page table {
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
    }

    .modern-public-page table thead th {
        background: #f8fafc;
        color: #4b5563;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .03em;
        white-space: nowrap;
    }

    .modern-public-page .section-heading h2,
    .modern-public-page h1,
    .modern-public-page h2,
    .modern-public-page h3 {
        color: var(--text);
        font-weight: 800;
    }

    .modern-public-page .exam-shell {
        background: rgba(255, 255, 255, 0.94);
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: var(--shadow);
        padding: 28px;
        margin-bottom: 40px;
    }

    .modern-public-page .timer-box {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 22px;
        box-shadow: var(--shadow);
        padding: 18px;
    }

    .modern-public-page .option-card,
    .modern-public-page .bgcolorClass {
        border-radius: 14px !important;
        border: 1px solid var(--border);
        transition: all .2s ease;
    }

    @media (max-width: 767px) {
        .modern-public-page .exam-shell,
        .modern-public-page .card,
        .modern-public-page .bd {
            padding: 18px !important;
            border-radius: 18px !important;
        }
    }
</style>

</head>

<body class="modern-public-page" class="modern-public-page">
    <div class="container">
        <div style="margin-bottom:100px" class="row justify-content-around align-items-center mb-5 pb-5">
            <div class="text-center">
                <a href="{{ route('home.page') }}"><img style="height: 200px" src="{{ asset('storage/logo/logo_text.png') }}" alt=""></a>
            </div>
            <div class="col-md-8 pb-3">

                <div>
                    <div>
                        <h5>Case Study:</h5>
                        <p style="text-align: justify"><b>TTRS -</b>  A 30-year-old product manufacturing company that dominated the market for a long period of time. once a dominant player in the consumer electronics industry has faced significant challenges in maintaining its market share and profitability. Over the years, the company has experienced intense competition from rivals, such as Samsung and Apple, and has struggled to keep up with changing consumer preferences and disruptive technological advancements.<br><br>

Very few companies could ever boast a string of such successful products.   A report said that the company executives spent 85% of their time on technology, products, and new applications/markets, 10% on human resource issues, and 5% on finance.   One of the company representatives said that financial results were just those results of doing a good job developing new products and markets. When the market was saturated their production and accordance to profitability was huge. But soon as the market expanded their traditional marketing efforts did not work on course. As technological advancements took place their adaption method was outdated and they suffered hugely in the new competitive market. As production was not steady a lot of faulty products resulted in a huge reputational damage for the organization.<br> <br>

As the leading organization always focused on their products their effort on putting their name forward didn’t work. New adaptive methods of actualizing the advertisement arena also failed because of that. Resulting in a huge gap between the market and their favored consumers. The consumer electronics brand slowly started losing its reputation. Their steady profitability and production started collapsing. Based on that the management decided to hire a professional marketing team to identify the problems. The outcomes soon came into the picture.  The following conclusion was drawn by the team:<br><br>
</p>
<ol>
    <li><b>Weak Brand Positioning:</b> The Organization’s brand positioning has become blurred, and its once-strong brand image has faded. The company has failed to effectively communicate its unique value proposition and differentiate itself from competitors. </li>
    <li><b>Inadequate Marketing Communication:</b> The Organization has struggled with ineffective marketing communication efforts. The company has not effectively conveyed its product features, benefits, and overall value to consumers. </li>
    <li><b>Limited Digital Presence:</b> The Organization has lagged in establishing a strong digital presence and leveraging e-commerce platforms. In an era where digital channels are critical for reaching and engaging consumers, their limited online visibility has hindered its ability to connect with the digital-savvy customer base. </li>
    <li><b>Inefficient Market Segmentation :</b> The organization has struggled with targeting the right customer segments effectively. The company's products cater to a wide range of consumer preferences and demographics, but its marketing efforts have not been tailored to specific target segments. </li>
</ol>
<p>Required:</p>
<ol>
    <li>Analyze the organizations brand positioning strategy and provide recommendations for revitalizing its brand to resonate with target consumers.</li>
    <li>Evaluate their marketing communication strategies, including advertising and promotional campaigns, and propose improvements to enhance brand awareness and customer engagement.</li>
    <li>Assess their digital marketing strategies and recommend ways to enhance its online presence and drive sales through digital channels.</li>
    <li>Develop a comprehensive market segmentation strategy for them, including identifying key consumer segments and customizing marketing initiatives to resonate with each segment.</li>
</ol><br>
<ol>
    <li><b>Redefining Brand Strategy: </b>Current brand identity is riddled with inconsistent customer experiences of the prior years. A new brand strategy is required that invokes and represents the fresh new look. </li><br>
    <li><b>Developing a Redefined Marketing Strategy: </b>Develop a redefined marketing strategy that outlines its new objectives. A redefined marketing strategy will provide a roadmap for consistent and effective marketing efforts that they are playing to reinvigorate its service model; while maintaining its overall vision to provide an exceptionally seamless customer experience.</li><br>
    <li><b>Digital and Media Strategy Enhancement: </b>The company's digital presence and online marketing initiatives require optimization to reach and engage customers effectively. As many of its competitors dominate digital media, the new marketing team suggested that they should invest in various digital marketing and media solutions to enhance brand visibility, attract new customers, and increase online conversions.</li><br>
    <li><b>Captivating Content Strategy Development: </b>They lack a comprehensive content strategy that aligns with customers' interests and preferences. It is suggested that the company needs to develop an engaging and informative content strategy that positions them well and generates a sense of trust.</li><br>
    <li><b>PR and Reputation Management: </b>Negative customer reviews and public criticism have significantly impacted their reputation. The team recommends the company proactively manage its public relations efforts to build a strong brand reputation and customer trust.</li><br>
</ol>
<p>Imagine you have been hired to lead the marketing management team. You aim to develop the best possible solution. You are requested to:</p>
<ul>
    <li>Prepare a favorable solution based on the given areas of the problem narratives. </li>
    <li>Use the PowerPoint Presentation Template provided by the Marketing Olympiad Authorities.</li>
    <li>Kindly convert the presentation into PDF and submit in Marketing Olympiad Website. </li>
    <li>Participants are allowed to use any marketing-based approach to establish their proposition. </li>
    <li>Submission windows will be open from 23rd May 2023 (11:59 PM) to 24th May 2023 (11:59 PM). </li>
</ul>
                        <a class="btn btn-primary" href="{{ asset('storage/Marketing-Olympiad-Case-Presentation.pptx') }}">Download Kit</a>
                    </div>
                    <form action="{{ route('round.three.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="border p-3 mt-3">
                            <label class="focus-label">Name</label>
                            <div class="input-group form-focus my-2">
                                <input name="name"
                                    value="{{ Auth::guard('admin')->user()->first_name . '_' . Auth::guard('admin')->user()->last_name }}"
                                    type="text" class="form-control floating" readonly>
                            </div>
                            <label class="focus-label">Email</label>
                            <div class="input-group form-focus my-2">
                                <input
                                    value="{{ Auth::guard('admin')->user()->email }}"
                                    type="text" class="form-control floating" readonly>
                            </div>
                            <label class="focus-label">Phone</label>
                            <div class="input-group form-focus my-2">
                                <input
                                    value="{{ Auth::guard('admin')->user()->cell }}"
                                    type="text" class="form-control floating" readonly>
                            </div>
                            <label class="focus-label">University/Institution</label>
                            <div class="input-group form-focus my-2">
                                <input
                                    value="{{ Auth::guard('admin')->user()->uniname }}"
                                    type="text" class="form-control floating" readonly>
                            </div>
                            <div class="form-group">
                                <hr>
                                <label class="mb-2">Your File (<span class="text-danger">Only Support PDF File</span>)</label>
                                <img style="max-width: 25%;" id="profile-photo-preview" src=""
                                    alt="">
                                <br>
                                    <input  id="profile-photo" name="documentFile" type="file"
                                    class="form-control">
                                {{-- <label for="profile-photo"><img style="cursor: pointer;width: 50px !important"
                                        class="w-25" src="{{ asset('admin\assets\img\upload.gif') }}"
                                        alt=""></label> --}}
                                <br>
                                @if($errors->has('documentFile'))
                                    <span class="text-danger"> {{$errors->first('documentFile')}} </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <button style="border-radius: 50px"
                                class="btn border border-2 btn-md my-2 btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>

</body>

</html>
