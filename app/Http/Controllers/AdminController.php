<?php

namespace App\Http\Controllers;

use App\Classes\AdminManageService;
use App\Classes\CategoriesService;
use App\Model\ColorsImages;
use App\Classes\MailService;
use App\FAQ;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CurrencyRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Requests\TaxClassRequest;
use App\Http\Requests\SubCategoryRequest2;
use App\Model\AboutUs;
use App\Model\Brands;
use App\Model\BrandsDocuments;
use App\Model\CancellationPolicy;
use App\Model\Categories;
use App\Model\Circle;
use App\Model\Currencies;
use App\Model\DeliveryInfo;
use App\Model\HomepageSlider;
use App\Model\Operators;
use App\Model\Order;
use App\Model\PrivacyPolicy;
use App\Model\Products;
use App\Model\SellerHoliday;
use App\Model\ProductsAttributes;
use App\Model\ProductsDiscount;
use App\Model\ProductsScreenshots;
use App\Model\ProductsSliders;
use App\Model\RechargeHistory;
use App\Model\SellerPolicy;
use App\Model\SellerPaymentRequest;
use App\Model\SellerPaymentHistory;
use App\Model\ShippingHistory;
use App\Model\SubCategory;
use App\Model\SubCategory2;
use App\Model\SubcategorySlider;
use App\Model\TaxClass;
use App\Model\Testimonials;
use App\Model\User;
use App\Model\FeeDeduction;
use App\Model\PaymentCollection;
use App\TermsCondition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * @var CategoriesService
     */
    private $categoriesService;
    /**
     * @var AdminManageService
     */
    private $adminManageService;
    /**
     * @var MailService
     */
    private $mailService;

    public function __construct(CategoriesService $categoriesService, AdminManageService $adminManageService, MailService $mailService)
    {
        $this->categoriesService = $categoriesService;
        $this->adminManageService = $adminManageService;
        $this->mailService = $mailService;
    }

    public function getIndex()
    {
        return view('admin.pages.index');
    }

    public function getAddCategory()
    {
        return view('admin.pages.category.add_category');
    }

    public function postAddCategory(CategoryRequest $request)
    {
        if ($request->get('categoryId')) {
            $categories = Categories::limit(1)->find($request->get('categoryId'));
        } else {
            $categories = new Categories();
        }
        $this->categoriesService->saveCategories($categories, $request->get('name'), $request->get('desc'), $request->get('m_title'), $request->get('m_desc'), $request->get('m_keywords'), $request->get('m_tag'));

        if ($request->file('thumb_img')) {
            $thumb_name = 'thumb_' . time() . '.' . $request->file('thumb_img')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('thumb_img')->getRealPath())->resize(320, 320,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(320, 320);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('category/') . $thumb_name);

            $categories->thumb_img = $thumb_name;
            if (\File::exists(public_path() . '/category/' . $request->get('oldThumImg'))) {
                \File::delete(public_path() . '/category/' . $request->get('oldThumImg'));
            }
        } else {
            $categories->cat_img = $request->get('oldThumImg');
        }

        if ($request->file('cat_img')) {
            $catImg = 'cat_' . time() . '.' . $request->file('cat_img')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('cat_img')->getRealPath())->resize(null, 20,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(20, 20);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('category/') . $catImg);

            $categories->cat_img = $catImg;
            if (\File::exists(public_path() . '/category/' . $request->get('oldCatImg'))) {
                \File::delete(public_path() . '/category/' . $request->get('oldCatImg'));
            }
        } else {
            $categories->cat_img = $request->get('oldCatImg');
        }
        if ($request->file('other_image')) {
            $otherImg = 'other_' . time() . '.' . $request->file('other_image')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('other_image')->getRealPath())->resize(null, 320,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(170, 320);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('category/') . $otherImg);

            $categories->other_image = $otherImg;
            if (\File::exists(public_path() . '/category/' . $request->get('oldOtherImg'))) {
                \File::delete(public_path() . '/category/' . $request->get('oldOtherImg'));
            }
        } else {
            $categories->other_image = $request->get('oldOtherImg');
        }
        if ($request->file('sidebar_image')) {
            $sideImg = 'side_' . time() . '.' . $request->file('sidebar_image')->getClientOriginalExtension();
            $destinationPath = public_path('/699CategoryImg/');
            $request->file('sidebar_image')->move($destinationPath, $sideImg);
            $image = Image::make(public_path('/699CategoryImg/') . $sideImg);
            $image->resize(699, 100);
            $image->save();

            $categories->sidebar_image = $sideImg;
            if (\File::exists(public_path() . '/699CategoryImg/' . $request->get('oldSideImg'))) {
                \File::delete(public_path() . '/699CategoryImg/' . $request->get('oldSideImg'));
            }
        } else {
            $categories->sidebar_image = $request->get('oldSideImg');
        }
        $categories->save();
        
       

        if ($request->get('categoryId')) {

            //Update Deduction data;
            FeeDeduction::where('category_id',$request->get('categoryId'))->limit(1)->update(array('deduction_type' => $request->deduction_type,'deduction_charge' => $request->deduction_charge));

            $deduct_id = FeeDeduction::select('id')->where('category_id',$request->get('categoryId'))->first();

            if($deduct_id)
            {
                // PaymentCollection update
                PaymentCollection::where('fee_deduction_id',$deduct_id->id)->limit(1)->update(array(
                    'selling_fee' =>$request->selling_fee,
                    'closing_fee' =>$request->closing_fee,
                    'total_fee' =>$request->total_fee,
                    'service_tax' =>$request->service_tax));
            }
            else
            {
                $feededuction = new FeeDeduction();
                $feededuction->category_id = $categories->id;
                $feededuction->deduction_charge = isset($request->deduction_charge) ? $request->deduction_charge : 0;
                $feededuction->deduction_type = isset($request->deduction_type) ? $request->deduction_type : '';
                $feededuction->save();

                //PaymentCollection
                $paycollection = new PaymentCollection();
                $paycollection->fee_deduction_id = $feededuction->id;
                $paycollection->selling_fee = isset($request->selling_fee) ? $request->selling_fee : 0;
                $paycollection->closing_fee = isset($request->closing_fee) ? $request->closing_fee : 0;
                $paycollection->total_fee = isset($request->total_fee) ? $request->total_fee : 0;
                $paycollection->service_tax =isset($request->service_tax) ? $request->service_tax : 0;
                $paycollection->save();
            }

            Session::flash('success', 'Categories updated successfully !');
            return redirect()->route('get:edit_categories', $categories->slug);
        } else {

            //Add entry in Fee Deduction table;
            $feededuction = new FeeDeduction();
            $feededuction->category_id = $categories->id;
            $feededuction->deduction_charge = isset($request->deduction_charge) ? $request->deduction_charge : 0;
            $feededuction->deduction_type = isset($request->deduction_type) ? $request->deduction_type : '';
            $feededuction->save();

            //PaymentCollection
            $paycollection = new PaymentCollection();
            $paycollection->fee_deduction_id = $feededuction->id;
            $paycollection->selling_fee = isset($request->selling_fee) ? $request->selling_fee : 0;
            $paycollection->closing_fee = isset($request->closing_fee) ? $request->closing_fee : 0;
            $paycollection->total_fee = isset($request->total_fee) ? $request->total_fee : 0;
            $paycollection->service_tax =isset($request->service_tax) ? $request->service_tax : 0;
            $paycollection->save();

            Session::flash('success', 'Categories added successfully !');
            return redirect()->route('get:add_category');
        }
    }

    public function getManageCategory()
    {
        return view('admin.pages.category.manage_category');
    }

    public function getHomepageCategories(Request $request)
    {
        $category = Categories::find($request->get('catId'));
        if (!$category) {
            return response()->json([
                'error' => true,
                'message' => 'Category not found..!'
            ]);
        }
        if ($request->get('type') == 'new') {
            if ($category->new_arrival == 0) {
                $category->new_arrival = 1;
            } else {
                $category->new_arrival = 0;
            }
            $category->save();
            return response()->json([
                'success' => true,
                'message' => 'Category added in new arrivals..!'
            ]);
        } elseif ($request->get('type') == 'top') {
            if ($category->top_seller == 0) {
                $category->top_seller = 1;
            } else {
                $category->top_seller = 0;
            }
            $category->save();
            return response()->json([
                'success' => true,
                'message' => 'Category added in new top seller..!'
            ]);
        } elseif ($request->get('type') == 'special') {
            if ($category->special == 0) {
                $category->special = 1;
            } else {
                $category->special = 0;
            }
            $category->save();
            return response()->json([
                'success' => true,
                'message' => 'Category added in new special..!'
            ]);
        } else {
            if ($category->recommend == 0) {
                $category->recommend = 1;
            } else {
                $category->recommend = 0;
            }
            $category->save();
            return response()->json([
                'success' => true,
                'message' => 'Category added in new recommend..!'
            ]);
        }
    }

    public function getManageHomepageProducts(Request $request)
    {
        $product = Products::find($request->get('productId'));
        if (!$product) {
            return response()->json([
                'error' => true,
                'message' => 'Product not found..!'
            ]);
        }
        if ($request->get('type') == 'new') {
            if ($product->new_arrival == 0) {
                $product->new_arrival = 1;
            } else {
                $product->new_arrival = 0;
            }
            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Product added in new arrivals..!'
            ]);
        } elseif ($request->get('type') == 'special') {
            if ($product->special == 0) {
                $product->special = 1;
            } else {
                $product->special = 0;
            }
            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Product added in new special..!'
            ]);
        } else {
            if ($product->recommend == 0) {
                $product->recommend = 1;
            } else {
                $product->recommend = 0;
            }
            $product->save();
            return response()->json([
                'success' => true,
                'message' => 'Product added in new recommend..!'
            ]);
        }
    }

    public function getEditCategory($slug)
    {
        $category = Categories::limit(1)->where('slug', $slug)->first();
        if (!$category) {
            Session::flash('error', 'Category not found..!');
            return redirect()->back();
        }

        //Ishwar get deduction from deduction table
        $feededuction = FeeDeduction::select('id','deduction_charge','deduction_type')->where('category_id',$category->id)->first();

        if($feededuction)
        {   
            $paymentcollection = PaymentCollection::select('*')->where('fee_deduction_id',$feededuction->id)->first();
            $category['deduction_charge'] =  $feededuction->deduction_charge;
            $category['deduction_type'] =  $feededuction->deduction_type;
            $category['selling_fee'] =  isset($paymentcollection->selling_fee) ? $paymentcollection->selling_fee : '' ;
            $category['closing_fee'] =  isset($paymentcollection->closing_fee) ? $paymentcollection->closing_fee : '' ;
            $category['total_fee'] =  isset($paymentcollection->total_fee) ? $paymentcollection->total_fee : '' ;
            $category['service_tax'] =  isset($paymentcollection->service_tax) ? $paymentcollection->service_tax : '' ;
        }

        return view('admin.pages.category.add_category', compact('category'));
    }

    public function getDeleteCategory(Request $request)
    {
        $category = Categories::where('slug', $request->get('slug'))->first();
        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }
        if (\File::exists(public_path() . '/category/' . $category->cat_img)) {
            \File::delete(public_path() . '/category/' . $category->cat_img);
        }
        $category->delete();
        Session::flash('success', 'Category Deleted Successfully!');
        return response()->json([
            'success' => true,
            'message' => 'Category Deleted Successfully'
        ]);
    }

    public function getAddSubCategory()
    {
        $categories = Categories::select('id', 'name')->orderBy('name')->get();
        return view('admin.pages.subcategory.add_sub_category', compact('categories'));
    }

    public function postAddSubCategory(SubCategoryRequest $request)
    {
        if ($request->get('subcategoryId')) {
            $subcategories = SubCategory::limit(1)->find($request->get('subcategoryId'));
        } else {
            $subcategories = new SubCategory();
        }
        $this->categoriesService->saveSubCategories($subcategories, $request->get('name'), $request->get('category'), $request->get('desc'), $request->get('commission'), $request->get('commission_type'), $request->get('m_title'), $request->get('m_desc'), $request->get('m_keywords'), $request->get('m_tag'));

        if ($request->file('sub_cat_img')) {
            $subcatImg = time() . '.' . $request->file('sub_cat_img')->getClientOriginalExtension();

            $thumb_img = Image::make($request->file('sub_cat_img')->getRealPath())->resize(null, 20,
                function ($constraint) { 
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(20, 20);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('subcategory/') . $subcatImg);

            $subcategories->sub_cat_img = $subcatImg;
            if (\File::exists(public_path() . '/subcategory/' . $request->get('oldSubCatImg'))) {
                \File::delete(public_path() . '/subcategory/' . $request->get('oldSubCatImg'));
            }
        } else {
            $subcategories->sub_cat_img = $request->get('oldSubCatImg');
        }


        if ($request->file('thumb_img')) {
            $imgname = 'thumb_'.time() . '.' . $request->file('thumb_img')->getClientOriginalExtension();

            $thumb_img = Image::make($request->file('thumb_img')->getRealPath())->resize(320, 320,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(320, 320);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('subcategory/') . $imgname);

            $subcategories->thumb_img = $imgname;
            if (\File::exists(public_path() . '/subcategory/' . $request->get('oldThumbImg'))) {
                \File::delete(public_path() . '/subcategory/' . $request->get('oldThumbImg'));
            }
        } else {
            $subcategories->thumb_img = $request->get('oldThumbImg');
        }
        
        $subcategories->save();

        if ($request->get('subcategoryId')) {
            Session::flash('success', 'Sub Categories updated successfully !');
            return redirect()->route('get:edit_subcategories', $subcategories->slug);
        } else {
            Session::flash('success', 'Sub Categories added successfully !');
            return redirect()->route('get:add_subcategory');
        }
    }

    public function getManageSubCategory()
    {
        $subcategories = SubCategory::select('id', 'name', 'slug')->get();
        return view('admin.pages.subcategory.manage_subcategory', compact('subcategories'));
    }

    public function getEditSubCategory($slug)
    {
        $subcategory = SubCategory::limit(1)->where('slug', $slug)->first();
        if (!$subcategory) {
            Session::flash('error', 'SubCategory not found..!');
            return redirect()->back();
        }
        $categories = Categories::select('id', 'name')->get();
        return view('admin.pages.subcategory.add_sub_category', compact('subcategory', 'categories'));
    }

    public function getDeleteSubCategory(Request $request)
    {
        $subcategory = SubCategory::where('slug', $request->get('slug'))->first();
        if (!$subcategory) {
            return response()->json([
                'success' => false,
                'message' => 'SubCategory not found'
            ]);
        }
        if (\File::exists(public_path() . '/subcategory/' . $subcategory->sub_cat_img)) {
            \File::delete(public_path() . '/subcategory/' . $subcategory->sub_cat_img);
        }
        $subcategory->delete();
        Session::flash('success', 'SubCategory Deleted Successfully!');
        return response()->json([
            'success' => true,
            'message' => 'SubCategory Deleted Successfully'
        ]);
    }

    public function getAddTaxCass()
    {
        return view('admin.pages.taxclass.add_tax_class');
    }

    public function postAddTaxCass(TaxClassRequest $request)
    {
        if ($request->get('taxClassId')) {
            $taxClass = TaxClass::find($request->get('taxClassId'));
        } else {
            $taxClass = new TaxClass();
        }
        $this->adminManageService->SaveTaxClassDetails($taxClass, $request);
        if ($request->get('taxClassId')) {
            Session::flash('success', 'Tax class added successfully..!');
            return redirect()->route('get:edit_tax_class', $taxClass->slug);
        } else {
            Session::flash('success', 'Tax class added successfully..!');
            return redirect()->back();
        }
    }

    public function getManageTaxClass()
    {
        $taxClasses = TaxClass::select('id', 'name', 'tax_rate', 'type', 'slug')->get();
        return view('admin.pages.taxclass.manage_tax_class', compact('taxClasses'));
    }

    public function getEditTaxClass($slug)
    {
        $taxclass = TaxClass::limit(1)->where('slug', $slug)->first();
        if (!$taxclass) {
            Session::flash('error', 'TaxClass not found..!');
            return redirect()->back();
        }
        return view('admin.pages.taxclass.add_tax_class', compact('taxclass'));
    }

    public function getDeleteTaxClass(Request $request)
    {
        $taxClass = TaxClass::where('slug', $request->get('slug'))->first();
        if (!$taxClass) {
            return response()->json([
                'success' => false,
                'message' => 'SubCategory not found'
            ]);
        }
        $taxClass->delete();
        Session::flash('success', 'Tax Class Deleted Successfully!');
        return response()->json([
            'success' => true,
            'message' => 'Tax Class Deleted Successfully'
        ]);
    }

    public function getAddCurrencies()
    {
        return view('admin.pages.currencies.add_currencies');
    }

    public function postAddCurrencies(CurrencyRequest $request)
    {
        if ($request->get('currencyId')) {
            $currency = Currencies::find($request->get('currencyId'));
        } else {
            $currency = new Currencies();
        }
        $this->adminManageService->saveCurrenciesDetails($currency, $request);
        Session::flash('success', 'Currency added successfully..!');
        return redirect()->back();
    }

    public function getManageCurrencies()
    {
        $currencies = Currencies::select('id', 'name', 'code', 'value', 'default', 'slug')->get();
        return view('admin.pages.currencies.manage_currencies', compact('currencies'));
    }

    public function getEditCurrency($slug)
    {
        $currency = Currencies::limit(1)->where('slug', $slug)->first();
        if (!$currency) {
            Session::flash('error', 'Currency not found..!');
            return redirect()->back();
        }
        return view('admin.pages.currencies.add_currencies', compact('currency'));
    }

    public function getDefaultCurrency($slug)
    {
        $currency = Currencies::limit(1)->where('slug', $slug)->first();
        if (!$currency) {
            Session::flash('error', 'Currency not found..!');
            return redirect()->back();
        }
        $currencies = Currencies::all();
        foreach ($currencies as $curren) {
            $curren->default = 0;
            $curren->save();
        }
        $currency->default = 1;
        $currency->save();

        Session::flash('success', 'Default currency selected..!');
        return redirect()->back();
    }

    public function getDeleteCurrency(Request $request)
    {
        $currency = Currencies::where('slug', $request->get('slug'))->first();
        if (!$currency) {
            return response()->json([
                'success' => false,
                'message' => 'SubCategory not found'
            ]);
        }
        $currency->delete();
        Session::flash('success', 'Currency Deleted Successfully!');
        return response()->json([
            'success' => true,
            'message' => 'Currency Deleted Successfully'
        ]);
    }

    public function getAddBrand()
    {
        $categories = Categories::select('id', 'name', 'slug')->orderBy('name')->get();
        return view('admin.pages.brand.add_brand', compact('categories'));
        // return view('admin.pages.brand.add_brand');
    }

    public function postAddBrand(BrandRequest $request)
    {
        if ($request->get('brandId')) {
            $brand = Brands::find($request->get('brandId'));
        } else {
            $brand = new Brands();
        }
        if (isset($brand->name)) {
            if ($brand->name != $request->get('name')) {
                $brand->slug = $brand->getSlugForCustom($brand->name);
            }
        } else {
            $brand->slug = $brand->getSlugForCustom($request->get('name'));
        }
        $brand->name = $request->get('name');
        $brand->desc = $request->get('desc');
        $brand->user_id = Auth::user()->id;
        $brand->category_id = $request->get('category');
        $this->adminManageService->saveBrandsImages($request, $brand);

        $brand->save();

        //store multiple docs...
        if ($request->hasFile('brand_documents')) {
            foreach ($request->file('brand_documents') as $brandDoc){
                $photo = $brandDoc;
                $imagename = 'brand_doc'.time() . uniqid(rand()) . '.' . $photo->getClientOriginalExtension();
                $destinationPath = public_path('/brandsImg/documents');
                $photo->move($destinationPath, $imagename);
                $brandDocs = new BrandsDocuments();
                $brandDocs->brand_id = $brand->id;
                $brandDocs->brands_documents = $imagename;
                $brandDocs->user_id = Auth::user()->id;
                $brandDocs->save();
            }
        }

        if ($request->get('brandId')) {
            Session::flash('success', 'Brand updated successfully..!');
            return redirect()->back();
        }
        else
        {
            Session::flash('success', 'Brand added successfully..!');
            return redirect()->back();
        }
       
    }

    public function postAddBrandDoc(Request $request)
    {

        // print_r($request->All());
        if ($request->hasFile('brand_documents')) {
            foreach ($request->file('brand_documents') as $brandDoc){
                $photo = $brandDoc;
                $imagename = 'brand_doc'.time() . uniqid(rand()) . '.' . $photo->getClientOriginalExtension();
                $destinationPath = public_path('/brandsImg/documents');
                $photo->move($destinationPath, $imagename);
                $brandDocs = new BrandsDocuments();
                $brandDocs->brand_id = $request->get('brandId');
                $brandDocs->brands_documents = $imagename;
                $brandDocs->user_id = Auth::user()->id;
                $brandDocs->save();
            }
        }

        Session::flash('success', 'Documents uploaded successfully..!');
            return redirect()->back();
    }

    public function getEditBrandDoc($slug)
    {
        $brand = Brands::limit(1)->where('slug', $slug)->first();
        $brandDocs = BrandsDocuments::select('id','brands_documents')->where('brand_id', $brand->id)->where('user_id',Auth::user()->id)->get();
        if (!$brand) {
            Session::flash('error', 'Brand not found..!');
            return redirect()->back();
        }
        return view('admin.pages.brand.manage_brand_document', compact('brand','brandDocs'));
    }

    public function getManageBrands()
    {
        $brands = Brands::select('brands.id', 'brands.name', 'brands.slug','brands.status','categories.name as categoryname')->join('categories','categories.id','brands.category_id')->get();
        return view('admin.pages.brand.manage_brand', compact('brands'));
    }

    public function getEditBrand($slug)
    {
        $brand = Brands::limit(1)->where('slug', $slug)->first();
        $brandDocs = BrandsDocuments::select('id','brands_documents')->where('brand_id', $brand->id)->get();
        if (!$brand) {
            Session::flash('error', 'Brand not found..!');
            return redirect()->back();
        }
        return view('admin.pages.brand.add_brand', compact('brand','brandDocs'));
    }

    public function getDeleteBrand(Request $request)
    {
        $brand = Brands::where('slug', $request->get('slug'))->first();
        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found'
            ]);
        }
        $brand->delete();
        Session::flash('success', 'Brand Deleted Successfully!');
        return response()->json([
            'success' => true,
            'message' => 'Brand Deleted Successfully'
        ]);
    }

    public function getApproveBrand(Request $request)
    {
        $brand = Brands::where('slug', $request->get('slug'))->first();
        if (!$brand) {
            return response()->json([
                'error' => true,
                'message' => 'Brand not found..!'
            ]);
        }
        if ($brand->status == 1) {
            $brand->status = 0;
        } else {
            $brand->status = 1;
        }
        $brand->save();
        Session::flash('success', 'Status Changed successfully..!');
        return response()->json(['success' => true]);
    }

    public function getAddProducts($slug)
    {
        $currencies = Currencies::select('id', 'name')->get();
        $taxClasses = TaxClass::select('id', 'name')->get();
       
        $subcategory = SubCategory::select('id','category_id')->where('slug',$slug)->first();
        $brands = Brands::select('id', 'name')->where('category_id',$subcategory->category_id)->get();

        $subcategory2 = SubCategory2::select('id', 'name')->where('subcategory_id',$subcategory->id)->get();
        return view('admin.pages.product.add_products', compact('currencies', 'brands', 'taxClasses', 'subcategory2','subcategory'));
        // return view('admin.pages.product.add_products', compact('currencies', 'brands', 'taxClasses', 'subcategories','categories'));
    }

    public function postAddProducts(ProductRequest $request)
    {
        if ($request->get('productId')) {
            $product = Products::find($request->get('productId'));
        } else {
            $product = new Products();
        }
        $product->user_id = Auth::user()->id;
        if (isset($product->name)) {
            if ($product->name != $request->get('name')) {
                $product->slug = $product->getSlugForCustom($product->name);
            }
        } else {
            $product->slug = $product->getSlugForCustom($request->get('name'));
        }
        $this->adminManageService->saveProductDetails($product, $request);

        $this->adminManageService->saveProductImages($request, $product);
        $oldSizeChartImg = $request->get('oldSizeChartImg');
        if ($request->file('size_chart')) {
            $this->adminManageService->saveProductSizeChart($request->file('size_chart'), $product, $oldSizeChartImg = null);
        } else {
            if ($oldSizeChartImg) {
                $product->size_chart = $oldSizeChartImg;
            }
        }

        $product->sub_category_id = $request->input("subcategory2_id");
        $product->save();

        if ($request->file('addition_image')) {
            $this->adminManageService->saveAdditionalImage($product, $request->file('addition_image'));
        }

        if ($request->get('productId')) {
            $productDiscounts = ProductsDiscount::where('product_id', $product->id)->get();
            if (count($productDiscounts) > 0) {
                foreach ($productDiscounts as $discount) {
                    $discount->delete();
                }
            }
        }
        if ($request->get('product_discount')) {
            $this->adminManageService->saveProductDiscount($product, $request->get('product_discount'));
        }

        if ($request->get('product_color')) 
        {
            // if ($request->get('productId')) {
            //     $productColors = ProductsAttributes::where('product_id', $product->id)->where('name', 'color')->get();
            //     if (count($productColors) > 0) {
            //         foreach ($productColors as $productColor) {
            //             $productColor->delete();
            //         }
            //     }
            // }

            // if($request->has('oldColor_images'))
            // {
            //     $this->adminManageService->saveProductAttr($product, $request->get('product_color'), 'color' ,$request->get('product_price'), null ,$request->get('oldColor_images'), $isold='yes');
            // }
            // else
            // {   

                // $arrayId = $request->get('color_images') ? $request->get('color_images') : array();
                // $arrayFile = $request->file('color_images') ? $request->file('color_images') : array();

                // $imagesArray = array_merge( $arrayId,  $arrayFile);

                // print_r($imagesArray);

                // exit;
                $this->adminManageService->saveProductAttr($product, $request->get('product_color'), 'color' ,$request->get('product_price'), null , null, $isold='no',$request);

            // }
        }

        if ($request->get('product_size')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'size')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('product_size'), 'size');
        }

        if ($request->get('product_size_color')) {
            // if ($request->get('productId')) {
            //     $productSizesColors = ProductsAttributes::where('product_id', $product->id)->where('name', 'size_color')->get();
            //     if (count($productSizesColors) > 0) {
            //         foreach ($productSizesColors as $productSizecolor) {
            //             $productSizecolor->delete();
            //         }
            //     }
            // }

            $this->adminManageService->saveProductAttr($product, $request->get('product_size_color'), 'size_color', $request->get('size_color_price'), $request->get('size_color_size'), $request->file('size_color_image'), 'no',$request);


        }

        if ($request->get('scent_name')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'scent')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('scent_name'), 'scent', $request->get('scent_price'), null , $request->file('scent_image'), 'no');
        }

        if ($request->get('size_scent_name')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'size_scent')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('size_scent_name'), 'size_scent', $request->get('size_scent_price'), $request->get('size_scent_size') , $request->file('size_scent_image'), 'no');
        }

        if ($request->get('paperback')) {

            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'paperback')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('paperback_name'), 'paperback', $request->get('paperback_price'), null , $request->file('paperback_image'), 'no');
        }

        if ($request->get('hardcover')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'hardcover')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('hardcover_name'), 'hardcover', $request->get('hardcover_price'), null , $request->file('hardcover_image'), 'no');
        }

        if ($request->get('audiocd')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'audiocd')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('audiocd_name'), 'audiocd', $request->get('audiocd_price'), null , $request->file('audiocd_image'), 'no');
        }

        if ($request->get('pattern')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'pattern')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('pattern_name'), 'pattern', $request->get('pattern_price'), null , $request->file('pattern_image'), 'no');
        }

        if ($request->get('cupsize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'cup_size')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('cup_size'), 'cup_size', $request->get('cup_size_price'), null , $request->file('cup_size_image'), 'no');
        }

        if ($request->get('cupsizecolor')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'cup_size_color')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('cup_size_color_size'), 'cup_size_color',  $request->get('cup_size_color_price'), $request->get('cup_size_color'), $request->file('cup_size_color_image'), 'no');
        }
      
        if ($request->get('colorlenswidth')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'color_lens_width')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('color_lens'), 'color_lens_width',  $request->get('color_lens_price'), $request->get('color_lens_width'), $request->file('color_lens_image'), 'no');
        }

        if ($request->get('colormagnificationstrength')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'color_magnification_strength')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('color_magnification_strength'), 'color_magnification_strength',  null , null, null, 'no');
        }

        if ($request->get('lenscolor')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'lens_color')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('lens_color'), 'lens_color',  $request->get('lens_color_price'), null , $request->file('lens_color_image'), 'no');
        }

        if ($request->get('colormaterial')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'color_material')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('color_material_color'), 'color_material',  $request->get('color_material_price'), $request->get('color_material') , $request->file('color_material_image'), 'no');
        }

        // --- After material
        if ($request->get('productFlavor')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'product_flavor')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('product_flavor'), 'product_flavor',  $request->get('product_flavor_price'), null , $request->file('product_flavor_image'), 'no');
        }

        if ($request->get('productWeight')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'product_weight')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('product_weight'), 'product_weight',  $request->get('product_weight_price'), null , $request->file('product_weight_image'), 'no');
        }

        if ($request->get('flavorsize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'flavor_size')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('flavor_size_flavor'), 'flavor_size',  $request->get('flavor_size_price'), $request->get('flavor_size') , $request->file('flavor_size_image'), 'no');
        }

        if ($request->get('flavorweight')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'flavor_weight')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('flavor_weight_flavor'), 'flavor_weight',  $request->get('flavor_weight_price'), $request->get('flavor_weight') , $request->file('flavor_weight_image'), 'no');
        }

        if ($request->get('productmaterial')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'product_material')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('product_material'), 'product_material',  $request->get('product_material_price'), null , $request->file('product_material_image'), 'no');
        }   

        if ($request->get('materialsize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'product_material_size')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('material_size_material'), 'product_material_size',  $request->get('material_size_price'), $request->get('material_size') , $request->file('material_size_image'), 'no');
        }


        // For Jwellery part

        if ($request->get('metaltype')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'metaltype')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('metal_type'), 'metaltype',  $request->get('metal_type_price'), null , $request->file('metal_type_image'), 'no');
        }

        if ($request->get('sizeperpearl')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'sizeperpearl')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('size_per_pearl'), 'sizeperpearl',  $request->get('size_per_pearl_price'), null , $request->file('size_per_pearl_image'), 'no');
        }

        if ($request->get('colormetaltype')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'color_metaltype')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('color_metaltype_color'), 'color_metaltype',  $request->get('color_metaltype_price'), $request->get('color_metaltype') , $request->file('color_metaltype_image'), 'no');
        }

        if ($request->get('coloritemlength')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'color_itemlength')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('color_itemlength_color'), 'color_itemlength',  $request->get('color_itemlength_price'), $request->get('color_itemlength') , $request->file('color_itemlength_image'), 'no');
        }

        if ($request->get('gemtype')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'gem_type')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('gem_type'), 'gem_type',  $request->get('gem_type_price'), null , $request->file('gem_type_image'), 'no');
        }


        if ($request->get('metalgemtype')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'metaltype_gemtype')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('metalgemtype_metaltype'), 'metaltype_gemtype',  $request->get('metalgemtype_price'),  $request->get('metalgemtype_gemtype') , $request->file('metalgemtype_image'), 'no');
        }

        if ($request->get('totalgemweight')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'total_gemweight')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('total_gemweight'), 'total_gemweight',  $request->get('total_gemweight_price'),  null , $request->file('total_gemweight_image'), 'no');
        }

        if ($request->get('totaldiamondweight')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'total_diamondweight')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('total_diamondweight'), 'total_diamondweight',  $request->get('total_diamondweight_price'),  null , $request->file('total_diamondweight_image'), 'no');
        }

        if ($request->get('metaltypetotaldiamondweight')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'metaltype_totaldiamondweight')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('metaltype_totaldiamondweight_metaltype'), 'metaltype_totaldiamondweight',  $request->get('metaltype_totaldiamondweight_price'),  $request->get('metaltype_totaldiamondweight_diamondweight') , $request->file('metaltype_totaldiamondweight_image'), 'no');
        }

        if ($request->get('itemlengthgemtype')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'itemlength_gemtype')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('itemlength_gemtype_itemlength'), 'itemlength_gemtype',  $request->get('itemlength_gemtype_price'),  $request->get('itemlength_gemtype') , $request->file('itemlength_gemtype_image'), 'no');
        }

        if ($request->get('itemlengthmaterial')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'itemlength_material')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('itemlength_material_itemlength'), 'itemlength_material',  $request->get('itemlength_material_price'),  $request->get('itemlength_material') , $request->file('itemlength_material_image'), 'no');
        }

        if ($request->get('itemlengthsizeperpearl')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'itemlength_sizeperpearl')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('itemlength_sizeperpearl_itemlength'), 'itemlength_sizeperpearl',  $request->get('itemlength_sizeperpearl_price'),  $request->get('itemlength_sizeperpearl') , $request->file('itemlength_sizeperpearl_image'), 'no');
        }

        if ($request->get('itemlengthmetaltype')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'itemlength_metaltype')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }

            $this->adminManageService->saveProductAttr($product, $request->get('itemlength_metaltype_itemlength'), 'itemlength_metaltype',  $request->get('itemlength_metaltype_price'),  $request->get('itemlength_metaltype') , $request->file('itemlength_metaltype_image'), 'no');
        }

        if ($request->get('itemlengthtotaldiamondweight')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'itemlength_totaldiamondweight')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('itemlength_totaldiamondweight_itemlength'), 'itemlength_totaldiamondweight',  $request->get('itemlength_totaldiamondweight_price'),  $request->get('itemlength_totaldiamondweight') , $request->file('itemlength_totaldiamondweight_image'), 'no');
        }

          if ($request->get('itemlength')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'item_length')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('item_length'), 'item_length',  $request->get('item_length_price'),  null , $request->file('item_length_image'), 'no');
        }

        if ($request->get('ringsize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'ring_size')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('ring_size'), 'ring_size',  $request->get('ring_size_price'),  null , $request->file('ring_size_image'), 'no');
        }

        if ($request->get('metaltyperingsize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'metaltype_ringsize')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('metaltype_ringsize_metaltype'), 'metaltype_ringsize',  $request->get('metaltype_ringsize_price'),  $request->get('metaltype_ringsize') , $request->file('metaltype_ringsize_image'), 'no');
        }

        if ($request->get('colorringsize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'color_ringsize')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('color_ringsize_color'), 'color_ringsize',  $request->get('color_ringsize_price'),  $request->get('color_ringsize') , $request->file('color_ringsize_image'), 'no');
        }

        if ($request->get('ringsizegemtype')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'ringsize_gemtype')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('ringsize_gemtype_ringsize'), 'ringsize_gemtype',  $request->get('ringsize_gemtype_price'),  $request->get('ringsize_gemtype') , $request->file('ringsize_gemtype_image'), 'no');
        }

        if ($request->get('ringsizetotaldiamondweight')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'ringsize_totaldiamondweight')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('ringsize_totaldiamondweight_ringsize'), 'ringsize_totaldiamondweight',  $request->get('ringsize_totaldiamondweight_price'),  $request->get('ringsize_totaldiamondweight') , $request->file('ringsize_totaldiamondweight_image'), 'no');
        }
        // Jwellery part over here...

        // Office 
        if ($request->get('numberofitems')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'number_of_items')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('number_of_items'), 'number_of_items',  $request->get('number_of_items_price'),  null  , $request->file('number_of_items_image'), 'no');
        }

        if ($request->get('papersize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'paper_size')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('paper_size'), 'paper_size',  $request->get('paper_size_price'),  null  , $request->file('paper_size_image'), 'no');
        }

        if ($request->get('maximumexpandablesize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'maximum_expandable_size')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('maximum_expandable_size'), 'maximum_expandable_size',  $request->get('maximum_expandable_size_price'),  null  , $request->file('maximum_expandable_size_image'), 'no');
        }

        if ($request->get('linesize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'line_size')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('line_size'), 'line_size',  $request->get('line_size_price'),  null  , $request->file('line_size_image'), 'no');
        }

        // Shoes & handbags

        if ($request->get('stylesize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'style_size')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('style_size_style'), 'style_size',  $request->get('style_size_price'),  $request->get('style_size')  , $request->file('style_size_image'), 'no');
        }

        if ($request->get('shoesstyle')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'shoes_style')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('shoes_style'), 'shoes_style',  $request->get('shoes_style_price'),  null  , $request->file('shoes_style_image'), 'no');
        }

        // Watches
        if ($request->get('bandcolor')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'band_color')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('band_color'), 'band_color',  $request->get('band_color_price'),  null  , $request->file('band_color_image'), 'no');
        }
        
        // Sports
        if ($request->get('golfloft')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'golf_loft')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('golf_loft'), 'golf_loft',  $request->get('golf_loft_price'),  null  , $request->file('golf_loft_image'), 'no');
        }

        if ($request->get('golfflexmaterial')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'golf_flexmaterial')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('golf_flexmaterial'), 'golf_flexmaterial',  $request->get('golf_flexmaterial_price'),  null  , $request->file('golf_flexmaterial_image'), 'no');
        }

        if ($request->get('golfflexshaftmaterial')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'golf_flexshaft_material')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('golf_flexshaft_material'), 'golf_flexshaft_material',  $request->get('golf_flexshaft_material_price'),  null  , $request->file('golf_flexshaft_material_image'), 'no');
        }

        if ($request->get('golfshaftmaterial')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'golf_shaft_material')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('golf_shaft_material'), 'golf_shaft_material',  $request->get('golf_shaft_material_price'),  null  , $request->file('golf_shaft_material_image'), 'no');
        }
        
        if ($request->get('gripsize')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'grip_size')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('grip_size'), 'grip_size',  $request->get('grip_size_price'),  null  , $request->file('grip_size_image'), 'no');
        }

        if ($request->get('griptype')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'grip_type')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('grip_type'), 'grip_type',  $request->get('grip_type_price'),  null  , $request->file('grip_type_image'), 'no');
        }

        if ($request->get('hand')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'sport_hand')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('sport_hand'), 'sport_hand',  $request->get('sport_hand_price'),  null  , $request->file('sport_hand_image'), 'no');
        }

        if ($request->get('handshaftlength')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'hand_shaftlength')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('hand_shaftlength'), 'hand_shaftlength',  $request->get('hand_shaftlength_price'),  null  , $request->file('hand_shaftlength_image'), 'no');
        }

        if ($request->get('shaftmaterialgolfflex')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'shaftmaterial_golfflex')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('shaftmaterial_golfflex'), 'shaftmaterial_golfflex',  $request->get('shaftmaterial_golfflex_price'),  null  , $request->file('shaftmaterial_golfflex_image'), 'no');
        }

        if ($request->get('shaftmaterialgolfflexgolfloft')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'shaftmaterial_golfflex')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('shaftmaterial_golfflex_golfloft'), 'shaftmaterial_golfflex_golfloft',  $request->get('shaftmaterial_golfflex_golfloft_price'),  null  , $request->file('shaftmaterial_golfflex_golfloft_image'), 'no');
        }

        if ($request->get('tensionlevel')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'tension_level')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('tension_level'), 'tension_level',  $request->get('tension_level_price'),  null  , $request->file('tension_level_image'), 'no');
        }

        if ($request->get('shaftmaterial')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'shaft_material')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('shaft_material'), 'shaft_material',  $request->get('shaft_material_price'),  null  , $request->file('shaft_material_image'), 'no');
        }

        if ($request->get('itemshape')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'item_shape')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('item_shape'), 'item_shape',  $request->get('item_shape_price'),  null  , $request->file('item_shape_image'), 'no');
        }

        if ($request->get('sizeweightsupported')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'size_weight_supported')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('size_weight_supported'), 'size_weight_supported',  $request->get('size_weight_supported_price'),  null  , $request->file('size_weight_supported_image'), 'no');
        }

        if ($request->get('stylename')) {
            if ($request->get('productId')) {
                $productSizes = ProductsAttributes::where('product_id', $product->id)->where('name', 'style_name')->get();
                if (count($productSizes) > 0) {
                    foreach ($productSizes as $productSize) {
                        $productSize->delete();
                    }
                }
            }
            $this->adminManageService->saveProductAttr($product, $request->get('style_name'), 'style_name',  $request->get('style_name_price'),  null  , $request->file('style_name_image'), 'no');
        }

        // Save All Other Attributes.......
        if ($request->get('product_attribute')) {
            if ($request->get('productId')) {
                $productAtts = ProductsAttributes::where('product_id', $product->id)
                ->where('name', '!=', 'color')
                ->where('name', '!=', 'size')
                ->where('name', '!=', 'size_color')
                ->where('name', '!=', 'scent')
                ->where('name', '!=', 'size_scent')
                ->where('name', '!=', 'paperback')
                ->where('name', '!=', 'hardcover')
                ->where('name', '!=', 'audiocd')
                ->where('name', '!=', 'pattern')
                ->where('name', '!=', 'cup_size')
                ->where('name', '!=', 'cup_size_color')
                ->where('name', '!=', 'color_lens_width')
                ->where('name', '!=', 'color_magnification_strength')
                ->where('name', '!=', 'lens_color')
                ->where('name', '!=', 'color_material')
                ->where('name', '!=', 'product_flavor')
                ->where('name', '!=', 'product_weight')
                ->where('name', '!=', 'flavor_size')
                ->where('name', '!=', 'flavor_weight')
                ->where('name', '!=', 'product_material')
                ->where('name', '!=', 'product_material_size')
                ->where('name', '!=', 'metaltype')
                ->where('name', '!=', 'sizeperpearl')
                ->where('name', '!=', 'color_metaltype')
                ->where('name', '!=', 'color_itemlength')
                ->where('name', '!=', 'gem_type')
                ->where('name', '!=', 'metaltype_gemtype')
                ->where('name', '!=', 'total_gemweight')
                ->where('name', '!=', 'total_diamondweight')
                ->where('name', '!=', 'metaltype_totaldiamondweight')
                ->where('name', '!=', 'itemlength_gemtype')
                ->where('name', '!=', 'itemlength_material')
                ->where('name', '!=', 'itemlength_sizeperpearl')
                ->where('name', '!=', 'itemlength_metaltype')
                ->where('name', '!=', 'itemlength_totaldiamondweight')
                ->where('name', '!=', 'item_length')
                ->where('name', '!=', 'ring_size')
                ->where('name', '!=', 'metaltype_ringsize')
                ->where('name', '!=', 'color_ringsize')
                ->where('name', '!=', 'ringsize_gemtype')
                ->where('name', '!=', 'ringsize_totaldiamondweight')
                ->where('name', '!=', 'number_of_items')
                ->where('name', '!=', 'paper_size')
                ->where('name', '!=', 'maximum_expandable_size')
                ->where('name', '!=', 'line_size')
                ->where('name', '!=', 'style_size')
                ->where('name', '!=', 'product_material_size')
                ->where('name', '!=', 'shoes_style')
                ->where('name', '!=', 'band_color')
                ->where('name', '!=', 'golf_loft')
                ->where('name', '!=', 'golf_flexmaterial')
                ->where('name', '!=', 'golf_flexshaft_material')
                ->where('name', '!=', 'golf_shaft_material')
                ->where('name', '!=', 'grip_size')
                ->where('name', '!=', 'grip_type')
                ->where('name', '!=', 'sport_hand')
                ->where('name', '!=', 'hand_shaftlength')
                ->where('name', '!=', 'shaftmaterial_golfflex')
                ->where('name', '!=', 'shaftmaterial_golfflex_golfloft')
                ->where('name', '!=', 'tension_level')
                ->where('name', '!=', 'shaft_material')
                ->where('name', '!=', 'item_shape')
                ->where('name', '!=', 'size_weight_supported')
                ->where('name', '!=', 'style_name')
                ->get();
                if (count($productAtts) > 0) {
                    foreach ($productAtts as $att) {
                        $att->delete();
                    }
                }
            }
            $this->adminManageService->saveproductAttributes($product, $request->get('product_attribute'));
        }

        if ($request->get('productId')) {
            Session::flash('success', 'Product updated successfully..!');
            return redirect()->back();
        } else if ($request->get('isNewProduct')) {
            Session::flash('success', 'Product added successfully..!');
             // return redirect()->back();
            
            return redirect(route('get:edit_products',$product->slug));
        }else
        {
            Session::flash('success', 'Product added successfully..!');
            return redirect()->back();
        }
        // return redirect()->back();
    }

    public function getManageProducts($type)
    {
        // if (Auth::user()->hasRole('admin')) {
        //     $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.model', 'products.price', 'products.quantity', 'products.status', 'products.slug', 'products.new_arrival', 'products.special', 'products.recommend', 'users.username')
        //         ->join('users', 'users.id', '=', 'products.user_id')
        //         ->orderBy('products.created_at', 'ASC')
        //         ->get();
        // } else {
        //     $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.model', 'products.price', 'products.quantity', 'products.status', 'products.slug', 'products.new_arrival', 'products.special', 'products.recommend', 'users.username')
        //         ->join('users', 'users.id', '=', 'products.user_id')
        //         ->where('products.user_id', Auth::user()->id)
        //         ->orderBy('products.created_at', 'ASC')
        //         ->get();
        // }
        // return view('admin.pages.product.manage_products', compact('products'));

        if($type == 'all')
        {
            if (Auth::user()->hasRole('admin')) {
                $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.model', 'products.price', 'products.quantity', 'products.status', 'products.slug', 'products.new_arrival', 'products.special', 'products.recommend', 'users.username')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->orderBy('products.created_at', 'DESC')
                    ->get();
            } else {
                $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.model', 'products.price', 'products.quantity', 'products.status', 'products.slug', 'products.new_arrival', 'products.special', 'products.recommend', 'users.username')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->where('products.user_id', Auth::user()->id)
                    ->orderBy('products.created_at', 'DESC')
                    ->get();
            }
            $type = 'all';
            return view('admin.pages.product.manage_products', compact('products','type'));
        }
        elseif ($type == 'active') {
            if (Auth::user()->hasRole('admin')) {
                $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.model', 'products.price', 'products.quantity', 'products.status', 'products.slug', 'products.new_arrival', 'products.special', 'products.recommend', 'users.username')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->where('products.status', 1)
                    ->orderBy('products.created_at', 'DESC')
                    ->get();
            } else {
                $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.model', 'products.price', 'products.quantity', 'products.status', 'products.slug', 'products.new_arrival', 'products.special', 'products.recommend', 'users.username')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->where('products.user_id', Auth::user()->id)
                     ->where('products.status', 1)
                    ->orderBy('products.created_at', 'DESC')
                    ->get();
            }
            $type = 'active';
            return view('admin.pages.product.manage_products', compact('products','type'));
        }
        elseif ($type == 'deactive')
        {
            if (Auth::user()->hasRole('admin')) {
                $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.model', 'products.price', 'products.quantity', 'products.status', 'products.slug', 'products.new_arrival', 'products.special', 'products.recommend', 'users.username')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->where('products.status', 0)
                    ->orderBy('products.created_at', 'DESC')
                    ->get();
            } else {
                $products = Products::select('products.id', 'products.name', 'products.product_img', 'products.model', 'products.price', 'products.quantity', 'products.status', 'products.slug', 'products.new_arrival', 'products.special', 'products.recommend', 'users.username')
                    ->join('users', 'users.id', '=', 'products.user_id')
                    ->where('products.user_id', Auth::user()->id)
                     ->where('products.status', 0)
                    ->orderBy('products.created_at', 'DESC')
                    ->get();
            }
            $type = 'deactive';
            return view('admin.pages.product.manage_products', compact('products','type'));
        }
        

    }

    public function getApproveProducts(Request $request)
    {
        $product = Products::where('slug', $request->get('slug'))->limit(1)->first();
        if (!$product) {
            return response()->json([
                'error' => true,
                'message' => 'Product not found..!'
            ]);
        }
        if ($product->status == 1) {
            $product->status = 0;
        } else {
            $product->status = 1;
        }
        $product->save();
        Session::flash('success', 'Product updated successfully..!');
        return response()->json([
            'success' => true,
        ]);
    }

    public function getManageSeller()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'seller');
        })->get();

        return view('admin.pages.seller.manage_seller', compact('users'));
    }

    public function getManageSellerHolidays()
    {
        return view('admin.pages.sellerholiday.seller_holidays');
    }

    public function getSellerHolidays()
    {
        $calendatdata = SellerHoliday::select('remarks as title','holiday_dates as start')->where('user_id',Auth::user()->id)->get();
        return response()->json(['result' => $calendatdata]);
    }

    public function postManageSellerHoliday(Request $request)
    {
        $hdate = \Carbon\Carbon::parse($request->holiday_date)->format('Y,m,d');
        $holiday = new SellerHoliday();
        $holiday->user_id = Auth::user()->id;
        $holiday->remarks = isset($request->remark) ? $request->remark : '';
        $holiday->holiday_dates =  $hdate;
        $holiday->save();

        $calendatdata = SellerHoliday::select('*')->where('user_id',Auth::user()->id)->get();
        Session::flash('success', 'Holiday added...!');
        return redirect()->back();
    }
    
    public function getSellerApprove(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found..!'
            ]);
        }
        if ($user->status == 0) {
            $user->status = 1;
            Session::flash('success', 'User approved successfully..!');
            $user->save();

            $data = array('username' => $request->get('username'), 'email' => $request->get('email'), 'link' => route('login'));
            $this->mailService->sendSellerApproveMail($data, $user);

            return response()->json([
                'success' => true,
            ]);
        } else {
            $user->status = 0;
            Session::flash('success', 'User disapproved successfully..!');
            $user->save();

            $data = array('username' => $request->get('username'), 'email' => $request->get('email'));
            $this->mailService->sendSellerDisApproveMail($data, $user);

            return response()->json([
                'success' => true,
            ]);
        }
    }

    public function getDeleteSeller(Request $request)
    {
        $user = User::where('id', $request->get('userId'))->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }
        if ($user->hasRole('seller')) {
            $data = array('username' => $user->username, 'email' => $user->email);
            $this->mailService->sendSellerRemoveMail($data, $user);
            $user->delete();
        }
        Session::flash('success', 'Seller Deleted Successfully!');
        return response()->json([
            'success' => true,
        ]);
    }

    public function getEditProducts($slug)
    {
       
        $product = Products::where('slug', $slug)->limit(1)->first();
        if (!$product) {
            Session::flash('error', 'Product not found');
            return redirect()->back();
        }
        $currencies = Currencies::select('id', 'name')->get();
       
        $taxClasses = TaxClass::select('id', 'name')->get();
        // $subcategories = SubCategory::select('id', 'name')->get();
        $productColors = ProductsAttributes::select('product_attributes.id', 'desc','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'color')->get();

        $productSizeColors = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'size_color')->get();

        $productSize = ProductsAttributes::select('id', 'desc')->where('product_id', $product->id)->where('name', 'size')->get();

        //ishwar
        //$subcat = Subcategory::where("id", $product->sub_category_id)->first();
        $subcategory_id = Subcategory2::select('subcategory_id')->where('id',$product->sub_category_id)->first();
        $subcategory2 = SubCategory2::select('id', 'name')->where('subcategory_id',$subcategory_id->subcategory_id)->get();

        $subcategory = SubCategory::select('category_id')->where('id',$subcategory_id->subcategory_id)->first();
        $brands = Brands::select('id', 'name')->where('category_id',$subcategory->category_id)->get();

        // Other all attributes will be retured
        $productsAttributes = ProductsAttributes::select('*')->where('product_id', $product->id)
        ->where('name', '!=', 'color')
        ->where('name', '!=', 'size')
        ->where('name', '!=', 'size_color')
        ->where('name', '!=', 'scent')
        ->where('name', '!=', 'size_scent')
        ->where('name', '!=', 'paperback')
        ->where('name', '!=', 'hardcover')
        ->where('name', '!=', 'audiocd')
        ->where('name', '!=', 'pattern')
        ->where('name', '!=', 'cup_size')
        ->where('name', '!=', 'cup_size_color')
        ->where('name', '!=', 'color_lens_width')
        ->where('name', '!=', 'color_magnification_strength')
        ->where('name', '!=', 'lens_color')
        ->where('name', '!=', 'color_material')
        ->where('name', '!=', 'product_flavor')
        ->where('name', '!=', 'product_weight')
        ->where('name', '!=', 'flavor_size')
        ->where('name', '!=', 'flavor_weight')
        ->where('name', '!=', 'product_material')
        ->where('name', '!=', 'product_material_size')
        ->where('name', '!=', 'metaltype')
        ->where('name', '!=', 'sizeperpearl')
        ->where('name', '!=', 'color_metaltype')
        ->where('name', '!=', 'color_itemlength')
        ->where('name', '!=', 'gem_type')
        ->where('name', '!=', 'metaltype_gemtype')
        ->where('name', '!=', 'total_gemweight')
        ->where('name', '!=', 'total_diamondweight')
        ->where('name', '!=', 'metaltype_totaldiamondweight')
        ->where('name', '!=', 'itemlength_gemtype')
        ->where('name', '!=', 'itemlength_material')
        ->where('name', '!=', 'itemlength_sizeperpearl')
        ->where('name', '!=', 'itemlength_metaltype')
        ->where('name', '!=', 'itemlength_totaldiamondweight')
        ->where('name', '!=', 'item_length')
        ->where('name', '!=', 'ring_size')
        ->where('name', '!=', 'metaltype_ringsize')
        ->where('name', '!=', 'color_ringsize')
        ->where('name', '!=', 'ringsize_gemtype')
        ->where('name', '!=', 'ringsize_totaldiamondweight')
        ->where('name', '!=', 'number_of_items')
        ->where('name', '!=', 'paper_size')
        ->where('name', '!=', 'maximum_expandable_size')
        ->where('name', '!=', 'line_size')
        ->where('name', '!=', 'style_size')
        ->where('name', '!=', 'product_material_size')
        ->where('name', '!=', 'shoes_style')
        ->where('name', '!=', 'band_color')
        ->where('name', '!=', 'golf_loft')
        ->where('name', '!=', 'golf_flexmaterial')
        ->where('name', '!=', 'golf_flexshaft_material')
        ->where('name', '!=', 'golf_shaft_material')
        ->where('name', '!=', 'grip_size')
        ->where('name', '!=', 'grip_type')
        ->where('name', '!=', 'sport_hand')
        ->where('name', '!=', 'hand_shaftlength')
        ->where('name', '!=', 'shaftmaterial_golfflex')
        ->where('name', '!=', 'shaftmaterial_golfflex_golfloft')
        ->where('name', '!=', 'tension_level')
        ->where('name', '!=', 'shaft_material')
        ->where('name', '!=', 'item_shape')
        ->where('name', '!=', 'size_weight_supported')
        ->where('name', '!=', 'style_name')
        ->get();

        // Product Category Parameters display
        $productScent = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'scent')->get();

        $productScentSize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'size_scent')->get();

        $productPaperback = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'paperback')->get();

        $productHardcover = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'hardcover')->get();

        $productAudioCD = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'audiocd')->get();

        $productPattern = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'pattern')->get();
        
        $productCupSize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'cup_size')->get();

        $productCupSizeColor = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'cup_size_color')->get();

        $productColorLensWidth = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'color_lens_width')->get();

        $productColorMagnificationStrength = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'color_magnification_strength')->get();

        $productLensColor = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'lens_color')->get();

        $productColorMaterial = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'color_material')->get();

        $productFlavor = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'product_flavor')->get();

        $productWeight = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'product_weight')->get();

        $productFlavorSize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'flavor_size')->get();

        $productFlavorWeight = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'flavor_weight')->get();

        $productMaterial = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'product_material')->get();

        $productMaterialSize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'product_material_size')->get();

        // Jwellery
        $productMetalType = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'metaltype')->get();

        $productSizePerPearl = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'sizeperpearl')->get();

        $productColorMetalType = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'color_metaltype')->get();

        $productColorItemLength = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'color_itemlength')->get();

        $productGemType = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'gem_type')->get();

        $productMetalTypeGemType = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'metaltype_gemtype')->get();
        
        $productTotalGemWeight = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'total_gemweight')->get();

        $productTotalDiamondWeight = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'total_diamondweight')->get();

        $productMetalTypeTotalDiamondWeight = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'metaltype_totaldiamondweight')->get();

        $productItemLengthGemType = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'itemlength_gemtype')->get();

        $productItemLengthMaterial = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'itemlength_material')->get();

        $productItemLengthSizePerPearl = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'itemlength_sizeperpearl')->get();

        $productItemLengthMetalType = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'itemlength_metaltype')->get();

        $productItemLengthTotalDiamondWeight = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'itemlength_totaldiamondweight')->get();

        $productItemLength = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'item_length')->get();

        $productRingSize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'ring_size')->get();

        $productMetalTypeRingSize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'metaltype_ringsize')->get();

        $productColorRingSize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'color_ringsize')->get();

        $productRingSizeGemType = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'ringsize_gemtype')->get();

        $productRingSizeTotalDiamondWeight = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'ringsize_totaldiamondweight')->get();

        $productNumberOfItems = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'number_of_items')->get();

        $productPapersize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'paper_size')->get();

        $productMaximumExpandableSize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'maximum_expandable_size')->get();

        $productLinesize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'line_size')->get();

        $productStyleSize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'style_size')->get();

        $productShoesStyle = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'shoes_style')->get();

        $productBandcolor = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'band_color')->get();
        
        // Sports.
        $productGolfloft = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'golf_loft')->get();

        $productGolfFlexMaterial = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'golf_flexmaterial')->get();

        $productGolfflexShaftMaterial = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'golf_flexshaft_material')->get();
        
        $productGolfShaftMaterial = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'golf_shaft_material')->get();

        $productGripsize = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'grip_size')->get();

        $productGriptype = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'grip_type')->get();

        $productSportHand = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'sport_hand')->get();

        $productHandShaftLength = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
        ->where('product_attributes.product_id', $product->id)->where('name', 'hand_shaftlength')->get();

        $productShaftmaterialGolfflex = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
                ->where('product_attributes.product_id', $product->id)->where('name', 'shaftmaterial_golfflex')->get();

        $productShaftmaterialGolfflexGolfloft = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
                ->where('product_attributes.product_id', $product->id)->where('name', 'shaftmaterial_golfflex_golfloft')->get();

        $productTensionlevel = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
                ->where('product_attributes.product_id', $product->id)->where('name', 'tension_level')->get();

        $productShaftMaterial = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
                ->where('product_attributes.product_id', $product->id)->where('name', 'shaft_material')->get();

        $productItemshape = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
                ->where('product_attributes.product_id', $product->id)->where('name', 'item_shape')->get();

        $productSizeWeightSupported = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
                ->where('product_attributes.product_id', $product->id)->where('name', 'size_weight_supported')->get();

        $productStylename = ProductsAttributes::select('product_attributes.id', 'desc','desc2','product_price','product_screenshots.screenshots','product_attributes.image_id')->leftjoin('product_screenshots','product_attributes.image_id','product_screenshots.id')
                ->where('product_attributes.product_id', $product->id)->where('name', 'style_name')->get();


        return view('admin.pages.product.add_products', compact('product', 'productColors', 'productSize', 'currencies', 'brands', 'taxClasses', 'categories', 'subcategories','subcategory2','productSizeColors','subcategory',   
            'productsAttributes', 'productScent', 'productScentSize', 'productPaperback', 'productHardcover', 'productAudioCD',
            'productPattern', 'productCupSize', 'productCupSizeColor', 'productColorLensWidth', 'productColorMagnificationStrength', 'productLensColor', 'productColorMaterial', 'productFlavor', 'productWeight' ,'productFlavorSize', 'productFlavorWeight','productMaterial', 'productMaterialSize', 
            'productMetalType', 'productSizePerPearl', 'productColorMetalType', 'productColorItemLength','productGemType' ,'productMetalTypeGemType','productTotalGemWeight','productTotalDiamondWeight', 'productMetalTypeTotalDiamondWeight', 'productItemLengthGemType', 'productItemLengthMaterial', 'productItemLengthSizePerPearl', 'productItemLengthMetalType', 'productItemLengthTotalDiamondWeight', 'productItemLength', 'productRingSize','productMetalTypeRingSize','productColorRingSize', 'productRingSizeGemType', 'productRingSizeTotalDiamondWeight' ,'productNumberOfItems', 'productPapersize', 'productMaximumExpandableSize' ,'productLinesize', 'productStyleSize', 'productShoesStyle','productBandcolor', 
            
        'productGolfloft', 'productGolfFlexMaterial', 'productGolfflexShaftMaterial', 'productGolfShaftMaterial', 'productGripsize', 'productGriptype', 'productSportHand', 'productHandShaftLength', 'productShaftmaterialGolfflex','productShaftmaterialGolfflexGolfloft','productTensionlevel', 'productShaftMaterial', 'productItemshape' ,'productSizeWeightSupported', 'productStylename'));
    }

    public function getDeleteProducts(Request $request)
    {
        $product = Products::where('slug', $request->get('slug'))->limit(1)->first();
        $productScreenshots = ProductsScreenshots::where('product_id', $product->id)->limit(1)->get();
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }
        if (\File::exists(public_path('productimg/' . $product->product_img))) {
            \File::delete(public_path('productimg/' . $product->product_img));
        }
        if (\File::exists(public_path('/268ProductImg/' . $product->product_img))) {
            \File::delete(public_path('/268ProductImg/' . $product->product_img));
        }
        if (\File::exists(public_path('/300ProdctImg/' . $product->product_img))) {
            \File::delete(public_path('/300ProdctImg/' . $product->product_img));
        }
        if (\File::exists(public_path('/420ProductImg/' . $product->product_img))) {
            \File::delete(public_path('/420ProductImg/' . $product->product_img));
        }
        if (\File::exists(public_path('/850ProductImg/' . $product->product_img))) {
            \File::delete(public_path('/850ProductImg/' . $product->product_img));
        }
        if (\File::exists(public_path('/100ProductImg/' . $product->product_img))) {
            \File::delete(public_path('/100ProductImg/' . $product->product_img));
        }

        foreach ($productScreenshots as $productScreenshot) {
            if (\File::exists(public_path() . '/productScreenshots/' . $productScreenshot->screenshots)) {
                \File::delete(public_path() . '/productScreenshots/' . $productScreenshot->screenshots);
            }
            if (\File::exists(public_path() . '/100ProductImg/' . $productScreenshot->screenshots)) {
                \File::delete(public_path() . '/100ProductImg/' . $productScreenshot->screenshots);
            }
            if (\File::exists(public_path() . '/420ProductImg/' . $productScreenshot->screenshots)) {
                \File::delete(public_path() . '/420ProductImg/' . $productScreenshot->screenshots);
            }
            if (\File::exists(public_path() . '/850ProductImg/' . $productScreenshot->screenshots)) {
                \File::delete(public_path() . '/850ProductImg/' . $productScreenshot->screenshots);
            }
        }
        $product->delete();
        Session::flash('success', 'Product deleted successfully..!');
        return response()->json([
            'success' => true,
            'message' => 'Product Deleted Successfully'
        ]);
    }

    public function getDeleteProductsScreenshots(Request $request)
    {
        $screenshots = ProductsScreenshots::find($request->get('screenId'));
        if (!$screenshots) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found..!'
            ]);
        }
        if (\File::exists(asset('productScreenshots/', $screenshots->screenshots))) {
            \File::delete(asset('productScreenshots/', $screenshots->screenshots));
        }
        if (\File::exists(public_path() . '/100ProductImg/' . $screenshots->screenshots)) {
            \File::delete(public_path() . '/100ProductImg/' . $screenshots->screenshots);
        }
        if (\File::exists(public_path() . '/420ProductImg/' . $screenshots->screenshots)) {
            \File::delete(public_path() . '/420ProductImg/' . $screenshots->screenshots);
        }
        if (\File::exists(public_path() . '/850ProductImg/' . $screenshots->screenshots)) {
            \File::delete(public_path() . '/850ProductImg/' . $screenshots->screenshots);
        }
        $screenshots->delete();
        Session::flash('success', 'File delete successfully..!');
        return response()->json([
            'success' => true,
            'message' => 'File delete successfully..!'
        ]);
    }

    public function getProductColor()
    {
        return view('front.pages.include.product_color');
    }

    public function getProductSize()
    {
        return view('front.pages.include.product_size');
    }

    public function getProductSizeColor()
    {
        return view('front.pages.include.product_size_color');
    }

    public function getProductScent()
    {
        return view('front.pages.include.scent');
    }

    public function getProductSizeScent()
    {
        return view('front.pages.include.size_scent');
    }

    public function getProductPaperback()
    {
        return view('front.pages.include.product_paperback');
    }

    public function getProductHardcover()
    {
        return view('front.pages.include.product_hardcover');
    }

    public function getProductAudioCD()
    {
        return view('front.pages.include.product_audiocd');
    }
    
    public function getProductPattern()
    {
        return view('front.pages.include.product_pattern');
    }

    public function getProductCupSize()
    {
        return view('front.pages.include.product_cup_size');
    }

    public function getProductCupSizeColor()
    {
        return view('front.pages.include.product_cup_size_color');
    }

    public function getProductColorLensWidth()
    {
        return view('front.pages.include.product_color_lens_width');
    }

    public function getProductColorMagnificationStrength()
    {
        return view('front.pages.include.product_color_magnification_strength');
    }

    public function getProductLensColor()
    {
        return view('front.pages.include.product_lens_color');
    }

