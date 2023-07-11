@extends('client.master')

@section('title', 'Cart')

@section('content-title', 'Cart')

@section('content')  
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th> 
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>amount</th>
                            <th>Total</th>
                            <th><a onclick="return confirm('bạn có chắc muốn xóa không?')" href="{{route('client.cartDeleteAll')}}">Delete all</i></a></th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        {{-- @foreach ($cart as $item) 
                        <tr>
                            <td class="align-middle"><img src="{{asset($item->product_img)}}" alt="" width="50px"></td> 
                            <td class="align-middle">{{number_format($item->product_price)}}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" name="amount" value="{{$item->amount}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">$150</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                        </tr> 
                        @endforeach --}}  
                        @if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) 
                            @if (sizeof($_SESSION['cart']) > 0)  
                                @for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) 
                                <input type="hidden" {{$tong += $_SESSION['cart'][$i][4]}} > 
                                    <tr>
                                    <td>{{ ($i + 1)}} </td>
                                    <td ><img src="{{asset($_SESSION['cart'][$i][0])}}" alt="" width="100px"></td>
                                    <td>{{ $_SESSION['cart'][$i][1] }}</td>
                                    <td>{{ number_format($_SESSION['cart'][$i][2]) }}</td>
                                    <td>{{ $_SESSION['cart'][$i][3] }}</td>
                                    <td>{{ number_format($_SESSION['cart'][$i][4]) }}</td> 
                                    <td> 
                                    <a onclick="return confirm('bạn có chắc muốn xóa không?')" href="{{route('client.cartDelete',$i)}}"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                    </tr>
                                @endfor  
                            @endif 
                        @endif
                        {{-- {{return $ttgh;}} --}}
                        
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            @if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) 
                            <h6>{{number_format($tong)}} VNĐ</h6>
                            @else
                            <h6>0 VNĐ</h6>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">0 VNĐ</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            @if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) 
                            <h5>{{number_format($tong)}} VNĐ</h5>
                            @else
                            <h5>0 VNĐ</h5>
                            @endif
                        </div>
                        <form action="{{route('client.checkout')}}" method="get">
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    @endsection

     


{{--
function show()
{
    $ttgh="";
    if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) {
        if (sizeof($_SESSION['cart']) > 0) {
            $tong = 0;
            for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                $tt = $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][3];
                $tong += $tt;
                $ttgh.= '<tr>
                        <td>' . ($i + 1) . '</td>
                        <td ><img src="../../images/' . $_SESSION['cart'][$i][0] . '" alt="" width="100px"></td>
                        <td>' . $_SESSION['cart'][$i][1] . '</td>
                        <td>' . number_format($_SESSION['cart'][$i][2]) . '</td>
                        <td>' . $_SESSION['cart'][$i][3] . '</td>
                        <td>
                            <div>' .number_format($tt)   . '</div>
                        </td>
                        <td>
                        <a href="cart.php?delid=' . $i . '"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>';
            }
            $ttgh.= '<tr>
                    <th colspan="5">Tổng tiền hàng</th>
                    <th>
                        <div>' .number_format($tong)  . ' VNĐ</div> 
                    </th>
                </tr>';
        }
    }
    return $ttgh;
}
function tong(){
    $tong = 0;
    if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) {
        if (sizeof($_SESSION['cart']) > 0) {
            for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                $tt = $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][3];
                $tong += $tt;
            }
        }
    }
    return $tong;
}
function don_hang()
{
    if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) {
        if (sizeof($_SESSION['cart']) > 0) {
            $tong = 0;
            for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                $tt = $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][3];
                $tong += $tt;
                echo '<tr>
                        <td>' . ($i + 1) . '</td>
                        <td ><img src="../../images/' . $_SESSION['cart'][$i][0] . '" alt="" width="60px"></td>
                        <td>' . $_SESSION['cart'][$i][1] . '</td>
                        <td>' . number_format($_SESSION['cart'][$i][2]) . '</td>
                        <td>' . $_SESSION['cart'][$i][3] . '</td>
                        <td>
                            <div>' .number_format($tt)   . '</div>
                        </td>
                        <td>
                        <a href="cart.php?delid=' . $i . '"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>';
            }
        } else {
            echo "Giỏ hàng rỗng!";
        }
    }
} --}}