<?php
/**
 * Created by PhpStorm.
 * User: xyz
 * Date: 2/23/2018
 * Time: 4:50 PM
 */

namespace App\Classes;


use App\Model\User;
use App\Model\WalletHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RechargeManager
{
    /**
     * @var UserManager
     */
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function saveRechargeDetails($recharge, $recharge_num, $operator, $circle, $amount)
    {
        if (Auth::check()) {
            $recharge->user_id = Auth::user()->id;
        } else {
            if (!Session::has('recharge_temp_id')) {
                $rechargeTempId = uniqid();
                Session::put('recharge_temp_id', $rechargeTempId);
                $recharge->recharge_temp_id = Session::get('recharge_temp_id');
            }
        }
        $recharge->recharge_num = $recharge_num;
        $recharge->operator_id = $operator;
        if ($circle) {
            $recharge->circle = $circle;
        }
        $recharge->amount = $amount;
        $uniqueId = $this->userManager->randomKey();
        $recharge->transaction_id = $uniqueId;
        return $recharge;
    }

    public function curl_get($url)
    {
        $ch = curl_init();
        $timeout = 300; // set to zero for no timeout
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function geturl($url)
    {
        $cookie = tempnam("/tmp", "CURLCOOKIE");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    # required for https urls
        curl_setopt($ch, CURLOPT_MAXREDIRS, 15);

        $html = curl_exec($ch);
        $status = curl_getinfo($ch);
        curl_close($ch);

        if ($status['http_code'] != 200) {
            if ($status['http_code'] == 301 || $status['http_code'] == 302) {
                list($header) = explode("\r\n\r\n", $html, 2);
                $matches = array();
                preg_match("/(Location:|URI:)[^(\n)]*/", $header, $matches);
                $url1 = trim(str_replace($matches[1], "", $matches[0]));
                $url_parsed = parse_url($url1);
                return (isset($url_parsed)) ? $this->curl_get($url1) : '';
            }
        }
        return $html;
    }

    public function updateWalletHistory($walletHistory, $recharge)
    {
        $user = User::find($recharge->user_id);
        $walletHistory->user_id = $user->id;
        $walletHistory->transaction_id = $recharge->transaction_id;
        $walletHistory->tran_mob_num = $recharge->recharge_num;
        $walletHistory->current_amount = $user->wallet_amount;
        $walletHistory->amount = $recharge->amount;
        if ($user->wallet_amount > $recharge->amount) {
            $walletHistory->next_amount = $user->wallet_amount - $recharge->amount;
        } else {
            $walletHistory->next_amount = 0;
        }
        $walletHistory->tran_type = WalletHistory::DEBIT;
        $walletHistory->status = WalletHistory::SUCCESS;
        $walletHistory->save();
        return $user;
    }

    public function updateFailWalletHistory($walletHistory, $recharge, $response)
    {
        $user = User::find($recharge->user_id);
        $walletHistory->user_id = $user->id;
        $walletHistory->transaction_id = $recharge->transaction_id;
        $walletHistory->tran_mob_num = $recharge->recharge_num;
        $walletHistory->current_amount = $user->wallet_amount;
        $walletHistory->amount = $response['amount'];
        $walletHistory->next_amount = $user->wallet_amount + $response['amount'];
        $walletHistory->tran_type = WalletHistory::CREDIT;
        $walletHistory->save();
        return $user;
    }
}