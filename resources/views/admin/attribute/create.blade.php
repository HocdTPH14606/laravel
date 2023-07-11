@extends('layout.master')

@section('title', 'Tạo thuộc tính')

@section('content-title', 'Tạo thuộc tính')

@section('content')
{{-- @if($errors->any())
    <ul class='danger'>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul> 
@endif
    <form
        action="{{isset($room)
            ? route('rooms.update', $room->id)
            : route('rooms.store')}}
        "
            action=""
        method="POST"  
    >
        @csrf
        @if (isset($room))
            @method('PUT')
        @endif
        <div class='form-group'>
            <label for="name">Tên thuộc tính</label>
            <input type="text" name='name' class='form-control' value="{{isset($room) ? $room->name : old('name')}}">
            <input type="text" name='name' class='form-control' value="">
        </div> 
        <div class='form-group'>
            <label for="value">Giá trị</label>
            <input type="text" name='name' class='form-control' value="{{isset($room) ? $room->name : old('name')}}">
            <input type="text" name='value' class='form-control' value="">
        </div>  
        <div class='form-group'>
            <label for="">Trạng thái</label>
            <input type="radio" name='status' value="1" {{(isset($room) && $room->status === 1) ? 'checked' : ''}}>Kích hoạt
            <input type="radio" name='status' value="0" {{(isset($room) && $room->status === 0) ? 'checked' : ''}}>Không kích hoạt
        </div>
        <div class='form-group'>
            <label for="">Danh mục</label>
            <select name="parent_id" class='form-control'>
                @foreach ($room_all as $item)
                    <option value="{{$item->id}}" 
                    {{(isset($room) && $room->parent_id === $item->id) ? 'selected' : ''}} >
                        {{$item->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <button class='btn btn-primary'>{{isset($room) ? 'Cập nhật' : 'Tạo mới'}}</button> 
            <button type='reset' class='btn btn-warning'>Nhập lại</button>
        </div> 
    </form> --}}

    <form action="{{route('admin.AttributeStore') }}" method="POST" class="was-validated">
        @csrf
        <div class="form-group">
            <label for="" class="form-label">Thuộc tính:</label>
            <select class="form-select form-select-lg custom-select" name="name" id="name">
                <option value="0">Thương hiệu</option>
                <option value="1">Dung tích</option>
                <option value="2">Lưu hương</option>
                <option value="3">Nhóm hương</option>
                <option value="4">Xuất xứ</option>
                <option value="5">Bộ sưu tập</option>
            </select>
        </div>
        <div class="form-group ">
          <label for="value">Giá trị:</label>
          <input type="text" class="form-control " id="value" placeholder="" name="value" required>
          {{-- <div class="valid-feedback">Valid.</div> --}}
          <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
        </div> 
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
      
      
@endsection
 
      {{-- <script>
        $('#inputName'.change(function(even){
            var _ip = $('#inputName').val();
            if(_ip == 0){
                $('#value').attr({
                    placeholder: 'Thương hiệu',
                })
            }
        });
      </script> --}}