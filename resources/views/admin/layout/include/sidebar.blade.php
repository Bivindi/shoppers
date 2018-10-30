<aside id="left-sidebar-nav">
    @if(Auth::user()->hasRole("seller"))
        @include("seller.layout.include.sidebar")
    @else
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
                            <li><a href="{{ route('get:profile') }}"><i class="mdi-action-face-unlock"></i> Profile</a>
                            </li>
                            <li><a href="#"><i class="mdi-action-settings"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="{{ route('get:logout') }}"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
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
            <li class="bold active"><a href="{{ route('get:dashboard') }}" class="waves-effect waves-cyan"><i
                            class="mdi-action-dashboard"></i> Dashboard</a>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('employee') || Auth::user()->hasRole('seller'))
                        @if(Auth::user()->hasRole('admin'))
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-account-circle"></i> Employee</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:add_employee') }}">Add Employee</a>
                                    </li>
                                    <li><a href="{{ route('get:manage_employee') }}">Manage Employee</a>
                                    </li>
                                    <li><a href="{{ route('get:add_holiday') }}">Add Holiday</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan">
                            <i class="mdi-image-palette"></i> Payments</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:manage_payment_request') }}">Manage Payment Requests</a></li>
                                </ul>
                            </div>
                        </li>

                        @endif
                        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('employee'))
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-account-circle"></i> Seller</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:manage_seller') }}">Manage Seller</a>
                                    </li>

                                
                                </ul>
                            </div>
                        </li>
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-account-balance"></i> Tax Class</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:add_tax_cass') }}">Add Tax Class</a>
                                    </li>
                                    <li><a href="{{ route('get:manage_tax_class') }}">Manage Tax Class</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-editor-attach-money"></i> Currencies</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:add_currencies') }}">Add Currencies</a>
                                    </li>
                                    <li><a href="{{ route('get:manage_currencies') }}">Manage Currencies</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-invert-colors"></i> Testimonial</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:add_testimonials') }}">Add Testimonial</a>
                                    </li>
                                    <li><a href="{{ route('get:manage_testimonials') }}">Manage Testimonial</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-invert-colors"></i> Homepage Pages</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:add_about_us') }}"> About Us</a>
                                    </li>
                                    <li><a href="{{ route('get:add_privacy_policy') }}">Privacy Policy</a>
                                    </li>
                                    <li><a href="{{ route('get:add_terms_condition') }}">Terms & condition</a>
                                    </li>
                                    <li><a href="{{ route('get:add_faq') }}">FAQ</a>
                                    </li>
                                    <li><a href="{{ route('get:add_delivery_info') }}">Delivery Info</a>
                                    </li>
                                    <li><a href="{{ route('get:add_cancellation_policy') }}">Cancellation Policy</a>
                                    </li>
                                    <li><a href="{{ route('get:add_seller_policy') }}">Seller Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        <!--<li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-verified-user"></i> Permission</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:add_permission') }}">Add Permission</a>
                                    </li> 
                                    <li><a href="{{ route('get:manage_permission') }}">Manage Permission</a>
                                    </li>
                                    <li><a href="{{ route('get:assign_permission') }}">Assign Permission</a>
                                    </li>
                                    <li><a href="{{ route('get:manage_assign_permission') }}">Manage Assign Permission</a>
                                    </li>
                                </ul>
                            </div>
                        </li>-->
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-invert-colors"></i> Category</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:add_category') }}">Add Category</a>
                                    </li>
                                    <li><a href="{{ route('get:manage_category') }}">Manage Category</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-invert-colors"></i> SubCategory</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:add_subcategory') }}">Add SubCategory</a>
                                    </li>
                                    <li><a href="{{ route('get:manage_subcategory') }}">Manage SubCategory</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Ishwar Changes start -->
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-invert-colors"></i> SubCategory2</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:add_subcategory2') }}">Add SubCategory2</a>
                                    </li>
                                    <li><a href="{{ route('get:manage_subcategory2') }}">Manage SubCategory2</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Ishwar Changes Over -->
                        
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-invert-colors"></i> Brand</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:add_brand') }}">Add Brand</a>
                                    </li>
                                    <li><a href="{{ route('get:manage_brand') }}">Manage Brand</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-action-invert-colors"></i> Reports</a>
                            <div class="collapsible-body">
                                <ul>
                                    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('employee'))
                                    <li><a href="{{ route('get:seller_commission_report') }}"> Seller Commi.</a>
                                    </li>
                                    @endif
                                    <li><a href="{{ route('get:subcategory_commission') }}">Subcategory Commi.</a>
                                    </li>
                                    <li><a href="{{ route('get:order_report') }}">Order Report</a>
                                    </li>
                                    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('employee'))
                                    
                                    <li><a href="{{ route('get:recharge_report') }}">Recharge Report</a>
                                    </li>
                                    <li><a href="{{ route('get:seller_report') }}">Seller Report</a>
                                    </li>

                                    <li><a href="{{ route('get:manage_seller_sales_report') }}">Sales Report</a></li>
                                    @endif

                                    @if(Auth::user()->hasRole('seller'))
                                        <li><a href="{{ route('get:seller_sales_report') }}">Sales Report</a></li>
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
                                    <li><a href="{{ route('get:manage_seller_holidays') }}">Add Holiday</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>

                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan">
                            <i class="mdi-image-palette"></i> Payments</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:seller_payment_request') }}">Add Payment Request</a></li>
                                    <li><a href="{{ route('get:view_seller_payment_request') }}">View Payment Request</a></li>
                                
                                </ul>
                            </div>
                        </li>

                    @endif

                    @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('seller'))
                    
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i
                                        class="mdi-image-palette"></i> Products</a>
                            <div class="collapsible-body">
                                <ul>
                                
                                    <li><a href="{{ route('get:add_products_select_category') }}">Add Products</a>

                                        

                                    </li>
                                    <li><a href="{{ route('get:add_bulk_products') }}">Add Bulk Products</a>
                                    </li>
                                    <li><a href="{{ route('get:manage_products','all') }}">Manage Products</a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan">
                            <i class="mdi-image-palette"></i> Orders</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="{{ route('get:manage_order') }}">Manage Order</a></li>
                                    <li><a href="{{ route('get:manage_cancel_order') }}">Manage Cancel Order</a></li>
                                    <li><a href="{{ route('get:manage_return_order') }}">Manage Return Order</a></li>
                                </ul>
                            </div>
                        </li>

                    

                        <li class="bold"><a href="{{ route('get:manage_subcategory') }}">Manage SubCategory</a>
                        </li>
                        <!-- <li class="bold"><a href="{{ route('get:manage_cancel_order') }}">Manage Cancel Order</a> </li>
                        <li class="bold"><a href="{{ route('get:manage_order') }}" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Manage Order</a> -->
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
    @endif
    <a href="#" data-activates="slide-out"
       class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i
                class="mdi-navigation-menu"></i></a>
</aside>