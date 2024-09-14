
<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark" id="sidebar" style="width:20%">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="/home" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>

            @role('admin')
                <li>
                    <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Services</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="/services" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">Service</span></a>
                        </li>
                        <li class="w-100">
                            <a href="/services/create" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">Add Service</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Why</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="/why" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">Why</span></a>
                        </li>
                        <li class="w-100">
                            <a href="/why/create" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">Add Why</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Contact Us</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu5" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="/contacts" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">Contact Us</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#submenu6" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Settings</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu6" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="/settings" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">Settings</span></a>
                        </li>
                    </ul>
                </li>
            @endrole

            <hr class="text-white">

            <li>
                <a href="#submenu8" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">المستخدمين</span> </a>
                <ul class="collapse nav flex-column ms-1" id="submenu8" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="/users" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">المستخدمين</span></a>
                    </li>
                    <li>
                        <a href="/users/create" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">إضافة مستخدم</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#submenu9" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                    <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">اللغات</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu9" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="/languages" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">اللغات</span></a>
                    </li>
                    <li>
                        <a href="/languages/create" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">إضافة لغة</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#submenu10" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">المترجمين</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu10" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="/translators" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">المترجمين</span></a>
                    </li>
                    <li>
                        <a href="/translators/create" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">إضافة مترجم</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#submenu20" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">فواتير الترجمة</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu20" data-bs-parent="#menu">

                    <li class="w-100">
                        <a href="/resets" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">فواتير الترجمة</span></a>
                    </li>
                    <li>
                        <a href="/resets/create" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">إضافة فاتورة ترجمة</span></a>
                    </li>

                    <li class="w-100">
                        <a href="/revisions/resets" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">مراحعة فواتير الترجمة</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#submenu37" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">الفواتير التي لم يتم استكمالها</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu37" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="/drafts" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">فواتير الترجمة التي لم يتم استكمالها</span></a>
                        </li>
                    </ul>
            </li>

            <li>
                <a href="#submenu7" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">logout</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu7" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="/logout" class="nav-link text-white px-0"> <span class="d-none d-sm-inline">Logout</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
