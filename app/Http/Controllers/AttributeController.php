<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\AttributeRequest;
use App\http\Requests\AttributeValueRequest;
use App\Models\Attribute;
use App\Models\attributeValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AttributeController extends Controller
{
    public function list(Request $request)
    {
        $attribute = Attribute::where('status', '=', 1)->get();
        $name = $request->get('name');
        if ($name) {
            $AttributeV = attributeValue::where('status', '=', 1)->where('attribute_id', 'like', '%' . $name . '%')->with('Attribute')->paginate(10);
        } else {
            $AttributeV = attributeValue::where('status', '=', 1)->with('Attribute')->orderBy('attribute_id')->paginate(10);
        }
        return view(
            'admin.attribute.list',
            [
                'AttributeV' => $AttributeV,
                'attribute' => $attribute,
                'name' => $name
            ]
        );
    }

    public function create()
    {
        $attributeV = Attribute::where('status', '=', 1)->get();

        return view(
            'admin.attribute.create',
            [
                'attributeV' => $attributeV,
            ]
        );
    }

    public function store1(AttributeRequest $request)
    {
        $request = $request->all();
        unset($request['_token']);
        $res  = Attribute::insert($request);
        if ($res > 0) {
            Session::flash('success', 'Thêm mới thành công');
            return back();
        } else {
            Session::flash('error', 'Thêm mới không thành công');
            return back();
        }
    }

    public function store2(AttributeValueRequest $request)
    {
        $request = $request->all();
        unset($request['_token']);
        $res  = attributeValue::insert($request);
        if ($res > 0) {
            Session::flash('success', 'Thêm mới thành công');
            return back();
        } else {
            Session::flash('error', 'Thêm mới không thành công');
            return back();
        }
    }
    // public function delete(Attribute $attr)
    // {
    //     if ($attr->delete()) {
    //         Session::flash('success', 'Xóa thành công');
    //         return redirect()->back();
    //     }
    // }
    public function delete1($id)
    {
        if (!empty($id)) {
            $Attribute = attributeValue::where('id', '=', $id);
            $data = [
                'status' => 0
            ];
            $Attribute->update($data);
            Session::flash('success', 'Xóa thành công');
            return redirect()->back();
        }
    }
    public function delete2($id)
    {
        $AttributeV = attributeValue::where('id', '=', $id)->find($id);
        if (!empty($id)) {
            $Attribute = Attribute::where('id', '=', $AttributeV->attribute_id);
            $data = [
                'status' => 0
            ];
            $Attribute->update($data);
            Session::flash('success', 'Xóa thành công');
            return redirect()->back();
        }
    }
    public function edit($id, Request $request)
    {
        $attributeV = attribute::where('status', '=', 1)->get();
        if ($id) {
            $request->session()->put('id', $id);
            $attributeValueID = attributeValue::where('id', '=', $id)->find($id); // attributeValueID bảng giá trị
            $attributeID = Attribute::where('id', '=', $attributeValueID->attribute_id)->find($attributeValueID->attribute_id);
            // attributeID bảng tên thuộc tính
            return view('admin.attribute.create', [
                'attributeValueID' => $attributeValueID,
                'attributeID' => $attributeID,
                'attributeV' => $attributeV
            ]);
        }
        return back();
    }

    public function update1(AttributeRequest $request)
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
    public function update2(AttributeValueRequest $request)
    {
        if (session('id')) {
            $id = session('id');
            $request = $request->all();
            unset($request['_token']);
            $res  = attributeValue::query()->find($id)->update($request);
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
