<?php

use App\Model\Services;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prepaidRec = Services::where('name', 'Prepaid Recharge')->limit(1)->first();
        $postpaidRec = Services::where('name', 'Postpaid Recharge')->limit(1)->first();
        $dthRec = Services::where('name', 'DTH Recharge')->limit(1)->first();
        $array = [
            [
                'name' => 'Aircel',
                'code' => 'AIR',
                'code1' => 'AC',
                'service' => $prepaidRec->id,
            ],
            [
                'name' => 'Airtel',
                'code' => 'A',
                'code1' => 'AT',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'Airtel Digital DTH TV',
                'code' => 'ATV',
                'code1' => '',
                'service' => $dthRec->id
            ],
            [
                'name' => 'BIG TV',
                'code' => 'BTV',
                'code1' => '',
                'service' => $dthRec->id
            ],
            [
                'name' => 'BSNL - 3G',
                'code' => 'B3',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'BSNL - STV',
                'code' => 'BR',
                'code1' => '',
                'service' => $dthRec->id
            ],
            [
                'name' => 'BSNL - TOPUP',
                'code' => 'BT',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'BSNL Recharge',
                'code' => 'BS',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'DISH TV',
                'code' => 'DTV',
                'code1' => '',
                'service' => $dthRec->id
            ],
            [
                'name' => 'DOCOME-SPECIAL',
                'code' => 'DS',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'DOCOMO',
                'code' => 'D',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'IDEA',
                'code' => 'I',
                'code1' => 'ID',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'LOOP MOBILE',
                'code' => 'LM',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'MTNL - Recharge',
                'code' => 'MTR',
                'code1' => 'DP',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'MTNL TOPUP',
                'code' => 'MTT',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'MTS',
                'code' => 'M',
                'code1' => 'MT',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'RECHARGE VIDEOCON',
                'code' => 'VD',
                'code1' => 'VD',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'RECHARGE VIDEOCON - SPL',
                'code' => 'VS',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'RELIANCE - JIO',
                'code' => 'RC',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'RELIANCE - GSM',
                'code' => 'RG',
                'code1' => 'RG',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'TATA INDICOM',
                'code' => 'T',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'TATASKY DTH TV',
                'code' => 'TTV',
                'code1' => '',
                'service' => $dthRec->id
            ],
            [
                'name' => 'UNINOR',
                'code' => 'U',
                'code1' => 'UN',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'UNINOR - SPL',
                'code' => 'US',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'VIDEOCON DTH TV',
                'code' => 'VTV',
                'code1' => '',
                'service' => $dthRec->id
            ],
            [
                'name' => 'VIRGIN - CDMA',
                'code' => 'VC',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'VIRGIN - GSM',
                'code' => 'VG',
                'code1' => '',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'Vodafone',
                'code' => 'V',
                'code1' => 'VF',
                'service' => $prepaidRec->id
            ],
            [
                'name' => 'Airtel Postpaid',
                'code' => 'PAT',
                'code1' => '',
                'service' => $postpaidRec->id
            ],
            [
                'name' => 'Bsnl Landline',
                'code' => 'LBS',
                'code1' => '',
                'service' => $postpaidRec->id
            ],
            [
                'name' => 'BSNL Postpaid',
                'code' => 'BP',
                'code1' => '',
                'service' => $postpaidRec->id
            ],
            [
                'name' => 'Idea Postpaid',
                'code' => 'IP',
                'code1' => '',
                'service' => $postpaidRec->id
            ],
            [
                'name' => 'Loop Mobile Postpaid',
                'code' => 'LMP',
                'code1' => '',
                'service' => $postpaidRec->id
            ],
            [
                'name' => 'MTNL Delhi Landline',
                'code' => 'LMT',
                'code1' => '',
                'service' => $postpaidRec->id
            ],
            [
                'name' => 'Reliance CDMA Postpaid',
                'code' => 'RCP',
                'code1' => 'CG',
                'service' => $postpaidRec->id
            ],
            [
                'name' => 'Reliance GSM Postpaid',
                'code' => 'RGP',
                'code1' => '',
                'service' => $postpaidRec->id
            ],
            [
                'name' => 'Tata Docomo Postpaid',
                'code' => 'DP',
                'code1' => 'TD',
                'service' => $postpaidRec->id
            ],
            [
                'name' => 'Tata Walky',
                'code' => 'TW',
                'code1' => '',
                'service' => $postpaidRec->id
            ],
            [
                'name' => 'Vodafone Postpaid',
                'code' => 'VP',
                'code1' => '',
                'service' => $postpaidRec->id
            ],
        ];

        foreach ($array as $item) {
            $operator = new \App\Model\Operators();
            $operator->name = $item['name'];
            $operator->op_code = $item['code'];
            $operator->op_code1 = $item['code1'];
            $operator->service_id = $item['service'];
            $operator->status = 1;
            $operator->save();
        }

    }
}
