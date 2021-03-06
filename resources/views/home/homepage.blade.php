
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tech Shop</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/slick-theme.css')}}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/nouislider.min.css')}}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/sweet-alert.css')}}">

    <!-- Custom stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/style.css')}}"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!-- HEADER -->
<header>
    <!-- TOP HEADER -->

    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +0123456789</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> phongtq1@smartosc.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> 250 Kim Giang</a></li>
            </ul>
            <ul class="header-links pull-right">
                @if (isset($customer)){
                <li>
                    <div class="dropdown">
                        <button > <i class="fa fa-user-o"></i>{{$customer->customerName}}</button>
                        <div class="dropdown-content">
                            <a href="userinfo.php" style="color: black"><i class="fa fa-user-o"></i>Th??ng tin</a>
                            <a href="{{route('history.index')}}" style="color: black"><i class="fa fa-user-o"></i>L???ch s??? mua h??ng</a>

                            <a href="{{route('customer-logout')}}" style="color: red">????ng xu???t</a>
                        </div>
                    </div>
                </li>
                @else
                <li><a href="{{route('customer-login-page')}}"><i class="fa fa-user-o"></i> T??i kho???n</a></li>
                @endif
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="/" class="logo">
                            <img src="{{asset('backend/dist/img/logo.svg')}}" width="60%" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                            <form method="GET">
                            <select class="input-select">
                                <option value="0">All Products</option>
                            </select>
                                <input class="input" type="text" name="textSearch" placeholder="T??m ki???m">
                                <button formaction="{{route('search')}}"  class="search-btn" type="submit" >T??m ki???m</button>
                            </form>

                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix" id="listcart" >
                    <div class="header-ctn cart">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Y??u th??ch</span>
{{--                                <div class="qty">2</div>--}}
                            </a>
                        </div>
                        <!-- /Wishlist -->

                        <!-- Cart -->
                        <div class="dropdown ">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Gi??? h??ng</span>
                                <div class="qty">{{$cartQuantity}}</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list"  >
                                 @if(isset($carts))
                                    @php $subtotal = 0; @endphp
                                        @foreach($carts as $cart)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img width="50px" src="{{asset('uploads/product/'.$cart['productImage'])}}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">{{$cart['productName']}}</a></h3>
                                            <h4 class="product-price"><span class="qty">{{$cart['quantity']}}x</span>{{number_format($cart['productPrice'])}} ??</h4>
                                            @php $total = $cart['quantity']*$cart['productPrice'] @endphp
                                        </div>
                                      @php $subtotal = $subtotal+$total; @endphp
                                        <button class="delete" onclick="removeCart({{$cart['id']}})"><i class="fa fa-close"></i></button>
                                    </div>
                                    @endforeach
                                    @else
                                     <p>Ch??a c?? s???n ph???m n??o trong gi??? h??ng!</p>
                                    @endif
                                <!--cart-->
                                </div>
                                <div class="cart-summary">
                                    <!--<small>3 Item(s) selected</small>-->
                                    @if(isset($carts))
                                    <h5>T???ng ti???n: @php echo number_format($subtotal,0,',','.'); @endphp ??</h5>
                                    @endif
                                </div>
                                <div class="cart-btns">
                                    <a href="{{route('view-cart')}}">Gi??? h??ng</a>
                                    <a href="{{route('check-out')}}">Thanh to??n  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<nav id="navigation" >
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="active"><a href="/">Trang ch???</a></li>
            @foreach($categories as $category)
                <li><a href="{{route('category',['id' => $category->id])}}">{{$category->categoryName}}</a></li>
                @endforeach
                <li><a href="{{route('all-product')}}">All products</a></li>
                <li><a href="">About Us</a></li>

            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
@yield('content');

<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">V??? ch??ng t??i</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>250 Kim Giang</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>+0123456789</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>phongtq1@smartosc.com</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Danh m???c</h3>
                        <ul class="footer-links">
                            <li><a href="#">Hot deals</a></li>
                            <li><a href="#">M??y t??nh</a></li>
                            <li><a href="#">??i???n tho???i</a></li>
                            <li><a href="#">M??y ???nh</a></li>
                            <li><a href="#">Ph??? ki???n</a></li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Th??ng tin</h3>
                        <ul class="footer-links">
                            <li><a href="#">V??? ch??ng t??i</a></li>
                            <li><a href="#">Li??n h???</a></li>
                            <li><a href="#">Ch??nh s??ch</a></li>
                            <li><a href="#">?????i tr???</a></li>
                            <li><a href="#">??i???u ki???n</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">D???ch v???</h3>
                        <ul class="footer-links">
                            <li><a href="#">T??i kho???n</a></li>
                            <li><a href="#">Xem gi??? h??ng</a></li>
                            <li><a href="#">Y??u th??ch</a></li>
                            <li><a href="#">Theo d??i ????n h??ng</a></li>
                            <li><a href="#">H??? tr???</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-payments">
                        <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                        <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                    </ul>
                    <span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website belong to our team. Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Phong Tr???n</a>
                                - <a href="https://colorlib.com" target="_blank">Ng???c Th???</a> -
                                <a href="https://colorlib.com" target="_blank">H?? Ph????ng</a> -
                                <a href="https://colorlib.com" target="_blank">Ph???m Nam</a> -
                                <a href="https://colorlib.com" target="_blank">Nguy???n Ho??ng</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<script src="{{asset('frontend/js/nouislider.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.zoom.min.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('frontend/js/sweet-alert.js')}}"></script>

<script>
    function addCart(id){
    
        $.get('{{route('add-to-cart')}}' ,{"id":id},function(data){
            $("#listcart").load("{{route('home')}} .cart");
            swal("...", "???? th??m v??o gi??? h??ng!", "success");
        });
    }
    function removeCart(id){
        $.get("{{route('remove-cart')}}",{"id":id},function(data){
            $("#list-cart").load("{{ route('view-cart') }} .cart-change");
            $("#listcart").load("{{route('home')}} .cart");
            $("#sub").load("{{ route('view-cart') }} .sub-change");
        });
    }
</script>
</body>
</html>


