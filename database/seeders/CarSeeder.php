<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [
            [
                'brand' => 'Toyota',
                'model' => 'Avanza',
                'license_plate' => 'B 1234 ABC',
                'daily_rate' => 350000,
                'is_available' => true,
            ],
            [
                'brand' => 'Honda',
                'model' => 'Civic',
                'license_plate' => 'D 5678 DEF',
                'daily_rate' => 500000,
                'is_available' => true,
            ],
            [
                'brand' => 'Suzuki',
                'model' => 'Ertiga',
                'license_plate' => 'E 9876 GHI',
                'daily_rate' => 400000,
                'is_available' => true,
            ],
            [
                'brand' => 'Mitsubishi',
                'model' => 'Pajero',
                'license_plate' => 'F 2468 JKL',
                'daily_rate' => 750000,
                'is_available' => true,
            ],
            [
                'brand' => 'Daihatsu',
                'model' => 'Xenia',
                'license_plate' => 'G 1357 MNO',
                'daily_rate' => 320000,
                'is_available' => true,
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
