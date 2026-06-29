<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Round Two Quiz</title>
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        :root {
            --primary: #7CC6FE;
            --primary-dark: #41aaf6;
            --text: #1f2937;
            --muted: #64748b;
            --border: #dbe7f3;
            --white: #ffffff;
            --shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
        }

        body {
            min-height: 100vh;
            background-image: linear-gradient(rgba(255, 255, 255, 0.42), rgba(255, 255, 255, 0.42)), url({{ asset('storage/logo/WebBanner.png') }});
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: top right;
            background-size: cover;
            color: var(--text);
        }

        input[type="radio"] {
            visibility: hidden;
            position: absolute;
        }

        .quiz-page {
            min-height: 100vh;
            padding: 24px 0 60px;
        }

        .quiz-logo {
            text-align: center;
            margin-bottom: 18px;
        }

        .quiz-logo img {
            height: 150px;
            max-width: 100%;
            object-fit: contain;
        }

        .quiz-layout {
            display: grid;
            grid-template-columns: 210px minmax(0, 1fr);
            gap: 24px;
            align-items: flex-start;
            margin-bottom: 80px;
        }

        .timer-panel {
            position: sticky;
            top: 22px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(219, 231, 243, 0.95);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 22px 18px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .timer-heading {
            font-size: 13px;
            font-weight: 800;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: 16px;
        }

        .timer-number {
            font-size: 58px;
            line-height: 1;
            font-weight: 800;
            color: var(--primary-dark);
            letter-spacing: -2px;
        }

        .timer-label {
            font-size: 14px;
            color: var(--muted);
            font-weight: 700;
            margin-top: 6px;
        }

        .timer-line {
            height: 1px;
            background: var(--border);
            margin: 18px 0;
        }

        .quiz-card {
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(219, 231, 243, 0.95);
            border-radius: 26px;
            box-shadow: var(--shadow);
            padding: 28px 30px 32px;
            backdrop-filter: blur(10px);
        }

        .quiz-topbar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-bottom: 22px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        #showQuestionCounter {
            width: auto !important;
            min-width: 128px;
            margin: 0;
            padding: 9px 18px !important;
            border-radius: 999px;
            background: var(--primary);
            color: #ffffff;
            font-size: 15px;
            line-height: 1.2;
            font-weight: 800;
            text-align: center;
            box-shadow: 0 10px 24px rgba(124, 198, 254, .35);
        }

        .mobile-timer {
            display: none;
            padding: 9px 16px;
            border-radius: 999px;
            background: #ffffff;
            border: 2px solid var(--primary);
            color: var(--primary-dark);
            font-size: 15px;
            font-weight: 800;
            line-height: 1.2;
        }

        .question {
            animation: softIn .25s ease;
        }

        @keyframes softIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .question-image-wrap {
            text-align: center;
            margin-bottom: 18px;
        }

        .question-image-wrap img {
            max-height: 130px !important;
            max-width: 100%;
            object-fit: contain;
            border-radius: 14px;
            background: #ffffff;
            border: 1px solid var(--border);
            padding: 8px;
        }

        .question-title {
            display: block;
            font-size: 20px !important;
            line-height: 1.55;
            font-weight: 700;
            color: #111827;
            text-align: center;
            margin-bottom: 20px;
        }

        .option-label {
            display: block;
            margin: 0 0 12px 0 !important;
            color: var(--text);
            font-weight: 700;
        }

        .bgAllClass {
            padding: 13px 18px !important;
            border-radius: 999px !important;
            border: 2px solid var(--border) !important;
            background: rgba(255, 255, 255, 0.92);
            color: var(--text);
            font-size: 16px;
            line-height: 1.45;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
        }

        .bgAllClass:hover {
            border-color: var(--primary) !important;
            background: #f8fcff;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(124, 198, 254, .20);
        }

        .bgcolorClass {
            background: var(--primary) !important;
            color: #ffffff !important;
            border-color: var(--primary) !important;
            box-shadow: 0 12px 26px rgba(124, 198, 254, .35);
        }

        .submitAnswer,
        #submitBtn {
            background-color: var(--primary) !important;
            color: #ffffff !important;
            border-radius: 999px !important;
            border: 2px solid transparent !important;
            min-width: 150px;
            padding: 11px 28px !important;
            font-size: 15px;
            font-weight: 800;
            box-shadow: 0 12px 26px rgba(124, 198, 254, .35);
        }

        .submitAnswer:hover,
        #submitBtn:hover {
            background-color: var(--primary-dark) !important;
            color: #ffffff !important;
        }

        @media (max-width: 991px) {
            .quiz-layout {
                grid-template-columns: 170px minmax(0, 1fr);
                gap: 18px;
            }

            .timer-number {
                font-size: 46px;
            }

            .quiz-card {
                padding: 24px;
            }
        }

        @media (max-width: 769px) {
            body {
                background-position: center right !important;
                background-size: cover !important;
                background-image: linear-gradient(rgba(255, 255, 255, 0.42), rgba(255, 255, 255, 0.42)), url({{ asset('storage/logo/WebBannerM.png') }}) !important;
            }

            .quiz-page {
                padding: 18px 0 40px;
            }

            .quiz-logo img {
                height: 110px;
            }

            .quiz-layout {
                display: block;
                margin-bottom: 40px;
            }

            .timer-panel {
                display: none;
            }

            .mobile-timer {
                display: inline-block;
            }

            .quiz-card {
                padding: 20px 16px 24px;
                border-radius: 22px;
            }

            .quiz-topbar {
                justify-content: space-between;
                gap: 10px;
                margin-bottom: 18px;
                padding-bottom: 14px;
            }

            #showQuestionCounter,
            .mobile-timer {
                font-size: 13px;
                padding: 8px 12px !important;
                min-width: auto;
            }

            .question-title {
                font-size: 17px !important;
                line-height: 1.5;
                margin-bottom: 17px;
            }

            .bgAllClass {
                border-radius: 18px !important;
                font-size: 15px;
                padding: 12px 14px !important;
            }
        }
    </style>
