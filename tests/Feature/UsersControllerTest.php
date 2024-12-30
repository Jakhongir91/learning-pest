<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

it("has authorization check", function () {
    $response = $this->get('/api/clients');

    $response->assertStatus(403);
});

it("returns success http status code", function () {
    $response = $this->get('/api/clients');

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