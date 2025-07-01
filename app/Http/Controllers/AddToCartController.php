<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    public function store(Request $request,$id){
       dd($request->all());
    }
}
