@extends('layout.master')

@section('title', 'Tạo mới sản phẩm')

@section('content-title', 'Tạo mới sản phẩm')

@section('content')
    <form action="{{ isset($product) ? route('admin.Product.Update') : route('admin.Product.Store') }}" method="POST"
        class="was-validated" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control " id="name" placeholder="" name="name"
                        value="{{ isset($product) ? $product->name : old('name') }}" required>
                    <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
                    {{-- @error('name')  
                            <span style="color: red"> {{ $messages }}
                                 </span> @enderror --}}
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Ảnh chính</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="image"
                            @if (isset($product)) @else required="required" @endif>
                        <label class="custom-file-label" for="customFile"
                            name='image'>{{ isset($product) ? $product->image : old('name') }}</label>
                    </div>
                    @if (isset($product))
                        <img width="150px" height="150px" src="{{ Storage::url($product->image) }}" alt=""
                            class="pt-1">
                    @else
                    @endif
                    {{-- @error('name')
                        <span style="color: red"> {{ $messages }} </span>
                    @enderror --}}
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">List ảnh</label>

                    @if (isset($product))
                        {{-- @foreach ($album[] = explode('|', $product->list_images) as $item)
                            <img width="150px" height="150px" src="{{ Storage::url($item) }}" alt="{{ $item }}"
                                class="pt-1">
                        @endforeach --}}
                        @foreach ($album as $key => $item)
                            <div style="margin-bottom: 20px">
                                <input name="{{ 'list_images' . $key }}" id="list_images" width="50px" type="file"
                                    value=" {{ $item }} ">
                                <img id="list_images" style="width:150px; height:120px " src="{{ Storage::URL($item) }}"
                                    alt="product-image" />
                            </div><br>
                        @endforeach
                    @else
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="list_images[]"
                                multiple="multiple">
                            <label class="custom-file-label" for="customFile" name='list_images'>list images</label>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Giá sản phẩm</label>
                    <input type="number" class="form-control " id="price" placeholder="" name="price"
                        value="{{ isset($product) ? $product->price : old('price') }}" required>
                    <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
                    {{-- @error('name')
                        <span style="color: red"> {{ $messages }} </span>
                    @enderror --}}
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Số lượng</label>
                    <input type="number" class="form-control " id="quantity" placeholder="" name="quantity"
                        value="{{ isset($product) ? $product->quantity : old('quantity') }}" required>
                    {{-- <div class="valid-feedback">Valid.</div> --}}
                    <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
                    {{-- @error('name')
                            <span style="color: red"> {{ $messages }} </span>
                        @enderror --}}
                </div>
            </div>
            {{-- vòng lặp bảng attribute lấy tên thuộc tính và id thuộc tính --}}
            <div class="col-6">
                @foreach ($attribute_All as $key => $attr_all)
                    <div class="mb-3">
                        <label for="my-input">{{ $attr_all->name }}</label>
                        <select name="id_attr[]" class="custom-select">
                            <option value="">Chọn {{ $attr_all->name }}</option>
                            @foreach ($attributeValue_All as $key => $attrValue_all)
                                @if ($attrValue_all->attribute_id === $attr_all->id)
                                    <option value="{{ $attrValue_all->id }}"
                                        @isset($productAttribute_All)
                                            @foreach ($productAttribute_All as $key => $PdrAttr_all)
                                                @if ($PdrAttr_all->attributeValue_id === $attrValue_all->id)   selected   @endif
                                            @endforeach
                                        @endisset>
                                        {{ $attrValue_all->value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endforeach
                <div class="mb-3">
                    <label for="my-input">Mô tả </label>
                    <textarea name="detail" id="timymce" class="form-control">{{ isset($product) ? $product->detail : '' }}</textarea>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Cập nhật' : 'Tạo mới' }}</button>
        </div>
    </form>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
