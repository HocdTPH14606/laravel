@extends('client.master')

@section('title', 'Checkout')

@section('content-title', 'Checkout')

@section('content')

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    @if($errors->any())
    <ul class='danger'>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
    <!-- Checkout Start -->
    <form action="{{route('client.order')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-6">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            @if (Auth::check())
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="status" value="0"> 
                            
                            @endif
                            <div class="col-md-6 form-group">
                                <label>Name</label> 
                                @if (Auth::check())  
                                <input class="form-control" readonly type="text" name="user_name" value="{{Auth::user()->username}}"> 
                                @else
                                <input class="form-control" readonly type="text" name="user_name" value="Name">
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Email</label>
                                @if (Auth::check())  
                                <input class="form-control" type="text" name="email" value="{{ Auth::user()->email }}">
                                @else
                                <input class="form-control" readonly type="text" name="email" value="email">
                                @endif
                                
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Phone</label>
                                <input class="form-control" type="text" name="phone">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>address</label>
                                <input class="form-control" type="text" name="address">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Note</label>
                                <textarea name="note" cols="65" rows="5"></textarea>
                            </div>  
                        </div>
                    </div>
                    {{-- <div class="collapse mb-5" id="shipping-address">
                        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span></h5>
                        <div class="bg-light p-30">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" placeholder="John">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" placeholder="Doe">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" placeholder="example@email.com">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" placeholder="+123 456 789">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Address Line 1</label>
                                    <input class="form-control" type="text" placeholder="123 Street">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Address Line 2</label>
                                    <input class="form-control" type="text" placeholder="123 Street">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Country</label>
                                    <select class="custom-select">
                                        <option selected>United States</option>
                                        <option>Afghanistan</option>
                                        <option>Albania</option>
                                        <option>Algeria</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>City</label>
                                    <input class="form-control" type="text" placeholder="New York">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>State</label>
                                    <input class="form-control" type="text" placeholder="New York">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>ZIP Code</label>
                                    <input class="form-control" type="text" placeholder="123">
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-lg-6">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            <h6 class="mb-3">Products</h6>
                            @if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) 
                                @if (sizeof($_SESSION['cart']) > 0)  
                                    @for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) 
                                    <input type="hidden" {{$tong += $_SESSION['cart'][$i][4]}} > 
                                    <div class="d-flex justify-content-between"> 
                                        <td ><img src="{{asset($_SESSION['cart'][$i][0])}}" alt="" width="50px" height="50px"></td>
                                        <p>{{ $_SESSION['cart'][$i][1] }}</p>
                                        <p>{{ number_format($_SESSION['cart'][$i][2]) }}</p>
                                        <p>{{ $_SESSION['cart'][$i][3] }}</p>
                                        <p>{{ number_format($_SESSION['cart'][$i][4]) }}</p> 
                                    </div>
                                    @endfor  
                                @endif 
                            @endif  
                        </div>
                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>{{ number_format($tong) }} VNĐ</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">0 VNĐ</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>{{ number_format($tong) }} VNĐ</h5>
                            </div>
                            <div class="bg-light p-25">
                                @if (Auth::check())  
                                <button class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                                @else
                                <p style="color: red">Mời bạn đăng nhập để thanh toán!</p>
                                @endif
                            </div>
                            <input type="hidden" name="price" value="{{$tong}}">  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Checkout End -->  
@endsection