<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    public function run()
    {
        $houses = [
            ['name' => 'Ocean Breeze Villa', 'description' => 'A luxurious beachfront villa with stunning ocean views.', 'price' => 1200000.00, 'location' => 'Malibu, CA'],
            ['name' => 'Mountain Retreat', 'description' => 'A cozy cabin nestled in the Rockies, perfect for nature lovers.', 'price' => 350000.00, 'location' => 'Aspen, CO'],
            ['name' => 'Urban Loft', 'description' => 'Modern open-plan loft in the heart of the city.', 'price' => 750000.00, 'location' => 'New York, NY'],
            ['name' => 'Suburban Haven', 'description' => 'Spacious family home with a large backyard.', 'price' => 450000.00, 'location' => 'Austin, TX'],
            ['name' => 'Lakeview Cottage', 'description' => 'Charming cottage by the lake, ideal for weekend getaways.', 'price' => 280000.00, 'location' => 'Lake Tahoe, NV'],
            ['name' => 'Desert Oasis', 'description' => 'Unique adobe-style home with a private pool.', 'price' => 600000.00, 'location' => 'Scottsdale, AZ'],
            ['name' => 'Historic Townhouse', 'description' => 'Restored 19th-century townhouse with original features.', 'price' => 900000.00, 'location' => 'Boston, MA'],
            ['name' => 'Countryside Estate', 'description' => 'Expansive estate with acres of rolling hills.', 'price' => 2000000.00, 'location' => 'Nashville, TN'],
            ['name' => 'City Penthouse', 'description' => 'Top-floor penthouse with panoramic skyline views.', 'price' => 1500000.00, 'location' => 'Chicago, IL'],
            ['name' => 'Beach Bungalow', 'description' => 'Quaint bungalow steps from the sandy shore.', 'price' => 500000.00, 'location' => 'Santa Monica, CA'],
        ];

        foreach ($houses as $house) {
            House::create($house);
        }
    }
}