<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorsController extends Controller
{
    public function index()
    {
        
        return response()->json(["data" => "success"]);
    }
}
