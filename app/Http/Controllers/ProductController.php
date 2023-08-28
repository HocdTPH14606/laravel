<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\attributeValue;
use App\Models\product as ModelsProduct;
use App\Models\productAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function list(Request $request)
    { 
        $name = $request->get('name');
        if ($name) {
            $product = product::where('status', '!=', 0)->where('name', 'like', '%' . $name . '%')->paginate(10); 
        } else {
            $product = product::where('status', '!=', 0)->paginate(10); 
        } 
        return view('admin.product.list', ['product' => $product, 'name' => $name]);
    }

    public function create()
    {
        $attribute_All = Attribute::where('status', '=', 1)->get();
        $attributeValue_All = attributeValue::where('status', '=', 1)->get();

        return view('admin.product.create', [
            'attribute_All' => $attribute_All,
            'attributeValue_All' => $attributeValue_All,
        ]);
    }
    public function store(ProductRequest $request)
    {
        $product = new product();
        $requests = $request->all();
        unset($requests['_token']);
        $product->fill($requests);

        // lấy ký tự sku thương hiệu
        $id_attrTH = $request->id_attr[0];
        $attrTH = Attribute::where('id', '=', $id_attrTH)->find($id_attrTH);
        $SkuTH =  strtoupper(substr($attrTH->value, 0, 2)); // lấy 2 ký tự đầu của tên hãng
        // lấy ký tự sku dung tích
        $id_attrDT = $request->id_attr[1];
        $attrDT = Attribute::where('id', '=', $id_attrDT)->find($id_attrDT);
        $SkuDT = trim($attrDT->value, " ml"); // trim xóa ký tự khỏi chuỗi 
        // ký tự random         
        $KiTuRandom = Str::random(10);
        $sku = "$SkuTH$SkuDT$KiTuRandom";
        $product->sku = $sku;
        //images
        if ($request->file('image')) {
            // hàm uploadFile này đc định nghĩa ra để upload ảnh bản ghi nếu có 
            $product->image = $this->uploadFile($request->file('image'));
        }
        if ($request->file('list_images')) {
            // hàm uploadFile này đc định nghĩa ra để upload ảnh bản ghi nếu có 
            $array = $request->file(('list_images'));
            // dd($array); 
            // dd(implode("|", ));
            $file = [];
            foreach ($array as $item) {
                $filename =  time() . '_' .  $item->getClientOriginalName(); // time để lấy thời gian thêm ảnh (độc nhất cho sản phẩm)
                $item->storeAs('ListImage', $filename,  'public');
                $file[] =    $item->storeAs('ListImage', $filename,  'public');
            }
            $product->list_images = implode("|", $file);
        }
        $res  = $product->save();
        foreach ($request->id_attr as $value) {
            productAttribute::create([
                'product_id' => $product->id,
                'attributeValue_id' => $value
            ]);
        }
        if ($res > 0) {
            Session::flash('success', 'Thêm mới thành công');
            return redirect()->route('admin.Product.List');
        } else {
            Session::flash('error', 'Thêm mới không thành công');
            return redirect()->route('admin.Product.List');
        }
    }

    public function edit($product, Request $request)
    {
        $request->session()->put('id', $product);
        $productAttribute_All = productAttribute::where('product_id', '=', $product)->get();
        $attribute_All = Attribute::where('status', '=', 1)->get();
        $product = Product::where('status', '=', 1)->find($product);
        $attributeValue_All = attributeValue::where('status', '=', 1)->get();

        $album = explode('|', $product->list_images);

        return view('admin.product.create', ['product' => $product, 'album' => $album, 'attribute_All' => $attribute_All, 'productAttribute_All' => $productAttribute_All, 'attributeValue_All' => $attributeValue_All]);
    }

    public function update(ProductRequest $request)
    {
        if (session('id')) {
            $id = session('id');
            $product = Product::query()->find($id);
            $requests = $request->all();
            $product->fill($requests);
            $albumCurrent  = Product::find($id);
            $arrayLIstImg = explode('|', $albumCurrent->list_images);

            if ($request->file('image') != null) {
                $product['image'] = $this->uploadFile($request->file('image'));
            }
            if ($request->file('image')) {
                // dd($request->file('car_list_image'));
            }
 
            if ($request->file('list_images')) {
                // dd($request->file('list_images'));
            }
            for ($i = 0; $i < count($arrayLIstImg); $i++) {
                // dd($arrayLIstImg); 
                if ($request->file('list_images' . $i)) {
                    $filename =  time() . '_' . ($request->file('list_images' . $i))->getClientOriginalName();
                    $fileNameCurrent = $request->file('list_images' . $i)->storeAs('ListImage', $filename,  'public');
                    $arrayLIstImg[$i] = $fileNameCurrent;

                     unset($product['list_images' . $i]);

                }
            }

            $product['list_images'] = implode("|", $arrayLIstImg);  
            unset($product['_token']); 
 
            productAttribute::where('product_id', '=', $id)->delete();
            foreach ($request->id_attr as $value) {
                productAttribute::create([
                    'product_id' => $id,
                    'attributeValue_id' => $value
                ]);
            }  
            

            $res = $product->update(); 

            if ($res > 0) {
                Session::flash('success', "Update thành công");
                return redirect()->route('admin.Product.List');
            } else {
                Session::flash('success', "Update không thành công");
                return redirect()->route('admin.Product.List');
            }
        }
    }

    public function detail($id, Request $request)
    {
        $productAttribute = productAttribute::all();
        $attributeValue = attributeValue::where('status', '=', 1)->get();
        $product = Product::where('status', '=', 1)->find($id);
        return view('admin.product.detail', ['product' => $product, 'productAttribute' => $productAttribute, 'attributeValue' => $attributeValue]);
    }

    public function delete($product)
    {
        if (!empty($product)) {
            $Product = Product::where('id', '=', $product);
            $data = [
                'status' => 0
            ];
            $Product->update($data);
            Session::flash('success', 'Xóa thành công');
            return redirect()->back();
        }
    }
    public function uploadFile($file)
    {
        $filename =  time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('imageSP', $filename,  'public');
    }

    public function changeStatus(Request $request)
    {
        $Product = Product::find($request->id);
        $Product->status = $request->status;
        $Product->save();
        return response()->json(['success' => 'Status change successfully.']);
    }
    public function changeDiscount(Request $request)
    {
        $Product = Product::find($request->id);
        $Product->discount = $request->discount;
        $Product->save();
        return response()->json(['success' => 'Status change successfully.']);
    }
}
