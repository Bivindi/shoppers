<ul id="slide-out" class="side-nav fixed leftside-navigation">
    <li class="user-details cyan darken-2">
        <div class="row">
            <div class="col col s4 m4 l4">
                @if(Auth::user()->profile)
                    <img src="{{ asset('profile/'.Auth::user()->profile) }}" alt=""
                        class="circle responsive-img valign profile-image">
                @else
                    <img src="{{ asset('assets/images/avatar.jpg') }}" alt=""
                        class="circle responsive-img valign profile-image">
                @endif
            </div>
            <div class="col col s8 m8 l8">
                <ul id="profile-dropdown" class="dropdown-content">
                    <li><a href="{{ route('get:seller_profile') }}"><i class="mdi-action-face-unlock"></i> Profile</a>
                    </li>
                    <li><a href="#"><i class="mdi-action-settings"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ route('get:seller_logout') }}"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                    </li>
                </ul>
                <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn"
                href="javascript:void(0);"
                data-activates="profile-dropdown">{{ Auth::user()->username }}<i
                            class="mdi-navigation-arrow-drop-down right"></i></a>
                <p class="user-roal">
                    @if(Auth::user()->hasRole('admin'))
                        Administrator
                    @elseif(Auth::user()->hasRole('seller')) 
                        Seller 
                    @else 
                        employee 
                    @endif
                </p>        
            </div>
        </div>
    </li>
    <li class="bold active"><a href="{{ route('get:seller_dashboard') }}" class="waves-effect waves-cyan"><i
                    class="mdi-action-dashboard"></i> Dashboard</a>
    </li>
    <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('employee') || Auth::user()->hasRole('seller'))
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                class="mdi-action-invert-colors"></i> Brand</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('get:seller_add_brand') }}">Add Brand</a>
                            </li>
                            <li><a href="{{ route('get:seller_manage_brand') }}">Manage Brand</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                class="mdi-action-invert-colors"></i> Top Menu Category</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('get:seller_top_menu_category') }}">Select Category</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-invert-colors"></i> Category</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:seller_add_category') }}">Add Category</a>
                                    </li>
                                    <li><a href="{{ route('get:seller_manage_category') }}">Manage Category</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                class="mdi-action-invert-colors"></i> Add Sliders</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('get:seller_homepage_slider') }}">Homepage Slider</a>
                            </li>
                            <li><a href="{{ route('get:seller_sub_category_slider') }}">Subcategory Slider</a>
                            </li>
                            <li><a href="{{ route('get:seller_product_details_slider') }}">Products Slider</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                class="mdi-action-invert-colors"></i> Reports</a>
                    <div class="collapsible-body">
                        <ul>
                            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('employee'))
                            <li><a href="{{ route('get:seller_seller_commission_report') }}"> Seller Commi.</a>
                            </li>
                            @endif
                            <li><a href="{{ route('get:seller_subcategory_commission') }}">Subcategory Commi.</a>
                            </li>
                            <li><a href="{{ route('get:seller_order_report') }}">Order Report</a>
                            </li>
                            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('employee'))
                            
                            <li><a href="{{ route('get:seller_recharge_report') }}">Recharge Report</a>
                            </li>
                            <li><a href="{{ route('get:seller_seller_report') }}">Seller Report</a>
                            </li>

                            <li><a href="{{ route('get:seller_manage_seller_sales_report') }}">Sales Report</a></li>
                            @endif

                            @if(Auth::user()->hasRole('seller'))
                                <li><a href="{{ route('get:seller_seller_sales_report') }}">Sales Report</a></li>
                            @endif

                        </ul>
                    </div>
                </li>
                
            @endif

            @if(Auth::user()->hasRole('seller'))
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                class="mdi-image-palette"></i>Calendar</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('get:seller_manage_seller_holidays') }}">Add Holiday</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <li class="bold"><a class="collapsible-header waves-effect waves-cyan">
                    <i class="mdi-image-palette"></i> Payments</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('get:seller_seller_payment_request') }}">Add Payment Request</a></li>
                            <li><a href="{{ route('get:seller_view_seller_payment_request') }}">View Payment Request</a></li>
                        
                        </ul>
                    </div>
                </li>

            @endif

            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('seller'))
            
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                class="mdi-image-palette"></i> Products</a>
                    <div class="collapsible-body">
                        <ul>
                        
                            <li><a href="{{ route('get:seller_add_products_select_category') }}">Add Products</a>

                                

                            </li>
                            <li><a href="{{ route('get:seller_add_bulk_products') }}">Add Bulk Products</a>
                            </li>
                            <li><a href="{{ route('get:seller_manage_products','all') }}">Manage Products</a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="bold"><a class="collapsible-header waves-effect waves-cyan">
                    <i class="mdi-image-palette"></i> Orders</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('get:seller_manage_order') }}">Manage Order</a></li>
                            <li><a href="{{ route('get:seller_manage_cancel_order') }}">Manage Cancel Order</a></li>
                            <li><a href="{{ route('get:seller_manage_return_order') }}">Manage Return Order</a></li>
                        </ul>
                    </div>
                </li>

            

                <li class="bold"><a href="{{ route('get:seller_manage_subcategory') }}">Manage SubCategory</a>
                </li>
                <!-- <li class="bold"><a href="{{ route('get:seller_manage_cancel_order') }}">Manage Cancel Order</a> </li>
                <li class="bold"><a href="{{ route('get:seller_manage_order') }}" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Manage Order</a> -->
                </li>
            @endif
        </ul>
    </li>
</ul>