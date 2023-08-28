@extends('layout.master')

@section('content-title', 'Tạo mới thuộc tính')

@section('content-button')
    <div class="col-2"></div>
    <a href="/admin/attribute" class="col-2">
        <button class='btn btn-primary'>Danh sách</button>
    </a>
@endsection
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible text-danger" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible text-danger" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    @error('value')
        <div class="alert alert-danger alert-dismissible text-danger" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div> 
    @enderror
    @error('name')
    <div class="alert alert-danger alert-dismissible text-danger" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div> 
@enderror


    <div class="form-group">
        <label for="" class="form-label">Chọn phương thức:</label>
        <select class="form-select form-select-lg custom-select" required id="inputName">
            <option value="attribute">Thêm thuộc tính</option>
            <option value="attributeValue">Thêm giá trị thuộc tính</option>
        </select>
    </div>
    <form action="{{ isset($attributeID) ? route('admin.Attribute.Update1') : route('admin.Attribute.Store1') }}"
        method="post" class="was-validated attr">
        @csrf
        <div class="form-group ">
            <label for="name">Tên thuộc tính:</label>
            <input type="text" class="form-control " id="name" placeholder="" name="name"
                value="{{ isset($attributeID) ? $attributeID->name : old('name') }}" required>
            <div class="invalid-feedback">Vui lòng điền vào trường này.</div> 
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($attributeID) ? 'Cập nhật' : 'Tạo mới' }}</button>
    </form>
    {{-- form thêm mới + update Attribute value --}}
    <form action="{{ isset($attributeValueID) ? route('admin.Attribute.Update2') : route('admin.Attribute.Store2') }}"
        method="POST" class="was-validated value" style="display: none">
        @csrf
        <div class="form-group ">
            <label for="" class="form-label">Thuộc tính:</label>
            <select class="form-select form-select-lg custom-select" name="attribute_id" id="attribute_id">
                @foreach ($attributeV as $item)
                    <option  value="{{$item->id}}" {{(isset($attributeID) && $attributeID->id === $item->id) ? 'selected' : ''}}
                    >{{$item->name }}  </option>
                @endforeach
            </select>
        </div>
        <div class="form-group ">
            <label for="value">Giá trị:</label>
            <input type="text" class="form-control " id="value" placeholder="" name="value"
                value="{{ isset($attributeValueID) ? $attributeValueID->value : old('value') }}" required>
            <div class="invalid-feedback">Vui lòng điền vào trường này.</div> 
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($attributeValueID) ? 'Cập nhật' : 'Tạo mới' }}</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.0s.min.js"></script>
    <script>
        $('#inputName').change(function(event) {
            var _ip = $('#inputName').val();
            if (_ip == 'attribute') {
                $('.attr').show();
                $('.value').hide();
            } else {
                $('.value').show();
                $('.attr').hide();
            }
        })
    </script>
@endsection
