<?php

use Illuminate\Database\Seeder;

class CircleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                'name' => 'Andhra Pradesh',
                'code' => 'AP',
            ],
            [
                'name' => 'Assam',
                'code' => 'AS',
            ],
            [
                'name' => 'Bihar & Jharkhand',
                'code' => 'BR',
            ],
            [
                'name' => 'Chennai',
                'code' => 'CH',
            ],
            [
                'name' => 'Delhi',
                'code' => 'DL',
            ],
            [
                'name' => 'Gujarat',
                'code' => 'GJ',
            ],
            [
                'name' => 'Haryana',
                'code' => 'HR',
            ],
            [
                'name' => 'Himachal Pradesh',
                'code' => 'HP',
            ],
            [
                'name' => 'Jammu & Kashmir',
                'code' => 'JK',
            ],
            [
                'name' => 'Karnataka',
                'code' => 'KA',
            ],
            [
                'name' => 'Kerala',
                'code' => 'KL',
            ],
            [
                'name' => 'Kolkata',
                'code' => 'KO',
            ],
            [
                'name' => 'Maharashtra & Goa (except Mumbai)',
                'code' => 'MH',
            ],
            [
                'name' => 'Madhya Pradesh & Chhattisgarh',
                'code' => 'MP',
            ],
            [
                'name' => 'Mumbai',
                'code' => 'MU',
            ],
            [
                'name' => 'North East',
                'code' => 'NE',
            ],
            [
                'name' => 'Orissa',
                'code' => 'OR',
            ],
            [
                'name' => 'Punjab',
                'code' => 'PB',
            ],
            [
                'name' => 'Rajasthan',
                'code' => 'RJ',
            ],
            [
                'name' => 'Tamil Nadu',
                'code' => 'TN',
            ],
            [
                'name' => 'Uttar Pradesh',
                'code' => 'UE',
            ],
            [
                'name' => 'West Bengal',
                'code' => 'WB',
            ],
        ];

        foreach ($array as $item){
            $circle  = new \App\Model\Circle();
            $circle->name = $item['name'];
            $circle->code = $item['code'];
            $circle->save();
        }
    }
}
