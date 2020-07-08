<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href=""><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">Main Page </span></a>
            </li>




            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> Main Categories </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Category::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.categories')}}"
                                          data-i18n="nav.dash.ecommerce">  Show All </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.categories.create')}}" data-i18n="nav.dash.crypto">
                             Add New Category </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> Main Products </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Product::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.products')}}"
                                          data-i18n="nav.dash.ecommerce">  Show All </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.products.create')}}" data-i18n="nav.dash.crypto">
                             Add New Product </a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</div>
