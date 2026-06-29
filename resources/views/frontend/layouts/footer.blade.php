<footer id="newsletter">
    <div class="container">
        {{-- <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="section-heading">
                        <h4 class="border p-3">Marketing Olympiad</h4>
                    </div>
                </div> --}}
        <!-- <div class="col-lg-6 offset-lg-3">
          <form id="search" action="#" method="GET">
            <div class="row">
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <input type="address" name="address" class="email" placeholder="Email Address..." autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6 col-sm-6">
                <fieldset>
                  <button type="submit" class="main-button">Subscribe Now <i class="fa fa-angle-right"></i></button>
                </fieldset>
              </div>
            </div>
          </form>
        </div> -->
        {{-- </div> --}}
        <div class="row justify-content-between pt-5 mt-5">
            {{-- <div class="col-lg-3">
                    <div class="footer-widget"> --}}
            {{-- <h4>Map</h4> --}}
            <!-- <div class="logo">
              <img src="assets/images/logo.png" alt="">
            </div> -->
            {{-- <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.7511550848762!2d90.4098196146581!3d23.79187409310831!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c74647ffa317%3A0x1cad1ee337675c10!2sBangladesh%20BRAND%20FORUM!5e0!3m2!1sen!2sbd!4v1680415814060!5m2!1sen!2sbd"
                            width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div> --}}
            <div class="col-lg-3 f">
                <div class="footer-widget">
                    <h4>Contact Us</h4>
                    <p>Apartment No-9/A (Level-9), House No - 30 CWN (A), Road No - 42/43 Gulshan-2, Dhaka-1212,
                        Bangladesh</p>
                    <!--<p><a href="tel:+880 1712-732124">+880 1712-732124</a></p>-->
                    <p><a href="mailto:support@marketingolympiad.com">support@marketingolympiad.com</a></p>
                </div>
            </div>
            <div class="col-lg-3 border-end h-50">
                <div class="footer-widget">
                    <h4>About Us</h4>
                    <ul>
                        <li><a href="#top">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#guidelines">Guidelines</a></li>
                        <li><a href="#rules">Rules & Regulation</a></li>
                        <li><a href="{{ route('tc.page') }}">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>

            <!-- <div class="col-lg-3">
          <div class="footer-widget">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Free Apps</a></li>
              <li><a href="#">App Engine</a></li>
              <li><a href="#">Programming</a></li>
              <li><a href="#">Development</a></li>
              <li><a href="#">App News</a></li>
            </ul>
            <ul>
              <li><a href="#">App Dev Team</a></li>
              <li><a href="#">Digital Web</a></li>
              <li><a href="#">Normal Apps</a></li>
            </ul>
          </div>
        </div> -->

            <div class="col-lg-3">
                <div class="footer-widget">
                    <h4>Archive</h4>
                    <ul>
                        {{-- <li><a href="#calender">Calender</a></li> --}}
                        <li><a href="{{ route('student.result.2023') }}">Result 2023</a></li>
                        <!--<li><a href="#rules">Rules & Regulation</a></li>-->
                        <!--<li><a href="#calender">Calender</a></li>-->
                    </ul>
                    <!-- <ul>
              <li><a href="#">About</a></li>
              <li><a href="#">Testimonials</a></li>
              <li><a href="#">Pricing</a></li>
            </ul> -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    @if (!empty($social->facebook))
                        <a style="font-size: 30px;color: white;" href="{{ $social->facebook }}" target="_blank"><i
                                class="fab fa-facebook-f mx-2" aria-hidden="true"></i></a>
                    @endif
                    @if (!empty($social->instagram))
                        <a style="font-size: 30px;color: white;" href="{{ $social->instagram }}" target="_blank"><i
                                class="fab fa-instagram mx-2"></i></a>
                    @endif
                    @if (!empty($social->linkedin))
                        <a style="font-size: 30px;color: white;" href="{{ $social->linkedin }}" target="_blank"><i
                                class="fab fa-linkedin-in mx-2" aria-hidden="true"></i></a>
                    @endif
                    @if (!empty($social->youtube))
                        <a style="font-size: 30px;color: white;" href="{{ $social->youtube }}" target="_blank"><i
                                class="fab fa-youtube mx-2" aria-hidden="true"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-12">
                <div class="copyright-text">
                    <p>{{ $theme->copyright }}</p>
                    <!-- <br>Design: <a href="https://templatemo.com/" target="_blank" title="css templates">TemplateMo</a></p> -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="copyright-text">
                    <p style="margin-top:15px !important" class="text-uppercase">Design & Developed by <a
                            href="https://webolutionbd.com/" target="_blank"><u>Webolution BD</u></a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
