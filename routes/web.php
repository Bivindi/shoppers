<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::get('/', ['as' => 'get:homepage', 'uses' => 'HomeController@getHomepage']);
    Route::get('category-products', ['as' => 'get:category_products', 'uses' => 'HomeController@getCategoryProducts']);
    Route::get('top-seller-products', ['as' => 'get:top_seller_products', 'uses' => 'HomeController@getTopSellerProducts']);
    Route::post('user-register', ['as' => 'post:user_register', 'uses' => 'Auth\LoginController@postUserRegister']);
    Route::get('verify/{code}', ['as' => 'get:seller_verify', 'uses' => 'Auth\LoginController@getSellerVerify']);
    Route::post('login', ['as' => 'post:user_login', 'uses' => 'Auth\LoginController@postUserLogin']);
    Route::post('forgot-password-mail', ['as' => 'post:forgot_password_mail', 'uses' => 'Auth\LoginController@postForgotPasswordMail']);
    Route::get('reset_password/{code}', ['as' => 'get:reset_password', 'uses' => 'Auth\LoginController@getResetPassword']);
    Route::post('reset_password', ['as' => 'post:reset_password', 'uses' => 'Auth\LoginController@postResetPassword']);

    Route::get('about-us', ['as' => 'get:about_us', 'uses' => 'Auth\LoginController@getAboutUs']);
    Route::get('terms-conditions', ['as' => 'get:terms_conditions', 'uses' => 'Auth\LoginController@getTermsConditions']);
    Route::get('delivery-info', ['as' => 'get:delivery_info', 'uses' => 'Auth\LoginController@getDeliveryInfo']);
    Route::get('cancellation-return-policy', ['as' => 'get:cancellation_policy', 'uses' => 'Auth\LoginController@getCancellationPolicy']);
    Route::get('seller-policy', ['as' => 'get:seller_policy', 'uses' => 'Auth\LoginController@getSellerPolicy']);
    Route::get('faq-support', ['as' => 'get:faq_support', 'uses' => 'Auth\LoginController@getFaqSupport']);
    Route::get('privacy-policy', ['as' => 'get:privacy_policy', 'uses' => 'Auth\LoginController@getPrivacyPolicy']);

    //contact us
    Route::get('contact-us', ['as' => 'get:contact_us', 'uses' => 'Auth\LoginController@getContactUs']);
    Route::post('contact-us', ['as' => 'post:contact_us', 'uses' => 'Auth\LoginController@postContactUs']);

    //login form
    Route::get('login-form', ['as' => 'get:login_form', 'uses' => 'Auth\LoginController@getLoginForm']);
    //recharge routes
    Route::get('prepaid-recharge', ['as' => 'get:prepaid_recharge', 'uses' => 'RechargeController@getPrepaidRecharge']);
    Route::get('postpaid-recharge', ['as' => 'get:postpaid_recharge', 'uses' => 'RechargeController@getPostpaidRecharge']);
    Route::get('datacard-recharge', ['as' => 'get:datacard_recharge', 'uses' => 'RechargeController@getDataCardRecharge']);
    Route::get('dth-recharge', ['as' => 'get:dth_recharge', 'uses' => 'RechargeController@getDthRecharge']);
    Route::get('broadband-recharge', ['as' => 'get:broadband_recharge', 'uses' => 'RechargeController@getBroadbandRecharge']);
    Route::get('electricity-recharge', ['as' => 'get:electricity_recharge', 'uses' => 'RechargeController@getElectricityRecharge']);
    Route::get('gas-recharge', ['as' => 'get:gas_recharge', 'uses' => 'RechargeController@getGasRecharge']);
    Route::get('water-recharge', ['as' => 'get:water_recharge', 'uses' => 'RechargeController@getWaterRecharge']);
    Route::get('land-line-recharge', ['as' => 'get:land_line_recharge', 'uses' => 'RechargeController@getLandLineRecharge']);
    Route::get('recharge-plans', ['as' => 'get:recharge_plans', 'uses' => 'RechargeController@getRechargePlans']);

    //recharge routes
    Route::post('recharge', ['as' => 'post:recharge', 'uses' => 'RechargeController@postRecharge']);
    Route::post('datacard-recharge', ['as' => 'post:datacard_recharge', 'uses' => 'RechargeController@postDataCardRecharge']);
    Route::post('dth-recharge', ['as' => 'post:dth_recharge', 'uses' => 'RechargeController@postDthRecharge']);
    Route::post('electricity-recharge', ['as' => 'post:electricity_recharge', 'uses' => 'RechargeController@postElectricityRecharge']);
    Route::post('gas-recharge', ['as' => 'post:gas_recharge', 'uses' => 'RechargeController@postGasRecharge']);
    Route::post('water-recharge', ['as' => 'post:water_recharge', 'uses' => 'RechargeController@postWaterRecharge']);
    Route::post('land-line-recharge', ['as' => 'post:land_line_recharge', 'uses' => 'RechargeController@postLandLineRecharge']);
    Route::get('recharge-callback', ['as' => 'get:recharge_callback', 'uses' => 'RechargeController@getRechargeCallback']);

    //order routes
    Route::get('order/{transaction_id?}', ['as' => 'get:order_page', 'uses' => 'HomeController@getOrder']);

    //products details routes
    Route::get('product/{slug}', ['as' => 'get:product_detail', 'uses' => 'HomeController@getProductDetail']);
    Route::get('add-to-cart', ['as' => 'get:add_to_cart', 'uses' => 'HomeController@getAddToCart']);
    Route::get('cart', ['as' => 'get:cart', 'uses' => 'HomeController@getCart']);
    Route::get('remove-cart-product/{slug}', ['as' => 'get:remove_cart_product', 'uses' => 'HomeController@getRemoveCartProduct']);
    Route::get('checkout', ['as' => 'get:checkout', 'uses' => 'HomeController@getCheckout']);

      // Route::get('color-images', ['as' => 'get:color_images', 'uses' => 'HomeController@getColorImages']);
    Route::get('color-images', ['as' => 'get:color_images', 'uses' => 'HomeController@getColorImages']);

    Route::get('product/{slug}/{colorid}', ['as' => 'get:product_detail2', 'uses' => 'HomeController@getProductDetail2']);

    //filter products routes
    Route::get('price-range-products', ['as' => 'get:price_range_products', 'uses' => 'HomeController@getPriceRangeProducts']);
    Route::get('brands-products', ['as' => 'get:brand_products', 'uses' => 'HomeController@getBrandProducts']);
    Route::get('attribute-products', ['as' => 'get:attribute_products', 'uses' => 'HomeController@getAttributeProducts']);

    Route::get('update-cart-quantity', ['as' => 'post:update_cart_quantity', 'uses' => 'HomeController@postUpdateCartQuantity']);
    Route::get('add-to-wishlist', ['as' => 'get:add_to_wishlist', 'uses' => 'HomeController@getAddToWishlist']);
    Route::get('wishlist-count', ['as' => 'get:wishlist_count', 'uses' => 'HomeController@getWishlistCount']);
    Route::get('add-to-compare', ['as' => 'get:add_to_compare', 'uses' => 'HomeController@getAddToCompare']);
    Route::get('compare-btn', ['as' => 'get:compare_btn', 'uses' => 'HomeController@getCompareBtn']);
    Route::get('compare', ['as' => 'get:compare', 'uses' => 'HomeController@getCompare']);
    Route::get('product-remove-compare', ['as' => 'get:remove_from_compare', 'uses' => 'HomeController@getRemoveFromCompare']);

    //category products
    Route::get('{catSub}/{slug}/product', ['as' => 'get:sub_category_products', 'uses' => 'HomeController@getSubCategoryProducts']);
    Route::get('quick-view', ['as' => 'get:quick_view_search', 'uses' => 'HomeController@getQuickView']);

    //ishwar
    Route::get('{cat}/{subcat}/{subcat2}/product', ['as' => 'get:subcategory2_products', 'uses' => 'HomeController@getSubCategory2Products']);

    //product search routes
    Route::get('product-suggestion', ['as' => 'get:search_suggestion', 'uses' => 'HomeController@getProductSuggestion']);
    Route::get('search', ['as' => 'get:product_search', 'uses' => 'HomeController@getProductSearch']);
    Route::get('brand-products-from-search', ['as' => 'get:brand_products_from_search', 'uses' => 'HomeController@getBrandProductsFromSearch']);
    Route::get('price-products-from-search', ['as' => 'get:price_range_products_form_search', 'uses' => 'HomeController@getPriceProductsFromSearch']);


    Route::get('price-products-search-form', ['as' => 'get:price_range_products_serach_form', 'uses' => 'HomeController@getPriceProductsSearchForm']);
    Route::get('brand-products-search-form', ['as' => 'get:brand_products_serach_form', 'uses' => 'HomeController@getBrandProductsSearchForm']);
    Route::get('attribute-products-search-form', ['as' => 'get:attribute_products_serach_form', 'uses' => 'HomeController@getAttributeProductsSearchForm']);


    Route::group(['middleware' => ['auth', 'role:customer|admin']], function () {
        Route::get('logout', ['as' => 'get:user_logout', 'uses' => 'Auth\LoginController@getUserLogout']);
    });
    Route::post('indipay/response', ['as' => 'get:indipay_response', 'uses' => 'RechargeController@getIndipayResponse']);
    Route::get('order-summary/{unique_id}', ['as' => 'get:order_summary', 'uses' => 'HomeController@getOrderSummary']);

    //wallet responce
    Route::post('wallet/response', ['as' => 'post:wallet_response', 'uses' => 'WalletController@getWalletResponse']);
    Route::post('single-product/response', ['as' => 'post:single_product_response', 'uses' => 'HomeController@getSingleProductResponse']);
    Route::get('lozypaywallet', ['as' => 'get:wallet', 'uses' => 'WalletController@getWallet']);

    Route::group(['middleware' => ['auth', 'role:customer']], function () {
        Route::get('user-profile', ['as' => 'get:user_profile', 'uses' => 'HomeController@getUserProfile']);
        Route::get('user-profile-form', ['as' => 'get:user_profile_form', 'uses' => 'HomeController@getUserProfileForm']);
        Route::post('user-profile', ['as' => 'post:user_profile', 'uses' => 'HomeController@postUserProfileForm']);
        Route::get('wishlist', ['as' => 'get:wish_list', 'uses' => 'HomeController@getWishList']);

        //recharge payment
        Route::post('checkout', ['as' => 'post:checkout', 'uses' => 'RechargeController@postCheckout']);
        Route::get('cancel-recharge/{transId}', ['as' => 'get:cancel_recharge', 'uses' => 'RechargeController@getCancelRecharge']);
        Route::get('process-transaction/{transId}', ['as' => 'get:process_transaction', 'uses' => 'RechargeController@getProcessTransaction']);
        Route::post('recharge-payment', ['as' => 'get:recharge_payment', 'uses' => 'RechargeController@getRechargePayment']);

        //shipping address routes
        Route::get('shipping-address', ['as' => 'get:shipping_address_form', 'uses' => 'HomeController@getShippingAddressForm']);
        Route::post('save-shipping-address', ['as' => 'post:shipping_address', 'uses' => 'HomeController@postShippingAddress']);
        Route::get('shipping-address-select', ['as' => 'get:select_shipping_address', 'uses' => 'HomeController@getSelectShippingAddress']);
        Route::get('shipping-address-delete', ['as' => 'get:delete_shipping_address', 'uses' => 'HomeController@getDeleteShippingAddress']);

        //order products routes
        Route::post('product-order', ['as' => 'post:product_order', 'uses' => 'HomeController@postProductOrder']);

        //review form
        Route::get('review-form', ['as' => 'get:add_review_form', 'uses' => 'HomeController@getReviewForm']);
        Route::post('product-rating', ['as' => 'post:review', 'uses' => 'HomeController@postReview']);

        //wallet routes
        Route::get('add-money-wallet', ['as' => 'get:add_money_wallet', 'uses' => 'WalletController@getAddMoneyWallet']);
        Route::get('wallet-to-wallet', ['as' => 'get:wallet_to_wallet_form', 'uses' => 'WalletController@getWalletToWalletForm']);
        Route::post('wallet-to-wallet', ['as' => 'post:wallet_to_wallet_money', 'uses' => 'WalletController@postWalletToWalletMoney']);

        //your orders
        Route::get('your-orders', ['as' => 'get:your_orders', 'uses' => 'HomeController@getYourOrders']);
        Route::get('recharge-details/{orderId}', ['as' => 'get:recharge_details', 'uses' => 'HomeController@getYourRechargeOrderDetails']);
        Route::get('order-details/{orderId}', ['as' => 'get:order_details', 'uses' => 'HomeController@getYourOrderDetails']);
        Route::get('product-order-invoice/{transId}', ['as' => 'get:product_order_invoice', 'uses' => 'HomeController@getProductInvoice']);

        //cancel-order
        Route::get('cancel-item-form', ['as' => 'get:cancel_item_form', 'uses' => 'HomeController@getCancelItemForm']);
        Route::post('order-cancel', ['as' => 'post:order_cancel', 'uses' => 'HomeController@postOrderCancel']);

        //return-order
        Route::get('return-item-form', ['as' => 'get:return_item_form', 'uses' => 'HomeController@getReturnItemForm']);
        Route::post('order-return', ['as' => 'post:order_return', 'uses' => 'HomeController@postOrderReturn']);



    });

    Route::prefix("seller")->group(function(){
        Route::get("dashboard", ["as" => "get:seller", "uses" => "DashboardController@getDashboard"]);
        Route::group(['middleware' => ['admin', 'role:seller']], function () {
            Route::get('add-employee', ['as' => 'get:seller_add_employee', 'uses' => 'EmployeeController@getAddEmployee']);
            Route::post('add-employee', ['as' => 'post:add_employee', 'uses' => 'EmployeeController@postAddEmployee']);
            Route::get('manage-employee', ['as' => 'get:seller_manage_employee', 'uses' => 'EmployeeController@getManageEmployee']);
            Route::get('edit-employee/{slug}', ['as' => 'get:seller_edit_employee', 'uses' => 'EmployeeController@getEditEmployee']);
            Route::get('delete-employee', ['as' => 'get:seller_delete_employee', 'uses' => 'EmployeeController@getDeleteEmployee']);
            Route::get('add-holiday', ['as' => 'get:seller_add_holiday', 'uses' => 'AdminController@getAddHoliday']);
            

            //permission route
            Route::get('add-permission', ['as' => 'get:seller_add_permission', 'uses' => 'EmployeeController@getAddPermission']);
            Route::post('add-permission', ['as' => 'post:add_permission', 'uses' => 'EmployeeController@postAddPermission']);
            Route::get('manage-permission', ['as' => 'get:seller_manage_permission', 'uses' => 'EmployeeController@getManagePermission']);
            Route::get('edit-permission/{slug}', ['as' => 'get:seller_edit_permission', 'uses' => 'EmployeeController@getEditPermission']);
            Route::get('delete-permission', ['as' => 'get:seller_delete_permission', 'uses' => 'EmployeeController@getDeletePermission']);
            Route::get('assign-permission', ['as' => 'get:seller_assign_permission', 'uses' => 'EmployeeController@getAssignPermission']);
            Route::post('assign-permission', ['as' => 'post:assign_permission', 'uses' => 'EmployeeController@postAssignPermission']);
            Route::get('manage-assign-permission', ['as' => 'get:seller_manage_assign_permission', 'uses' => 'EmployeeController@getManageAssignPermission']);
            Route::get('delete-assign-permission', ['as' => 'get:seller_delete_assign_permission', 'uses' => 'EmployeeController@getDeleteAssignPermission']);
            Route::get('check-employee', ['as' => 'get:seller_check_employee', 'uses' => 'EmployeeController@getcheckEmployeePermission']);

            //categories routes
            Route::get('add-category', ['as' => 'get:seller_add_category', 'uses' => 'AdminController@getAddCategory']);
            Route::post('add-category', ['as' => 'post:add_category', 'uses' => 'AdminController@postAddCategory']);
            Route::get('manage-category', ['as' => 'get:seller_manage_category', 'uses' => 'AdminController@getManageCategory']);
            Route::get('edit-category/{slug}', ['as' => 'get:seller_edit_categories', 'uses' => 'AdminController@getEditCategory']);
            Route::get('delete-category', ['as' => 'get:seller_delete_categories', 'uses' => 'AdminController@getDeleteCategory']);

            //subcategory routes
            Route::get('add-subcategory', ['as' => 'get:seller_add_subcategory', 'uses' => 'AdminController@getAddSubCategory']);
            Route::post('add-subcategory', ['as' => 'post:add_subcategory', 'uses' => 'AdminController@postAddSubCategory']);
            Route::get('edit-subcategory/{slug}', ['as' => 'get:seller_edit_subcategories', 'uses' => 'AdminController@getEditSubCategory']);
            Route::get('delete-subcategory', ['as' => 'get:seller_delete_subcategories', 'uses' => 'AdminController@getDeleteSubCategory']);

            // subcategory2 routes ishwar start
            Route::get('add-subcategory2', ['as' => 'get:seller_add_subcategory2', 'uses' => 'AdminController@getAddSubCategory2']);
            Route::post('add-subcategory2', ['as' => 'post:add_subcategory2', 'uses' => 'AdminController@postAddSubCategory2']);
            Route::get('manage-subcategory2', ['as' => 'get:seller_manage_subcategory2', 'uses' => 'AdminController@getManageSubCategory2']);
            Route::get('edit-subcategory2/{slug}', ['as' => 'get:seller_edit_subcategories2', 'uses' => 'AdminController@getEditSubCategory2']);
            Route::get('delete-subcategory2', ['as' => 'get:seller_delete_subcategories2', 'uses' => 'AdminController@getDeleteSubCategory2']);
            // subcategory2 routes ishwar over

            //Products ishwar start
            Route::get('add-products-select-category', ['as' => 'get:seller_add_products_select_category', 'uses' => 'AdminController@getCategoryPage']);
            Route::get('add-products-select-subcategory/{slug}', ['as' => 'get:seller_add_products_select_subcategory', 'uses' => 'AdminController@getSubCategoryPage']);
            //Products ishwar start

            //tax class routes
            Route::get('add-tax-class', ['as' => 'get:seller_add_tax_cass', 'uses' => 'AdminController@getAddTaxCass']);
            Route::post('add-tax-class', ['as' => 'post:add_tax_class', 'uses' => 'AdminController@postAddTaxCass']);
            Route::get('manage-tax-class', ['as' => 'get:seller_manage_tax_class', 'uses' => 'AdminController@getManageTaxClass']);
            Route::get('edit-tax-class/{slug}', ['as' => 'get:seller_edit_tax_class', 'uses' => 'AdminController@getEditTaxClass']);
            Route::get('delete-tax-class', ['as' => 'get:seller_delete_tax_class', 'uses' => 'AdminController@getDeleteTaxClass']);


            //Currencies routes
            Route::get('add-currencies', ['as' => 'get:seller_add_currencies', 'uses' => 'AdminController@getAddCurrencies']);
            Route::post('add-currencies', ['as' => 'post:add_currencies', 'uses' => 'AdminController@postAddCurrencies']);
            Route::get('manage-currencies', ['as' => 'get:seller_manage_currencies', 'uses' => 'AdminController@getManageCurrencies']);
            Route::get('edit-currency/{slug}', ['as' => 'get:seller_edit_currency', 'uses' => 'AdminController@getEditCurrency']);
            Route::get('default-currency/{slug}', ['as' => 'get:seller_default_currency', 'uses' => 'AdminController@getDefaultCurrency']);
            Route::get('delete-currency', ['as' => 'get:seller_delete_currency', 'uses' => 'AdminController@getDeleteCurrency']);

            //brand routes
            //Currencies routes
            Route::get('add-brand', ['as' => 'get:seller_add_brand', 'uses' => 'AdminController@getAddBrand']);
            Route::post('add-brand', ['as' => 'post:add_brand', 'uses' => 'AdminController@postAddBrand']);
            Route::get('manage-brands', ['as' => 'get:seller_manage_brand', 'uses' => 'AdminController@getManageBrands']);
            Route::get('edit-brand/{slug}', ['as' => 'get:seller_edit_brand', 'uses' => 'AdminController@getEditBrand']);
            Route::get('delete-brand', ['as' => 'get:seller_delete_brand', 'uses' => 'AdminController@getDeleteBrand']);
            Route::get('approve-brand', ['as' => 'get:seller_approve_brand', 'uses' => 'AdminController@getApproveBrand']);

             Route::get('add-brand-doc/{slug}', ['as' => 'get:seller_add_brand_doc', 'uses' => 'AdminController@getEditBrandDoc']);
            Route::post('add-brand-doc', ['as' => 'post:add_brand_doc', 'uses' => 'AdminController@postAddBrandDoc']);



            Route::get('remove-brand-document', ['as' => 'get:seller_delete_brand_document', 'uses' => 'AdminController@getDeleteBrandDocument']);


            //top menu category routes
            Route::get('menu-category', ['as' => 'get:seller_top_menu_category', 'uses' => 'AdminController@getTopMenuCategory']);
            Route::post('menu-category', ['as' => 'post:add_menu_category', 'uses' => 'AdminController@postTopMenuCategory']);

            //product approve
            Route::get('approve-product', ['as' => 'get:seller_approve_products', 'uses' => 'AdminController@getApproveProducts']);

            //manage seller
            Route::get('manage-seller', ['as' => 'get:seller_manage_seller', 'uses' => 'AdminController@getManageSeller']);
            Route::get('seller-details', ['as' => 'get:seller_seller_details', 'uses' => 'AdminController@getSellerDetails']);
            Route::get('delete-seller', ['as' => 'get:seller_delete_seller', 'uses' => 'AdminController@getDeleteSeller']);
            Route::get('approve-seller', ['as' => 'get:seller_seller_approve', 'uses' => 'AdminController@getSellerApprove']);

            //seller calendar by ishwar
            Route::get('manage-seller-holidays', ['as' => 'get:seller_manage_seller_holidays', 'uses' => 'AdminController@getManageSellerHolidays']);

            Route::get('get_seller_holidays', ['as' => 'get:seller_get_seller_holidays', 'uses' => 'AdminController@getSellerHolidays']);

            Route::post('manage_seller_holidays', ['as' => 'post:manage_seller_holidays', 'uses' => 'AdminController@postManageSellerHoliday']);


            Route::get('manage-homepage-categories', ['as' => 'get:seller_homepage_categories', 'uses' => 'AdminController@getHomepageCategories']);
            Route::get('manage-homepage-products', ['as' => 'get:seller_manage_homepage_product', 'uses' => 'AdminController@getManageHomepageProducts']);

            Route::get('notify', ['as' => 'get:seller_notify', 'uses' => 'AdminController@getNotify']);


            //import products Excel
            Route::get('import-products', ['as' => 'get:seller_import_products', 'uses' => 'AdminController@getImportProducts']);

            //reports routes
            Route::get('seller-commission-report', ['as' => 'get:seller_seller_commission_report', 'uses' => 'AdminController@getSellerCommissionReport']);
            Route::get('filter-seller-commission-report', ['as' => 'get:seller_commission_filter_order', 'uses' => 'AdminController@getCommissionFilterOrder']);
            Route::get('subcategory-commission', ['as' => 'get:seller_subcategory_commission', 'uses' => 'AdminController@getSubcategoryCommission']);
            Route::get('filter-subcategory-commission', ['as' => 'get:seller_subcategory_commission_filter', 'uses' => 'AdminController@getSubcategoryCommissionFilter']);
            Route::get('order-report', ['as' => 'get:seller_order_report', 'uses' => 'AdminController@getOrderReport']);
            Route::get('order-filter', ['as' => 'get:seller_order_filter', 'uses' => 'AdminController@getOrderFilter']);
            Route::get('recharge-report', ['as' => 'get:seller_recharge_report', 'uses' => 'AdminController@getRechargeReport']);
            Route::get('recharge-filter', ['as' => 'get:seller_recharge_filter', 'uses' => 'AdminController@getRechargeFilter']);
            Route::get('seller-report', ['as' => 'get:seller_seller_report', 'uses' => 'AdminController@getSellerReport']);
            Route::get('seller-filter', ['as' => 'get:seller_seller_filter', 'uses' => 'AdminController@getSellerFilter']);

            //excel and pdf download routes
            Route::get('seller-commission-export-file/{type}', ['as' => 'get:seller_seller_commission_export_file', 'uses' => 'AdminController@getSellerCommissionExportFile']);
            Route::get('subcat-commission-export-file/{type}', ['as' => 'get:seller_subcat_commission_export_file', 'uses' => 'AdminController@getSubCategoryCommissionExportFile']);
            Route::get('order-export-file/{type}', ['as' => 'get:seller_order_export_file', 'uses' => 'AdminController@getOrderExportFile']);
            Route::get('recharge-export-file/{type}', ['as' => 'get:seller_recharge_export_file', 'uses' => 'AdminController@getRechargeExportFile']);
            Route::get('seller-export-file/{type}', ['as' => 'get:seller_seller_export_file', 'uses' => 'AdminController@getSellerExportFile']);
            //ishwar
            Route::get('products-export-file/{type}', ['as' => 'get:seller_products_export_file', 'uses' => 'AdminController@getProductsExportFile']);
            // Route::get('show-products/{type}', ['as' => 'get:seller_show_products', 'uses' => 'AdminController@showProducts']);

            //homepage slider routes
            Route::get('homepage-slider', ['as' => 'get:seller_homepage_slider', 'uses' => 'AdminController@getHomepageSlider']);
            Route::post('homepage-slider', ['as' => 'post:homepage_slider', 'uses' => 'AdminController@postHomepageSlider']);
            Route::get('remove-homepage-slider', ['as' => 'get:seller_delete_slider', 'uses' => 'AdminController@getDeleteSlider']);

            //subcategory slider routes
            Route::get('subcategory-slider', ['as' => 'get:seller_sub_category_slider', 'uses' => 'AdminController@getSubCategorySlider']);
            Route::post('subcategory-slider', ['as' => 'post:subcategory_slider', 'uses' => 'AdminController@postSubCategorySlider']);
            Route::get('subcategory-slider-remove', ['as' => 'get:seller_delete_sub_slider', 'uses' => 'AdminController@getDeleteSubSlider']);

            //products sliders
            Route::get('products-slider', ['as' => 'get:seller_product_details_slider', 'uses' => 'AdminController@getProductDetailsSlider']);
            Route::post('products-slider', ['as' => 'post:products_slider', 'uses' => 'AdminController@postProductsSlider']);
            Route::get('remove-products-slider', ['as' => 'get:seller_delete_product_slider', 'uses' => 'AdminController@getDeleteProductSlider']);

            //others pages
            Route::get('add-about-us', ['as' => 'get:seller_add_about_us', 'uses' => 'AdminController@getAddAboutUs']);
            Route::post('add-about-us', ['as' => 'post:add_about_us', 'uses' => 'AdminController@postAddAboutUs']);
            Route::get('add-privacy-policy', ['as' => 'get:seller_add_privacy_policy', 'uses' => 'AdminController@getAddPrivacyPolicy']);
            Route::post('add-privacy-policy', ['as' => 'post:privacy_policy', 'uses' => 'AdminController@postAddPrivacyPolicy']);
            Route::get('add-terms-condition', ['as' => 'get:seller_add_terms_condition', 'uses' => 'AdminController@getAddTermsCondition']);
            Route::post('add-terms-condition', ['as' => 'post:add_terms_condition', 'uses' => 'AdminController@postAddTermsCondition']);
            Route::get('add-faq', ['as' => 'get:seller_add_faq', 'uses' => 'AdminController@getAddFaq']);
            Route::post('add-faq', ['as' => 'post:add_faq', 'uses' => 'AdminController@postAddFaq']);
            Route::get('add-delivery-info', ['as' => 'get:seller_add_delivery_info', 'uses' => 'AdminController@getAddDeliveryInfo']);
            Route::post('add-delivery-info', ['as' => 'post:add_delivery_info', 'uses' => 'AdminController@postAddDeliveryInfo']);
            Route::get('add-cancellation-policy', ['as' => 'get:seller_add_cancellation_policy', 'uses' => 'AdminController@getAddCancellationPolicy']);
            Route::post('add-cancellation-policy', ['as' => 'post:add_cancellation_policy', 'uses' => 'AdminController@postAddCancellationPolicy']);
            Route::get('add-seller-policy', ['as' => 'get:seller_add_seller_policy', 'uses' => 'AdminController@getAddSellerPolicy']);
            Route::post('add-seller-policy', ['as' => 'post:add_seller_policy', 'uses' => 'AdminController@postAddSellerPolicy']);
            Route::get('add-testimonials', ['as' => 'get:seller_add_testimonials', 'uses' => 'AdminController@getAddTestimonials']);
            Route::post('add-testimonials', ['as' => 'post:add_testimonials', 'uses' => 'AdminController@postAddTestimonials']);
            Route::get('manage-testimonials', ['as' => 'get:seller_manage_testimonials', 'uses' => 'AdminController@getManageTestimonials']);
            Route::get('edit-testimonials/{slug}', ['as' => 'get:seller_edit_testimonial', 'uses' => 'AdminController@getEditTestimonials']);
            Route::get('delete-testimonials', ['as' => 'get:seller_delete_testimonial', 'uses' => 'AdminController@getDeleteTestimonials']);

            Route::get('logout', ['as' => 'get:seller_logout', 'uses' => 'Auth\LoginController@getLogout']);
            Route::get('dashboard', ['as' => 'get:seller_dashboard', 'uses' => 'DashboardController@getDashboard']);

            //profile
            Route::get('profile', ['as' => 'get:seller_profile', 'uses' => 'DashboardController@getProfile']);
            Route::post('profile', ['as' => 'post:profile', 'uses' => 'DashboardController@postProfile']);
            Route::get('delete-kyc-doc', ['as' => 'get:seller_delete_kyc_doc', 'uses' => 'DashboardController@getDeleteKycDoc']);
            Route::get('delete-other-doc', ['as' => 'get:seller_delete_other_doc', 'uses' => 'DashboardController@getDeleteOtherDoc']);

            //products routes
            Route::get('add-products/{slug}', ['as' => 'get:seller_add_products', 'uses' => 'AdminController@getAddProducts']); //ishwar

            Route::get('get-products', ['as' => 'get:seller_get_products', 'uses' => 'AdminController@getProducts']);//ishwar
            Route::get('get-products-formdata', ['as' => 'get:seller_get_products_formdata', 'uses' => 'AdminController@getProductsFormdata']); //ishwar

            Route::get('get-products-filldata/{slug}', ['as' => 'get:seller_get_products_filldata', 'uses' => 'AdminController@getFormWithPdata']); //ishwar
            
            

            Route::post('add-products', ['as' => 'post:add_products', 'uses' => 'AdminController@postAddProducts']);
            Route::get('manage-products/{type}', ['as' => 'get:seller_manage_products', 'uses' => 'AdminController@getManageProducts']);
            Route::get('edit-products/{slug}', ['as' => 'get:seller_edit_products', 'uses' => 'AdminController@getEditProducts']);
            Route::get('delete-products', ['as' => 'get:seller_delete_products', 'uses' => 'AdminController@getDeleteProducts']);
            Route::get('delete-products-screenshots', ['as' => 'get:seller_delete_products_screenshots', 'uses' => 'AdminController@getDeleteProductsScreenshots']);
            Route::get('products-color', ['as' => 'get:seller_product_color', 'uses' => 'AdminController@getProductColor']);
            Route::get('products-size', ['as' => 'get:seller_product_size', 'uses' => 'AdminController@getProductSize']);

            //New category products routes
            Route::get('products-size-color', ['as' => 'get:seller_product_size_color', 'uses' => 'AdminController@getProductSizeColor']);
            Route::get('products-scent', ['as' => 'get:seller_product_scent', 'uses' => 'AdminController@getProductScent']);
            Route::get('products-size-scent', ['as' => 'get:seller_product_size_scent', 'uses' => 'AdminController@getProductSizeScent']);

            Route::get('products-paperback', ['as' => 'get:seller_product_paperback', 'uses' => 'AdminController@getProductPaperback']);
            Route::get('products-hardcover', ['as' => 'get:seller_product_hardcover', 'uses' => 'AdminController@getProductHardcover']);
            Route::get('products-audiocd', ['as' => 'get:seller_product_audiocd', 'uses' => 'AdminController@getProductAudioCD']);

            Route::get('products-pattern', ['as' => 'get:seller_product_pattern', 'uses' => 'AdminController@getProductPattern']);
            Route::get('products-cup-size', ['as' => 'get:seller_product_cup_size', 'uses' => 'AdminController@getProductCupSize']);
            Route::get('products-cup-size-color', ['as' => 'get:seller_product_cup_size_color', 'uses' => 'AdminController@getProductCupSizeColor']);

            Route::get('products-color-lens-width', ['as' => 'get:seller_product_color_lens_width', 'uses' => 'AdminController@getProductColorLensWidth']);
            Route::get('products-color-magnification-strength', ['as' => 'get:seller_product_color_magnification_strength', 'uses' => 'AdminController@getProductColorMagnificationStrength']);
            Route::get('products-lens-color', ['as' => 'get:seller_product_lens_color', 'uses' => 'AdminController@getProductLensColor']);

            // 13-08-2018
            Route::get('products-color-material', ['as' => 'get:seller_product_color_material', 'uses' => 'AdminController@getProductColorMaterial']);
            // --
            Route::get('products-flavor', ['as' => 'get:seller_product_flavor', 'uses' => 'AdminController@getProductFlavor']);
            Route::get('products-weight', ['as' => 'get:seller_product_weight', 'uses' => 'AdminController@getProductWeight']);
            Route::get('products-flavor-size', ['as' => 'get:seller_product_flavor_size', 'uses' => 'AdminController@getProductFlavorSize']);
            Route::get('products-flavor-weight', ['as' => 'get:seller_product_flavor_weight', 'uses' => 'AdminController@getProductFlavorWeight']);
            // --
            Route::get('products-material', ['as' => 'get:seller_product_material', 'uses' => 'AdminController@getProductMaterial']);
            Route::get('products-material-size', ['as' => 'get:seller_product_material_size', 'uses' => 'AdminController@getProductMaterialSize']);
            
            // Jwellery items
            Route::get('products-metaltype', ['as' => 'get:seller_product_metaltype', 'uses' => 'AdminController@getProductMetalType']);
            Route::get('products-sizeperpearl', ['as' => 'get:seller_product_sizeperpearl', 'uses' => 'AdminController@getProductSizePerPearl']);
            Route::get('products-color-metaltype', ['as' => 'get:seller_product_color_metaltype', 'uses' => 'AdminController@getColorMetalType']);
            Route::get('products-color-itemlength', ['as' => 'get:seller_product_color_itemlength', 'uses' => 'AdminController@getColorItemLength']);
            Route::get('products-gemtype', ['as' => 'get:seller_product_gemtype', 'uses' => 'AdminController@getGemType']);
            Route::get('products-metalgemtype', ['as' => 'get:seller_product_metalgemtype', 'uses' => 'AdminController@getMetalGemType']);
            Route::get('products-total-gemweight', ['as' => 'get:seller_product_total_gemweight', 'uses' => 'AdminController@getTotalGemWeight']);

            Route::get('products-total-diamondweight', ['as' => 'get:seller_product_total_diamondweight', 'uses' => 'AdminController@getTotalDiamondWeight']);

            Route::get('products-metaltype-totaldiamondweight', ['as' => 'get:seller_product_metaltype_totaldiamondweight', 'uses' => 'AdminController@getMetalTypeTotalDiamondWeight']);
            Route::get('products-itemlength-gemtype', ['as' => 'get:seller_product_itemlength_gemtype', 'uses' => 'AdminController@getItemLengthGemtype']);
            Route::get('products-itemlength-material', ['as' => 'get:seller_product_itemlength_material', 'uses' => 'AdminController@getItemLengthMaterial']);
            Route::get('products-itemlength-sizeperpearl', ['as' => 'get:seller_product_itemlength_sizeperpearl', 'uses' => 'AdminController@getItemLengthSizePerPearl']);
            Route::get('products-itemlength-metaltype', ['as' => 'get:seller_product_itemlength_metaltype', 'uses' => 'AdminController@getItemLengthMetalType']);
            Route::get('products-itemlength-totaldiamondweight', ['as' => 'get:seller_product_itemlength_totaldiamondweight', 'uses' => 'AdminController@getItemLengthTotalDiamondWeight']);

            Route::get('products-itemlength', ['as' => 'get:seller_product_itemlength', 'uses' => 'AdminController@getItemLength']);
            Route::get('products-ringsize', ['as' => 'get:seller_product_ringsize', 'uses' => 'AdminController@getRingSize']);
            Route::get('products-metaltype-ringsize', ['as' => 'get:seller_product_metaltype_ringsize', 'uses' => 'AdminController@getMetalTypeRingSize']);
            Route::get('products-color-ringsize', ['as' => 'get:seller_product_color_ringsize', 'uses' => 'AdminController@getColorRingSize']);
            Route::get('products-ringsize-gemtype', ['as' => 'get:seller_product_ringsize_gemtype', 'uses' => 'AdminController@getRingSizeGemType']);
            Route::get('products-ringsize-totaldiamondweight', ['as' => 'get:seller_product_ringsize_totaldiamondweight', 'uses' => 'AdminController@getRingSizeTotalDiamondWeight']);
            // Jwellery items

            // Office Supplies
            Route::get('products-numberofitems', ['as' => 'get:seller_product_numberofitems', 'uses' => 'AdminController@getNumberOfItems']);
            Route::get('products-papersize', ['as' => 'get:seller_product_papersize', 'uses' => 'AdminController@getPaperSize']);
            Route::get('products-maximum-expandablesize', ['as' => 'get:seller_product_maximum_expandablesize', 'uses' => 'AdminController@getMaximumExpandableSize']);
            Route::get('products-linesize', ['as' => 'get:seller_product_linesize', 'uses' => 'AdminController@getLineSize']);
            // Office Supplies

            // Shoes & Handbags
            Route::get('products-stylesize', ['as' => 'get:seller_product_stylesize', 'uses' => 'AdminController@getStyleSize']);
            Route::get('products-shoesstyle', ['as' => 'get:seller_product_shoesstyle', 'uses' => 'AdminController@getShoesStyle']);
            // Shoes & Handbags

            // Watches 15-08-2018
            Route::get('products-bandcolor', ['as' => 'get:seller_product_bandcolor', 'uses' => 'AdminController@getBandColor']);

            // Sports 15-08-2018
            Route::get('products-golfloft', ['as' => 'get:seller_product_golfloft', 'uses' => 'AdminController@getGolfLoft']);
            Route::get('products-golf-flex-material', ['as' => 'get:seller_product_golf_flex_material', 'uses' => 'AdminController@getGolfFlexMaterial']);
            Route::get('products-golf-flex-shaft-material', ['as' => 'get:seller_product_golf_flex_shaft_material', 'uses' => 'AdminController@getGolfFlexShaftMaterial']);
            Route::get('products-golf-shaft-material', ['as' => 'get:seller_product_golf_shaft_material', 'uses' => 'AdminController@getGolfShaftMaterial']);
            Route::get('products-gripsize', ['as' => 'get:seller_product_gripsize', 'uses' => 'AdminController@getGripSize']);
            Route::get('products-griptype', ['as' => 'get:seller_product_griptype', 'uses' => 'AdminController@getGripType']);
            Route::get('products-hand', ['as' => 'get:seller_product_hand', 'uses' => 'AdminController@getHand']);
            Route::get('products-hand-shaft-length', ['as' => 'get:seller_product_hand_shaft_length', 'uses' => 'AdminController@getHandShaftLength']);
            Route::get('products-shaftmaterial-golfflex', ['as' => 'get:seller_product_shaftmaterial_golfflex', 'uses' => 'AdminController@getShaftMaterialGolfFlex']);
            Route::get('products-shaftmaterial-golfflex-golfloft', ['as' => 'get:seller_product_shaftmaterial_golfflex_golfloft', 'uses' => 'AdminController@getShaftMaterialGolfFlexGolfLoft']);
            Route::get('products-tensionlevel', ['as' => 'get:seller_product_tensionlevel', 'uses' => 'AdminController@getTensionLevel']);
            Route::get('products-shaft-material', ['as' => 'get:seller_product_shaft_material', 'uses' => 'AdminController@getShaftMaterial']);
            Route::get('products-itemshape', ['as' => 'get:seller_product_itemshape', 'uses' => 'AdminController@getItemShape']);
            Route::get('products-size-weight-supported', ['as' => 'get:seller_product_size_weight_supported', 'uses' => 'AdminController@getSizeWeightSupported']);
            Route::get('products-stylename', ['as' => 'get:seller_product_stylename', 'uses' => 'AdminController@getStyleName']);



            Route::get('add-bulk-products', ['as' => 'get:seller_add_bulk_products', 'uses' => 'AdminController@getAddBulkProducts']);
            Route::post('add-bulk-products', ['as' => 'post:add_bulk_products', 'uses' => 'AdminController@postAddBulkProducts']);

            Route::get('manage-subcategory', ['as' => 'get:seller_manage_subcategory', 'uses' => 'AdminController@getManageSubCategory']);

            // ishwar
            Route::post('remove-color-image', ['as' => 'post:remove_color_image', 'uses' => 'AdminController@RemoveColorImage']);

            Route::post('remove-product-color', ['as' => 'post:remove_product_color', 'uses' => 'AdminController@RemoveProductColor']);

            Route::post('add-color-image', ['as' => 'post:add_color_image', 'uses' => 'AdminController@addColorImage']);

            Route::post('update-product-color', ['as' => 'post:update_product_color', 'uses' => 'AdminController@updateProductColor']);
            Route::post('update-product-price', ['as' => 'post:update_product_price', 'uses' => 'AdminController@updateProductPrice']);


            //manage order routes
            Route::get('manage-order', ['as' => 'get:seller_manage_order', 'uses' => 'AdminController@getManageOrder']);
            Route::post('manage-order-status', ['as' => 'post:order_status', 'uses' => 'AdminController@postOrderStatus']);
            Route::get('product-invoice/{slug}', ['as' => 'get:seller_product_invoice', 'uses' => 'AdminController@getProductInvoice']);
            Route::get('manage-cancel-order', ['as' => 'get:seller_manage_cancel_order', 'uses' => 'AdminController@getManageCancelOrder']);
            Route::get('approve-cancel-order', ['as' => 'get:seller_order_cancel_approve', 'uses' => 'AdminController@getOrderCancelApprove']);
            // ishwar start
            Route::get('manage-return-order', ['as' => 'get:seller_manage_return_order', 'uses' => 'AdminController@getManageReturnOrder']);
            Route::get('approve-return-order', ['as' => 'get:seller_order_return_approve', 'uses' => 'AdminController@getOrderReturnApprove']);
            // ishwar over

            Route::get('order-shipping-process', ['as' => 'post:order_shipping_process', 'uses' => 'AdminController@postOrderShippingProcess']); 

            //seller payment 02-08-2018
            Route::get('seller-payment-request', ['as' => 'get:seller_seller_payment_request', 'uses' => 'AdminController@getSellerPaymentRequest']);
            Route::post('add-payment-request', ['as' => 'post:add_payment_request', 'uses' => 'AdminController@postAddPaymentRequest']);
            Route::get('view_seller-payment-request', ['as' => 'get:seller_view_seller_payment_request', 'uses' => 'AdminController@getViewSellerPaymentRequest']);

            //seller payment manage by admin 03-08-2018
            Route::get('manage-payment-request', ['as' => 'get:seller_manage_payment_request', 'uses' => 'AdminController@getManagePaymentRequest']);
            Route::post('update-seller-payment-status', ['as' => 'post:update_seller_payment_status', 'uses' => 'AdminController@postUpdateSellerPaymentStatus']);
            Route::post('update-seller-payment-remark', ['as' => 'post:update_seller_payment_remark', 'uses' => 'AdminController@postUpdateSellerPaymentRemarks']);

            //seller sales reports 04-08-2018
            Route::get('manage-seller-sales-report', ['as' => 'get:seller_manage_seller_sales_report', 'uses' => 'AdminController@getManageSellerSalesReport']);
            Route::get('fee-deduct-data', ['as' => 'get:seller_fee_deduct_data', 'uses' => 'AdminController@getProductFeeData']);
        
            Route::get('filter-seller-sales-report', ['as' => 'get:seller_filter_seller_sales_report', 'uses' => 'AdminController@getSellerSalesFilter']);
            
            Route::get('seller-sales-report', ['as' => 'get:seller_seller_sales_report', 'uses' => 'AdminController@getViewSellerSalesReport']);

            
            


        });
    });

    Route::prefix('admin')->group(function () {
        Route::get('', 'AdminController@getIndex');
        Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
        Route::post('login', ['as' => 'post:login', 'uses' => 'Auth\LoginController@postLogin']);

        //seller authentication routes
        Route::get('register', ['as' => 'get:register', 'uses' => 'Auth\LoginController@getRegister']);
        Route::post('register', ['as' => 'post:register', 'uses' => 'Auth\LoginController@postRegister']);


        Route::group(['middleware' => ['admin', 'role:admin|seller|employee']], function () {
            Route::get('logout', ['as' => 'get:logout', 'uses' => 'Auth\LoginController@getLogout']);
            Route::get('dashboard', ['as' => 'get:dashboard', 'uses' => 'DashboardController@getDashboard']);

            //profile
            Route::get('profile', ['as' => 'get:profile', 'uses' => 'DashboardController@getProfile']);
            Route::post('profile', ['as' => 'post:profile', 'uses' => 'DashboardController@postProfile']);
            Route::get('delete-kyc-doc', ['as' => 'get:delete_kyc_doc', 'uses' => 'DashboardController@getDeleteKycDoc']);
            Route::get('delete-other-doc', ['as' => 'get:delete_other_doc', 'uses' => 'DashboardController@getDeleteOtherDoc']);

            //products routes
            Route::get('add-products/{slug}', ['as' => 'get:add_products', 'uses' => 'AdminController@getAddProducts']); //ishwar

            Route::get('get-products', ['as' => 'get:get_products', 'uses' => 'AdminController@getProducts']);//ishwar
            Route::get('get-products-formdata', ['as' => 'get:get_products_formdata', 'uses' => 'AdminController@getProductsFormdata']); //ishwar

            Route::get('get-products-filldata/{slug}', ['as' => 'get:get_products_filldata', 'uses' => 'AdminController@getFormWithPdata']); //ishwar
            
            

            Route::post('add-products', ['as' => 'post:add_products', 'uses' => 'AdminController@postAddProducts']);
            Route::get('manage-products/{type}', ['as' => 'get:manage_products', 'uses' => 'AdminController@getManageProducts']);
            Route::get('edit-products/{slug}', ['as' => 'get:edit_products', 'uses' => 'AdminController@getEditProducts']);
            Route::get('delete-products', ['as' => 'get:delete_products', 'uses' => 'AdminController@getDeleteProducts']);
            Route::get('delete-products-screenshots', ['as' => 'get:delete_products_screenshots', 'uses' => 'AdminController@getDeleteProductsScreenshots']);
            Route::get('products-color', ['as' => 'get:product_color', 'uses' => 'AdminController@getProductColor']);
            Route::get('products-size', ['as' => 'get:product_size', 'uses' => 'AdminController@getProductSize']);

            //New category products routes
            Route::get('products-size-color', ['as' => 'get:product_size_color', 'uses' => 'AdminController@getProductSizeColor']);
            Route::get('products-scent', ['as' => 'get:product_scent', 'uses' => 'AdminController@getProductScent']);
            Route::get('products-size-scent', ['as' => 'get:product_size_scent', 'uses' => 'AdminController@getProductSizeScent']);

            Route::get('products-paperback', ['as' => 'get:product_paperback', 'uses' => 'AdminController@getProductPaperback']);
            Route::get('products-hardcover', ['as' => 'get:product_hardcover', 'uses' => 'AdminController@getProductHardcover']);
            Route::get('products-audiocd', ['as' => 'get:product_audiocd', 'uses' => 'AdminController@getProductAudioCD']);

            Route::get('products-pattern', ['as' => 'get:product_pattern', 'uses' => 'AdminController@getProductPattern']);
            Route::get('products-cup-size', ['as' => 'get:product_cup_size', 'uses' => 'AdminController@getProductCupSize']);
            Route::get('products-cup-size-color', ['as' => 'get:product_cup_size_color', 'uses' => 'AdminController@getProductCupSizeColor']);

            Route::get('products-color-lens-width', ['as' => 'get:product_color_lens_width', 'uses' => 'AdminController@getProductColorLensWidth']);
            Route::get('products-color-magnification-strength', ['as' => 'get:product_color_magnification_strength', 'uses' => 'AdminController@getProductColorMagnificationStrength']);
            Route::get('products-lens-color', ['as' => 'get:product_lens_color', 'uses' => 'AdminController@getProductLensColor']);

            // 13-08-2018
            Route::get('products-color-material', ['as' => 'get:product_color_material', 'uses' => 'AdminController@getProductColorMaterial']);
            // --
            Route::get('products-flavor', ['as' => 'get:product_flavor', 'uses' => 'AdminController@getProductFlavor']);
            Route::get('products-weight', ['as' => 'get:product_weight', 'uses' => 'AdminController@getProductWeight']);
            Route::get('products-flavor-size', ['as' => 'get:product_flavor_size', 'uses' => 'AdminController@getProductFlavorSize']);
            Route::get('products-flavor-weight', ['as' => 'get:product_flavor_weight', 'uses' => 'AdminController@getProductFlavorWeight']);
            // --
            Route::get('products-material', ['as' => 'get:product_material', 'uses' => 'AdminController@getProductMaterial']);
            Route::get('products-material-size', ['as' => 'get:product_material_size', 'uses' => 'AdminController@getProductMaterialSize']);
            
            // Jwellery items
            Route::get('products-metaltype', ['as' => 'get:product_metaltype', 'uses' => 'AdminController@getProductMetalType']);
            Route::get('products-sizeperpearl', ['as' => 'get:product_sizeperpearl', 'uses' => 'AdminController@getProductSizePerPearl']);
            Route::get('products-color-metaltype', ['as' => 'get:product_color_metaltype', 'uses' => 'AdminController@getColorMetalType']);
            Route::get('products-color-itemlength', ['as' => 'get:product_color_itemlength', 'uses' => 'AdminController@getColorItemLength']);
            Route::get('products-gemtype', ['as' => 'get:product_gemtype', 'uses' => 'AdminController@getGemType']);
            Route::get('products-metalgemtype', ['as' => 'get:product_metalgemtype', 'uses' => 'AdminController@getMetalGemType']);
            Route::get('products-total-gemweight', ['as' => 'get:product_total_gemweight', 'uses' => 'AdminController@getTotalGemWeight']);

            Route::get('products-total-diamondweight', ['as' => 'get:product_total_diamondweight', 'uses' => 'AdminController@getTotalDiamondWeight']);

            Route::get('products-metaltype-totaldiamondweight', ['as' => 'get:product_metaltype_totaldiamondweight', 'uses' => 'AdminController@getMetalTypeTotalDiamondWeight']);
            Route::get('products-itemlength-gemtype', ['as' => 'get:product_itemlength_gemtype', 'uses' => 'AdminController@getItemLengthGemtype']);
            Route::get('products-itemlength-material', ['as' => 'get:product_itemlength_material', 'uses' => 'AdminController@getItemLengthMaterial']);
            Route::get('products-itemlength-sizeperpearl', ['as' => 'get:product_itemlength_sizeperpearl', 'uses' => 'AdminController@getItemLengthSizePerPearl']);
            Route::get('products-itemlength-metaltype', ['as' => 'get:product_itemlength_metaltype', 'uses' => 'AdminController@getItemLengthMetalType']);
            Route::get('products-itemlength-totaldiamondweight', ['as' => 'get:product_itemlength_totaldiamondweight', 'uses' => 'AdminController@getItemLengthTotalDiamondWeight']);

            Route::get('products-itemlength', ['as' => 'get:product_itemlength', 'uses' => 'AdminController@getItemLength']);
            Route::get('products-ringsize', ['as' => 'get:product_ringsize', 'uses' => 'AdminController@getRingSize']);
            Route::get('products-metaltype-ringsize', ['as' => 'get:product_metaltype_ringsize', 'uses' => 'AdminController@getMetalTypeRingSize']);
            Route::get('products-color-ringsize', ['as' => 'get:product_color_ringsize', 'uses' => 'AdminController@getColorRingSize']);
            Route::get('products-ringsize-gemtype', ['as' => 'get:product_ringsize_gemtype', 'uses' => 'AdminController@getRingSizeGemType']);
            Route::get('products-ringsize-totaldiamondweight', ['as' => 'get:product_ringsize_totaldiamondweight', 'uses' => 'AdminController@getRingSizeTotalDiamondWeight']);
            // Jwellery items

            // Office Supplies
            Route::get('products-numberofitems', ['as' => 'get:product_numberofitems', 'uses' => 'AdminController@getNumberOfItems']);
            Route::get('products-papersize', ['as' => 'get:product_papersize', 'uses' => 'AdminController@getPaperSize']);
            Route::get('products-maximum-expandablesize', ['as' => 'get:product_maximum_expandablesize', 'uses' => 'AdminController@getMaximumExpandableSize']);
            Route::get('products-linesize', ['as' => 'get:product_linesize', 'uses' => 'AdminController@getLineSize']);
            // Office Supplies

            // Shoes & Handbags
            Route::get('products-stylesize', ['as' => 'get:product_stylesize', 'uses' => 'AdminController@getStyleSize']);
            Route::get('products-shoesstyle', ['as' => 'get:product_shoesstyle', 'uses' => 'AdminController@getShoesStyle']);
            // Shoes & Handbags

            // Watches 15-08-2018
            Route::get('products-bandcolor', ['as' => 'get:product_bandcolor', 'uses' => 'AdminController@getBandColor']);

            // Sports 15-08-2018
            Route::get('products-golfloft', ['as' => 'get:product_golfloft', 'uses' => 'AdminController@getGolfLoft']);
            Route::get('products-golf-flex-material', ['as' => 'get:product_golf_flex_material', 'uses' => 'AdminController@getGolfFlexMaterial']);
            Route::get('products-golf-flex-shaft-material', ['as' => 'get:product_golf_flex_shaft_material', 'uses' => 'AdminController@getGolfFlexShaftMaterial']);
            Route::get('products-golf-shaft-material', ['as' => 'get:product_golf_shaft_material', 'uses' => 'AdminController@getGolfShaftMaterial']);
            Route::get('products-gripsize', ['as' => 'get:product_gripsize', 'uses' => 'AdminController@getGripSize']);
            Route::get('products-griptype', ['as' => 'get:product_griptype', 'uses' => 'AdminController@getGripType']);
            Route::get('products-hand', ['as' => 'get:product_hand', 'uses' => 'AdminController@getHand']);
            Route::get('products-hand-shaft-length', ['as' => 'get:product_hand_shaft_length', 'uses' => 'AdminController@getHandShaftLength']);
            Route::get('products-shaftmaterial-golfflex', ['as' => 'get:product_shaftmaterial_golfflex', 'uses' => 'AdminController@getShaftMaterialGolfFlex']);
            Route::get('products-shaftmaterial-golfflex-golfloft', ['as' => 'get:product_shaftmaterial_golfflex_golfloft', 'uses' => 'AdminController@getShaftMaterialGolfFlexGolfLoft']);
            Route::get('products-tensionlevel', ['as' => 'get:product_tensionlevel', 'uses' => 'AdminController@getTensionLevel']);
            Route::get('products-shaft-material', ['as' => 'get:product_shaft_material', 'uses' => 'AdminController@getShaftMaterial']);
            Route::get('products-itemshape', ['as' => 'get:product_itemshape', 'uses' => 'AdminController@getItemShape']);
            Route::get('products-size-weight-supported', ['as' => 'get:product_size_weight_supported', 'uses' => 'AdminController@getSizeWeightSupported']);
            Route::get('products-stylename', ['as' => 'get:product_stylename', 'uses' => 'AdminController@getStyleName']);



            Route::get('add-bulk-products', ['as' => 'get:add_bulk_products', 'uses' => 'AdminController@getAddBulkProducts']);
            Route::post('add-bulk-products', ['as' => 'post:add_bulk_products', 'uses' => 'AdminController@postAddBulkProducts']);

            Route::get('manage-subcategory', ['as' => 'get:manage_subcategory', 'uses' => 'AdminController@getManageSubCategory']);

            // ishwar
            Route::post('remove-color-image', ['as' => 'post:remove_color_image', 'uses' => 'AdminController@RemoveColorImage']);

            Route::post('remove-product-color', ['as' => 'post:remove_product_color', 'uses' => 'AdminController@RemoveProductColor']);

            Route::post('add-color-image', ['as' => 'post:add_color_image', 'uses' => 'AdminController@addColorImage']);

            Route::post('update-product-color', ['as' => 'post:update_product_color', 'uses' => 'AdminController@updateProductColor']);
            Route::post('update-product-price', ['as' => 'post:update_product_price', 'uses' => 'AdminController@updateProductPrice']);


            //manage order routes
            Route::get('manage-order', ['as' => 'get:manage_order', 'uses' => 'AdminController@getManageOrder']);
            Route::post('manage-order-status', ['as' => 'post:order_status', 'uses' => 'AdminController@postOrderStatus']);
            Route::get('product-invoice/{slug}', ['as' => 'get:product_invoice', 'uses' => 'AdminController@getProductInvoice']);
            Route::get('manage-cancel-order', ['as' => 'get:manage_cancel_order', 'uses' => 'AdminController@getManageCancelOrder']);
            Route::get('approve-cancel-order', ['as' => 'get:order_cancel_approve', 'uses' => 'AdminController@getOrderCancelApprove']);
            // ishwar start
            Route::get('manage-return-order', ['as' => 'get:manage_return_order', 'uses' => 'AdminController@getManageReturnOrder']);
            Route::get('approve-return-order', ['as' => 'get:order_return_approve', 'uses' => 'AdminController@getOrderReturnApprove']);
            // ishwar over

            Route::get('order-shipping-process', ['as' => 'post:order_shipping_process', 'uses' => 'AdminController@postOrderShippingProcess']); 

            //seller payment 02-08-2018
            Route::get('seller-payment-request', ['as' => 'get:seller_payment_request', 'uses' => 'AdminController@getSellerPaymentRequest']);
            Route::post('add-payment-request', ['as' => 'post:add_payment_request', 'uses' => 'AdminController@postAddPaymentRequest']);
            Route::get('view_seller-payment-request', ['as' => 'get:view_seller_payment_request', 'uses' => 'AdminController@getViewSellerPaymentRequest']);

            //seller payment manage by admin 03-08-2018
            Route::get('manage-payment-request', ['as' => 'get:manage_payment_request', 'uses' => 'AdminController@getManagePaymentRequest']);
            Route::post('update-seller-payment-status', ['as' => 'post:update_seller_payment_status', 'uses' => 'AdminController@postUpdateSellerPaymentStatus']);
            Route::post('update-seller-payment-remark', ['as' => 'post:update_seller_payment_remark', 'uses' => 'AdminController@postUpdateSellerPaymentRemarks']);

            //seller sales reports 04-08-2018
            Route::get('manage-seller-sales-report', ['as' => 'get:manage_seller_sales_report', 'uses' => 'AdminController@getManageSellerSalesReport']);
            Route::get('fee-deduct-data', ['as' => 'get:fee_deduct_data', 'uses' => 'AdminController@getProductFeeData']);
        
            Route::get('filter-seller-sales-report', ['as' => 'get:filter_seller_sales_report', 'uses' => 'AdminController@getSellerSalesFilter']);
            
            Route::get('seller-sales-report', ['as' => 'get:seller_sales_report', 'uses' => 'AdminController@getViewSellerSalesReport']);

            
            


        });

       // Route::group(['middleware' => ['admin', 'role:admin']], function () {
            Route::get('add-employee', ['as' => 'get:add_employee', 'uses' => 'EmployeeController@getAddEmployee']);
            Route::post('add-employee', ['as' => 'post:add_employee', 'uses' => 'EmployeeController@postAddEmployee']);
            Route::get('manage-employee', ['as' => 'get:manage_employee', 'uses' => 'EmployeeController@getManageEmployee']);
            Route::get('edit-employee/{slug}', ['as' => 'get:edit_employee', 'uses' => 'EmployeeController@getEditEmployee']);
            Route::get('delete-employee', ['as' => 'get:delete_employee', 'uses' => 'EmployeeController@getDeleteEmployee']);
            Route::get('add-holiday', ['as' => 'get:add_holiday', 'uses' => 'AdminController@getAddHoliday']);
            

            //permission route
            Route::get('add-permission', ['as' => 'get:add_permission', 'uses' => 'EmployeeController@getAddPermission']);
            Route::post('add-permission', ['as' => 'post:add_permission', 'uses' => 'EmployeeController@postAddPermission']);
            Route::get('manage-permission', ['as' => 'get:manage_permission', 'uses' => 'EmployeeController@getManagePermission']);
            Route::get('edit-permission/{slug}', ['as' => 'get:edit_permission', 'uses' => 'EmployeeController@getEditPermission']);
            Route::get('delete-permission', ['as' => 'get:delete_permission', 'uses' => 'EmployeeController@getDeletePermission']);
            Route::get('assign-permission', ['as' => 'get:assign_permission', 'uses' => 'EmployeeController@getAssignPermission']);
            Route::post('assign-permission', ['as' => 'post:assign_permission', 'uses' => 'EmployeeController@postAssignPermission']);
            Route::get('manage-assign-permission', ['as' => 'get:manage_assign_permission', 'uses' => 'EmployeeController@getManageAssignPermission']);
            Route::get('delete-assign-permission', ['as' => 'get:delete_assign_permission', 'uses' => 'EmployeeController@getDeleteAssignPermission']);
            Route::get('check-employee', ['as' => 'get:check_employee', 'uses' => 'EmployeeController@getcheckEmployeePermission']);

            //categories routes
            Route::get('add-category', ['as' => 'get:add_category', 'uses' => 'AdminController@getAddCategory']);
            Route::post('add-category', ['as' => 'post:add_category', 'uses' => 'AdminController@postAddCategory']);
            Route::get('manage-category', ['as' => 'get:manage_category', 'uses' => 'AdminController@getManageCategory']);
            Route::get('edit-category/{slug}', ['as' => 'get:edit_categories', 'uses' => 'AdminController@getEditCategory']);
            Route::get('delete-category', ['as' => 'get:delete_categories', 'uses' => 'AdminController@getDeleteCategory']);

            //subcategory routes
            Route::get('add-subcategory', ['as' => 'get:add_subcategory', 'uses' => 'AdminController@getAddSubCategory']);
            Route::post('add-subcategory', ['as' => 'post:add_subcategory', 'uses' => 'AdminController@postAddSubCategory']);
            Route::get('edit-subcategory/{slug}', ['as' => 'get:edit_subcategories', 'uses' => 'AdminController@getEditSubCategory']);
            Route::get('delete-subcategory', ['as' => 'get:delete_subcategories', 'uses' => 'AdminController@getDeleteSubCategory']);

            // subcategory2 routes ishwar start
            Route::get('add-subcategory2', ['as' => 'get:add_subcategory2', 'uses' => 'AdminController@getAddSubCategory2']);
            Route::post('add-subcategory2', ['as' => 'post:add_subcategory2', 'uses' => 'AdminController@postAddSubCategory2']);
            Route::get('manage-subcategory2', ['as' => 'get:manage_subcategory2', 'uses' => 'AdminController@getManageSubCategory2']);
            Route::get('edit-subcategory2/{slug}', ['as' => 'get:edit_subcategories2', 'uses' => 'AdminController@getEditSubCategory2']);
            Route::get('delete-subcategory2', ['as' => 'get:delete_subcategories2', 'uses' => 'AdminController@getDeleteSubCategory2']);
            // subcategory2 routes ishwar over

            //Products ishwar start
            Route::get('add-products-select-category', ['as' => 'get:add_products_select_category', 'uses' => 'AdminController@getCategoryPage']);
            Route::get('add-products-select-subcategory/{slug}', ['as' => 'get:add_products_select_subcategory', 'uses' => 'AdminController@getSubCategoryPage']);
            //Products ishwar start

            //tax class routes
            Route::get('add-tax-class', ['as' => 'get:add_tax_cass', 'uses' => 'AdminController@getAddTaxCass']);
            Route::post('add-tax-class', ['as' => 'post:add_tax_class', 'uses' => 'AdminController@postAddTaxCass']);
            Route::get('manage-tax-class', ['as' => 'get:manage_tax_class', 'uses' => 'AdminController@getManageTaxClass']);
            Route::get('edit-tax-class/{slug}', ['as' => 'get:edit_tax_class', 'uses' => 'AdminController@getEditTaxClass']);
            Route::get('delete-tax-class', ['as' => 'get:delete_tax_class', 'uses' => 'AdminController@getDeleteTaxClass']);


            //Currencies routes
            Route::get('add-currencies', ['as' => 'get:add_currencies', 'uses' => 'AdminController@getAddCurrencies']);
            Route::post('add-currencies', ['as' => 'post:add_currencies', 'uses' => 'AdminController@postAddCurrencies']);
            Route::get('manage-currencies', ['as' => 'get:manage_currencies', 'uses' => 'AdminController@getManageCurrencies']);
            Route::get('edit-currency/{slug}', ['as' => 'get:edit_currency', 'uses' => 'AdminController@getEditCurrency']);
            Route::get('default-currency/{slug}', ['as' => 'get:default_currency', 'uses' => 'AdminController@getDefaultCurrency']);
            Route::get('delete-currency', ['as' => 'get:delete_currency', 'uses' => 'AdminController@getDeleteCurrency']);

            //brand routes
            //Currencies routes
            Route::get('add-brand', ['as' => 'get:add_brand', 'uses' => 'AdminController@getAddBrand']);
            Route::post('add-brand', ['as' => 'post:add_brand', 'uses' => 'AdminController@postAddBrand']);
            Route::get('manage-brands', ['as' => 'get:manage_brand', 'uses' => 'AdminController@getManageBrands']);
            Route::get('edit-brand/{slug}', ['as' => 'get:edit_brand', 'uses' => 'AdminController@getEditBrand']);
            Route::get('delete-brand', ['as' => 'get:delete_brand', 'uses' => 'AdminController@getDeleteBrand']);
            Route::get('approve-brand', ['as' => 'get:approve_brand', 'uses' => 'AdminController@getApproveBrand']);

             Route::get('add-brand-doc/{slug}', ['as' => 'get:add_brand_doc', 'uses' => 'AdminController@getEditBrandDoc']);
            Route::post('add-brand-doc', ['as' => 'post:add_brand_doc', 'uses' => 'AdminController@postAddBrandDoc']);



            Route::get('remove-brand-document', ['as' => 'get:delete_brand_document', 'uses' => 'AdminController@getDeleteBrandDocument']);


            //top menu category routes
            Route::get('menu-category', ['as' => 'get:top_menu_category', 'uses' => 'AdminController@getTopMenuCategory']);
            Route::post('menu-category', ['as' => 'post:add_menu_category', 'uses' => 'AdminController@postTopMenuCategory']);

            //product approve
            Route::get('approve-product', ['as' => 'get:approve_products', 'uses' => 'AdminController@getApproveProducts']);

            //manage seller
            Route::get('manage-seller', ['as' => 'get:manage_seller', 'uses' => 'AdminController@getManageSeller']);
            Route::get('seller-details', ['as' => 'get:seller_details', 'uses' => 'AdminController@getSellerDetails']);
            Route::get('delete-seller', ['as' => 'get:delete_seller', 'uses' => 'AdminController@getDeleteSeller']);
            Route::get('approve-seller', ['as' => 'get:seller_approve', 'uses' => 'AdminController@getSellerApprove']);

            //seller calendar by ishwar
            Route::get('manage-seller-holidays', ['as' => 'get:manage_seller_holidays', 'uses' => 'AdminController@getManageSellerHolidays']);

            Route::get('get_seller_holidays', ['as' => 'get:get_seller_holidays', 'uses' => 'AdminController@getSellerHolidays']);

            Route::post('manage_seller_holidays', ['as' => 'post:manage_seller_holidays', 'uses' => 'AdminController@postManageSellerHoliday']);


            Route::get('manage-homepage-categories', ['as' => 'get:homepage_categories', 'uses' => 'AdminController@getHomepageCategories']);
            Route::get('manage-homepage-products', ['as' => 'get:manage_homepage_product', 'uses' => 'AdminController@getManageHomepageProducts']);

            Route::get('notify', ['as' => 'get:notify', 'uses' => 'AdminController@getNotify']);


            //import products Excel
            Route::get('import-products', ['as' => 'get:import_products', 'uses' => 'AdminController@getImportProducts']);

            //reports routes
            Route::get('seller-commission-report', ['as' => 'get:seller_commission_report', 'uses' => 'AdminController@getSellerCommissionReport']);
            Route::get('filter-seller-commission-report', ['as' => 'get:commission_filter_order', 'uses' => 'AdminController@getCommissionFilterOrder']);
            Route::get('subcategory-commission', ['as' => 'get:subcategory_commission', 'uses' => 'AdminController@getSubcategoryCommission']);
            Route::get('filter-subcategory-commission', ['as' => 'get:subcategory_commission_filter', 'uses' => 'AdminController@getSubcategoryCommissionFilter']);
            Route::get('order-report', ['as' => 'get:order_report', 'uses' => 'AdminController@getOrderReport']);
            Route::get('order-filter', ['as' => 'get:order_filter', 'uses' => 'AdminController@getOrderFilter']);
            Route::get('recharge-report', ['as' => 'get:recharge_report', 'uses' => 'AdminController@getRechargeReport']);
            Route::get('recharge-filter', ['as' => 'get:recharge_filter', 'uses' => 'AdminController@getRechargeFilter']);
            Route::get('seller-report', ['as' => 'get:seller_report', 'uses' => 'AdminController@getSellerReport']);
            Route::get('seller-filter', ['as' => 'get:seller_filter', 'uses' => 'AdminController@getSellerFilter']);

            //excel and pdf download routes
            Route::get('seller-commission-export-file/{type}', ['as' => 'get:seller_commission_export_file', 'uses' => 'AdminController@getSellerCommissionExportFile']);
            Route::get('subcat-commission-export-file/{type}', ['as' => 'get:subcat_commission_export_file', 'uses' => 'AdminController@getSubCategoryCommissionExportFile']);
            Route::get('order-export-file/{type}', ['as' => 'get:order_export_file', 'uses' => 'AdminController@getOrderExportFile']);
            Route::get('recharge-export-file/{type}', ['as' => 'get:recharge_export_file', 'uses' => 'AdminController@getRechargeExportFile']);
            Route::get('seller-export-file/{type}', ['as' => 'get:seller_export_file', 'uses' => 'AdminController@getSellerExportFile']);
            //ishwar
            Route::get('products-export-file/{type}', ['as' => 'get:products_export_file', 'uses' => 'AdminController@getProductsExportFile']);
            // Route::get('show-products/{type}', ['as' => 'get:show_products', 'uses' => 'AdminController@showProducts']);

            //homepage slider routes
            Route::get('homepage-slider', ['as' => 'get:homepage_slider', 'uses' => 'AdminController@getHomepageSlider']);
            Route::post('homepage-slider', ['as' => 'post:homepage_slider', 'uses' => 'AdminController@postHomepageSlider']);
            Route::get('remove-homepage-slider', ['as' => 'get:delete_slider', 'uses' => 'AdminController@getDeleteSlider']);

            //subcategory slider routes
            Route::get('subcategory-slider', ['as' => 'get:sub_category_slider', 'uses' => 'AdminController@getSubCategorySlider']);
            Route::post('subcategory-slider', ['as' => 'post:subcategory_slider', 'uses' => 'AdminController@postSubCategorySlider']);
            Route::get('subcategory-slider-remove', ['as' => 'get:delete_sub_slider', 'uses' => 'AdminController@getDeleteSubSlider']);

            //products sliders
            Route::get('products-slider', ['as' => 'get:product_details_slider', 'uses' => 'AdminController@getProductDetailsSlider']);
            Route::post('products-slider', ['as' => 'post:products_slider', 'uses' => 'AdminController@postProductsSlider']);
            Route::get('remove-products-slider', ['as' => 'get:delete_product_slider', 'uses' => 'AdminController@getDeleteProductSlider']);

            //others pages
            Route::get('add-about-us', ['as' => 'get:add_about_us', 'uses' => 'AdminController@getAddAboutUs']);
            Route::post('add-about-us', ['as' => 'post:add_about_us', 'uses' => 'AdminController@postAddAboutUs']);
            Route::get('add-privacy-policy', ['as' => 'get:add_privacy_policy', 'uses' => 'AdminController@getAddPrivacyPolicy']);
            Route::post('add-privacy-policy', ['as' => 'post:privacy_policy', 'uses' => 'AdminController@postAddPrivacyPolicy']);
            Route::get('add-terms-condition', ['as' => 'get:add_terms_condition', 'uses' => 'AdminController@getAddTermsCondition']);
            Route::post('add-terms-condition', ['as' => 'post:add_terms_condition', 'uses' => 'AdminController@postAddTermsCondition']);
            Route::get('add-faq', ['as' => 'get:add_faq', 'uses' => 'AdminController@getAddFaq']);
            Route::post('add-faq', ['as' => 'post:add_faq', 'uses' => 'AdminController@postAddFaq']);
            Route::get('add-delivery-info', ['as' => 'get:add_delivery_info', 'uses' => 'AdminController@getAddDeliveryInfo']);
            Route::post('add-delivery-info', ['as' => 'post:add_delivery_info', 'uses' => 'AdminController@postAddDeliveryInfo']);
            Route::get('add-cancellation-policy', ['as' => 'get:add_cancellation_policy', 'uses' => 'AdminController@getAddCancellationPolicy']);
            Route::post('add-cancellation-policy', ['as' => 'post:add_cancellation_policy', 'uses' => 'AdminController@postAddCancellationPolicy']);
            Route::get('add-seller-policy', ['as' => 'get:add_seller_policy', 'uses' => 'AdminController@getAddSellerPolicy']);
            Route::post('add-seller-policy', ['as' => 'post:add_seller_policy', 'uses' => 'AdminController@postAddSellerPolicy']);
            Route::get('add-testimonials', ['as' => 'get:add_testimonials', 'uses' => 'AdminController@getAddTestimonials']);
            Route::post('add-testimonials', ['as' => 'post:add_testimonials', 'uses' => 'AdminController@postAddTestimonials']);
            Route::get('manage-testimonials', ['as' => 'get:manage_testimonials', 'uses' => 'AdminController@getManageTestimonials']);
            Route::get('edit-testimonials/{slug}', ['as' => 'get:edit_testimonial', 'uses' => 'AdminController@getEditTestimonials']);
            Route::get('delete-testimonials', ['as' => 'get:delete_testimonial', 'uses' => 'AdminController@getDeleteTestimonials']);

       // });
    });
});