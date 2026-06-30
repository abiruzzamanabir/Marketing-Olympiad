@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions | Marketing Olympiad</title>

    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/templatemo-chain-app-dev.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.css') }}">

    <style>
        body {
            background: #f5f8ff;
            color: #1f2937;
        }

        .terms-hero {
            padding: 160px 0 75px;
            background: linear-gradient(0deg, #0b3d91, #ffffff);
            color: #fff;
            text-align: center;
        }

        .terms-hero h1 {
            font-size: 46px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .terms-hero p {
            color: #fff;
            font-size: 18px;
            opacity: .9;
            margin-bottom: 0;
        }

        .terms-section {
            padding: 70px 0;
        }

        .terms-card {
            background: #fff;
            border-radius: 22px;
            padding: 45px;
            box-shadow: 0 20px 55px rgba(0, 0, 0, .08);
            border: 1px solid rgba(0, 0, 0, .06);
        }

        .terms-card h3 {
            font-size: 30px;
            font-weight: 800;
            color: #061a3a;
            margin-bottom: 22px;
        }

        .terms-card h4 {
            font-size: 20px;
            font-weight: 700;
            color: #0b3d91;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .terms-card p {
            font-size: 16px;
            line-height: 1.8;
            color: #374151;
            margin-bottom: 0;
            text-align: justify;
        }

        .terms-list {
            margin-top: 12px;
            padding-left: 20px;
        }

        .terms-list li {
            font-size: 16px;
            line-height: 1.8;
            color: #374151;
            margin-bottom: 8px;
        }

        .terms-btn {
            background: #0b3d91;
            color: #fff;
            padding: 12px 34px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }

        .terms-btn:hover {
            background: #061a3a;
            color: #fff;
        }

        @media (max-width: 767px) {
            .terms-hero {
                padding: 130px 20px 55px;
            }

            .terms-hero h1 {
                font-size: 34px;
            }

            .terms-card {
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>

    @include('frontend.layouts.landing-menu')

    <section class="terms-hero">
        <div class="container">
            <h1>Terms & Conditions</h1>
            <p>Effective from 2023</p>
        </div>
    </section>

    <section class="terms-section">
        <div class="container">
            <div class="terms-card">

                <h3>Terms of Use</h3>

                <p>
                    Thank you for using Marketing Olympiad. These Terms & Conditions govern your use of the Marketing
                    Olympiad website, registration system, services, communication platforms, and related digital
                    services operated in association with Bangladesh Brand Forum.
                </p>

                <h4>Use of Services</h4>
                <p>
                    By accessing or using Marketing Olympiad services, you agree to comply with these Terms & Conditions
                    and all applicable laws. You must provide accurate, complete, and updated information whenever
                    required for registration, participation, communication, or service access.
                </p>

                <h4>Registration & Participation</h4>
                <p>
                    Participants must submit authentic information during registration. Marketing Olympiad reserves the
                    right to review, verify, approve, reject, suspend, or cancel any registration if the provided
                    information is found inaccurate, incomplete, misleading, duplicated, or inconsistent with the
                    platform rules.
                </p>

                <h4>Eligibility</h4>
                <p>
                    Participation may be subject to specific eligibility criteria, rules, timelines, and requirements
                    announced by Marketing Olympiad. Participants are responsible for reviewing and following all
                    official instructions before submitting any entry, form, or registration.
                </p>

                <h4>User Responsibility</h4>
                <p>
                    Users are responsible for maintaining the confidentiality of their account information, login
                    credentials, and submitted data. Any activity carried out through a user account will be considered
                    the responsibility of the account holder.
                </p>

                <h4>Code of Conduct</h4>
                <p>
                    Participants and users are expected to maintain honesty, professionalism, respect, and fair conduct
                    throughout their engagement with Marketing Olympiad.
                </p>

                <ul class="terms-list">
                    <li>Users must not submit false, copied, misleading, or unauthorized information.</li>
                    <li>Users must not attempt to disrupt, misuse, damage, or unlawfully access the platform.</li>
                    <li>Users must not impersonate another person, team, institution, or organization.</li>
                    <li>Users must not violate any applicable law, regulation, intellectual property right, or platform
                        rule.</li>
                </ul>

                <h4>Content & Intellectual Property</h4>
                <p>
                    All logos, names, designs, visuals, website content, documents, event materials, platform assets,
                    and related intellectual properties of Marketing Olympiad are owned by or licensed to Marketing
                    Olympiad and Bangladesh Brand Forum unless otherwise stated. Users may not copy, reproduce,
                    distribute, modify, or commercially use any platform content without written permission.
                </p>

                <h4>User Submitted Content</h4>
                <p>
                    By submitting information, content, documents, responses, entries, or other materials to Marketing
                    Olympiad, users confirm that they have the necessary rights and permissions to submit such
                    materials. Marketing Olympiad may use submitted materials for review, verification, communication,
                    event management, publication, documentation, and promotional purposes related to the platform.
                </p>

                <h4>Communication</h4>
                <p>
                    By registering or submitting information through the platform, users agree to receive relevant
                    communication from Marketing Olympiad, Bangladesh Brand Forum, or authorized representatives
                    regarding registration, participation, updates, reminders, results, events, or related initiatives.
                </p>

                <h4>Privacy & Data Usage</h4>
                <p>
                    Marketing Olympiad may collect and process user information for registration, verification,
                    communication, participation management, analytics, event operations, and service improvement.
                    Reasonable measures will be taken to protect user information; however, users acknowledge that no
                    digital platform can guarantee absolute security.
                </p>

                <h4>Third-Party Links & Services</h4>
                <p>
                    The platform may contain links, tools, payment systems, embedded services, or content provided by
                    third parties. Marketing Olympiad is not responsible for the content, policies, availability,
                    security, or practices of third-party websites or services.
                </p>

                <h4>Platform Changes</h4>
                <p>
                    Marketing Olympiad may update, modify, suspend, or discontinue any part of the website, registration
                    system, service, feature, content, schedule, rule, or communication process at any time without
                    prior notice.
                </p>

                <h4>Limitation of Liability</h4>
                <p>
                    Marketing Olympiad, Bangladesh Brand Forum, its partners, organizers, employees, representatives,
                    and affiliates shall not be liable for any indirect, incidental, special, consequential, or punitive
                    damages arising from the use of the platform, participation in the initiative, technical issues,
                    data loss, communication delay, or inability to access services.
                </p>

                <h4>Indemnification</h4>
                <p>
                    Users agree to indemnify and hold harmless Marketing Olympiad, Bangladesh Brand Forum, and its
                    related parties from any claims, damages, liabilities, costs, or expenses arising from misuse of the
                    platform, violation of these Terms & Conditions, infringement of rights, or submission of unlawful
                    or inaccurate content.
                </p>

                <h4>Governing Law</h4>
                <p>
                    These Terms & Conditions shall be governed by and interpreted in accordance with the laws of the
                    People’s Republic of Bangladesh. Any dispute shall be subject to the jurisdiction of the competent
                    courts of Bangladesh.
                </p>

                <h4>Policy Updates</h4>
                <p>
                    Marketing Olympiad reserves the right to revise these Terms & Conditions at any time. Updated terms
                    will become effective upon publication on the website. Continued use of the platform after updates
                    indicates acceptance of the revised Terms & Conditions.
                </p>

                <h4>Contact</h4>
                <p>
                    For any questions regarding these Terms & Conditions, users may contact Marketing Olympiad or
                    Bangladesh Brand Forum through the official communication channels provided on the website.
                </p>

                <div class="text-center mt-5">
                    <a href="{{ route('student-register.index') }}" class="terms-btn">Back to Registration</a>
                </div>

            </div>
        </div>

    </section>
    @include('frontend.layouts.footer')

    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>

</body>

</html>
