@extends('layout.master')

@section('title', 'Quản lý Room')

@section('content-title', 'Quản lý Room')

@section('content')
<div class='my-3'>
    <a href="{{route('rooms.create')}}">
        <button class='btn btn-success'>Tạo mới</button>
    </a>
</div>
<caption>
    <form action="{{route('rooms.list')}}" method="get">
        @csrf
        <input type="search" name="name" placeholder="search" value="{{$name}}" class="form-control">
    </form>
</caption> 
    <table class='table'> 
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>status</th>
                <th>parent_id</th> 
                <th>Tên nhân viên</th>
                <th>Hành động</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room) 
                <tr>
                    <td>{{$room->id}}</td>
                    <td>{{$room->name}}</td>
                    <td>
                         <button class="toggle-class" class="btn btn-info"><input data-id="{{$room->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $room->status ? 'checked' : '' }}> 
                            {{-- @if ($room->status === 1)
                                Kích hoạt
                            @else
                                Không kích hoạt
                            @endif --}}
                        </button>
                    </td>
                    <td> {{isset($room->oneParent) ? $room ->oneParent->name : ''}}
                        {{-- <ul>{{$room->parent_id}}</ul> --}}
                    </td>  
                    <td>
                        <ul>@foreach($room->users as $user)
                            <li>{{$user->name}}</li>
                            @endforeach 
                        </ul>
                    </td>
                    <td>
                        <a href="{{route('rooms.edit',  $room->id) }}">
                            <button class='btn btn-warning'>Chỉnh sửa</button>
                        </a>
                        <form  action="{{route('rooms.delete', $room->id)}}" method="post" >
                            @csrf
                            @method('DELETE')
                            <button class='btn btn-danger' onclick="return confirm('bạn có chắc muốn xóa không?')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $rooms->links() }}
    </div>
    <script> 
        $(function() { 
          $('.toggle-class').change(function() { 
              var status = $(this).prop('checked') == true ? 1 : 0;  
              var id = $(this).data('id');  
              $.ajax({ 
                  type: "GET", 
                  dataType: "json", 
                  url: '/admin/rooms/changeStatus', 
                  data: {'status': status, 'id': id}, 
                  success: function(data){ 
                    console.log(data.success) 
                  } 
              }); 
          }) 
        }) 
      </script>
@endsection
