<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Author;

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
    $user = new App\Models\User();
    $user->name = 'test_user';
    $user->email = 'test_email';
    $user->password = bcrypt('password');
    $user->save();

    $token = $user->createToken("test_token");

    $authorNames = ["autorh1", "author2"];
    $authors = [];

    foreach($authorNames as $authorName) {
        $author = new Author();
        $author->name = $authorName;
        $author->save();

        $authors[] = $author;
    }

    $result = [];
    foreach ($authors as $author) {
        $result[] = [
            "id" => $author->id,
            "name" => $author->name,
        ];
    }

    $responseToAssert = [
        "data" => [
            "returnType" => "collection",
            "paginate" => false,
            "result" => $result,
        ]
    ];

    // $responseToAssert = json_encode($responseToAssert);
    
    $response = $this
    ->withHeaders([
        "Authorization" => "Bearer " . $token->plainTextToken,
        "Accept" => "application/json",
    ])
    ->get('/api/authors'); 

    // dd($responseToAssert);
    // dd($response->json(), $responseToAssert);
    expect($response->json())->toEqual($responseToAssert);



    // $response->assertJson($responseToAssert);
});