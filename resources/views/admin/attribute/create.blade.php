@extends('layout.master')

@section('title', 'Tạo mới thuộc tính')

@section('content-title', 'Tạo mới thuộc tính')

@section('content')
    <form action="{{ isset($attribute) ? route('admin.Attribute.Update') : route('admin.Attribute.Store') }}" method="POST"
        class="was-validated">
        @csrf
        <div class="form-group">
            <label for="" class="form-label">Thuộc tính:</label>
            <select class="form-select form-select-lg custom-select" name="name" id="name">
                @if (isset($attribute))
                    <option value="{{ $attribute->name }}">
                        @if ($attribute->name == 1)
                            Dung tích
                        @elseif($attribute->name == 2)
                            Lưu hương
                        @elseif($attribute->name == 3)
                            Nhóm hương
                        @elseif($attribute->name == 4)
                            Xuất xứ
                        @elseif($attribute->name == 5)
                            Bộ sưu tập
                        @elseif($attribute->name == 6)
                            Thương hiệu
                        @endif
                    </option>
                @endif

                <option value="1">Dung tích</option>
                <option value="2">Lưu hương</option>
                <option value="3">Nhóm hương</option>
                <option value="4">Xuất xứ</option>
                <option value="5">Bộ sưu tập</option>
                <option value="6">Thương hiệu</option>
            </select>
            @error('name')
                <span style="color: red"> {{ $messages }} </span>
            @enderror
        </div>
        <div class="form-group ">
            <label for="value">Giá trị:</label>
            <input type="text" class="form-control " id="value" placeholder="" name="value"
                value="{{ isset($attribute) ? $attribute->value : old('value') }}" required>
            {{-- <div class="valid-feedback">Valid.</div> --}}
            <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
            @error('value')
                <span style="color: red"> {{ $message }} </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($attribute) ? 'Cập nhật' : 'Tạo mới' }}</button>
    </form>
@endsection
