@extends('layout.master')
   
@section('content-title', 'Quản lý thuộc tính')
@section('content-button')
<caption> 
    <div class="rol-3 row">
        <form action="{{ route('admin.Attribute.List') }}" method="get">
            <div class="form-group row">
                <select class="form-select form-select-lg ml-5"data-live-search="true" name="name" id="name">
                    <option name="name" value="0">Tất cả thuộc tính</option>
                    @foreach ($attribute as $item)
                    <option name="name" value="{{$item->id}}">{{$item->name}}</option> 
                    @endforeach
                   
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
    
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>STT</th>
                <th>Thuộc tính</th>
                <th>Giá trị</th>
                <th>
                    <select class="form-select form-select-lg" required id="inputName">
                        <option value="attribute">Thuộc tính</option>
                        <option value="attributeValue" selected>Giá trị</option>
                    </select>
                </th>
            </tr>
        </thead>
        <tbody class="attributeValue">
            @foreach ($AttributeV as $key => $attr)
                <tr>
                    <td>{{ $key++ }}</td>
                    <td>{{ $attr->Attribute->name }}</td>
                    <td>{{ $attr->value }}</td>
                    <td class="row">
                        <a href="{{ route('admin.Attribute.Edit', $attr->id) }}">
                            <button class='btn btn-warning'>Chỉnh sửa</button>
                        </a>
                        <form action="{{ route('admin.Attribute.Delete1', $attr->id) }}" method="post"
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
        <tbody class="attribute" style="display: none">
            @foreach ($attribute as $key => $attr)
                <tr>
                    <td>{{ $key++ }}</td>
                    <td>{{ $attr->name }}</td>
                    <td></td>
                    <td class="row"> 
                        <form action="{{ route('admin.Attribute.Delete2', $attr->id) }}" method="post"
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
        {{ $AttributeV->links() }}
    </div>
    <script src="https://code.jquery.com/jquery-3.5.0s.min.js"></script>
    <script>
        $('#inputName').change(function(event) {
            var _ip = $('#inputName').val();
            if (_ip == 'attribute') {
                $('.attribute').show();
                $('.attributeValue').hide();
            } else {
                $('.attributeValue').show();
                $('.attribute').hide();
            }
        })
    </script>
@endsection
