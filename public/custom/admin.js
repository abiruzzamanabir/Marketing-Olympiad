(function ($) {
    $(document).ready(function () {
        $('.submitAnswer').click(function() {
            var currentQuestion = $(this).parent();
            var nextQuestion = currentQuestion.next('.question');
            currentQuestion.hide();
            nextQuestion.show();
            if(nextQuestion.length == 0){
                $("#submitBtn").removeClass('d-none');
            }else{
                $("#submitBtn").addClass('d-none');
            }
        });
        $("#option1").change(function () {
            var value = $("#option1").val();
            $("#answer1").attr("value", value);
            $("#answer1").text(value);
        });
        $("#option2").change(function () {
            var value = $("#option2").val();
            $("#answer2").attr("value", value);
            $("#answer2").text(value);
        });
        $("#option3").change(function () {
            var value = $("#option3").val();
            $("#answer3").attr("value", value);
            $("#answer3").text(value);
        });
        $("#option4").change(function () {
            var value = $("#option4").val();
            $("#answer4").attr("value", value);
            $("#answer4").text(value);
        });

        $("#profile-photo").change(function (e) {
            const photo_url = URL.createObjectURL(e.target.files[0]);
            $("#profile-photo-preview").attr("src", photo_url);
        });
        $("#nidf-photo").change(function (e) {
            const photo_url = URL.createObjectURL(e.target.files[0]);
            $("#nidf-photo-preview").attr("src", photo_url);
        });
        $("#nidb-photo").change(function (e) {
            const photo_url = URL.createObjectURL(e.target.files[0]);
            $("#nidb-photo-preview").attr("src", photo_url);
        });
        $("#sidf-photo").change(function (e) {
            const photo_url = URL.createObjectURL(e.target.files[0]);
            $("#sidf-photo-preview").attr("src", photo_url);
        });
        $("#sidb-photo").change(function (e) {
            const photo_url = URL.createObjectURL(e.target.files[0]);
            $("#sidb-photo-preview").attr("src", photo_url);
        });

        $(".delete-form").submit(function (e) {
            let conf = confirm("Are you sure?");

            if (conf) {
                return true;
            } else {
                e.preventDefault();
            }
        });

        $("#dataTable").DataTable();
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);

        // let btn_no = 1;

        // $("#add-new-slider-button").click(function (e) {
        //     e.preventDefault();

        //     $(".btn-opt-area").append(`
        //                     <div class="btn-section">
        //                     <div class="d-flex justify-content-between">
        //                     <span>Button ${btn_no}</span>
        //                     <span style="cursor: pointer" class="badge badge-danger remove-btn">Remove <i class="fa fa-close" aria-hidden="true"></i></span>
        //                     </div>
        //                     <input name="btn_title[]" class="form-control my-3" type="text" placeholder="Button Title">
        //                     <input name="btn_link[]" class="form-control my-3" type="text" placeholder="Button Link">

        //                     <select class="form-control my-3" name="btn_type[]">
        //                     <option value="btn-light-out">Default</option>
        //                     <option value="btn-color btn-full">Red</option>
        //                     </select>
        //                     </div>
        //             `);
        //     btn_no++;
        // });

        // $(document).on("click", ".remove-btn", function () {
        //     $(this).closest(".btn-section").remove();
        // });

        // $("#percentage").change(function () {
        //     document.getElementById("percentage_val").value = $(this).val();
        // });

        // $(".show-icon").click(function (e) {
        //     e.preventDefault();
        //     $("#select-icon").modal("show");
        // });

        // $(".select-icon-abir .preview-icon").click(function () {
        //     let icon_name = $(this).find("i").attr("class");
        //     $(".select-abir-icon-input").val(icon_name);
        //     $("#select-icon").modal("hide");
        // });
        // $("#portfolio-gallery").change(function (e) {
        //     const files = e.target.files;
        //     let gallery_ui = "";
        //     for (let i = 0; i < files.length; i++) {
        //         const gallery = URL.createObjectURL(files[i]);
        //         gallery_ui += `<img src="${gallery}">`;
        //     }
        //     $(".port-gall").append(gallery_ui);
        // });

        // CKEDITOR.replace("portfolio-desc");
        // $(".js-example-basic-multiple").select2();
        // CKEDITOR.replace("shortdesc");
        // $(".js-example-basic-multiple").select2();
        // CKEDITOR.replace("desc");
        // $(".js-example-basic-multiple").select2();

        // $("#post-type-selector").ready(function () {
        //     var type = $("#post-type-selector option:selected").val();
        //     // const type = $(this).val();

        //     if (type == "standard") {
        //         $(".post-standard").show();
        //         $(".post-gallery").hide();
        //         $(".post-video").hide();
        //         $(".post-audio").hide();
        //         $(".post-quote").hide();
        //     }
        //     if (type == "gallery") {
        //         $(".post-standard").hide();
        //         $(".post-gallery").show();
        //         $(".post-video").hide();
        //         $(".post-audio").hide();
        //         $(".post-quote").hide();
        //     }
        //     if (type == "video") {
        //         $(".post-standard").hide();
        //         $(".post-gallery").hide();
        //         $(".post-video").show();
        //         $(".post-audio").hide();
        //         $(".post-quote").hide();
        //     }
        //     if (type == "audio") {
        //         $(".post-standard").hide();
        //         $(".post-gallery").hide();
        //         $(".post-video").hide();
        //         $(".post-audio").show();
        //         $(".post-quote").hide();
        //     }
        //     if (type == "quote") {
        //         $(".post-standard").hide();
        //         $(".post-gallery").hide();
        //         $(".post-video").hide();
        //         $(".post-audio").hide();
        //         $(".post-quote").show();
        //     }
        // });
        // $("#post-type-selector").change(function () {
        //     const type = $(this).val();

        //     if (type == "standard") {
        //         $(".post-standard").show();
        //         $(".post-gallery").hide();
        //         $(".post-video").hide();
        //         $(".post-audio").hide();
        //         $(".post-quote").hide();
        //     }
        //     if (type == "gallery") {
        //         $(".post-standard").hide();
        //         $(".post-gallery").show();
        //         $(".post-video").hide();
        //         $(".post-audio").hide();
        //         $(".post-quote").hide();
        //     }
        //     if (type == "video") {
        //         $(".post-standard").hide();
        //         $(".post-gallery").hide();
        //         $(".post-video").show();
        //         $(".post-audio").hide();
        //         $(".post-quote").hide();
        //     }
        //     if (type == "audio") {
        //         $(".post-standard").hide();
        //         $(".post-gallery").hide();
        //         $(".post-video").hide();
        //         $(".post-audio").show();
        //         $(".post-quote").hide();
        //     }
        //     if (type == "quote") {
        //         $(".post-standard").hide();
        //         $(".post-gallery").hide();
        //         $(".post-video").hide();
        //         $(".post-audio").hide();
        //         $(".post-quote").show();
        //     }
        // });

        // let size_no = 1;

        // $("#add-new-size-button").click(function (e) {
        //     e.preventDefault();

        //     $(".btn-size-area").append(`
        //                     <div class="btn-section">
        //                     <div class="d-flex justify-content-between">
        //                     <span>Button ${size_no}</span>
        //                     <span style="cursor: pointer" class="badge badge-danger remove-btn">Remove <i class="fa fa-close" aria-hidden="true"></i></span>
        //                     </div>
        //                     <input name="size_name[]" class="form-control my-3" type="text" placeholder="Size ${size_no}">
        //                     </div>
        //             `);
        //     size_no++;
        // });

        // let color_no = 1;

        // $("#add-new-color-button").click(function (e) {
        //     e.preventDefault();

        //     $(".btn-color-area").append(`
        //                     <div class="btn-section">
        //                     <div class="d-flex justify-content-between">
        //                     <span>Button ${color_no}</span>
        //                     <span style="cursor: pointer" class="badge badge-danger remove-btn">Remove <i class="fa fa-close" aria-hidden="true"></i></span>
        //                     </div>
        //                     <input name="color_name[]" class="form-control my-3" type="text" placeholder="Color ${color_no}">
        //                     </div>
        //             `);
        //     color_no++;
        // });

        // $("#product-gallery").change(function (e) {
        //     const files = e.target.files;
        //     let gallery_ui = "";
        //     for (let i = 0; i < files.length; i++) {
        //         const gallery = URL.createObjectURL(files[i]);
        //         gallery_ui += `<img src="${gallery}">`;
        //     }
        //     $(".product-gall").append(gallery_ui);
        // });
    });
})(jQuery);
