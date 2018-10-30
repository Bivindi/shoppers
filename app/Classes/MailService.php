<?php
/**
 * Created by PhpStorm.
 * User: xyz
 * Date: 3/8/2018
 * Time: 10:09 AM
 */

namespace App\Classes;


use Illuminate\Support\Facades\Mail;

class MailService
{
    /*Seller Mailer*/
    public function sendSellerRegisterMail($data, $user)
    {
        Mail::send('emails.seller.seller_verify', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('Account verification!');
        });
        return $user;
    }

    public function sendVerifiedMail($data, $user)
    {
        Mail::send('emails.seller.verified_seller', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('Account verified!');
        });
        return $user;
    }

    public function sendSellerApproveMail($data, $user)
    {
        Mail::send('emails.seller.approve_seller', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('Approve Account!');
        });
        return $user;
    }

    public function sendSellerDisApproveMail($data, $user)
    {
        Mail::send('emails.seller.disapprove_seller', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('Approve Account');
        });
        return $user;
    }

    public function sendSellerRemoveMail($data, $user)
    {
        Mail::send('emails.seller.remove_seller', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('Delete Account');
        });
        return $user;
    }

    /*User Mailer*/
    public function sendUserMail($data, $user)
    {
        Mail::send('emails.customer.customer_register', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('Account Register!');
        });
        return $user;
    }

    public function sendRechargeMail($data, $user)
    {
        Mail::send('emails.recharge.recharge', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('LozyPay Recharge!');
        });
        return $user;
    }

    public function sendOrderMail($data, $user)
    {
        Mail::send('emails.order.product_invoice', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('LozyPay Order!');
        });
        return $user;
    }

    public function sendOrderUpdateMail($data, $user)
    {
        Mail::send('emails.order.order_update', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('LozyPay Order Update!');
        });
        return $user;
    }

    public function sendOrderShippingMail($data, $user)
    {
        Mail::send('emails.order.order_shipping', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('LozyPay Order Update!');
        });
        return $user;
    }

    public function sendContactUsMail($data, $email)
    {
        Mail::send('emails.contact_us', $data, function ($m) use ($email) {
            $m->replyTo($email)->subject('contact Us!');
            $m->to('info@lozypay.com', 'LozyPay');
        });
        return $email;
    }

    public function sendThankYouContactUsMail($data, $email)
    {
        Mail::send('emails.thank_you_contact_us', $data, function ($m) use ($email) {
            $m->replyTo('info@lozypay.com')->subject('Thank You!');
            $m->to($email, 'LozyPay');
        });
        return $email;
    }

    public function sendAddWalletMail($data, $user)
    {
        Mail::send('emails.wallet.add_to_wallet', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com')->subject('Wallet Amount!');
            $m->to($user->email, 'LozyPay');
        });
        return $user;
    }

    public function sendNotAddWalletMail($data, $user)
    {
        Mail::send('emails.wallet.failed_add_to_wallet', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com')->subject('Wallet Amount!');
            $m->to($user->email, 'LozyPay');
        });
        return $user;
    }

    public function sendForgotPasswordMail($data, $user)
    {
        Mail::send('emails.reset_password', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('Forgot Password');
        });
        return $user;
    }

    public function sendOrderCancelMail($data, $user)
    {
        Mail::send('emails.order.cancel_order', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('Order Cancel');
        });
        return $user;
    }


    public function sendOrderCancelSellerMail($data, $user, $seller)
    {
        Mail::send('emails.order.cancel_order_seller', $data, function ($m) use ($user, $seller) {
            $m->replyTo($user->email, 'LozyPay');
            $m->to($seller)->subject('Order Cancel');
        });
        return $user;
    }

    //Changes by me 02-08-2018 start
    public function sendOrderReturnMail($data, $user)
    {
        Mail::send('emails.order.return_order', $data, function ($m) use ($user) {
            $m->replyTo('info@lozypay.com', 'LozyPay');
            $m->to($user->email)->subject('Order Return');
        });
        return $user;
    }

    public function sendOrderReturnSellerMail($data, $user, $seller)
    {
        Mail::send('emails.order.return_order_seller', $data, function ($m) use ($user, $seller) {
            $m->replyTo($user->email, 'LozyPay');
            $m->to($seller)->subject('Order Return');
        });
        return $user;
    }
    //Changes by me 02-08-2018 over
}