</head>

<body>
    <main class="quiz-page">
        <div class="container">
            <div class="quiz-logo">
                <img src="{{ asset('storage/logo/logo_text.png') }}" alt="Marketing Olympiad">
            </div>

            <div class="quiz-layout">
                <aside class="timer-panel">
                    <div class="timer-heading">Time Remaining</div>

                    <div>
                        <div class="timer-number"><span id="m"></span><span id="min"></span></div>
                        <div class="timer-label">Min</div>
                    </div>

                    <div class="timer-line"></div>

                    <div>
                        <div class="timer-number"><span id="z"></span><span id="remain"></span></div>
                        <div class="timer-label">Sec</div>
                    </div>
                </aside>

                <section class="quiz-card">
                    <div class="quiz-topbar">
                        <div class="mobile-timer">
                            <span id="minn"></span> : <span id="remainn"></span>
                        </div>
                        <h4 id="showQuestionCounter"></h4>
                    </div>

                    <form id="round1" action="{{ route('round.two.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="duration" id="duration">
                        <input type="hidden" name="is_disqualified" id="is_disqualified" value="0">
                        <input type="hidden" name="disqualification_reason" id="disqualification_reason" value="">
                        <input type="hidden" name="" id="question_qty" value="{{ count($question) }}">

                        @foreach ($question as $key => $ques)
                            <div class="question" style="{{ $key == 0 ? '' : 'display:none' }}">
                                @if (!empty($ques['image_question']))
                                    <div class="question-image-wrap">
                                        <img src="{{ asset('storage/questionTwo/' . $ques['image_question']) }}"
                                            alt="IMG">
                                    </div>
                                @endif

                                <strong class="question-title">{{ $ques['question'] }}</strong>

                                <input type="hidden" name="question[{{ $key }}]" value="{{ $ques['id'] }}">
                                <input type="hidden" name="category_id[{{ $key }}]"
                                    value="{{ $ques['category_id'] }}">

                                @foreach (json_decode($ques['option']) as $keyIndex => $options)
                                    <label class="option-label" for="{{ 'option_' . $key . '_' . $keyIndex }}">
                                        <div id="{{ 'bgcolor_' . $key . '_' . $keyIndex }}" class="bgAllClass">
                                            <input type="radio" id="{{ 'option_' . $key . '_' . $keyIndex }}"
                                                data-parentID="{{ 'bgcolor_' . $key . '_' . $keyIndex }}"
                                                name="answer[{{ $key }}]" value="{{ $options }}"
                                                class="optionCheck border">
                                            {{ $options }}
                                        </div>
                                    </label>
                                @endforeach

                                <button class="btn btn-md my-3 submitAnswer d-none mx-auto d-block" type="button">
                                    Confirm
                                </button>
                            </div>
                        @endforeach

                        <div class="text-center">
                            <button class="btn btn-md my-2 d-none" type="submit" id="submitBtn">
                                Submit
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('custom/admin.js') }}"></script>
    <script type="text/javascript">
        const autosaveUrl = "{{ route('round.two.autosave') }}";
        const csrfToken = "{{ csrf_token() }}";
        let activeQuestionIndex = 0;
        let answerSaving = false;

        function updateQuestionCounter() {
            const total = parseInt($("#question_qty").val(), 10) || $(".question").length;
            const current = Math.min(activeQuestionIndex + 1, total);
            $("#showQuestionCounter").text(`${current} / ${total}`);
        }

        function showQuestion(index) {
            const questions = $(".question");
            questions.hide();
            questions.eq(index).show();
            activeQuestionIndex = index;
            updateQuestionCounter();
        }

        function getQuestionPayload(questionEl) {
            const qInput = questionEl.find('input[name^="question["]');
            const cInput = questionEl.find('input[name^="category_id["]');
            const checked = questionEl.find('input[type="radio"]:checked');

            if (!checked.length) {
                return null;
            }

            return {
                _token: csrfToken,
                question_id: qInput.val(),
                category_id: cInput.val(),
                answer: checked.val(),
                duration: $("#duration").val()
            };
        }

        function saveConfirmedAnswer(questionEl) {
            const payload = getQuestionPayload(questionEl);

            if (!payload || answerSaving) {
                return $.Deferred().reject().promise();
            }

            answerSaving = true;

            return $.ajax({
                url: autosaveUrl,
                method: 'POST',
                data: payload
            }).always(function() {
                answerSaving = false;
            }).fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Answer not saved',
                    text: 'Please check your connection and confirm the answer again.',
                    confirmButtonColor: '#41aaf6'
                });
            });
        }

        function submitFinalExam() {
            if (examSubmitted) return;
            examSubmitted = true;
            $("#showQuestionCounter").text('Submitting...');
            document.getElementById("round1").submit();
        }

        $(document).ready(function() {
            showQuestion(0);

            $(document).on('change', '.optionCheck', function() {
                const parentId = $(this).attr('data-parentID');
                const questionEl = $(this).closest('.question');

                questionEl.find('.bgAllClass').removeClass('bgcolorClass');
                $('#' + parentId).addClass('bgcolorClass');
                questionEl.find('.submitAnswer').removeClass('d-none');
            });

            $(document).on('click', '.submitAnswer', function() {
                const btn = $(this);
                const questionEl = btn.closest('.question');
                const total = $('.question').length;

                if (!questionEl.find('input[type="radio"]:checked').length) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Select an answer',
                        text: 'Please select an option before confirming.',
                        confirmButtonColor: '#41aaf6'
                    });
                    return;
                }

                btn.prop('disabled', true).text('Saving...');

                saveConfirmedAnswer(questionEl).done(function() {
                    btn.text('Saved');

                    if (activeQuestionIndex + 1 >= total) {
                        submitFinalExam();
                        return;
                    }

                    showQuestion(activeQuestionIndex + 1);
                    btn.prop('disabled', false).text('Confirm');
                }).fail(function() {
                    btn.prop('disabled', false).text('Confirm');
                });
            });

            $('#round1').on('submit', function() {
                examSubmitted = true;
            });
        });
    </script>

    <script type="text/javascript">
        let warningCount = 0;
        let examSubmitted = false;
        let securityPopupOpen = false;

        function submitExamBySecurity() {
            if (examSubmitted) return;

            examSubmitted = true;
            document.getElementById("is_disqualified").value = "1";
            document.getElementById("disqualification_reason").value = "Leaving the exam window or changing tabs multiple times.";
            $("#submitBtn").removeClass("d-none");
            document.getElementById("round1").submit();
        }

        function showSecurityWarning() {
            if (securityPopupOpen || examSubmitted) return;

            warningCount++;

            if (warningCount === 1) {
                securityPopupOpen = true;

                Swal.fire({
                    icon: "warning",
                    title: "Security Warning",
                    html: `
                    <div style="text-align:center;">
                        <p style="font-size:15px;margin-bottom:8px;">
                            You have switched tabs or left the exam window.
                        </p>
                        <p style="font-size:14px;margin-bottom:0;color:#64748b;">
                            Please stay on this page. One more violation will automatically submit your exam.
                        </p>
                    </div>
                `,
                    confirmButtonText: "Continue Exam",
                    confirmButtonColor: "#41aaf6",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then(function() {
                    securityPopupOpen = false;
                });

                return;
            }

            securityPopupOpen = true;
            let timerInterval;

            Swal.fire({
                icon: "error",
                title: "Disqualified",
                html: `
                <div style="text-align:center;">
                    <p style="font-size:15px;margin-bottom:8px;">
                        You have been <strong>disqualified</strong> for leaving the exam window or changing tabs multiple times.
                    </p>

                    <h2 id="securityCountdown" style="color:#dc2626;font-weight:800;margin:14px 0 6px;">
                        5
                    </h2>

                    <p style="font-size:14px;margin-bottom:0;color:#64748b;">
                        Your exam will be submitted automatically in <strong>5 seconds</strong>.
                    </p>
                </div>
            `,
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: function() {
                    let timeLeft = 5;

                    timerInterval = setInterval(function() {
                        timeLeft--;

                        const countdownEl = document.getElementById("securityCountdown");
                        if (countdownEl) {
                            countdownEl.innerHTML = timeLeft;
                        }

                        if (timeLeft <= 0) {
                            clearInterval(timerInterval);
                            submitExamBySecurity();
                        }
                    }, 1000);
                },
                willClose: function() {
                    clearInterval(timerInterval);
                }
            });
        }

        document.addEventListener("visibilitychange", function() {
            if (document.hidden && !examSubmitted) {
                showSecurityWarning();
            }
        });

        window.addEventListener("blur", function() {
            setTimeout(function() {
                if (!document.hidden && !securityPopupOpen && !examSubmitted) {
                    showSecurityWarning();
                }
            }, 300);
        });
    </script>
    <script type='text/javascript'>
        var isCtrl = false;
        document.onkeyup = function(e) {
            if (e.which == 17)
                isCtrl = false;
        }
        document.onkeydown = function(e) {
            if (e.which == 17)
                isCtrl = true;
            if (((e.which == 85) || (e.which == 65) || (e.which == 88) || (e.which == 67) || (e.which == 86) || (e
                    .which == 2) || (e.which == 3) || (e.which == 123) || (e.which == 83)) && isCtrl == true) {
                // swal("Function Disabled By Admin!")
                return false;
            }
        }
        // right click code
        var isNS = (navigator.appName == "Netscape") ? 1 : 0;
        if (navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN || Event.MOUSEUP);

        function mischandler() {
            // swal("Function Disabled By Admin!")
            return false;
        }

        function mousehandler(e) {
            var myevent = (isNS) ? e : event;
            var eventbutton = (isNS) ? myevent.which : myevent.button;
            if ((eventbutton == 2) || (eventbutton == 3)) return false;
        }
        document.oncontextmenu = mischandler;
        document.onmousedown = mousehandler;
        document.onmouseup = mousehandler;
        //select content code disable  alok goyal
        function killCopy(e) {
            return false
        }

        function reEnable() {
            return true
        }
        document.onselectstart = new Function("return false")
        if (window.sidebar) {
            document.onmousedown = killCopy
            document.onclick = reEnable
        }
        // const onConfirmRefresh = function (event) {
        // event.preventDefault();
        // return event.returnValue = "Are you sure you want to leave the page?";
        // }

        if (typeof onConfirmRefresh === "function") {
            window.addEventListener("beforeunload", onConfirmRefresh, {
                capture: true
            });
        }
    </script>
    <script type="text/javascript">
        window.onload = counter;

        function counter() {
            minutes = parseInt("{{ $minute }}", 10);
            seconds = parseInt("{{ $seconds }}", 10);
            count = 0;
            countDown();
        }
    </script>
    <script type="text/javascript">
        function countDown() {
            document.getElementById("min").innerHTML = minutes;
            document.getElementById("remain").innerHTML = seconds;
            document.getElementById("minn").innerHTML = minutes;
            document.getElementById("remainn").innerHTML = seconds;
            document.getElementById("duration").value = count;
            // if (minutes > 1) {
            //     document.getElementById("s").innerHTML = 's';
            // } else {
            //     document.getElementById("s").innerHTML = '';
            // }
            // if (seconds > 1) {
            //     document.getElementById("ss").innerHTML = 's';
            // } else {
            //     document.getElementById("ss").innerHTML = '';
            // }
            if (minutes < 10) {
                document.getElementById("m").innerHTML = '0';
            } else {
                document.getElementById("m").innerHTML = '';
            }
            if (seconds < 10) {
                document.getElementById("z").innerHTML = '0';
            } else {
                document.getElementById("z").innerHTML = '';
            }
            setTimeout("countDown()", 1000);
            if (minutes == 0 && seconds == 0) {
                $("#showQuestionCounter").text(`Submitting...`);
                document.getElementById("round1").submit();
            } else {
                seconds--;
                count++;
                if (seconds < 0 && minutes > 0) {
                    minutes--;
                    seconds = 59;
                }
            }
        }
    </script>



</body>

</html>
