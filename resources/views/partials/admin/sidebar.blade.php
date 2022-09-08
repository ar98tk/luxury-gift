<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <div class="mx-auto">
            <img alt="Logo" src="{{asset('admin-assets/media/logos/dpmhomes.png')}}" class="h-50px logo"/>
        </div>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
									<path
                                        d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z"
                                        fill="black"/>
								</svg>
							</span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu admin -->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-2 py-5 py-lg-8" id="kt_aside_menu_wrapper" data-kt-scroll="true"
             data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
             data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div
                class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('home')) active @endif" href="{{route('home')}}">
										<span class="menu-icon">
											<i class="bi bi-safe fs-3"></i>
										</span>
                        <span class="menu-title">Home</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('admins.index')) active @endif"
                       href="{{route('admins.index')}}">
										<span class="menu-icon">
											<i class="fa fa-user-lock fs-3"></i>
										</span>
                        <span class="menu-title">Admins</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('users.index') || Route::is('users.edit') || Route::is('users.show')) active @endif"
                       href="{{route('users.index')}}">
										<span class="menu-icon">
											<i class="fa fa-users fs-3"></i>
										</span>
                        <span class="menu-title">Users</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('colors.index')) active @endif"
                       href="{{route('colors.index')}}">
										<span class="menu-icon">
											<i class="fa fa-paint-brush fs-3"></i>
										</span>
                        <span class="menu-title">Colors</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('sizes.index')) active @endif"
                       href="{{route('sizes.index')}}">
										<span class="menu-icon">
											<i class="fa fa-box fs-3"></i>
										</span>
                        <span class="menu-title">Sizes</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('messages.index') || Route::is('messages.show')) active @endif"
                       href="{{route('messages.index')}}">
										<span class="menu-icon">
											<i class="fa fa-mail-bulk fs-3"></i>
										</span>
                        <span class="menu-title">Messages</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('categories.index')) active @endif"
                       href="{{route('categories.index')}}">
										<span class="menu-icon">
											<i class="fa fa-code-branch fs-3"></i>
										</span>
                        <span class="menu-title">Categories</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('brands.index')) active @endif"
                       href="{{route('brands.index')}}">
										<span class="menu-icon">
											<i class="fa fa-braille fs-3"></i>
										</span>
                        <span class="menu-title">Brands</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('products.index') || Route::is('products.show') || Route::is('products.create') || Route::is('products.edit')) active @endif"
                       href="{{route('products.index')}}">
										<span class="menu-icon">
											<i class="fa fa-code-branch fs-3"></i>
										</span>
                        <span class="menu-title">Products</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('cities.index')) active @endif"
                       href="{{route('cities.index')}}">
										<span class="menu-icon">
											<i class="fa fa-city fs-3"></i>
										</span>
                        <span class="menu-title">Cities</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link @if(Route::is('settings.index')) active @endif"
                       href="{{route('settings.index')}}">
										<span class="menu-icon">
											<i class="fa fa-cogs fs-3"></i>
										</span>
                        <span class="menu-title">Settings</span>
                    </a>
                </div>
                {{--<div data-kt-menu-trigger="click"
                     class="menu-item here @if(Route::is('countries.index') || Route::is('cities.index') ) show @endif menu-accordion">
									<span class="menu-link">
										<span class="menu-icon">
											<i class="fa fa-city fs-3"></i>
										</span>
										<span class="menu-title">{{trans('sidebar.countries_cities')}}</span>
										<span class="menu-arrow"></span>
									</span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link @if(Route::is('countries.index')) active @endif"
                               href="{{route('countries.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                                <span class="menu-title">{{trans('sidebar.countries')}}</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @if(Route::is('cities.index')) active @endif"
                               href="{{route('cities.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                                <span class="menu-title">{{trans('sidebar.cities')}}</span>
                            </a>
                        </div>
                    </div>
                </div>--}}
            </div>
            <!--end::Menu-->
        </div>
    </div>

</div>
<!--end::Aside-->
