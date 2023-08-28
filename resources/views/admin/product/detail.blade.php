@extends('layout.master')

@section('content-title', 'Chi tiết sản phẩm')

@section('content-button')
    <caption>
        <div class="rol-3 row">
            <form action="{{ route('admin.Product.List') }}" method="get">
                <div class="form-group row">
                    <input type="search" placeholder="Nhập tên sản phẩm">
                    <div class="input-group-prepend  ml-3 mr-3">
                        <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                    </div>
                </div>
            </form>
            <div class='ml-3'>
                <a href="{{ route('admin.Product.List') }}">
                    <button class='btn btn-success'>Danh sách</button>
                </a>
            </div>
        </div>
    </caption>
@endsection
@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible text-danger" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    {{-- hiển thị message đc gắn ở session::flash('success') --}}
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible text-danger" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    <table class='table table-striped verticle-middle table-responsive-sm text-center'>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh</th>
                <th>List ảnh</th>
                <th>Giá sản phẩm</th>
                <th>Số lượng</th>
                <th>Chi tiết</th>
                <th>Ngày thêm</th>
                <th>Cập nhật mới nhất</th>
                <th>Giảm giá</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td><img width="100px" height="100px" src="{{ Storage::url($product->image) }}" alt=""></td>
                <td>
                    @foreach ($album[] = explode('|', $product->list_images) as $item)
                        <img width="50px" height="50px" src="{{ Storage::url($item) }}" alt="">
                    @endforeach
                </td>
                <td style="color: red">{{ number_format($product->price, 0, '', '.') }} VNĐ</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ substr($product->detail, 0, 20) }}...</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <button class="toggle-class-discount" class="btn btn-info">
                        <input data-id="{{ $product->id }}" class="toggle-class-discount" type="checkbox"
                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active"
                            data-off="InActive" {{ $product->discount === 1 ? 'checked' : '' }}>
                        @if ($product->discount === 1)
                            <a style="color: blue"> Có</a>
                        @else
                            <a style="color: red"> không</a>
                        @endif
                    </button>
                </td>
            </tr>
        </tbody>
        {{-- prd(lấy id === vs id bên prd_attr)->prd_attr(attrValue_id === )->attriValue-> --}}
        {{-- vòng 1 prd->id === prd_attr->prd_id --}}
        {{-- vòng 2 prd_attr->attrValue === attrValue->id --}}
        {{--  attrValue --}}
    </table>
    @foreach ($productAttribute as $key => $prdattr)
        @if ($prdattr->product_id === $product->id)
            <div class="form-group"> 
                @foreach ($attributeValue as $key => $attrVl)
                    @if ($prdattr->attributeValue_id === $attrVl->id)
                        <label for="" class="form-label">{{ $attrVl->Attribute->name }}: {{ $attrVl->value }}</label> 
                    @endif
                @endforeach
            </div>
        @endif
    @endforeach
    <script src="https://code.jquery.com/jquery-3.5.0s.min.js"></script>
    <script>
        $('#search').change(function(even) {
            var _search = $('#search').val();
            if (_search == '6') {
                return true;
                // return route('admin.AttributeList', $name = 6)
            }
        })
    </script>
    <script>
        $(function() {
            $('.toggle-class-discount').change(function() {
                var discount = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/product/changeDiscount',
                    data: {
                        'discount': discount,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
@endsection
