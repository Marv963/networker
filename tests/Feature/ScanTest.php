<?php

namespace Tests\Feature;

use App\Models\Host;
use App\Models\Network;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;;

class ScanTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_scan_host_avail_not_existing()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();

        $this->actingAs($user)->post('/network',[
                '_token' => csrf_token(),
                'netaddr' => '62.206.254.196',
                'netmask' => '30'
            ]
        );

        $response = $this->actingAs($user)->getJson('/scan');
        $response->assertJson([
            'result' => 'success',
        ]);

        $this->AssertDatabaseHas(Host::class, [
            'address' => '62.206.254.197'
        ]);
        $this->AssertDatabaseHas(Host::class, [
            'address' => '62.206.254.198'
        ]);

    }

    public function test_scan_host_not_avail_not_existing()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/network',[
                '_token' => csrf_token(),
                'netaddr' => '62.206.254.192',
                'netmask' => '30'
            ]
        );

        $response = $this->get('/scan');

        $this->AssertDatabaseMissing(Host::class, [
            'address' => '62.206.254.193'
        ]);
        $this->AssertDatabaseMissing(Host::class, [
            'address' => '62.206.254.194'
        ]);
    }

    public function test_scan_host_avail_existing_up()
    {
        $this->assertTrue(true);
    }

    public function test_scan_host_avail_existing_down()
    {
        $this->assertTrue(true);
    }
}
