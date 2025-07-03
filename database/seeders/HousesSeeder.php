<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Houses;

class HousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for 10 houses
        $houses = [
            [
                'name' => 'Cozy Cottage',
                'city' => 'Nairobi',
                'price' => 150000.00,
                'location' => 'nairobi',
                'bedrooms' => 2,
                'description' => 'with parking',
                'status' => 'available',
            ],
            [
                'name' => 'Modern Apartment',
                'city' => 'Mombasa',
                'price' => 250000.00,
                'location' => 'Githurai',
                'bedrooms' => 3,
                'description' => 'self contained',
                'status' => 'available',
            ],
            [
                'name' => 'Beach Villa',
                'city' => 'Diani',
                'price' => 450000.00,
                'location' => 'Juja',
                'bedrooms' => 4,
                'description' => 'spacious rooms',
                'status' => 'occupied',
            ],
            [
                'name' => 'Urban Loft',
                'city' => 'Kisumu',
                'price' => 180000.00,
                'location' => 'Westlands',
                'bedrooms' => 2,
                'description' => 'Spacious rooms',
                'status' => 'available',
            ],
            [
                'name' => 'Family Bungalow',
                'city' => 'Nakuru',
                'price' => 300000.00,
                'location' => 'Muthaiga',
                'bedrooms' => 3,
                'description' => 'with parking ',
                'status' => 'available',
            ],
            [
                'name' => 'Luxury Mansion',
                'city' => 'Eldoret',
                'price' => 750000.00,
                'location' => 'Karen',
                'bedrooms' => 5,
                'description' => 'water available',
                'status' => 'occupied',
            ],
            [
                'name' => 'City Studio',
                'city' => 'Nairobi',
                'price' => 100000.00,
                'location' => 'Dolhnhome',
                'bedrooms' => 1,
                'description' => 'wifi free',
                'status' => 'available',
            ],
            [
                'name' => 'Seaside Condo',
                'city' => 'Mombasa',
                'price' => 320000.00,
                'location' => 'Mirema',
                'bedrooms' => 3,
                'description' => 'quite place',
                'status' => 'available',
            ],
            [
                'name' => 'Country House',
                'city' => 'Naivasha',
                'price' => 280000.00,
                'location' => 'Joska',
                'bedrooms' => 4,
                'description' => 'water available',
                'status' => 'occupied',
            ],
            [
                'name' => 'Downtown Flat',
                'city' => 'Nairobi',
                'price' => 200000.00,
                'location' => 'Westlands',
                'bedrooms' => 2,
                'description' => 'free internet',
                'status' => 'available',
            ],
        ];

        // Insert houses into database
        foreach ($houses as $house) {
            Houses::create($house);
        }
    }
}
