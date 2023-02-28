<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserAuthTest extends TestCase
{
    use WithFaker;

    public function test_api_auth_register()
    {
        $data = [
            'name' => $this->faker()->name(),
            'email' => $this->faker()->email(),
            'password' => $this->faker()->password(8),
        ];
        $response = $this->postJson('api/auth/register', $data);


        $response->assertStatus(200);
        $this->assertDatabaseHas('users', Arr::only($data, ['email', 'name']));
    }

    public function test_api_auth_login()
    {
        $password = $this->faker()->password(8);

        $data = [
            'name' => $this->faker()->name(),
            'email' => $this->faker()->email(),
            'password' => $password,
        ];

        $user = User::query()->make($data);
        $user->password = Hash::make($password);
        $user->save();

        $response = $this->postJson('api/auth/login', $data);
        
        $response->assertJson([
            'data' => [
                'name' => $data['name'],
                'email' => $data['email'],
            ]
        ]);

        $response->assertStatus(200);
    }

    public function test_api_auth_logout()
    {
        $response = $this->postJson('api/auth/logout');
        $response->assertOk();
    }


}
