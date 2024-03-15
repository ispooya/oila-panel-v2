<div class="navigation border-0">
    <div class="navigation-menu-tab">
        <div>
            <div class="navigation-menu-tab-header" data-toggle="tooltip"
                 title="{{\Illuminate\Support\Facades\Auth::user()->name}}" data-placement="right">
                <a class="nav-link" style="cursor: pointer;">
                    <figure class="avatar avatar-sm">
                        {{--                        <img src="{{asset('images/user-profile.svg')}}" class="rounded-circle" alt="">--}}
                        <img
                            src="{{\Illuminate\Support\Facades\Auth::user()->pic == null ? '/images/man.png' : '/images/user/'.\Illuminate\Support\Facades\Auth::user()->pic}}"
                            class="rounded-circle" alt="">
                    </figure>
                </a>
            </div>
        </div>
        <div class="flex-grow-1">
            <ul>
                <li>
                    <a class="{{(request()->segment(1) == 'home') ? 'active' : ''}}" data-toggle="tooltip"
                       data-placement="right" title="داشبورد"
                       data-nav-target="#dashboard" style="cursor: pointer;">
                        <i data-feather="home"></i>
                    </a>
                </li>
                <li>
                    <a class="{{(request()->segment(1) == 'product') ? 'active' : ''}}"
                       data-toggle="tooltip" data-placement="right" title="محصولات" data-nav-target="#product"
                       style="cursor: pointer;">
                        <i data-feather="package"></i>
                    </a>
                </li>
                <li>
                    <a class="{{(request()->segment(1) == 'mag'  or request()->segment(1) == 'category') ? 'active' : ''}}"
                       data-toggle="tooltip" data-placement="right" title="مجله" data-nav-target="#mag"
                       style="cursor: pointer;">
                        <i data-feather="book"></i>
                    </a>
                </li>
                <li>
                    <a class="{{(request()->segment(1) == 'general' or request()->segment(1) == 'seller') ? 'active' : ''}}"
                       data-toggle="tooltip" data-placement="right" title="عمومی" data-nav-target="#general"
                       style="cursor: pointer;">
                        <i data-feather="database"></i>
                    </a>
                </li>
                <li>
                    <a class="{{(request()->segment(1) == 'user') ? 'active' : ''}}"
                       data-toggle="tooltip" data-placement="right" title="مدیران" data-nav-target="#users"
                       style="cursor: pointer;">
                        <i data-feather="user"></i>
                    </a>
                </li>

                <li>
                    <a class="{{(request()->segment(1) == 'message') ? 'active' : ''}}"
                       data-toggle="tooltip" data-placement="right" title="تماس" data-nav-target="#contact"
                       style="cursor: pointer;">
                        <i data-feather="mail"></i>
                    </a>
                </li>
                <li>
                    <a data-toggle="tooltip" data-placement="right" title="خروج"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                       style="cursor: pointer;">
                        <i data-feather="log-out"></i>
                    </a>
                    <form class="d-none" id="logout-form" action="{{route('logout')}}" method="POST">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>
    </div>

    <div class="navigation-menu-body">
        <div>
            <div id="navigation-logo">
                <img src="{{asset('images/golrang-system-logo.png')}}" class="logo img-fluid" alt=""
                     style="width: 50%;">
            </div>
        </div>
        <div class="navigation-menu-group">
            <div
                class="{{(request()->segment(1) == '' or request()->segment(1) == 'home') ? 'open' : ''}}"
                id="dashboard">
                <ul>
                    <li class="navigation-divider">دسترسی</li>
                    <li>
                        <a href="{{route('home')}}" class="{{(request()->routeIs('home')) ? 'active' : ''}}">
                            <i class="fa fa-inbox" style="margin-left: 5px;font-size: 12px;"></i>
                            داشبورد
                        </a>
                    </li>
                </ul>
            </div>
            <div
                class="{{ request()->segment(1) == 'general' || in_array(request()->segment(1), ['seller', 'faq']) ? 'open' : ''}}"
                id="general">
                <ul>
                    <li class="navigation-divider">محتوا عمومی</li>
                    <li>
                        <a href="{{(route('general.home'))}}"
                           class="{{(request()->routeIs('general.aboutUs')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            صفحه اول
                        </a>
                    </li>
                    <li>
                        <a href="{{(route('general.contactUs'))}}"
                           class="{{(request()->routeIs('general.contactUs')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            ارتباط باما
                        </a>
                    </li>
                    <li>
                        <a href="{{(route('general.aboutUs'))}}"
                           class="{{(request()->routeIs('general.aboutUs')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            درباره ما
                        </a>
                    </li>
                    <li>
                        <a href="{{(route('seller.index'))}}"
                           class="{{(request()->routeIs('seller.index')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            مراکز فروش
                        </a>
                    </li>
                    <li>
                        <a href="{{(route('faq.index'))}}"
                           class="{{(request()->routeIs('faq.index')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            سوالات متداول
                        </a>
                    </li>
                </ul>
            </div>
            <div
                class="{{(request()->segment(1) == 'product' or request()->segment(1) == 'products') ? 'open' : ''}}"
                id="product">
                <ul>
                    <li class="navigation-divider">محصولات</li>
                    <li>
                        <a href="{{(route('product.create'))}}"
                           class="{{(request()->routeIs('product.create')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            افزودن محصول
                        </a>
                    </li>
                    <li>
                        <a href="{{(route('product.index'))}}"
                           class="{{(request()->routeIs('product.index')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            لیست محصولات
                        </a>
                    </li>
                    <li>
                        <a href="{{(route('product.category'))}}"
                           class="{{(request()->routeIs('product.category')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            دسته بندی محصولات
                        </a>
                    </li>
                    <li>
                        <a href="{{(route('product.fpp'))}}"
                           class="{{(request()->routeIs('product.fpp')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            ویژگی های تولید محصول
                        </a>
                    </li>
                    <li>
                        <a href="{{(route('product.uses'))}}"
                           class="{{(request()->routeIs('product.uses')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            موارد استفاده محصول
                        </a>
                    </li>
                </ul>
            </div>
            <div
                class="{{(request()->segment(1) == 'mag' or request()->segment(1) == 'post' or request()->segment(1) == 'category') ? 'open' : ''}}"
                id="mag">
                <ul>
                    <li class="navigation-divider">مجله سلامت</li>
                    <li>
                        <a href="{{(route('category.index'))}}"
                           class="{{(request()->routeIs('category.index')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            دسته بندی
                        </a>
                    </li>
                    <li>
                        <a href="{{(route('post.create'))}}"
                           class="{{(request()->routeIs('post.create')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            افزودن مطلب
                        </a>
                    </li>
                    <li>
                        <a href="{{(route('post.index'))}}"
                           class="{{(request()->routeIs('post.index')) ? 'active' : ''}}">
                            <i class="fa fa-plus" style="margin-left: 5px;font-size: 12px;"></i>
                            لیست مطالب
                        </a>
                    </li>
                </ul>
            </div>
            <div
                class="{{( request()->segment(1) == 'user') ? 'open' : ''}}"
                id="users">
                <ul>
                    <li class="navigation-divider">مدیر</li>
                    <li>
                        <a href="{{route('user.create')}}"
                           class="{{(request()->routeIs('user.create')) ? 'active' : ''}}">
                            <i class="fa fa-user" style="margin-left: 5px;font-size: 12px;"></i>
                            افزودن مدیر
                        </a>
                    </li>
                    <li>
                        <a href="{{route('users.index')}}"
                           class="{{(request()->routeIs('user.create')) ? 'active' : ''}}">
                            <i class="fa fa-user" style="margin-left: 5px;font-size: 12px;"></i>
                            لیست مدیران
                        </a>
                    </li>
                </ul>
            </div>

            <div class="{{(request()->segment(1) == 'message') ? 'open' : ''}}"
                 id="contact">
                <div id="pages">
                    <ul>
                        <li class="navigation-divider">تماس</li>
                        <li>
                            <a href="{{(route('message.index'))}}"
                               class="{{(request()->routeIs('message.index')) ? 'active' : ''}}">
                                <i class="fa fa-phone" style="margin-left: 5px;font-size: 12px;"></i>
                                گزارش تماس ها
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
