<?php
/**
 * Created by PhpStorm.
 * User: xyz
 * Date: 3/28/2018
 * Time: 5:01 PM
 */

namespace App\Classes;


use App\Model\KycDocuments;
use App\Model\Order;
use App\Model\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Zend\Diactoros\Request;

class DashboardManager
{
    public function getFlatCommission()
    {
        $flatCommission = Order::select('subcategories.*')
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::FLAT)
            ->where('products.user_id', Auth::user()->id)
            ->sum('subcategories.commission');
        return $flatCommission;
    }

    public function getPercentageCommission()
    {
        $percentageCommission = Order::select(DB::raw('sum(subcategories.commission * .01 * order.price) as newPrice'))
            ->join('products', 'products.id', '=', 'order.product_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.sub_category_id')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->where('subcategories.commission_type', SubCategory::PERCENTAGE)
            ->where('products.user_id', Auth::user()->id)
            ->first();

        return $percentageCommission;
    }

    public function saveProfile($request)
    {
        $user = Auth::user();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->username = Auth::user()->username;
        $user->email = Auth::user()->email;
        $user->mobile_num = Auth::user()->mobile_num;
        if ($request->get('pan_tan_number')) {
            $user->pan_or_tan_num = $request->get('pan_tan_number');
        }
        if ($request->get('gst_number')) {
            $user->gst_num = $request->get('gst_number');
        }
        if ($request->get('aadhar_num')) {
            $user->aadhar_num = $request->get('aadhar_num');
        }
        //ishwar
        if ($request->get('company_name')) {
            $user->company_name = $request->get('company_name');
        }
        if ($request->get('city')) {
            $user->city = $request->get('city');
        }
        if ($request->get('state')) {
            $user->state = $request->get('state');
        }
        if ($request->get('shipping_address')) {
            $user->shipping_address = $request->get('shipping_address');
        }
        if ($request->get('pincode')) {
            $user->pincode = $request->get('pincode');
        }
        if ($request->get('benificiary_name')) {
            $user->benificiary_name = $request->get('benificiary_name');
        }
        if ($request->get('account_number')) {
            $user->account_number = $request->get('account_number');
        }
        if ($request->get('ifsc_code')) {
            $user->ifsc_code = $request->get('ifsc_code');
        }
        if ($request->get('bank_name')) {
            $user->bank_name = $request->get('bank_name');
        }
        if ($request->get('location')) {
            $user->location = $request->get('location');
        }
        if ($request->get('fullfilment_mode')) {
            $user->fullfilment_mode = $request->get('fullfilment_mode');
        }
        if ($request->get('seller_name')) {
            $user->seller_name = $request->get('seller_name');
        }
        if ($request->get('branch_name')) {
            $user->branch_name = $request->get('branch_name');
        }
        // if ($request->get('shipping_type')) {
            $user->shipping_type = $request->get('shipping_type');
        // }

        $user->save();
        if ($request->hasFile('kyc_docs')) {
            foreach ($request->file('kyc_docs') as $kycDoc) {
                $photo = $kycDoc;
                $imagename = time() . uniqid(rand()) . '.' . $photo->getClientOriginalExtension();
                $destinationPath = public_path('/aadharcard');
                $photo->move($destinationPath, $imagename);
                $kyc = new KycDocuments();
                $kyc->user_id = $user->id;
                $kyc->kyc_doc = $imagename;
                $kyc->save();
            }
        }
        if ($request->hasFile('other_docs')) {
            foreach ($request->file('other_docs') as $otherDoc)
                $back = $otherDoc;
            $backimagename = uniqid(5) . '.' . $back->getClientOriginalExtension();
            $destinationPath = public_path('/aadharcard');
            $back->move($destinationPath, $backimagename);
            $kyc = new KycDocuments();
            $kyc->user_id = $user->id;
            $kyc->other_doc = $backimagename;
            $kyc->save();
        }
        return $user;
    }
}