<?php

namespace App\Http\Controllers;

use App\Models\Reference\Category;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    public function categories()
    {
        $data = Category::select('id', 'name')->get();
        return response()->json($data);
    }
}
