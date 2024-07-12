<footer class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="">
                    <div class="logo">
                        <a href="/">
                            <img src="{{ asset('assets/images/firstLogo.JPG') }}" width="60px" height="60px" />
                        </a>
                    </div>
                </div>

                <div class="additionl-data mt-11">
                    <h2>Contact Us</h2>
                </div>
                <p class="text-gray-dark">
                    Official working hours:
                    From 10 am to 6 pm
                </p>

                <div>
                    <div class="media aligned-row mt-11">
                        <div class="image-holder">
                            <img src="{{ asset('assets/images/Group56027.png') }}" width="60px" height="60px" />
                        </div>
                        <div class="info mx-2">
                            <p class="text-gray gray-only">Got Questions</p>
                            <p class="text-gray-dark">198465</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-5">
                <div class="titleHolder">
                    <h2>Fast Links</h2>
                </div>
                <ul>
                    <li>
                        <a class="text-gray" href="/about">About us</a>
                    </li>
                    <li>
                        <a class="text-gray" href="/show/service/1">Services</a>
                    </li>
                    <li>
                        <a class="text-gray" href="/contact">Contact Us</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 colmd-6 col-lg-3">
                <div class="titleHolder">
                    <h2>Social Links</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ $settings[2]->value }}">
                            <i class="fab fa-facebook fa-lg text-white"></i>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ $settings[3]->value }}">
                            <i class="fab fa-twitter fa-lg text-white"></i>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ $settings[4]->value }}">
                            <i class="fab fa-instagram fa-lg text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <hr />
                <p class="text-gray">© 2024 Copyrights by AboElkheir Agency. All Rights Reserved. Made With <i class="fas fa-heart fa-lg text-white"></i> <a href="/"> <span class="styleFooterText">AboElkheir Agency</span></a></p>
            </div>
        </div>
    </div>
</footer>
