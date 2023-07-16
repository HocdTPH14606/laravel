<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AttributeController extends Controller
{
    public function list(Request $request)
    {
        $Attribute = Attribute::get();

        $name = $request->get('name');
        if ($name) {
            $Attribute = Attribute::where('name', 'like', '%' . $name . '%')->paginate(10);
        } else {
            $Attribute = Attribute::get();
        }

        return view(
            'admin.attribute.list',
            [
                'attribute' => $Attribute,
                'name' => $name
            ]
        );
    }

    public function create()
    {
        return view('admin.attribute.create');
    }

    public function store(AttributeRequest $request)
    {
        $request = $request->all();
        unset($request['_token']);
        $res  = Attribute::insert($request);
        if ($res > 0) {
            Session::flash('success', 'Thêm mới thành công');
            return redirect()->route('admin.Attribute.List');
        } else {
            Session::flash('error', 'Thêm mới không thành công');
            return redirect()->route('admin.Attribute.List');
        }
    }

    public function delete(Attribute $attr)
    {
        if ($attr->delete()) {
            Session::flash('success', 'Xóa thành công');
            return redirect()->back();
        }
    }

    public function edit($id, Request $request)
    {
        if ($id) {
            $request->session()->put('id', $id);
            $attribute = Attribute::where('id', '=', $id)->find($id);
            return view('admin.attribute.create', [
                'attribute' => $attribute,
            ]);
        }
        return back();
    }

    public function update(AttributeRequest $request)
    {
        if (session('id')) {
            $id = session('id');
            $request = $request->all();
            unset($request['_token']);
            $res  = Attribute::query()->find($id)->update($request);
            if ($res > 0) {
                Session::flash('success', 'Cập nhập thành công');
                return redirect()->route('admin.Attribute.List');
            } else {
                Session::flash('error', 'Cập nhập không thành công');
                return redirect()->route('admin.Attribute.List');
            }
        }
    }
}
