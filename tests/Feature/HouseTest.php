<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\House;
use Tests\TestCase;

class HouseTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Seed 10 records (from HouseSeeder.php)
        $this->artisan('db:seed');
    }

    #[test]
    public function authenticated_user_can_filter_by_price_range()
    {
        $response = $this->actingAs($this->user)->get(route('houses.index', [
            'min_price' => 500000,
            'max_price' => 1000000,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('houses.index');
        $response->assertViewHas('houses', function ($houses) {
            return $houses->count() > 0 && 
                   $houses->every(fn($house) => $house->price >= 500000 && $house->price <= 1000000);
        });
    }

    #[test]
    public function authenticated_user_can_filter_by_location_and_sort()
    {
        $response = $this->actingAs($this->user)->get(route('houses.index', [
            'location' => 'Malibu',
            'sort' => 'desc',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('houses.index');
        $response->assertViewHas('houses', function ($houses) {
            return $houses->count() === 1 && 
                   $houses->first()->location === 'Malibu, CA' && 
                   $houses->isSortedBy('price', 'desc');
        });
    }

    #[test]
    public function authenticated_user_can_filter_by_property_type()
    {
        $response = $this->actingAs($this->user)->get(route('houses.index', [
            'property_type' => 'villa',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('houses.index');
        $response->assertViewHas('houses', function ($houses) {
            return $houses->count() > 0 && 
                   $houses->every(fn($house) => stripos($house->description, 'villa') !== false);
        });
    }
}