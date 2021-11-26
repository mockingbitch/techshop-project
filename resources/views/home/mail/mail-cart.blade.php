<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style='margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tohoma";
        box-sizing: border-box;
        -moz-box-sizing: border-box;'>
<div id="page" class="page" style="width: 21cm;
        overflow:hidden;
        min-height:297mm;
        padding: 2.5cm;
        margin-left:auto;
        margin-right:auto;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);">
    <div class="header">
{{--        <div class="logo"><img src="../images/logo.jpg"/></div>--}}
        <div class="company" style=" padding-top:24px;
        text-transform:uppercase;
        background-color:#FFFFFF;
        text-align:right;
        float:right;
        font-size:16px;">Cửa hàng TechShop</div>
    </div>
    <br/>
    <div class="title" style="text-align:center;
        position:relative;
        color:#0000FF;
        font-size: 24px;
        top:1px;">
        HÓA ĐƠN THANH TOÁN
        <br/>
        -------oOo-------
    </div>
    <br/>
    <h5>Thông tin đơn hàng: </h5>
    <h5>Tên khách hàng: {{$customer->customerName}}</h5>
    <h5>Email: {{$order->email}}</h5>
    <h5>Địa chỉ: {{$order->address}}</h5>
    <h5>Số điện thoại: {{$order->phone}}</h5>
    <br/>
    <table class="TableData" style=" background:#ffffff;
        font-size: 11px;
        width:100%;
        border-collapse:collapse;
        font-family:Verdana, Arial, Helvetica, sans-serif;
        font-size:12px;
        border:thin solid #d3d3d3;">
        <tr style=" height: 24px;
        border:thin solid #d3d3d3;">
            <th style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;
        text-align:center;
        width: 10%;">STT</th>
            <th style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;  text-align:left;
        width: 40%;">Tên</th>
            <th style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;
 text-align:center;
        width: 120px;">Đơn giá</th>
            <th style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;
 text-align: center;
        width: 50px;">Số lượng</th>
            <th style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;
text-align: center;
        width: 120px;">Thành tiền</th>
        </tr>
        @php $subtotal = 0; $stt =0; @endphp
            @foreach($carts as $cart)
                <tr style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;">
                <td style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;
        text-align:center;
        width: 10%;
" >@php echo ++$stt; @endphp</td>
                <td class="cotTenSanPham" align="center" style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;  text-align:left;
        width: 40%;">{{$cart['productName']}}</td>
                <td class="cotGia" style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;
 text-align:center;
        width: 120px;">{{$cart['productPrice']}}</td>
                <td class="cotSoLuong" style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;
 text-align: center;
        width: 50px;" align='center'>{{$cart['quantity']}}</td>
                <td class="cotSo" align="center" style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;
text-align: center;
        width: 120px;">@php echo $total = $cart['quantity']*$cart['productPrice']; @endphp</td>
                </tr>
                @php $subtotal += $total; @endphp
            @endforeach
        <tr style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;">
            <td colspan="2" class="tong" style=" text-align: center;
        font-weight:bold;
        text-transform:uppercase;
        padding-right: 4px;">Tổng:</td>
            <td></td>
            <td></td>

            <td class="cotSo" style="padding-right: 2px;
        padding-left: 2px;
        border:thin solid #d3d3d3;
text-align: center;
        width: 120px;">@php echo number_format(($subtotal),0,",",".")@endphp Đ</td>
        </tr>
    </table>
    <h5> Ghi chú: {{$order->note}}</h5>
    <div class="footer-right"> Đây là tin nhắn tự động. Vui lòng không trả lời. </div>
</div>
</body>
</html>
