<?php

use App\Company;

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::insert([
            [
                'name' => "Thai Union Group Public (TUGP)",
                'logo' => '',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Thai Union Manufacturing (TUM)",
                'logo' => '',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Thai Union Seafood (TUS)",
                'logo' => '',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Pakfood",
                'logo' => '',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Lucky Union Food (LUF)",
                'logo' => '',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Songkla Canning PCL (SCC)",
                'logo' => '',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Pataya Food",
                'logo' => '',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Okeanos Food",
                'logo' => '',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Thai Union Feed Mill (TFM)",
                'logo' => '',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "Southeast Asia Packing and Canning Co.,Ltd (Sea Pac)",
                'logo' => '',
                'address' => '',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
