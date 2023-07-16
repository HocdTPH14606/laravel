@extends('layout.master')

@section('title', 'Quản lý thuộc tính')

@section('content-title', 'Quản lý thuộc tính')

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
    <caption>
        <div class="row">
            <form action="{{ route('admin.Attribute.List') }}" method="get">
                <div class="form-group row"> 
                    <select class="form-select form-select-lg ml-5"data-live-search="true" name="name" id="name">
                        <option name="name" value="0">Tất cả thuộc tính</option>
                        <option name="name" value="1">Dung tích</option>
                        <option name="name" value="2">Lưu hương</option>
                        <option name="name" value="3">Nhóm hương</option>
                        <option name="name" value="4">Xuất xứ</option>
                        <option name="name" value="5">Bộ sưu tập</option>
                        <option name="name" value="6">Thương hiệu</option>
                    </select>
                    <div class="input-group-prepend  ml-3 mr-3">
                        <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                    </div>
                </div>
            </form>
            <div class='ml-3'>
                <a href="{{ route('admin.Attribute.Create') }}">
                    <button class='btn btn-success'>Tạo mới</button>
                </a>
            </div>
        </div>
    </caption>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Thuộc tính</th>
                <th>Giá trị</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attribute as $attr)
                <tr>
                    <td>{{ $attr->id }}</td>
                    @if ($attr->name == 6)
                        <td>Thương hiệu</td>
                    @elseif($attr->name == 1)
                        <td>Dung tích</td>
                    @elseif($attr->name == 2)
                        <td>Lưu hương</td>
                    @elseif($attr->name == 3)
                        <td>Nhóm hương</td>
                    @elseif($attr->name == 4)
                        <td>Xuất xứ</td>
                    @elseif($attr->name == 5)
                        <td>Bộ sưu tập</td>
                    @endif
                    <td>{{ $attr->value }}</td>
                    <td class="row">
                        <a href="{{ route('admin.Attribute.Edit', $attr->id) }}">
                            <button class='btn btn-warning'>Chỉnh sửa</button>
                        </a>
                        <form action="{{ route('admin.Attribute.Delete', $attr->id) }}" method="post"
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
    {{-- <div>
        {{$attr->links() }}
    </div>  --}}
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
@endsection
