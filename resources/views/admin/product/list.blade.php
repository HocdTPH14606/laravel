@extends('layout.master')


@section('content-title', 'Quản lý sản phẩm')
@section('content-button')
    <caption>
        <div class="rol-3 row">
            <form action="{{ route('admin.Product.List') }}" method="get">
                <div class="form-group row">
                    <input type="search" name="name" placeholder="Nhập tên sản phẩm">
                    <div class="input-group-prepend  ml-3 mr-3">
                        <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                    </div>
                </div>
            </form>
            <div class='ml-3'>
                <a href="{{ route('admin.Product.Create') }}">
                    <button class='btn btn-success'>Tạo mới</button>
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
                <th scope="col">STT</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh</th>
                <th>List ảnh</th>
                <th>Giá sản phẩm</th>
                <th>Số lượng</th>
                <th>Tình trạng</th>
                <th>Giảm giá</th>
                <th scope="col" colspan="3">hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $key => $attr)
                <tr>
                    <td>{{ $key++ }}</td>
                    <td>{{ $attr->name }}</td>
                    <td><img width="100px" height="100px" src="{{ Storage::url($attr->image) }}" alt=""></td>
                    <td>
                        @foreach ($album[] = explode('|', $attr->list_images) as $item)
                            <img width="50px" height="50px" src="{{ Storage::url($item) }}" alt="">
                        @endforeach
                    </td>
                    <td style="color: red">{{ number_format($attr->price, 0, '', '.') }} VNĐ</td>
                    <td>{{ $attr->quantity }}</td>
                    <td>
                        <button class="toggle-class-status" class="btn btn-info">
                            <input data-id="{{ $attr->id }}" class="toggle-class-status" type="checkbox"
                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                data-off="InActive" {{ $attr->status === 1 ? 'checked' : '' }}>
                            @if ($attr->status === 1)
                                <a style="color: blue">Còn hàng</a>
                            @elseif($attr->status === 2)
                                <a style="color: red"> Hết hàng</a>
                            @endif 
                        </button>
                    </td>
                    <td>
                        <button class="toggle-class-discount" class="btn btn-info">
                            <input data-id="{{ $attr->id }}" class="toggle-class-discount" type="checkbox"
                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                data-off="InActive" {{ $attr->discount === 1 ? 'checked' : '' }}>
                            @if ($attr->discount === 1)
                                <a style="color: blue"> Có</a>
                            @else
                                <a style="color: red"> không</a>
                            @endif
                        </button>
                    </td>
                    <td class="row">
                        <a href="{{ route('admin.Product.Edit', $attr->id) }}">
                            <button class='btn btn-warning'>Chỉnh sửa</button>
                        </a>
                        <a href="{{ route('admin.Product.Detail', $attr->id) }}"  style="padding-left: 5px">
                            <button class='btn btn-primary'>Chi tiết</button>
                        </a>
                        <form action="{{ route('admin.Product.Delete', $attr->id) }}" method="post"
                            style="padding-left: 5px">
                            @csrf
                            @method('DELETE')
                            <button class='btn btn-danger'
                                onclick="return confirm('bạn có chắc muốn xóa không?')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $product->links() }}
    </div>
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

        $(function() {
            $('.toggle-class-status').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 2;
                var id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/product/changeStatus',
                    data: {
                        'status': status,
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
