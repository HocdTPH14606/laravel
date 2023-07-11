<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;


class AttributeController extends Controller
{
    public function index(){
        return view('admin.attribute.list');
    }

    public function create(){
        return view('admin.attribute.create');
    }
    public function store(Request $request){
        dd($request->all());
        
    }
}
