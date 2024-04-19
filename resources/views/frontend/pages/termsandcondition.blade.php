@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Terms And Condition</title>
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container">

        <div class="row justify-content-center mt-5">
            <div class="text-center">
                <a href="{{ route('home.page') }}"><img style="height: 150px"
                        src="{{ asset('storage/logo/' . $theme->logo) }}" alt=""></a>
            </div>
            <div class="col-md-12">
                <p style="text-align: justify">Terms of Use <br><br>
                    Effective: May 10, 2023. <br><br>
                    Thank you for using Marketing Olympiad!<br> <br>
                    Marketing Olympiad products and services are provided by Bangladesh Brand Forum. These Terms of Use
                    ("Terms") govern your use of Marketing Olympiad's website, apps, and other products and services
                    ("Services"). As some of our Services may be software that is downloaded to your computer, phone,
                    tablet, or other device, you agree that we may automatically update this software, and that these
                    Terms will apply to such updates. Please read these Terms carefully, and contact us if you have any
                    questions. By using our Services, you agree to be bound by these Terms, including the policies
                    referenced in these Terms. <br><br>
                    Using Marketing Olympiad<br><br>
                    Who May Use our Services? <br><br>
                    You may use our Services only if you can form a binding contract with Marketing Olympiad, and only
                    in compliance with these Terms and all applicable laws. When you create your Marketing Olympiad
                    account, and subsequently when you use certain features, you must provide us with accurate and
                    complete information, and you agree to update your information to keep it accurate and complete. Any
                    use or access by anyone under the age of 13 is prohibited, and certain courses may have additional
                    requirements and/or restrictions. <br><br>
                    Our License to You <br><br>
                    Subject to these Terms and our policies (including the Acceptable Use Policy, Honor Code, and
                    course-specific eligibility requirements and other terms), we grant you a limited, personal,
                    non-exclusive, non-transferable, and revocable license to use our Services. You may download content
                    from our Services only for your personal, non-commercial use, unless you obtain Marketing Olympiad's
                    written permission to otherwise use the content. You also agree that you will create, access, and/or
                    use only one user account, and you will not share with any third party access to or access
                    information for your account. Using our Services does not give you ownership of any intellectual
                    property rights in our Services or the content you access. <br><br>

                    No Academic Credit <br><br>
                    Unless otherwise explicitly indicated by a credit-granting institution, participation in or
                    completion of a course does not confer any academic credit. Even if credit is awarded by one
                    institution, there is no presumption that other institutions will accept that credit. You agree not
                    to accept credit for completing a course unless you have earned a Course Certificate (or other
                    equivalent Bangladesh Brand Forum credential) for that course. Bangladesh Brand Forum, the course
                    instructors, and the associated participating institutions have no obligation to have a course
                    recognized by any educational institution or accreditation organization. <br><br>
                    Disclaimer of Student-University Relationship <br><br>
                    Nothing in these Terms or otherwise with respect to your participation in any course: (a)
                    establishes any relationship between you and any educational institution with which Bangladesh Brand
                    Forum may be affiliated; (b) enrolls or registers you in any educational institution, or in any
                    course offered by any educational institution; or (c) entitles you to use the resources of any
                    educational institution beyond participation in the course. <br><br>
                    User Content <br><br>
                    The Services enable you to share your content, such as homework, quizzes, exams, projects, and other
                    assignments you submit, posts you make in the forums, and the like ("User Content"), with Bangladesh
                    Brand Forum, instructors, and/or other users. You retain all intellectual property rights in, and
                    are responsible for, the User Content you share. <br><br>
                    How Bangladesh Brand Forum and Others May Use User Content <br><br>
                    To the extent that you provide User Content, you grant Bangladesh Brand Forum a fully-transferable,
                    royalty-free, perpetual, sublicensable, non-exclusive, worldwide license to copy, distribute,
                    modify, create derivative works based on, publicly perform, publicly display, and otherwise use the
                    User Content. This license includes granting Bangladesh Brand Forum the right to authorize
                    participating institutions to use User Content with their registered students and on-campus learners
                    independent of the Services. Nothing in these Terms shall restrict other legal rights Bangladesh
                    Brand Forum may have to User Content, for example under other licenses. We reserve the right to
                    remove or modify User Content for any reason, including User Content that we believe violates these
                    Terms. <br><br>
                    Feedback <br><br>
                    We welcome your suggestions, ideas, comments, and other feedback regarding the Services
                    ("Feedback"). By submitting any Feedback, you grant us the right to use the Feedback without any
                    restriction or any compensation to you. By accepting your Feedback, Bangladesh Brand Forum does not
                    waive any rights to use similar or related Feedback previously known to Bangladesh Brand Forum,
                    developed by its employees or contractors, or obtained from other sources. <br><br>
                    Security <br><br>
                    We care about the security of our users. While we work to protect the security of your account and
                    related information, Bangladesh Brand Forum cannot guarantee that unauthorized third parties will
                    not be able to defeat our security measures. Please notify us immediately of any compromise or
                    unauthorized use of your account by emailing security@bangladeshbrandforum.com. <br><br>
                    Third Party Content <br><br>
                    Through the Services, you will have the ability to access and/or use content provided by
                    instructors, other users, and/or other third parties and links to websites and services maintained
                    by third parties. Bangladesh Brand Forum cannot guarantee that such third party content, in the
                    Services or elsewhere, will be free of material you may find objectionable or otherwise
                    inappropriate or of malware or other contaminants that may harm your computer, mobile device, or any
                    files therein. Bangladesh Brand Forum disclaims any responsibility or liability related to your
                    access or use of such third party content.
                    Copyright and Trademark Policy <br><br>
                    Bangladesh Brand Forum respects the intellectual property rights of our users, participating
                    institutions, and other third parties and expects our users to do the same when using the Services.
                    We have adopted and implemented the Bangladesh Brand Forum Copyright and Trademark Policy in
                    accordance with applicable law, including the Digital Millennium Copyright Act.
                    Education Research <br><br>
                    Bangladesh Brand Forum is committed to advancing the science of learning and teaching, and records
                    of your participation in courses may be used for education research. In the interest of this
                    research, you may be exposed to variations in the course content. Research findings will typically
                    be reported at the aggregate level. Your personal identity will not be publicly disclosed in any
                    research findings without your express consent. <br><br>
                    Modifying and Terminating our Services <br><br>
                    We are constantly changing and improving our Services. We may add or remove functions, features, or
                    requirements, and we may suspend or stop a Service altogether. Accordingly, Bangladesh Brand Forum
                    may terminate your use of any Service for any reason. If your use of a paid Service is terminated, a
                    refund may be available under our Refund Policy. None of Bangladesh Brand Forum, its participating
                    institutions and instructors, its contributors, sponsors, and other business partners, and their
                    employees, contractors, and other agents (the "Bangladesh Brand Forum Parties") shall have any
                    liability to you for any such action. You can stop using our Services at any time, although we'll be
                    sorry to see you go.<br><br>
                    Disclaimers <br><br>
                    THE SERVICES AND ALL INCLUDED CONTENT ARE PROVIDED ON AN "AS IS" BASIS WITHOUT WARRANTY OF ANY KIND,
                    WHETHER EXPRESS OR IMPLIED. THE BANGLADESH BRAND FORUM PARTIES SPECIFICALLY DISCLAIM ANY AND ALL
                    WARRANTIES AND CONDITIONS OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND
                    NON-INFRINGEMENT, AND ANY WARRANTIES ARISING OUT OF COURSE OF DEALING OR USAGE OF TRADE. THE
                    BANGLADESH BRAND FORUM PARTIES FURTHER DISCLAIM ANY AND ALL LIABILITY RELATED TO YOUR ACCESS OR USE
                    OF THE SERVICES OR ANY RELATED CONTENT. YOU ACKNOWLEDGE AND AGREE THAT ANY ACCESS TO OR USE OF THE
                    SERVICES OR SUCH CONTENT IS AT YOUR OWN RISK.
                    Limitation of Liability <br><br>
                    TO THE MAXIMUM EXTENT PERMITTED BY LAW, THE BANGLADESH BRAND FORUM PARTIES SHALL NOT BE LIABLE FOR
                    ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, OR ANY LOSS OF PROFITS OR
                    REVENUES, WHETHER INCURRED DIRECTLY OR INDIRECTLY, OR ANY LOSS OF DATA, USE, GOODWILL, OR OTHER
                    INTANGIBLE LOSSES, RESULTING FROM: (A) YOUR ACCESS TO OR USE OF OR INABILITY TO ACCESS OR USE THE
                    SERVICES; (B) ANY CONDUCT OR CONTENT OF ANY PARTY OTHER THAN THE APPLICABLE BANGLADESH BRAND FORUM
                    PARTY, INCLUDING WITHOUT LIMITATION, ANY DEFAMATORY, OFFENSIVE, OR ILLEGAL CONDUCT; OR (C)
                    UNAUTHORIZED ACCESS, USE, OR ALTERATION OF YOUR CONTENT OR INFORMATION. IN NO EVENT SHALL BANGLADESH
                    BRAND FORUM'S AGGREGATE LIABILITY FOR ALL CLAIMS RELATED TO THE SERVICES EXCEED TWENTY U.S. DOLLARS
                    ($20) OR THE
                    TOTAL AMOUNT OF FEES RECEIVED BY BANGLADESH BRAND FORUM FROM YOU FOR THE USE OF PAID SERVICES DURING
                    THE PAST SIX MONTHS, WHICHEVER IS GREATER. <br><br>
                    YOU ACKNOWLEDGE AND AGREE THAT THE DISCLAIMERS AND THE LIMITATIONS OF LIABILITY SET FORTH IN THIS
                    TERMS OF USE REFLECT A REASONABLE AND FAIR ALLOCATION OF RISK BETWEEN YOU AND THE BANGLADESH BRAND
                    FORUM PARTIES, AND THAT THESE LIMITATIONS ARE AN ESSENTIAL BASIS TO BANGLADESH BRAND FORUM'S ABILITY
                    TO MAKE THE SERVICES AVAILABLE TO YOU ON AN ECONOMICALLY FEASIBLE BASIS.
                    YOU AGREE THAT ANY CAUSE OF ACTION RELATED TO THE SERVICES MUST COMMENCE WITHIN ONE (1) YEAR AFTER
                    THE CAUSE OF ACTION ACCRUES. OTHERWISE, SUCH CAUSE OF ACTION IS PERMANENTLY BARRED. <br><br>
                    Indemnification <br><br>
                    You agree to indemnify, defend, and hold harmless the Bangladesh Brand Forum Parties from any and
                    all claims, liabilities, expenses, and damages, including reasonable attorneys' fees and costs, made
                    by any third party related to: (a) your use or attempted use of the Services in violation of these
                    Terms; (b) your violation of any law or rights of any third party; or (c) User Content, including
                    without limitation any claim of infringement or misappropriation of intellectual property or other
                    proprietary rights. <br><br>
                    Governing Law and Jurisdiction <br><br>
                    The Services are managed by Bangladesh Brand Forum, which is located in Dhaka, Bangladesh. You agree
                    that any dispute related to these Terms will be governed by the laws of the People’s Republic of
                    Bangladesh, excluding its conflicts of law provisions. You further consent to the personal
                    jurisdiction of and exclusive venue in the federal and state courts located in and serving Dhaka,
                    Bangladesh as the legal forum for any such dispute. <br><br>
                    Excluding claims for injunctive or other equitable relief, for claims related to the Services where
                    the total amount sought is less than ten thousand Bangladesh Taka (10,000.00 BDT), either you or
                    Bangladesh Brand Forum may elect at any point during the dispute to resolve the claim through
                    binding, non-appearance-based arbitration. The dispute will then be resolved using an established
                    alternative dispute resolution ("ADR") provider, mutually agreed upon by you and Bangladesh Brand
                    Forum. The parties and the selected ADR provider shall not involve any personal appearance by the
                    parties or witnesses, unless otherwise mutually agreed by the parties; rather, the arbitration shall
                    be conducted, at the option of the party seeking relief, online, by telephone, or via written
                    submissions alone. Any judgment rendered by the arbitrator may be entered in any court of competent
                    jurisdiction. <br><br>
                    General Terms <br><br>
                    Revisions to the Terms <br><br>
                    We reserve the right to revise the Terms at our sole discretion at any time. Any revisions to the
                    Terms will be effective immediately upon posting by us. For any material changes to the Terms, we
                    will take reasonable steps to notify you of such changes. In all cases, your continued use of the
                    Services after publication of such changes, with or without notification, constitutes binding
                    acceptance of the revised Terms. <br><br>
                    Severability; Waiver <br><br>
                    If it turns out that a particular provision of these Terms is not enforceable, this will not affect
                    any other terms. If you do not comply with these Terms, and we do not take immediate action, this
                    does not indicate that we relinquish any rights that we may have (such as taking action in the
                    future). <br><br>
                    Participating Institutions <br><br>
                    Bangladesh Brand Forum's participating institutions are third party beneficiaries of the Terms and
                    may enforce those provisions of the Terms that relate to them. <br><br>
                    Referenced Policies <br><br>
                    Acceptable Use Policy <br><br>
                    Copyright and Trademark Infringement Policy <br><br>
                    Refund Policy <br><br>
                    Honor Code <br><br>
                    Acceptable Use Policy <br><br>
                    Effective: May 10, 2023 <br><br>
                    Bangladesh Brand Forum's mission is to provide universal access to the world’s best education. We
                    believe strongly in preserving free speech and expression for our learners as well as academic
                    freedom for our partner institutions and instructors. We also want to make sure that all of our
                    learners and instructors feel safe and comfortable while using our Services. We have drafted these
                    guidelines to ensure that people understand and follow the rules when participating in our online
                    community and otherwise using our Services.<br><br>
                    Although we do not routinely screen or monitor content provided by users, we may remove or edit
                    inappropriate content or activity reported to us or suspend, disable, or terminate a user's access
                    to all or part of the Services. <br><br>
                    You are prohibited from using our Services to share content that: <br><br>
                    Contains illegal content or promotes illegal activities with the intent to commit such activities.
                    Please keep in mind that learners who are as young as 13 use Bangladesh Brand Forum, and we do not
                    allow content that is inappropriate for these younger learners. <br><br>
                    Contains credible threats or organizes acts of real-world violence. We don’t allow content that
                    creates a genuine risk of physical injury or property damage, credibly threatens people or public
                    safety, or organizes or encourages harm.
                    Harrasses others. We encourage commentary about people and matters of public interest, but abusive
                    or otherwise inappropriate content directed at private individuals is not allowed. <br><br>
                    Violates intellectual property, privacy, or other rights. Do not share content that you do not have
                    the right to share, claim content that you did not create as your own, or otherwise infringe or
                    misappropriate someone else’s intellectual property or other rights. Always attribute materials used
                    or quoted by you to the original copyright owner.
                    Spams others. Do not share irrelevant or inappropriate advertising, promotional, or solicitation
                    content.
                    Otherwise violates the Bangladesh Brand Forum Terms of Use. Please note that specific courses may
                    have additional rules and requirements. <br><br>
                    You also aren't allowed to: <br><br>
                    Do anything that violates local, state, national or international law or breaches any of your
                    contractual obligations or fiduciary duties.
                    Share your password, let anyone access your account, or do anything that might put your account at
                    risk.
                    Attempt to access any other user's account.
                    Reproduce, transfer, sell, resell, or otherwise misuse any content from our Services, unless
                    specifically authorized to do so.
                    Access, tamper with, or use non-public areas of our systems, unless specifically authorized to do
                    so.
                    Break or circumvent our authentication or security measures or otherwise test the vulnerability of
                    our systems or networks, unless specifically authorized to do so.
                    Try to reverse engineer any portion of our Services.
                    Try to interfere with any user, host, or network, for example by sending a virus, overloading,
                    spamming, or mail-bombing.
                    Use our Services to distribute malware.
                    Impersonate or misrepresent your affiliation with any person or entity.
                    Encourage or help anyone do any of the things on this list. <br><br>
                    Copyright and Trademark Policy <br><br>
                    Effective as of May 10, 2023. <br><br>
                    Bangladesh Brand Forum respects the intellectual property rights of our partner institutions,
                    instructors, and other third parties and expects our users to do the same when using the Services.
                    We reserve the right to suspend, disable, or terminate the accounts of users who repeatedly infringe
                    or are repeatedly charged with infringing the copyrights, trademarks, or other intellectual property
                    rights of others. <br><br>
                    The notice must include the following information: <br><br>
                    the physical or electronic signature of a person authorized to act on behalf of the owner of an
                    exclusive right that is allegedly infringed;
                    identification of the copyrighted work claimed to have been infringed (or, if multiple copyrighted
                    works located on the Services are covered by a single notification, a representative list of such
                    works);
                    identification of the material that is claimed to be infringing or the subject of infringing
                    activity, and information reasonably sufficient to allow Bangladesh Brand Forum to locate the
                    material on the Services;
                    the name, address, telephone number, and email address (if available) of the complaining party;
                    a statement that the complaining party has a good faith belief that use of the material in the
                    manner complained of is not authorized by the copyright owner, its agent, or the law; and
                    a statement that the information in the notification is accurate and, under penalty of perjury, that
                    the complaining party is authorized to act on behalf of the owner of an exclusive right that is
                    allegedly infringed.
                    Notices must meet the then-current statutory requirements imposed by the Copy Right Act, 2000.
                    Notices and counter-notices with respect to the Services can either be sent: <br><br>
                    via mail: Copyright Agent, Bangladesh Brand Forum Apartment No-9/A (Level-9), House No - 30 CWN (A),
                    Road No - 42/43, Gulshan-2, Dhaka-1212 <br><br>
                    via email: support@marketingolympiad.com <br><br>
                    We suggest that you consult your legal advisor before filing a notice. Also, be aware that there can
                    be penalties for false claims under the Copy Right Act, 2000. <br><br>
                    Bangladesh Brand Forum also respects the trademark rights of others. Accounts with any other content
                    that misleads others or violates another's trademark may be updated, suspended, disabled, or
                    terminated by Bangladesh Brand Forum in its sole discretion. If you are concerned that someone may
                    be
                    using your trademark in an infringing way on our Services, please email us at copyright@
                    bangladeshbrandforum.com, and we will review your complaint. If we deem appropriate, we may remove
                    the offending content, warn the individual who posted the content, and/or temporarily or permanently
                    suspend or disable the individual’s account.
                    Bangladesh Brand Forum Refund Policy <br><br>
                    Effective as of May 10, 2023. <br><br>
                    For details on our refund deadlines and policies, please refer to the information below; note that
                    our policies differ for subscription payments vs. one-time course and Specialization purchases, and
                    that payment options may vary from one Service to another. Please also note that we treat violations
                    of our Terms of Use and Honor Code very seriously, and we have no obligation to offer refunds to
                    learners who are found to be in violation of these terms, even if their requests are made within the
                    designated refund period. Similarly, we have no obligation to offer late refunds to learners who do
                    not pass a course or Specialization, or who are otherwise unsatisfied with their final grade.
                    <br><br>
                    For more information about our refund process, including instructions for requesting a refund,
                    please visit our Learner Help Center. <br><br>

                    Effective as of May 10, 2023.
                    All students participating in the class must agree to abide by the following code of conduct:
                    I will register for only one account.
                    My answers to homework, quizzes, exams, projects, and other assignments will be my own work (except
                    for assignments that explicitly permit collaboration).
                    I will not make solutions to homework, quizzes, exams, projects, and other assignments available to
                    anyone else (except to the extent an assignment explicitly permits sharing solutions). This includes
                    both solutions written by me, as well as any solutions provided by the course staff or others.
                    I will not engage in any other activities that will dishonestly improve my results or dishonestly
                    improve or hurt the results of others.
                </p>
                <a href="{{ route('student-register.index') }}" class="btn btn-primary mb-5">Back</a>
            </div>

        </div>
    </div>
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>


</body>

</html>
