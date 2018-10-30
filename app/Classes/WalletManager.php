<?php
/**
 * Created by PhpStorm.
 * User: xyz
 * Date: 3/16/2018
 * Time: 1:12 PM
 */

namespace App\Classes;


use App\Model\WalletHistory;
use Illuminate\Support\Facades\Auth;

class WalletManager
{
    public function random_num($size)
    {
        $alpha_key = '';
        $keys = range('A', 'Z');

        for ($i = 0; $i < 2; $i++) {
            $alpha_key .= $keys[array_rand($keys)];
        }

        $length = $size - 2;

        $key = '';
        $keys = range(0, 9);

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $alpha_key . $key;
    }

    public function saveWalletMoney($walletHistory, $user, $amount, $uniqueId)
    {
        $walletHistory->user_id = $user->id;
        $walletHistory->transaction_id = $uniqueId;
        $walletHistory->amount = $amount;
        $walletHistory->tran_type = WalletHistory::CREDIT;
        return $walletHistory;
    }

    public function saveReceiverMoney($receiverWallet, $senderUser, $receiverUser, $request)
    {
        $receiverWallet->user_id = $receiverUser->id;
        $receiverWallet->transaction_id = $this->random_num(10);
        $receiverWallet->tran_mob_num = $receiverUser->mobile_num;
        $receiverWallet->received_mob_num = $senderUser->mobile_num;
        $receiverWallet->current_amount = $receiverUser->wallet_amount;
        $receiverWallet->amount = $request->get('money');
        $receiverWallet->next_amount = $receiverUser->wallet_amount + $request->get('money');
        $receiverWallet->tran_type = WalletHistory::CREDIT;
        $receiverWallet->status = WalletHistory::SUCCESS;
        $receiverWallet->save();

        return $receiverWallet;
    }

    public function saveSenderMoney($senderWallet, $receiverUser, $request)
    {
        $senderWallet->user_id = Auth::user()->id;
        $senderWallet->transaction_id = $this->random_num(10);
        $senderWallet->tran_mob_num = $receiverUser->mobile_num;
        $senderWallet->current_amount = Auth::user()->wallet_amount;
        $senderWallet->amount = $request->get('money');
        $senderWallet->next_amount = Auth::user()->wallet_amount - $request->get('money');
        $senderWallet->tran_type = WalletHistory::DEBIT;
        $senderWallet->status = WalletHistory::SUCCESS;
        $senderWallet->save();
        return $senderWallet;
    }
}