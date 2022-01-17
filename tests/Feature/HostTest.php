<?php

namespace Tests\Feature;

use App\Http\Controllers\HostController;
use App\Models\Host;
use App\Models\Network;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HostTest extends TestCase
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

        $network = Network::factory()->create();
        $network->save();

        $response = $this->actingAs($user)->post('/host',[
                '_token' => csrf_token(),
                'network_id' => $network->id,
                'hostname' => 'test',
                'address' => '62.206.254.199'
            ]
        );

        $this->assertDatabaseHas(Host::class, [
            'network_id' => $network->id,
            'hostname' => 'test',
            'address' => '62.206.254.199'
        ]);

    }

    public function test_create_invalid()
    {
        $this->withoutMiddleware();
        $user = User::factory()->create();
        $user->save();

        $network = Network::factory()->create();

        $response = $this->actingAs($user)->post('/host',[
                '_token' => csrf_token(),
                'network_id' => $network->id,
                'hostname' => 'test',
                'address' => '62.206.278.225'
            ]
        );

        $this->assertDatabaseMissing(Host::class, [
            'network_id' => $network->id,
            'hostname' => 'test',
            'address' => '62.206.278.225'
        ]);
    }
}