// -- 13-08-2018
    public function getProductColorMaterial()
    {
        return view('front.pages.include.product_color_material');
    }

// ---
    public function getProductFlavor()
    {
        return view('front.pages.include.product_flavor');
    }

    public function getProductWeight()
    {
        return view('front.pages.include.product_weight');
    }

    public function getProductFlavorSize()
    {
        return view('front.pages.include.product_flavor_size');
    }

    public function getProductFlavorWeight()
    {
        return view('front.pages.include.product_flavor_weight');
    }

    public function getProductMaterial()
    {
        return view('front.pages.include.product_material');
    }

    public function getProductMaterialSize()
    {
        return view('front.pages.include.product_material_size');
    }

    // Jwellery
    public function getProductMetalType()
    {
        return view('front.pages.include.product_metaltype');
    }

    public function getProductSizePerPearl()
    {
        return view('front.pages.include.product_sizeperpearl');
    }

    public function getColorMetalType()
    {
        return view('front.pages.include.product_color_metaltype');
    }

    public function getColorItemLength()
    {
        return view('front.pages.include.product_color_itemlength');
    }

    public function getGemType()
    {
        return view('front.pages.include.product_gemtype');
    }

    public function getMetalGemType()
    {
        return view('front.pages.include.product_metalgemtype');
    }

    public function getTotalGemWeight()
    {
        return view('front.pages.include.product_totalgemweight');
    }

    public function getTotalDiamondWeight()
    {
        return view('front.pages.include.product_totaldiamondweight');
    }

    public function getMetalTypeTotalDiamondWeight()
    {
        return view('front.pages.include.product_metaltype_totaldiamondweight');
    }

    public function getItemLengthGemtype()
    {
        return view('front.pages.include.product_itemlength_gemtype');
    }

    public function getItemLengthMaterial()
    {
        return view('front.pages.include.product_itemlength_material');
    }

    public function getItemLengthSizePerPearl()
    {
        return view('front.pages.include.product_itemlength_sizeperpearl');
    }

    public function getItemLengthMetalType()
    {
        return view('front.pages.include.product_itemlength_metaltype');
    }

    public function getItemLengthTotalDiamondWeight()
    {
        return view('front.pages.include.product_itemlength_totaldiamondweight');
    }

    public function getItemLength()
    {
        return view('front.pages.include.product_itemlength');
    }

    public function getRingSize()
    {
        return view('front.pages.include.product_ringsize');
    }

    public function getMetalTypeRingSize()
    {
        return view('front.pages.include.product_metaltype_ringsize');
    }

    public function getColorRingSize()
    {
        return view('front.pages.include.product_color_ringsize');
    }
    
    public function getRingSizeGemType()
    {
        return view('front.pages.include.product_ringsize_gemtype');
    }

    public function getRingSizeTotalDiamondWeight()
    {
        return view('front.pages.include.product_ringsize_totaldiamondweight');
    }
    // Jwellery

    // Office
    public function getNumberOfItems()
    {
        return view('front.pages.include.product_numberofitems');
    }
    public function getPaperSize()
    {
        return view('front.pages.include.product_papersize');
    }
    public function getMaximumExpandableSize()
    {
        return view('front.pages.include.product_maximum_expandablesize');
    }
    public function getLineSize()
    {
        return view('front.pages.include.product_linesize');
    }
    // Office

    // Shoes & Hand Bags
    public function getStyleSize()
    {
        return view('front.pages.include.product_stylesize');
    }

    public function getShoesStyle()
    {
        return view('front.pages.include.product_shoesstyle');
    }

    // Watches
    public function getBandColor()
    {
        return view('front.pages.include.product_bandcolor');
    }
    // Sports
    public function getGolfLoft()
    {
        return view('front.pages.include.product_golfloft');
    }

    public function getGolfFlexMaterial()
    {
        return view('front.pages.include.product_golf_flex_material');
    }

    public function getGolfFlexShaftMaterial()
    {
        return view('front.pages.include.product_golf_flexshaft_material');
    }

    public function getGolfShaftMaterial()
    {
        return view('front.pages.include.product_golf_shaft_material');
    }

    public function getGripSize()
    {
        return view('front.pages.include.product_gripsize');
    }

    public function getGripType()
    {
        return view('front.pages.include.product_griptype');
    }

    public function getHand()
    {
        return view('front.pages.include.product_hand');
    }

    public function getHandShaftLength()
    {
        return view('front.pages.include.product_hand_shaftlength');
    }

    public function getShaftMaterialGolfFlex()
    {
        return view('front.pages.include.product_shaftmaterial_golfflex');
    }

    public function getShaftMaterialGolfFlexGolfLoft()
    {
        return view('front.pages.include.product_shaftmaterial_golfflex_golfloft');
    }

    public function getTensionLevel()
    {
        return view('front.pages.include.product_tensionlevel');
    }

    public function getShaftMaterial()
    {
        return view('front.pages.include.product_shaftmaterial');
    }

    public function getItemShape()
    {
        return view('front.pages.include.product_itemshape');
    }

    public function getSizeWeightSupported()
    {
        return view('front.pages.include.product_size_weight_supported');
    }

    public function getStyleName()
    {
        return view('front.pages.include.product_stylename');
    }
    // Sports

    //ishwar 30/07/18
    public function getProducts(Request $request)
    {
        $products = Products::select('id','name')->where('name', 'like', $request->productname . '%')->get();
        return response()->json($products);
    }

    //ishwar 30/07/18
    public function getProductsFormdata(Request $request)
    {
        $products = Products::select('*')->where('name', $request->productname)->first();
        return response()->json($products);
    }

    public function getFormWithPdata($slug)
    {
        $newproduct = Products::select('*')->where('slug', $slug)->limit(1)->first();
        if (!$newproduct) {
            Session::flash('error', 'Product not found');
            return redirect()->back();
        }
        $currencies = Currencies::select('id', 'name')->get();
        $brands = Brands::select('id', 'name')->get();
        $taxClasses = TaxClass::select('id', 'name')->get();
        // $subcategories = SubCategory::select('id', 'name')->get();
        $productColors = ProductsAttributes::select('id', 'desc','product_price')->where('product_id', $newproduct->id)->where('name', 'color')->get();
        $productSize = ProductsAttributes::select('id', 'desc')->where('product_id', $newproduct->id)->where('name', 'size')->get();

        //ishwar
        $subcategory_id = Subcategory2::select('subcategory_id')->where('id',$newproduct->sub_category_id)->first();
        $subcategory2 = SubCategory2::select('id', 'name')->where('subcategory_id',$subcategory_id->subcategory_id)->get();

        $subcategory = SubCategory::select('category_id')->where('id',$subcategory_id->subcategory_id)->first();
       

        return view('admin.pages.product.add_products', compact('newproduct', 'productColors', 'productSize', 'currencies', 'brands', 'taxClasses', 'categories', 'subcategory2','subcategory'));
    }


    

    public function getManageOrder()
    {
        if (Auth::user()->hasRole('admin')) {
            $orders = Order::select('order.id', 'order.transaction_id', 'order.color', 'order.size', 'order.created_at', 'order.status', 'order.price', 'order.shipping', 'products.name', 'products.slug', 'products.product_img', 'users.username')
                ->join('products', 'products.id', 'order.product_id')
                ->join('users', 'users.id', 'order.user_id')
                ->orderBY('order.id', 'DESC')
                ->get();
        } else {
            $orders = Order::select('order.id', 'order.transaction_id', 'order.color', 'order.size', 'order.created_at', 'order.status', 'order.shipping', 'order.price', 'products.name', 'products.slug', 'products.product_img', 'users.username')
                ->join('products', 'products.id', 'order.product_id')
                ->join('users', 'users.id', 'order.user_id')
                ->where('products.user_id', Auth::user()->id)
                ->orderBY('order.id', 'DESC')
                ->get();
        }
        return view('admin.pages.order.manage_order', compact('orders'));
    }

    public function postOrderShippingProcess(Request $request)
    {
        $order = Order::where('transaction_id', $request->get('transId'))->limit(1)->first();
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found..!'
            ]);
        }

        // 1.dispute, 2.ontheway, 3.nearbyyou, 4.delivered
        if ($order->shipping == $request->get('status')) {
            return \response()->json([
                'success' => false,
                'message' => 'Order already in ' . $request->get('status') . ' process..!'
            ]);
        }

        // myupdate start
        $data = ShippingHistory::select('status')->where('order_id', $order->id)->get()->toArray();

        $statusarr = array();
        foreach ($data as $value) {
            $statusarr[] = $value['status'];
        }

        if (in_array($request->get('status'), $statusarr))
        {
            return \response()->json([
                'success' => false,
                'message' => 'Order already in ' . $order->shipping . ' process..!'
            ]);
        }
        // myupdate over

        $order->shipping = $request->get('status');
        $order->delivery_date = Carbon::parse($request->get('delivery_date'))->format('Y-m-d H:i:s');
        $order->save();

        //check status is delivered and it's cod if true then make product price+cod in user wallet
        if($order->shipping=='delivered' && $order->payment_type=='cod')
        {
            $productsprice = $order->price+$order->shipping_charge;
            $SelleUserid = Products::select('user_id')->where('id', $order->product_id)->first();

            $userbalance = User::select('wallet_amount')->where('id',$SelleUserid->user_id)->first();

            $updatedBalance = $userbalance->wallet_amount + $productsprice;

            User::where('id', $SelleUserid->user_id)->update(['wallet_amount' => $updatedBalance]);
    
        }

        if (ShippingHistory::where('order_id', $order->id)->where('status', $request->get('status'))->limit(1)->first()) {
            $shippingHistory = ShippingHistory::where('order_id', $order->id)->where('status', $request->get('status'))->limit(1)->first();
        } else {
            $shippingHistory = new ShippingHistory();
        }
        $shippingHistory->order_id = $order->id;
        $shippingHistory->status = $request->get('status');
        $shippingHistory->delivery_date = Carbon::parse($request->get('delivery_date'))->format('Y-m-d H:i:s');
        $shippingHistory->remark = $request->get('remark');
        $shippingHistory->save();

        $user = User::find($order->user_id);
        $product = Products::find($order->product_id);
        $data = array('username' => $user->username, 'product' => $product->name, 'shipping' => $order->shipping, 'delivery_date' => Carbon::parse($order->delivery_date)->format('d-m-Y'), 'remark' => $request->get('remark'));
        $this->mailService->sendOrderShippingMail($data, $user);

        Session::flash('message', 'Order Updated successfully..!');
        return response()->json([
            'success' => true
        ]);
    }

    public function getManageCancelOrder()
    {
        if (Auth::user()->hasRole('admin')) {
            $orders = Order::select('order.id', 'order.transaction_id', 'order.reason', 'order.comments', 'order.cancel_approve', 'order.color', 'order.size', 'order.created_at', 'order.status', 'order.shipping', 'order.price', 'products.name', 'products.slug', 'products.product_img', 'users.username')
                ->join('products', 'products.id', 'order.product_id')
                ->join('users', 'users.id', 'order.user_id')
                ->where('products.user_id', Auth::user()->id)
                ->where('order.status', Order::CANCELED)
                ->orderBY('order.id', 'DESC')
                ->get();
        } else {
            $orders = Order::select('order.id', 'order.transaction_id', 'order.reason', 'order.comments', 'order.cancel_approve', 'order.color', 'order.size', 'order.created_at', 'order.status', 'order.shipping', 'order.price', 'products.name', 'products.slug', 'products.product_img', 'users.username')
                ->join('products', 'products.id', 'order.product_id')
                ->join('users', 'users.id', 'order.user_id')
                ->where('products.user_id', Auth::user()->id)
                ->where('order.status', Order::CANCELED)
                ->orderBY('order.id', 'DESC')
                ->get();
        }
        return view('admin.pages.order.cancel_orders', compact('orders'));
    }

    public function getManageReturnOrder()
    {
        if (Auth::user()->hasRole('admin')) {
            $orders = Order::select('order.id', 'order.transaction_id', 'order.reason', 'order.comments', 'order.cancel_approve', 'order.return_approve', 'order.delivered_seller',  'order.color', 'order.size', 'order.created_at', 'order.status', 'order.shipping', 'order.price', 'products.name', 'products.slug', 'products.product_img', 'users.username')
                ->join('products', 'products.id', 'order.product_id')
                ->join('users', 'users.id', 'order.user_id')
                ->where('products.user_id', Auth::user()->id)
                ->where('order.status', Order::RETURNED)
                ->orderBY('order.id', 'DESC')
                ->get();
        } else {
            $orders = Order::select('order.id', 'order.transaction_id', 'order.reason', 'order.comments', 'order.cancel_approve', 'order.return_approve', 'order.delivered_seller','order.color', 'order.size', 'order.created_at', 'order.status', 'order.shipping', 'order.price', 'products.name', 'products.slug', 'products.product_img', 'users.username')
                ->join('products', 'products.id', 'order.product_id')
                ->join('users', 'users.id', 'order.user_id')
                ->where('products.user_id', Auth::user()->id)
                ->where('order.status', Order::RETURNED)
                ->orderBY('order.id', 'DESC')
                ->get();
        }
        return view('admin.pages.order.return_orders', compact('orders'));
    }

    public function getOrderCancelApprove(Request $request)
    {
        $order = Order::where('transaction_id', $request->get('transId'))->limit(1)->first();
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found..!'
            ]);
        }
        if($order->cancel_approve != 1){
            $order->cancel_approve = 1;
        }else{
            $order->cancel_approve = 0;
        }
        $order->save();

        return response()->json([
           'success' => true,
           'message' => 'Order cancellation approved successfully'
        ]);
    }

     public function getOrderReturnApprove(Request $request)
    {
        $order = Order::where('transaction_id', $request->get('transId'))->limit(1)->first();
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found..!'
            ]);
        }
        if($order->return_approve != 1)
        {
            $order->return_approve = 1;
        }
        else
        {
            $order->delivered_seller = 1;
        }
        $order->save();

        return response()->json([ 'success' => true, 'message' => 'Order return approved successfully' ]);
    }

    public function postOrderStatus(Request $request)
    {
        // Ishwar
        $check = Order::select('status')->where('id',$request->orderId)->first();
        if($check->status==Order::SUCCESS || $check->status==Order::FAILED || $check->status==Order::CANCELED || $check->status==Order::RETURNED)
        {    
            Session::flash('success', 'You can not change status...!');
            return redirect()->back();
        }
        else
        {
            $order = Order::find($request->get('orderId'));
            if (!$order) {
                Session::flash('error', 'Order not found');
                return redirect()->back();
            }
            $this->adminManageService->saveOrderStatus($order, $request);
            //$user = User::find($order->user_id);
            //$data = array('username' => $user->username, 'product' => $order);
            //$this->mailService->sendOrderUpdateMail($data, $user);
            Session::flash('success', 'Order updated successfully..!');
            return redirect()->back();
        }
    }

    public function getProductInvoice($slug)
    {
        $order = Products::where('slug', $slug)->first();
        if (!$order) {
            Session::flash('error', 'Order not found');
            return redirect()->back();
        }
        $productOrder = Products::select('products.id', 'products.name', 'users.username', 'products.desc', 'products.product_img', 'order.price', 'order.address', 'order.quantity', 'order.created_at', 'order.transaction_id', 'order.status')
            ->join('order', 'order.product_id', 'products.id')
            ->join('users', 'users.id', 'order.user_id')
            ->where('products.id', $order->id)->first();
        return view('front.pages.invoice.product_invoice', compact('productOrder'));

//        return view('admin.pages.invoice.invoice', compact('product'));
    }

    public function getAddBulkProducts()
    {
        return view('admin.pages.product.add_bulk_product');
    }

    public function postAddBulkProducts(Request $request)
    {
        if ($request->hasFile('import_products')) {
            $path = $request->file('import_products')->getRealPath();

            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'user_id' => Auth::user()->id,
                        'name' => $value->name,
                        'desc' => $value->desc,
                        'm_title' => $value->m_title,
                        'm_desc' => $value->m_desc,
                        'm_keywords' => $value->m_keywords,
                        'm_tag' => $value->m_tag,
                        'model' => $value->model,
                        'sku' => $value->sku,
                        'hsn' => $value->hsn,
                        'isbn' => $value->isbn,
                        'price' => $value->price,
                        'quantity' => $value->quantity,
                        'reward_points' => $value->reward_points,
                        'video_thumb' => $value->video_thumb,
                        'video_id' => $value->video_id,
                        'url' => $value->url,
                        'tax_class_id' => $value->tax_class_id,
                        'brand_id' => $value->brand_id,
                        'sub_category_id' => $value->sub_category_id,
                        'status' => 0,
                        'order' => $value->order,
                        'slug' => $this->adminManageService->getSlug($value->name),
                        'recommend' => $value->recommend,
                        'special' => $value->special,
                        'new_arrival' => $value->new_arrival,
                    ];
                }
                if (!empty($insert)) {
                    DB::table('products')->insert($insert);
                    Session::flash('success', 'Products added successfully');
                    return redirect()->back();
                }
            }
        }
    }


    public
    function getTopMenuCategory()
    {
        $category = Categories::select('id', 'name', 'slug', 'top_menu')->get();
        return view('admin.pages.category.menu_category', compact('category'));
    }

    public
    function postTopMenuCategory(Request $request)
    {
        if ($request->get('category')) {
            $categories = Categories::all();
            foreach ($categories as $cat) {
                $cat->top_menu = 0;
                $cat->save();
            }
            foreach ($request->get('category') as $item) {
                $category = Categories::where('slug', $item)->first();
                if ($category) {
                    $category->top_menu = 1;
                    $category->save();
                }
            }
            Session::flash('success', 'Category added in top menu..!');
            return redirect()->back();

        }
    }

    public
    function getImportProducts()
    {
        return view('admin.pages.product.import_produts');
    }

    public function getSellerCommissionReport()
    {
        $commissions = Order::select('users.id', 'users.username', 'order.created_at', 'order.unique_order_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->distinct()
            ->paginate(10);

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'seller');
        })->get();

        return view('admin.pages.report.seller_commission_report', compact('commissions', 'users'));
    }

    public function getCommissionFilterOrder(Request $request)
    {
        if ($request->get('daterange')) {
            $startDate = explode('-', $request->get('daterange'))[0];
            $endDate = explode('-', $request->get('daterange'))[1];

            $commissions = Order::select('users.username', 'order.created_at', 'order.unique_order_id')
                ->join('products', 'products.id', '=', 'order.product_id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                ->join('users', 'users.id', '=', 'products.user_id')
                ->whereBetween('order.created_at', [Carbon::parse($startDate)->format('Y-m-d H:i:s'), Carbon::parse($endDate)->format('Y-m-d H:i:s')])
                ->distinct()
                ->get();
        } else {
            $user = User::find($request->get('seller'));
            if (!$user) {
                return response()->json([
                    'error' => true,
                    'message' => 'Seller not found..!'
                ]);
            }
            $commissions = Order::select('users.username', 'order.created_at', 'order.unique_order_id')
                ->join('products', 'products.id', '=', 'order.product_id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                ->join('users', 'users.id', '=', 'products.user_id')
                ->where('users.id', $user->id)
                ->distinct()
                ->get();
        }
        return view('admin.pages.report.include.filter_seller_commissin', compact('commissions'));
    }

    public function getSubcategoryCommission()
    {
        $commissions = Order::select('subcategories.name as subcategory', 'users.id', 'products.name', 'order.price', 'order.created_at', 'order.transaction_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->distinct()
            ->paginate(10);
        $products = Products::select('id', 'name')->get();
        $subcategories = SubCategory::select('id', 'name')->get();
        return view('admin.pages.report.subcategory_commission', compact('commissions', 'subcategories', 'products'));
    }

    public function getSubcategoryCommissionFilter(Request $request)
    {
        if ($request->get('daterange')) {
            $startDate = explode('-', $request->get('daterange'))[0];
            $endDate = explode('-', $request->get('daterange'))[1];

            $commissions = Order::select('subcategories.name as subcategory', 'users.id', 'products.name', 'order.price', 'order.created_at', 'order.transaction_id')
                ->join('products', 'products.id', '=', 'order.product_id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                ->join('users', 'users.id', '=', 'products.user_id')
                ->whereBetween('order.created_at', [Carbon::parse($startDate)->format('Y-m-d H:i:s'), Carbon::parse($endDate)->format('Y-m-d H:i:s')])
                ->distinct()
                ->get();
        } elseif ($request->get('subcategory')) {
            $subcategory = SubCategory::find($request->get('subcategory'));
            if (!$subcategory) {
                return response()->json([
                    'error' => true,
                    'message' => 'Subcategory not found..!'
                ]);
            }
            $commissions = Order::select('subcategories.name as subcategory', 'users.id', 'products.name', 'order.price', 'order.created_at', 'order.transaction_id')
                ->join('products', 'products.id', '=', 'order.product_id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                ->join('users', 'users.id', '=', 'products.user_id')
                ->where('subcategories.id', $subcategory->id)
                ->distinct()
                ->get();
        } else {
            $product = Products::find($request->get('product'));
            if (!$product) {
                return response()->json([
                    'error' => true,
                    'message' => 'Subcategory not found..!'
                ]);
            }
            $commissions = Order::select('subcategories.name as subcategory', 'users.id', 'products.name', 'order.price', 'order.created_at', 'order.transaction_id')
                ->join('products', 'products.id', '=', 'order.product_id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                ->join('users', 'users.id', '=', 'products.user_id')
                ->where('products.id', $product->id)
                ->distinct()
                ->get();
        }
        return view('admin.pages.report.include.subcategory_commission_filter', compact('commissions'));
    }

    public function getOrderReport()
    {
        $orders = Order::select('order.unique_order_id', 'order.status', 'users.username', 'subcategories.name as subcategory', 'categories.name as category', 'products.name', 'order.price', 'order.price', 'order.created_at', 'order.transaction_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->distinct()
            ->paginate(10);

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'seller');
        })->get();
        return view('admin.pages.report.order_report', compact('users', 'orders'));
    }

    public function getOrderFilter(Request $request)
    {
        if ($request->get('daterange')) {
            $startDate = explode('-', $request->get('daterange'))[0];
            $endDate = explode('-', $request->get('daterange'))[1];

            $orders = Order::select('order.unique_order_id', 'order.status', 'users.username', 'subcategories.name as subcategory', 'categories.name as category', 'products.name', 'order.price', 'order.price', 'order.created_at', 'order.transaction_id')
                ->join('products', 'products.id', '=', 'order.product_id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                ->join('users', 'users.id', '=', 'products.user_id')
                ->whereBetween('order.created_at', [Carbon::parse($startDate)->format('Y-m-d H:i:s'), Carbon::parse($endDate)->format('Y-m-d H:i:s')])
                ->distinct()
                ->get();
        } elseif ($request->get('seller')) {
            $seller = User::find($request->get('seller'));
            if (!$seller) {
                return response()->json([
                    'error' => true,
                    'message' => 'Seller not found..!'
                ]);
            }
            $orders = Order::select('order.unique_order_id', 'order.status', 'users.username', 'subcategories.name as subcategory', 'categories.name as category', 'products.name', 'order.price', 'order.price', 'order.created_at', 'order.transaction_id')
                ->join('products', 'products.id', '=', 'order.product_id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                ->join('users', 'users.id', '=', 'products.user_id')
                ->where('users.id', $seller->id)
                ->distinct()
                ->get();
        } else {
            $orders = Order::select('order.unique_order_id', 'order.status', 'users.username', 'subcategories.name as subcategory', 'categories.name as category', 'products.name', 'order.price', 'order.price', 'order.created_at', 'order.transaction_id')
                ->join('products', 'products.id', '=', 'order.product_id')
                ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
                ->join('categories', 'categories.id', '=', 'subcategories.category_id')
                ->join('users', 'users.id', '=', 'products.user_id')
                ->where('order.status', $request->get('status'))
                ->distinct()
                ->get();
        }
        return \view('admin.pages.report.include.order_filter', compact('orders'));
    }

    public function getRechargeReport()
    {
        $recharges = RechargeHistory::select('recharge_history.recharge_num', 'operators.name as op_name', 'circle.name as circle', 'recharge_history.amount', 'recharge_history.created_at', 'recharge_history.status', 'users.username')
            ->join('operators', 'operators.id', '=', 'recharge_history.operator_id')
            ->join('circle', 'circle.id', '=', 'recharge_history.circle')
            ->leftJoin('users', 'users.id', '=', 'recharge_history.user_id')
            ->join('services', 'services.id', '=', 'recharge_history.service_id')
            ->paginate(10);
        $operators = Operators::select('id', 'name')->get();
        $circles = Circle::select('id', 'name')->get();
        return \view('admin.pages.report.recharge_report', compact('recharges', 'operators', 'circles'));
    }

    public function getRechargeFilter(Request $request)
    {
        if ($request->get('daterange')) {
            $startDate = explode('-', $request->get('daterange'))[0];
            $endDate = explode('-', $request->get('daterange'))[1];

            $recharges = RechargeHistory::select('recharge_history.recharge_num', 'operators.name as op_name', 'circle.name as circle', 'recharge_history.amount', 'recharge_history.created_at', 'recharge_history.status', 'users.username')
                ->join('operators', 'operators.id', '=', 'recharge_history.operator_id')
                ->join('circle', 'circle.id', '=', 'recharge_history.circle')
                ->leftJoin('users', 'users.id', '=', 'recharge_history.user_id')
                ->join('services', 'services.id', '=', 'recharge_history.service_id')
                ->whereBetween('recharge_history.created_at', [Carbon::parse($startDate)->format('Y-m-d H:i:s'), Carbon::parse($endDate)->format('Y-m-d H:i:s')])
                ->get();
        } elseif ($request->get('operator')) {
            if ($request->get('operator') == 'all') {
                $recharges = RechargeHistory::select('recharge_history.recharge_num', 'operators.name as op_name', 'circle.name as circle', 'recharge_history.amount', 'recharge_history.created_at', 'recharge_history.status', 'users.username')
                    ->join('operators', 'operators.id', '=', 'recharge_history.operator_id')
                    ->join('circle', 'circle.id', '=', 'recharge_history.circle')
                    ->leftJoin('users', 'users.id', '=', 'recharge_history.user_id')
                    ->join('services', 'services.id', '=', 'recharge_history.service_id')
                    ->get();
            } else {
                $operator = Operators::find($request->get('operator'));
                if (!$operator) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Operator not found..!'
                    ]);
                }
                $recharges = RechargeHistory::select('recharge_history.recharge_num', 'operators.name as op_name', 'circle.name as circle', 'recharge_history.amount', 'recharge_history.created_at', 'recharge_history.status', 'users.username')
                    ->join('operators', 'operators.id', '=', 'recharge_history.operator_id')
                    ->join('circle', 'circle.id', '=', 'recharge_history.circle')
                    ->leftJoin('users', 'users.id', '=', 'recharge_history.user_id')
                    ->join('services', 'services.id', '=', 'recharge_history.service_id')
                    ->where('operators.id', $operator->id)
                    ->get();
            }
        } elseif ($request->get('status')) {
            if ($request->get('status') == 'all') {
                $recharges = RechargeHistory::select('recharge_history.recharge_num', 'operators.name as op_name', 'circle.name as circle', 'recharge_history.amount', 'recharge_history.created_at', 'recharge_history.status', 'users.username')
                    ->join('operators', 'operators.id', '=', 'recharge_history.operator_id')
                    ->join('circle', 'circle.id', '=', 'recharge_history.circle')
                    ->leftJoin('users', 'users.id', '=', 'recharge_history.user_id')
                    ->join('services', 'services.id', '=', 'recharge_history.service_id')
                    ->get();
            } else {
                $recharges = RechargeHistory::select('recharge_history.recharge_num', 'operators.name as op_name', 'circle.name as circle', 'recharge_history.amount', 'recharge_history.created_at', 'recharge_history.status', 'users.username')
                    ->join('operators', 'operators.id', '=', 'recharge_history.operator_id')
                    ->join('circle', 'circle.id', '=', 'recharge_history.circle')
                    ->leftJoin('users', 'users.id', '=', 'recharge_history.user_id')
                    ->join('services', 'services.id', '=', 'recharge_history.service_id')
                    ->where('recharge_history.status', $request->get('status'))
                    ->get();
            }
        }
        return \view('admin.pages.report.include.recharge_filter', compact('recharges'));
    }

    public function getSellerReport()
    {
        $users = User::select('users.id', 'users.username', 'products.name', 'order.price', 'order.unique_order_id', 'order.transaction_id', 'order.status')
            ->leftJoin('products', 'products.user_id', '=', 'users.id')
            ->join('order', 'order.product_id', '=', 'products.id')
            ->whereHas('roles', function ($query) {
                $query->where('name', '=', 'seller');
            })->paginate(10);

        $sellers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'seller');
        })->paginate(10);

        return \view('admin.pages.report.seller_report', compact('users', 'sellers'));
    }

    public function getSellerFilter(Request $request)
    {
        if ($request->get('daterange')) {
            $startDate = explode('-', $request->get('daterange'))[0];
            $endDate = explode('-', $request->get('daterange'))[1];

            $users = User::select('users.id', 'users.username', 'products.name', 'order.price', 'order.unique_order_id', 'order.transaction_id', 'order.status')
                ->leftJoin('products', 'products.user_id', '=', 'users.id')
                ->join('order', 'order.product_id', '=', 'products.id')
                ->whereBetween('order.created_at', [Carbon::parse($startDate)->format('Y-m-d H:i:s'), Carbon::parse($endDate)->format('Y-m-d H:i:s')])
                ->whereHas('roles', function ($query) {
                    $query->where('name', '=', 'seller');
                })->get();

        } elseif ($request->get('seller')) {
            if ($request->get('operator') == 'all') {
                $users = User::select('users.id', 'users.username', 'products.name', 'order.price', 'order.unique_order_id', 'order.transaction_id', 'order.status')
                    ->leftJoin('products', 'products.user_id', '=', 'users.id')
                    ->join('order', 'order.product_id', '=', 'products.id')
                    ->whereHas('roles', function ($query) {
                        $query->where('name', '=', 'seller');
                    })->get();
            } else {
                $seller = User::find($request->get('seller'));
                if (!$seller) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Seller not found..!'
                    ]);
                }
                $users = User::select('users.id', 'users.username', 'products.name', 'order.price', 'order.unique_order_id', 'order.transaction_id', 'order.status')
                    ->leftJoin('products', 'products.user_id', '=', 'users.id')
                    ->join('order', 'order.product_id', '=', 'products.id')
                    ->where('users.id', $seller->id)
                    ->whereHas('roles', function ($query) {
                        $query->where('name', '=', 'seller');
                    })->get();
            }
        } elseif ($request->get('status')) {
            if ($request->get('status') == 'all') {
                $users = User::select('users.id', 'users.username', 'products.name', 'order.price', 'order.unique_order_id', 'order.transaction_id', 'order.status')
                    ->leftJoin('products', 'products.user_id', '=', 'users.id')
                    ->join('order', 'order.product_id', '=', 'products.id')
                    ->whereHas('roles', function ($query) {
                        $query->where('name', '=', 'seller');
                    })->get();
            } else {
                $users = User::select('users.id', 'users.username', 'products.name', 'order.price', 'order.unique_order_id', 'order.transaction_id', 'order.status')
                    ->leftJoin('products', 'products.user_id', '=', 'users.id')
                    ->join('order', 'order.product_id', '=', 'products.id')
                    ->where('order.status', $request->get('status'))
                    ->whereHas('roles', function ($query) {
                        $query->where('name', '=', 'seller');
                    })->get();
            }
        }
        return view('admin.pages.report.include.seller_filter', compact('users'));
    }

    public function getSellerDetails(Request $request)
    {
        $user = User::find($request->get('userId'));
        if (!$user) {
            return \response()->json([
                'error' => true,
                'message' => 'Seller not found..!'
            ]);
        }
        return \view('admin.pages.seller.seller_details', compact('user'));
    }

    public function getSellerCommissionExportFile($type)
    {
        $commissions = $this->adminManageService->getSellerCommission();
        $commissions->toArray();

        if ($type == 'pdf') {
            $pdf = \PDF::loadView('admin.pages.report.include.seller_commission', compact('commissions'));
            return $pdf->download('seller_commission.pdf');
        } else {
            return Excel::create('Seller Commission Excel', function ($excel) use ($commissions, $type) {
                $excel->sheet('Seller Commission sheet', function ($sheet) use ($commissions, $type) {
                    $sheet->loadView('admin.pages.report.include.seller_commission', compact('commissions', 'type'))
                        ->with('commissions', $commissions);
                    $sheet->setOrientation('landscape');
                });
            })->download($type);
        }
    }

    public function getSubCategoryCommissionExportFile($type)
    {
        $commissions = Order::select('subcategories.name as subcategory', 'users.id', 'products.name', 'order.price', 'order.created_at', 'order.transaction_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->distinct()
            ->get();

        if ($type == 'pdf') {
            $pdf = \PDF::loadView('admin.pages.report.include.subcategory_commission', compact('commissions', 'type'));
            return $pdf->download('seller_commission.pdf');
        } else {
            return Excel::create('Subcategory Commission Excel', function ($excel) use ($commissions, $type) {
                $excel->sheet('Subcategory Commission sheet', function ($sheet) use ($commissions, $type) {
                    $sheet->loadView('admin.pages.report.include.subcategory_commission', compact('commissions', 'type'))
                        ->with('commissions', $commissions);
                    $sheet->setOrientation('landscape');
                });
            })->download($type);
        }
    }

    public function getOrderExportFile($type)
    {
        $orders = Order::select('order.unique_order_id', 'order.status', 'users.username', 'subcategories.name as subcategory', 'categories.name as category', 'products.name', 'order.price', 'order.price', 'order.created_at', 'order.transaction_id')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->distinct()
            ->get();
        if ($type == 'pdf') {
            $pdf = \PDF::loadView('admin.pages.report.include.order_report_file', compact('orders', 'type'));
            return $pdf->download('order_report.pdf');
        } else {
            return Excel::create('Order Excel', function ($excel) use ($orders, $type) {
                $excel->sheet('Order sheet', function ($sheet) use ($orders, $type) {
                    $sheet->loadView('admin.pages.report.include.order_report_file', compact('orders', 'type'))
                        ->with('orders', $orders);
                    $sheet->setOrientation('landscape');
                });
            })->download($type);
        }
    }

    public function getRechargeExportFile($type)
    {
        $recharges = RechargeHistory::select('recharge_history.recharge_num', 'operators.name as op_name', 'circle.name as circle', 'recharge_history.amount', 'recharge_history.created_at', 'recharge_history.status', 'users.username')
            ->join('operators', 'operators.id', '=', 'recharge_history.operator_id')
            ->join('circle', 'circle.id', '=', 'recharge_history.circle')
            ->leftJoin('users', 'users.id', '=', 'recharge_history.user_id')
            ->join('services', 'services.id', '=', 'recharge_history.service_id')
            ->get();

        if ($type == 'pdf') {
            $pdf = \PDF::loadView('admin.pages.report.include.recharge_report_file', compact('recharges', 'type'));
            return $pdf->download('recharge_report.pdf');
        } else {
            return Excel::create('Recharge Report', function ($excel) use ($recharges, $type) {
                $excel->sheet('Recharge sheet', function ($sheet) use ($recharges, $type) {
                    $sheet->loadView('admin.pages.report.include.recharge_report_file', compact('recharges', 'type'))
                        ->with('recharges', $recharges);
                    $sheet->setOrientation('landscape');
                });
            })->download($type);
        }
    }

    public function getSellerExportFile($type)
    {
        $users = User::select('users.id', 'users.username', 'products.name', 'order.price', 'order.unique_order_id', 'order.transaction_id', 'order.status')
            ->leftJoin('products', 'products.user_id', '=', 'users.id')
            ->join('order', 'order.product_id', '=', 'products.id')
            ->whereHas('roles', function ($query) {
                $query->where('name', '=', 'seller');
            })->get();

        if ($type == 'pdf') {
            $pdf = \PDF::loadView('admin.pages.report.include.seller_report_file', compact('users', 'type'));
            return $pdf->download('seller_report.pdf');
        } else {
            return Excel::create('Seller Report', function ($excel) use ($users, $type) {
                $excel->sheet('Seller sheet', function ($sheet) use ($users, $type) {
                    $sheet->loadView('admin.pages.report.include.seller_report_file', compact('users', 'type'))
                        ->with('users', $users);
                    $sheet->setOrientation('landscape');
                });
            })->download($type);
        }
    }

    public function getHomepageSlider()
    {
        $mainSliders = HomepageSlider::select('id', 'main_slider', 'url')->get();
        $smallSliders = HomepageSlider::select('id', 'small_slider', 'url')->get();
        $mediumSliders = HomepageSlider::select('id', 'medium_slider', 'url')->get();
        $newArrivalSliders = HomepageSlider::select('id', 'new_arrival_slider', 'url')->get();
        $topSellerSliders = HomepageSlider::select('id', 'top_seller_slider', 'url')->get();
        $topSellerHorizontalSliders = HomepageSlider::select('id', 'seller_horizontal_slider', 'url')->get();
        $specialSliders = HomepageSlider::select('id', 'special_product_slider', 'url')->get();
        $recommendSliders = HomepageSlider::select('id', 'recommend_slider', 'url')->get();
        $footerImages = HomepageSlider::select('id', 'footer_slider')->get();
        return view('admin.pages.slider.homepage_slider', compact('mainSliders', 'smallSliders', 'mediumSliders', 'newArrivalSliders', 'topSellerSliders', 'topSellerHorizontalSliders', 'specialSliders', 'recommendSliders', 'footerImages'));
    }

    public function postHomepageSlider(Request $request)
    {
        if ($request->hasFile('main_slider')) {
            $this->adminManageService->saveMainSlider($request->file('main_slider'), $request->get('url'));
        }
        if ($request->hasFile('small_slider')) {
            $this->adminManageService->saveSmallSlider($request->file('small_slider'), $request->get('url'));
        }
        if ($request->hasFile('medium_slider')) {
            $this->adminManageService->saveMediumSlider($request->file('medium_slider'), $request->get('url'));
        }
        if ($request->hasFile('new_arrival_slider')) {
            $this->adminManageService->saveNewArrivalSlider($request->file('new_arrival_slider'), $request->get('url'));
        }
        if ($request->hasFile('top_seller_slider')) {
            $this->adminManageService->saveTopSellerSlider($request->file('top_seller_slider'), $request->get('url'));
        }
        if ($request->hasFile('seller_horizontal_slider')) {
            $this->adminManageService->saveTopSellerHorizontalSlider($request->file('seller_horizontal_slider'), $request->get('url'));
        }
        if ($request->hasFile('special_product_slider')) {
            $this->adminManageService->saveSpecialProductSlider($request->file('special_product_slider'), $request->get('url'));
        }
        if ($request->hasFile('recommend_slider')) {
            $this->adminManageService->saveRecommendSlider($request->file('recommend_slider'), $request->get('url'));
        }
        if ($request->hasFile('footer_slider')) {
            $this->adminManageService->savefooterSlider($request->file('footer_slider'));
        }

        Session::flash('success', 'Slider added successfully..!');
        return redirect()->back();
    }

    public function getDeleteSlider(Request $request)
    {
        $slider = HomepageSlider::find($request->get('sliderId'));
        if (!$slider) {
            return \response()->json([
                'success' => false,
                'message' => 'Slider not found..!'
            ]);
        }
        if (\File::exists(public_path() . '/slider/' . $slider->main_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->main_slider);
        } elseif (\File::exists(public_path() . '/slider/' . $slider->small_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->small_slider);
        } elseif (\File::exists(public_path() . '/slider/' . $slider->medium_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->medium_slider);
        } elseif (\File::exists(public_path() . '/slider/' . $slider->new_arrival_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->new_arrival_slider);
        } elseif (\File::exists(public_path() . '/slider/' . $slider->top_seller_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->top_seller_slider);
        } elseif (\File::exists(public_path() . '/slider/' . $slider->seller_horizontal_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->seller_horizontal_slider);
        } elseif (\File::exists(public_path() . '/slider/' . $slider->special_product_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->special_product_slider);
        } elseif (\File::exists(public_path() . '/slider/' . $slider->recommend_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->recommend_slider);
        } else {
            \File::delete(public_path() . '/slider/' . $slider->footer_slider);
        }
        $slider->delete();
        Session::flash('success', 'Slider delete successfully..!');
        return \response()->json([
            'success' => true,
        ]);
    }

    public function getSubCategorySlider()
    {
        $mainSliders = SubcategorySlider::select('id', 'main_slider')->where('main_slider', '!=', NULL)->get();
        $sidebarSliders = SubcategorySlider::select('id', 'sidebar_slider')->where('sidebar_slider', '!=', NULL)->get();
        return \view('admin.pages.slider.subcategory_slider', compact('mainSliders', 'sidebarSliders'));
    }

    public function getProductDetailsSlider()
    {
        $mainSliders = ProductsSliders::select('id', 'main_slider', 'url')->where('main_slider', '!=', NULL)->get();
        $sidebarSlider = ProductsSliders::select('id', 'sidebar_slider', 'url')->where('sidebar_slider', '!=', NULL)->first();
        return \view('admin.pages.slider.products_slider', compact('mainSliders', 'sidebarSlider'));
    }

    public function postProductsSlider(Request $request)
    {
        if ($request->hasFile('main_slider')) {
            $this->adminManageService->saveProductsSlider($request->file('main_slider'), $request->get('url'));
            Session::flash('success', 'Slider added successfully..!');
            return redirect()->back();
        }
        if ($request->hasFile('sidebar_slider')) {
            $this->adminManageService->saveProductsSlider2($request->file('sidebar_slider'), $request->get('url'));
            Session::flash('success', 'Slider added successfully..!');
            return redirect()->back();
        }
    }

    public function postSubCategorySlider(Request $request)
    {
        if ($request->hasFile('main_slider')) {
            $this->adminManageService->saveSubcatMainSlider($request->file('main_slider'));
            Session::flash('success', 'Slider added successfully..!');
            return redirect()->back();
        }
        if ($request->hasFile('sidebar_slider')) {
            $this->adminManageService->saveSubcatSidebarSlider($request->file('sidebar_slider'));
            Session::flash('success', 'Slider added successfully..!');
            return redirect()->back();
        }
    }

    public function getDeleteSubSlider(Request $request)
    {
        $slider = SubcategorySlider::find($request->get('sliderId'));
        if (!$slider) {
            return \response()->json([
                'success' => false,
                'message' => 'Slider not found..!'
            ]);
        }
        if (\File::exists(public_path() . '/slider/' . $slider->main_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->main_slider);
        } elseif (\File::exists(public_path() . '/slider/' . $slider->sidebar_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->sidebar_slider);
        }
        $slider->delete();
        Session::flash('success', 'Slider delete successfully..!');
        return \response()->json([
            'success' => true,
        ]);
    }

    public function getDeleteProductSlider(Request $request)
    {
        $slider = ProductsSliders::find($request->get('sliderId'));
        if (!$slider) {
            return \response()->json([
                'success' => false,
                'message' => 'Slider not found..!'
            ]);
        }
        if (\File::exists(public_path() . '/slider/' . $slider->main_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->main_slider);
        } elseif (\File::exists(public_path() . '/slider/' . $slider->sidebar_slider)) {
            \File::delete(public_path() . '/slider/' . $slider->sidebar_slider);
        }
        $slider->delete();
        Session::flash('success', 'Slider delete successfully..!');
        return \response()->json([
            'success' => true,
        ]);
    }

    public function getAddAboutUs()
    {
        $about = AboutUs::select('id', 'desc', 'image')->first();
        return view('admin.pages.other.about_us', compact('about'));
    }

    public function postAddAboutUs(Request $request)
    {
        if ($request->get('privacyId')) {
            $aboutUs = AboutUs::find($request->get('AboutId'));
        } else {
            $aboutUs = new AboutUs();
        }
        if ($request->get('desc')) {
            $aboutUs->desc = $request->get('desc');
        }
        if ($request->file('about_image')) {
            $otherImg = 'about_' . time() . '.' . $request->file('about_image')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('about_image')->getRealPath())->resize(null, 346,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(271, 346);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('otherpages/') . $otherImg);
            $aboutUs->image = $otherImg;
            if (\File::exists(public_path() . '/otherpages/' . $request->get('oldAboutImg'))) {
                \File::delete(public_path() . '/otherpages/' . $request->get('oldAboutImg'));
            }
        }
        $aboutUs->save();
        Session::flash('success', 'About Us added successfully..!');
        return redirect()->back();
    }

    public function getAddPrivacyPolicy()
    {
        $policy = PrivacyPolicy::select('id', 'desc', 'image')->first();
        return view('admin.pages.other.privacy_policy', compact('policy'));
    }

    public function postAddPrivacyPolicy(Request $request)
    {
        if ($request->get('privacyId')) {
            $privacy = PrivacyPolicy::find($request->get('privacyId'));
        } else {
            $privacy = new PrivacyPolicy();
        }
        if ($request->get('desc')) {
            $privacy->desc = $request->get('desc');
        }
        if ($request->file('privacy_image')) {
            $otherImg = 'privacy_' . time() . '.' . $request->file('privacy_image')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('privacy_image')->getRealPath())->resize(null, 346,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(271, 346);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('otherpages/') . $otherImg);
            $privacy->image = $otherImg;
            if (\File::exists(public_path() . '/otherpages/' . $request->get('oldAboutImg'))) {
                \File::delete(public_path() . '/otherpages/' . $request->get('oldAboutImg'));
            }
        }
        $privacy->save();
        Session::flash('success', 'Privacy Policy added successfully..!');
        return redirect()->back();
    }

    public function getAddTermsCondition()
    {
        $terms = TermsCondition::select('id', 'desc', 'image')->limit(1)->first();
        return view('admin.pages.other.terms_condition', compact('terms'));
    }

    public function postAddTermsCondition(Request $request)
    {
        if ($request->get('termsId')) {
            $privacy = TermsCondition::find($request->get('termsId'));
        } else {
            $privacy = new TermsCondition();
        }
        if ($request->get('desc')) {
            $privacy->desc = $request->get('desc');
        }
        if ($request->file('terms_image')) {
            $otherImg = 'terms_' . time() . '.' . $request->file('terms_image')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('terms_image')->getRealPath())->resize(null, 346,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(271, 346);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('otherpages/') . $otherImg);
            $privacy->image = $otherImg;
            if (\File::exists(public_path() . '/otherpages/' . $request->get('oldAboutImg'))) {
                \File::delete(public_path() . '/otherpages/' . $request->get('oldAboutImg'));
            }
        }
        $privacy->save();
        Session::flash('success', 'Terms & condition added successfully..!');
        return redirect()->back();
    }

    public function getAddFaq()
    {
        $faq = FAQ::select('id', 'desc', 'image')->limit(1)->first();
        return view('admin.pages.other.faq', compact('faq'));
    }

    public function postAddFaq(Request $request)
    {
        if ($request->get('faqId')) {
            $faq = FAQ::find($request->get('faqId'));
        } else {
            $faq = new FAQ();
        }
        if ($request->get('desc')) {
            $faq->desc = $request->get('desc');
        }
        if ($request->file('faq_image')) {
            $otherImg = 'faq_' . time() . '.' . $request->file('faq_image')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('faq_image')->getRealPath())->resize(null, 346,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(271, 346);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('otherpages/') . $otherImg);
            $faq->image = $otherImg;
            if (\File::exists(public_path() . '/otherpages/' . $request->get('oldAboutImg'))) {
                \File::delete(public_path() . '/otherpages/' . $request->get('oldAboutImg'));
            }
        }
        $faq->save();
        Session::flash('success', 'FAQ added successfully..!');
        return redirect()->back();
    }

    public function getAddDeliveryInfo()
    {
        $delivery = DeliveryInfo::select('id', 'desc', 'image')->limit(1)->first();
        return view('admin.pages.other.delivery_info', compact('delivery'));
    }

    public function postAddDeliveryInfo(Request $request)
    {
        if ($request->get('deliveryId')) {
            $delivery = DeliveryInfo::find($request->get('deliveryId'));
        } else {
            $delivery = new DeliveryInfo();
        }
        if ($request->get('desc')) {
            $delivery->desc = $request->get('desc');
        }
        if ($request->file('delivery_image')) {
            $otherImg = 'faq_' . time() . '.' . $request->file('delivery_image')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('delivery_image')->getRealPath())->resize(null, 346,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(271, 346);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('otherpages/') . $otherImg);
            $delivery->image = $otherImg;
            if (\File::exists(public_path() . '/otherpages/' . $request->get('oldAboutImg'))) {
                \File::delete(public_path() . '/otherpages/' . $request->get('oldAboutImg'));
            }
        }
        $delivery->save();
        Session::flash('success', 'DeliveryInfo added successfully..!');
        return redirect()->back();
    }

    public function getAddCancellationPolicy()
    {
        $cancellation = CancellationPolicy::select('id', 'desc', 'image')->limit(1)->first();
        return view('admin.pages.other.cancellation_policy', compact('cancellation'));
    }

    public function postAddCancellationPolicy(Request $request)
    {
        if ($request->get('cancellationId')) {
            $cancellation = CancellationPolicy::find($request->get('cancellationId'));
        } else {
            $cancellation = new CancellationPolicy();
        }
        if ($request->get('desc')) {
            $cancellation->desc = $request->get('desc');
        }
        if ($request->file('cancellation_image')) {
            $otherImg = 'faq_' . time() . '.' . $request->file('cancellation_image')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('cancellation_image')->getRealPath())->resize(null, 346,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(271, 346);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('otherpages/') . $otherImg);
            $cancellation->image = $otherImg;
            if (\File::exists(public_path() . '/otherpages/' . $request->get('oldAboutImg'))) {
                \File::delete(public_path() . '/otherpages/' . $request->get('oldAboutImg'));
            }
        }
        $cancellation->save();
        Session::flash('success', 'Cancellation policy added successfully..!');
        return redirect()->back();
    }

    public function getAddSellerPolicy()
    {
        $seller = SellerPolicy::select('id', 'desc', 'image')->limit(1)->first();
        return view('admin.pages.other.seller_policy', compact('seller'));
    }

    public function postAddSellerPolicy(Request $request)
    {
        if ($request->get('SellerPolicyId')) {
            $seller = SellerPolicy::find($request->get('SellerPolicyId'));
        } else {
            $seller = new SellerPolicy();
        }
        if ($request->get('desc')) {
            $seller->desc = $request->get('desc');
        }
        if ($request->file('seller_image')) {
            $otherImg = 'faq_' . time() . '.' . $request->file('seller_image')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('seller_image')->getRealPath())->resize(null, 110,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(110, 110);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('otherpages/') . $otherImg);
            $seller->image = $otherImg;
            if (\File::exists(public_path() . '/otherpages/' . $request->get('oldAboutImg'))) {
                \File::delete(public_path() . '/otherpages/' . $request->get('oldAboutImg'));
            }
        }
        $seller->save();
        Session::flash('success', 'Seller policy added successfully..!');
        return redirect()->back();
    }

    public function getAddTestimonials()
    {
        return view('admin.pages.testimonial.add_testimonial');
    }

    public function postAddTestimonials(Request $request)
    {
        if ($request->get('testimonialId')) {
            $testimonial = Testimonials::find($request->get('testimonialId'));
        } else {
            $testimonial = new Testimonials();
        }
        if (isset($testimonial->title)) {
            if ($testimonial->title != $request->get('title')) {
                $testimonial->slug = $testimonial->getSlugForCustom($testimonial->title);
            }
        } else {
            $testimonial->slug = $testimonial->getSlugForCustom($request->get('title'));
        }
        if ($request->get('title')) {
            $testimonial->title = $request->get('title');
        }
        if ($request->get('desc')) {
            $testimonial->desc = $request->get('desc');
        }
        if ($request->file('testimonial_image')) {
            $otherImg = 'testmonial_' . time() . '.' . $request->file('testimonial_image')->getClientOriginalExtension();
            $thumb_img = Image::make($request->file('testimonial_image')->getRealPath())->resize(null, 346,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(271, 346);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('otherpages/') . $otherImg);
            $testimonial->image = $otherImg;
            if (\File::exists(public_path() . '/otherpages/' . $request->get('oldAboutImg'))) {
                \File::delete(public_path() . '/otherpages/' . $request->get('oldAboutImg'));
            }
        }
        $testimonial->save();
        Session::flash('success', 'Testimonial added successfully..!');
        return redirect()->back();
    }

    public function getManageTestimonials()
    {
        $testimonials = Testimonials::select('id', 'title', 'desc', 'slug')->get();
        return view('admin.pages.testimonial.manage_testimonials', compact('testimonials'));
    }

    public function getEditTestimonials($slug)
    {
        $testimonial = Testimonials::where('slug', $slug)->limit(1)->first();
        if (!$testimonial) {
            Session::flash('error', 'Testimonial not found..!');
            return redirect()->back();
        }
        return view('admin.pages.testimonial.add_testimonial', compact('testimonial'));
    }

    public function getDeleteTestimonials(Request $request)
    {
        $testimonial = Testimonials::where('slug', $request->get('slug'))->limit(1)->first();
        if (!$testimonial) {
            return response()->json([
                'success' => false,
                'message' => 'Testimonial not found..!'
            ]);
        }
        if (\File::exists(public_path('otherpages/' . $testimonial->image))) {
            \File::delete(public_path('otherpages/' . $testimonial->image));
        }
        $testimonial->delete();
        Session::flash('success', 'Testimonial delete successfully..!');
        return response()->json([
            'success' => true,
        ]);
    }
    
    //getAddHoliday
    public function getAddHoliday()
    {
        return view('admin.pages.add_holiday');
    }

    // Add subcategory2 page by ishwar start
    public function getAddSubCategory2()
    {

        $subcategoriesitms = Subcategory::select('subcategories.id as subcategoryId', 'subcategories.name','categories.name as catName')->
        join('categories','categories.id','subcategories.category_id')->orderBy('categories.name')->get();


        return view('admin.pages.subcategory2.add_sub_category2', compact('subcategoriesitms'));
    }

    public function postAddSubCategory2(SubCategoryRequest2 $request)
    {
        if ($request->get('subcategoryId2')) {
            $subcategories2 = SubCategory2::limit(1)->find($request->get('subcategoryId2'));
        } else {
            $subcategories2 = new SubCategory2();
        }
        $this->categoriesService->saveSubCategories2($subcategories2, 
            $request->get('name'), 
            $request->get('subcategoryid'), 
            $request->get('desc'), 
            $request->get('commission'), 
            $request->get('commission_type'), 
            $request->get('m_title'), 
            $request->get('m_desc'), 
            $request->get('m_keywords'), 
            $request->get('m_tag'));

        if ($request->file('sub_cat_img')) {
            $subcatImg = time() . '.' . $request->file('sub_cat_img')->getClientOriginalExtension();

            $thumb_img = Image::make($request->file('sub_cat_img')->getRealPath())->resize(null, 20,
                function ($constraint) {
                    $constraint->aspectRatio();
                });
            $canvas1 = Image::canvas(20, 20);
            $canvas1->insert($thumb_img, 'center');
            $canvas1->save(public_path('subcategory/') . $subcatImg);

            $subcategories2->sub_cat_img = $subcatImg;
            if (\File::exists(public_path() . '/subcategory/' . $request->get('oldSubCatImg'))) {
                \File::delete(public_path() . '/subcategory/' . $request->get('oldSubCatImg'));
            }
        } else {
            $subcategories2->sub_cat_img = $request->get('oldSubCatImg');
        }
        $subcategories2->save();

        if ($request->get('subcategoryId2')) {
            Session::flash('success', 'Sub Categories updated successfully !');
            return redirect()->route('get:edit_subcategories2', $subcategories2->slug);
        } else {
            Session::flash('success', 'Sub Categories added successfully !');
            return redirect()->route('get:add_subcategory2');
        }
    }

    public function getManageSubCategory2()
    {
        $subcategoriesitms = SubCategory2::select('id', 'name', 'slug')->get();
        return view('admin.pages.subcategory2.manage_subcategory2', compact('subcategoriesitms'));
    }

    public function getDeleteSubCategory2(Request $request)
    {
        $subcategory = SubCategory2::where('slug', $request->get('slug'))->first();
        if (!$subcategory) {
            return response()->json([
                'success' => false,
                'message' => 'SubCategory not found'
            ]);
        }
        if (\File::exists(public_path() . '/subcategory/' . $subcategory->sub_cat_img)) {
            \File::delete(public_path() . '/subcategory/' . $subcategory->sub_cat_img);
        }
        $subcategory->delete();
        Session::flash('success', 'SubCategory Deleted Successfully!');
        return response()->json([
            'success' => true,
            'message' => 'SubCategory Deleted Successfully'
        ]);
    }

    public function getEditSubCategory2($slug)
    {
        $editsubcategoryitm = SubCategory2::limit(1)->where('slug', $slug)->first();
        if (!$editsubcategoryitm) {
            Session::flash('error', 'SubCategory not found..!');
            return redirect()->back();
        }
        $subcategoriesitms = SubCategory::select('id as subcategoryId', 'name')->get();
        return view('admin.pages.subcategory2.add_sub_category2', compact('editsubcategoryitm', 'subcategoriesitms'));
    }
    // Add subcategory2 page by ishwar over

    //Add Product by ishwar start
    public function getCategoryPage()
    {
        $all_id = explode(",", Auth::user()->categories_id);
        $mycategories = Categories::select('id','name','cat_img','thumb_img','slug')->whereIn("id", $all_id)->orderBy('name','ASC')->get();

        if (!$mycategories) {
            Session::flash('error', 'Categories not found..!');
            return redirect()->back();
        }
        return view('admin.pages.product.add_products_category', compact('mycategories'));
    }

    public function getSubCategoryPage($slug)
    {
        $categoryid = Categories::select('id')->where('slug',$slug)->first();
        $subcategories = SubCategory::select('id','name','sub_cat_img','thumb_img','slug')->where('category_id',$categoryid->id)->orderBy('name')->get();
        if (!$subcategories) {
            Session::flash('error', 'Sub Categories not found..!');
            return redirect()->back();
        }
        return view('admin.pages.product.add_products_subcategory', compact('subcategories'));
    }


    public function getNotify()
    {   
        $newseller = array();
        $productsnotify=array();
        if (Auth::user()->hasRole('seller')) {
            $productsnotify = Products::select('id','name','quantity')->where('user_id',Auth::user()->id)->where('quantity','<',11)->get();
        }else{
            $productsnotify = Products::select('id','name','quantity')->where('quantity','<',11)->get();
            if (Auth::user()->hasRole('admin')) {
            $newseller = User::whereHas('roles', function ($query) {
                        $query->where('name', '=', 'seller');
                        })->where('status','0')->get();
            }
        }
        return view('admin.layout.include.notify', compact('productsnotify','newseller'));
    }

    public function getProductsExportFile($type)
    {
        $products = Products::select('products.*','users.first_name')
        ->join('users','users.id','products.user_id')->get();
    
        if ($type == 'pdf') {
            $pdf = \PDF::loadView('admin.pages.product.include.manage_products', compact('products','type'));
            return $pdf->download('manage_products.pdf');
        } 
        else 
        {
            return Excel::create('Manage Products Excel', function ($excel) use ($products, $type) {
                $excel->sheet('Manage Products sheet', function ($sheet) use ($products, $type) {
                    $sheet->loadView('admin.pages.product.include.manage_products', compact('products', 'type'));
                    $sheet->setOrientation('landscape');
                });
            })->download($type);
        }
    }

    public function getDeleteBrandDocument(Request $request)
    {
        $doc = BrandsDocuments::find($request->get('brandDocId'));
        if (!$doc) {
            return \response()->json(['success' => false,'message' => 'Document not found..!']);
        }
        if (\File::exists(public_path() . '/brandsImg/documents/' . $doc->brands_documents)) {
            \File::delete(public_path() . '/brandsImg/documents/' . $doc->brands_documents);
        } 
        $doc->delete();
        Session::flash('success', 'Document deleted successfully..!');
        return \response()->json(['success' => true]);
    }


    //seller payment
    public function getSellerPaymentRequest()
    {
        return view('admin.pages.seller.seller_payment_request');
    }

    public function getViewSellerPaymentRequest()
    {
        $sellerPayments = SellerPaymentRequest::select('*')
            ->where('user_id', Auth::user()->id)
            ->orderBY('id', 'DESC')->get();

        return view('admin.pages.seller.view_seller_payment_request', compact('sellerPayments'));
    }

    public function postAddPaymentRequest(Request $request)
    {
        $checkBalance =  $sellerPayments = User::select('wallet_amount')->where('id', Auth::user()->id)->first();

        if($request->get('amount') >= 1000)
        {
            if($request->get('amount') > $checkBalance->wallet_amount)
            {
                Session::flash('error', 'You request amount is greater than your wallet amount ');
                return redirect()->back();
            }
            else
            {
                //Add entry in seller_payment_request table
                $addPayment = new SellerPaymentRequest();
                $addPayment->amount = $request->get('amount');
                $addPayment->user_id = Auth::user()->id;
                $addPayment->payment_status = 0;
                $addPayment->save();

                //Add entry in seller_payment_history table
                $addHistory = new SellerPaymentHistory();
                $addHistory->amount = $request->get('amount');
                $addHistory->seller_payment_id = $addPayment->id; 
                $addHistory->payment_status = 0;
                $addHistory->save();

                Session::flash('success', 'You request amount is sent successfully..!');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error', 'You must request amount more than 1000 ');
            return redirect()->back();
        }
    }

    public function getManagePaymentRequest()
    {
        $paymentRequests = SellerPaymentRequest::select('seller_payment_request.*','users.wallet_amount','users.first_name')->join('users','seller_payment_request.user_id','users.id')->orderBY('id', 'DESC')->get();
        return view('admin.pages.seller.manage_payment_requests', compact('paymentRequests'));
    }

    public function postUpdateSellerPaymentStatus(Request $request)
    {
        // Ishwar
        $check = SellerPaymentRequest::find($request->get('sPaymentId'));

        if(!$check)
        {    
            Session::flash('success', 'Payment request not found...!');
            return redirect()->back();
        }
        else
        {
            //update entry in seller_payment_request table
            SellerPaymentRequest::where('id', $request->get('sPaymentId'))->update(['payment_status' => 1]);
            $paymentData = SellerPaymentRequest::select('id','amount','payment_status')->where('id',$request->get('sPaymentId'))->first();
            //Add entry in seller_payment_history table
            $addHistory = new SellerPaymentHistory();
            $addHistory->amount = $paymentData->amount;
            $addHistory->seller_payment_id = $paymentData->id; 
            $addHistory->payment_status = $paymentData->payment_status; 
            $addHistory->save();

            Session::flash('success', 'Status updated successfully..!');
            return \response()->json(['success' => true]);
        }
    }

    public function postUpdateSellerPaymentRemarks(Request $request)
    {
        $remark = isset($request->remark) ? $request->remark : ''; 
        $check = SellerPaymentRequest::find($request->get('sellerPaymentId'));

        if(!$check)
        {    
            Session::flash('danger', 'Payment request not found...!');
            return redirect()->back();
        }
        elseif($request->get('paymentType')=='withdraw')
        {
            $checkPaymentData = SellerPaymentRequest::select('*')->where('id',$request->get('sellerPaymentId'))->first();
            $checkMainbalance = User::select('wallet_amount')->where('id', $paymentData->user_id)->first();
            
            if($checkPaymentData->amount > $checkMainbalance->wallet_amount)
            {
                Session::flash('danger', 'Wallet amount is low to withdraw..!');
                return redirect()->back();
            }
            else
            {
                SellerPaymentRequest::where('id', $request->get('sellerPaymentId'))->update(['payment_status' => 3,'remarks'=>$remark]);
                $paymentData = SellerPaymentRequest::select('*')->where('id',$request->get('sellerPaymentId'))->first();
                $mainbalance = User::select('wallet_amount')->where('id', $paymentData->user_id)->first();

                //Add entry in seller_payment_history table
                $addHistory = new SellerPaymentHistory();
                $addHistory->amount = $paymentData->amount;
                $addHistory->seller_payment_id = $paymentData->id; 
                $addHistory->payment_status = $paymentData->payment_status; 
                $addHistory->remarks =  $paymentData->remarks; 
                $addHistory->save();

                $remainBalance = $mainbalance->wallet_amount - $paymentData->amount;
                //Deduct amount from seller wallet balance
                User::where('id', $paymentData->user_id)->update(['wallet_amount' => $remainBalance]);

                Session::flash('success', 'Transaction done successfully..!');
                return redirect()->back();
            }
        }
        elseif($request->get('paymentType')=='decline')
        {
            SellerPaymentRequest::where('id', $request->get('sellerPaymentId'))->update(['payment_status' => 2,'remarks'=>$remark]);
            $paymentData = SellerPaymentRequest::select('*')->where('id',$request->get('sellerPaymentId'))->first();

            $addHistory = new SellerPaymentHistory();
            $addHistory->amount = $paymentData->amount;
            $addHistory->seller_payment_id = $paymentData->id; 
            $addHistory->payment_status = $paymentData->payment_status; 
            $addHistory->remarks =  $paymentData->remarks; 
            $addHistory->save();

            return redirect()->back();
        }
    }

    //only for seller
    public function getViewSellerSalesReport(Request $request)
    {
        $salesReports = Order::select('product_id','users.first_name','products.name as productname','products.price','products.id as productid')
        ->join('products','products.id','order.product_id')
        ->join('users','users.id','products.user_id')
        ->where('shipping','delivered')
        ->where('users.id',Auth::user()->id)->get();

        return view('admin.pages.seller.seller_sales_report', compact('salesReports','users'));
    }

    //sales reports for admin
    public function getManageSellerSalesReport(Request $request)
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'seller');
        })->get();
        
        $salesReports = Order::select('product_id','users.first_name','products.name as productname','products.price','products.id as productid')
        ->join('products','products.id','order.product_id')
        ->join('users','users.id','products.user_id')
        ->where('shipping','delivered')
        ->where('users.id',Auth::user()->id)->get();

        return view('admin.pages.seller.manage_seller_sales_report', compact('salesReports','users'));
    }

    public function getSellerSalesFilter(Request $request)
    {
        $user = User::find($request->get('seller'));
        if (!$user) 
        {
            return response()->json(['error' => true, 'message' => 'Seller not found..!']);
        }
        
        $salesReports = Order::select('product_id','users.first_name','products.name as productname','products.price','products.id as productid')
        ->join('products','products.id','order.product_id')
        ->join('users','users.id','products.user_id')
        ->where('shipping','delivered')
        ->where('users.id',$user->id)->get(); 
        return view('admin.pages.seller.include.filter_seller_sales_report', compact('salesReports'));
    }

    public function getProductFeeData(Request $request)
    {
        $data = Products::select('products.price','categories.*','fee_deduction.deduction_charge','payment_collection.selling_fee','payment_collection.closing_fee','payment_collection.total_fee','payment_collection.service_tax')
        ->join('subcategories2','products.sub_category_id','subcategories2.id')
        ->join('subcategories','subcategories.id','subcategories2.subcategory_id')->join('categories','subcategories.category_id','categories.id')
        ->join('fee_deduction','categories.id','fee_deduction.category_id')
        ->join('payment_collection','payment_collection.fee_deduction_id','fee_deduction.id')->where('products.id',$request->productid)->first();

        return view('admin.pages.seller.include.sales_fee_deduct', compact('data'));
    }

    // RemoveColorImage
    public function RemoveColorImage(Request $request)
    {
        $removeImage = ColorsImages::where('id', $request->imageid)->update([$request->imagename => '']);
        return response()->json([
            'success' => true,
            'message' => 'Image removed successfully..!'
        ]);
    }

    
    public function RemoveProductColor(Request $request)
    {
        
        $delete=ProductsAttributes::find($request->attribute_id);
        $delete->delete($request->attribute_id);

        return response()->json([
            'success' => true,
            'message' => 'Color removed successfully..!'
        ]);
    }

    public function addColorImage(Request $request)
    {
        $colorimage1 = $request->file('file');
        $screenshots1 = 'color_' . time() . '.' . $colorimage1->getClientOriginalExtension();
        $colorimage1->move(public_path('productScreenshots/'), $screenshots1);

        $thumb_screen = Image::make(public_path('productScreenshots/' . $screenshots1))->resize(null, 122,
            function ($constraint) {
                $constraint->aspectRatio();
            });
        $canvas1 = Image::canvas(100, 122);
        $canvas1->insert($thumb_screen, 'center');
        $canvas1->save(public_path('100ProductImg/') . $screenshots1);

        $thumb_screen2 = Image::make(public_path('productScreenshots/' . $screenshots1))->resize(null, 366,
            function ($constraint) {
                $constraint->aspectRatio();
            });
        $canvas2 = Image::canvas(300, 366);
        $canvas2->insert($thumb_screen2, 'center');
        $canvas2->save(public_path('300ProdctImg/') . $screenshots1);

        $thumb_screen3 = Image::make(public_path('productScreenshots/' . $screenshots1))->resize(null, 512,
            function ($constraint) {
                $constraint->aspectRatio();
            });
        $canvas3 = Image::canvas(420, 512);
        $canvas3->insert($thumb_screen3, 'center');
        $canvas3->save(public_path('420ProductImg/') . $screenshots1);

        $thumb_screen4 = Image::make(public_path('productScreenshots/' . $screenshots1))->resize(null, 1036,
            function ($constraint) {
                $constraint->aspectRatio();
            });
        $canvas4 = Image::canvas(850, 1036);
        $canvas4->insert($thumb_screen4, 'center');
        $canvas4->save(public_path('850ProductImg/') . $screenshots1);

        $addImage = ColorsImages::where('id', $request->id)->update([$request->name => $screenshots1]);

        return response()->json([
            'success' => true,
            'message' => 'Image Added successfully..!'
        ]);
    }

    public function updateProductColor(Request $request)
    {
        $update = ProductsAttributes::where('id', $request->id)->update(['desc' => $request->color]);
        if($update)
        return response()->json(['success' => true]);   
    }
    
    public function updateProductPrice(Request $request)
    {
        $update = ProductsAttributes::where('id', $request->id)->update(['product_price' => $request->price]);
        if($update)
        return response()->json(['success' => true]);   
    }


    // ishwar changes over here

}