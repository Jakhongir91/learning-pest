<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorsController extends Controller
{
    public function index()
    {
        $authors = Author::get();
        $result = [];

        foreach ($authors as $author) {
            $result[] = [
                "id" => $author->id,
                "name" => $author->name,
            ];
        }

        return [
            "data" => [
                "returnType" => "collection",
                "paginate" => false,
                "result" => $result,
            ]
        ];
        
        return response()->json(["data" => "success"]);
    }
}
