<footer class="pt-5">
    <div class="container">
        <?php $settings = \App\Models\Setting::all(); ?>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="">
                    <div class="logo">
                        <a href="/">
                            <img src="{{ asset('uploads/' . $settings[7]->image) }}" width="60px" height="60px" />
                        </a>
                    </div>
                </div>

                <div class="additionl-data mt-11">
                    <h2>تواصل معنا</h2>
                </div>
                <p class="text-gray-dark">
                    مواعيد وقت العمل الرسمية من 10 صباحا حتي 6 مساءا
                </p>

                <div>
                    <div class="media aligned-row mt-11">
                        <div class="image-holder">
                            <img src="{{ asset('assets/images/Group56027.png') }}" width="60px" height="60px" />
                        </div>
                        <div class="info mx-2">
                            <p class="text-gray gray-only">لديك اسئلة؟</p>
                            <p class="text-gray-dark">{{ $settings[1]->value }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-5">
                <div class="titleHolder">
                    <h2>روابط سريعة</h2>
                </div>
                <ul>
                    <li>
                        <a class="text-gray" href="/about">عن الموقع</a>
                    </li>
                    <li>
                        <a class="text-gray" href="/show/service/1">خدماتنا</a>
                    </li>
                    <li>
                        <a class="text-gray" href="/contact">تواصل معنا</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 colmd-6 col-lg-3">
                <div class="titleHolder">
                    <h2>روابط سوشيال ميديا</h2>
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
                <p class="text-gray">© 2024 حقوق النشر لوكالة أبوالخير. كل الحقوق محفوظة. <i class="fas fa-heart fa-lg text-white"></i> <a href="/"> <span class="styleFooterText">ابو الخير للسفريات</span></a></p>
            </div>
        </div>
    </div>
</footer>
