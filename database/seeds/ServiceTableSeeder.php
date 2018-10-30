<?php

use App\Model\Services;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
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
                'name' => 'Prepaid Recharge',
            ],
            [
                'name' => 'Postpaid Recharge',
            ],
            [
                'name' => 'DataCard',
            ],
            [
                'name' => 'DTH Recharge',
            ],
            [
                'name' => 'Electricity',
            ],
            [
                'name' => 'Gas',
            ],
            [
                'name' => 'Water',
            ],
            [
                'name' => 'Insurance',
            ],
            [
                'name' => 'Broadband',
            ],
            [
                'name' => 'Landline',
            ],
            [
                'name' => 'Bus',
            ],
            [
                'name' => 'Domestic Hotel',
            ],
            [
                'name' => 'International Hotel',
            ],
            [
                'name' => 'Domestic Flights',
            ],
            [
                'name' => 'International Flights',
            ],
            [
                'name' => 'DMT',
            ],
            [
                'name' => 'ECommerce',
            ],
            [
                'name' => 'Multi Vendor',
            ],
        ];

        foreach ($array as $item) {
            $service = new Services();
            $service->name = $item['name'];
            $service->slug = $service->getSlugForCustom($item['name']);
            $service->save();
        }
    }
}
