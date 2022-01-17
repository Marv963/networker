<?php

namespace Tests\Feature;

use App\Http\Controllers\NetworkController;
use App\Models\Network;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class NetworkTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_valid()
    {
        $this->withoutMiddleware();
        $user = User::factory()->create();
        $user->save();
        $response = $this->actingAs($user)->post('/network',[
                '_token' => csrf_token(),
                'netaddr' => '62.206.254.192',
                'netmask' => '27'
            ]
        );

        $this->assertDatabaseHas(Network::class, [
            'net_addr' => '62.206.254.192',
            'netmask' => '27',
            'broadcast_addr' => '62.206.254.223',
            'maxhost' => '30'
        ]);
    }

    public function test_create_invalid()
    {
        $this->withoutMiddleware();
        $user = User::factory()->create();
        $user->save();
        $response = $this->actingAs($user)->post('/network',[
                '_token' => csrf_token(),
                'netaddr' => '62.206.278.192',
                'netmask' => '33'
            ]
        );

        $this->assertDatabaseMissing(Network::class, [
            'net_addr' => '62.206.278.192',
            'netmask' => '33'
        ]);
    }
}
