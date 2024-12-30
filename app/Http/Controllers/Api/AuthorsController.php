<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index()
    {
        return response()->noContent();
    }
}
