<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

it("has authorization check", function () {
    $response = $this->withHeaders(["Accept" => "application/json"])->get("/api/authors");

    $response->assertStatus(401);
});

it("returns success http status code", function () {
    $user = new App\Models\User();
    $user->name = 'test_user';
    $user->email = 'test_email';
    $user->password = bcrypt('password');
    $user->save();

    $token = $user->createToken("test_token");

    $response = $this->withHeaders([
        "Authorization" => "Bearer " . $token->plainTextToken,
        "Accept" => "application/json",
    ])
                     ->get('/api/authors');
    $response = $this->get('/api/authors');

    $response->assertStatus(200);
});

it("shows list of clients without pagination", function () {
    $response = $this->get('/api/clients'); 

    $response->assertJson('
        {
            "data": {
            "returnType": "collection",
            "paginate": false,
            "result": [
                {
                    "id": 1,
                    "name": "Ali"
                },
                {
                    "id": 1,
                    "name": "Ali"
                }
            ]
            }
        }
    ');
});