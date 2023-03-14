@extends('admin.adminLayout')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3 align="center" style="text-shadow: 1px 1px 5px grey;">Quản lý kho</h3>
            @if(isset($msg))
                {{$msg}}
            @endif
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Giá</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Cập nhật kho</th>
                </tr>
                </thead>
                <form method="POST" >
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->productName}}</td>
                        <td>
                            @if($product->status == 0)
                                <span style="color: red">Hết hàng</span>
                            @else
                                Còn hàng
                            @endif
                        </td>
                        <td>{{number_format($product->productPrice) }} Đ</td>
                        <td><img width="100px" src="{{asset('uploads/product/'.$product->productImage)}}" alt=""></td>
                        <td>{{$product->quantity}}</td>
                        <td align="left"><a class="btn btn-success" href="{{route('stock.update.view',['id'=>$product->productId])}}"><i class="fas fa-edit"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
                </form>
            </table>
        </div>
        {!! $products->links("pagination::bootstrap-4") !!}
    </div>

@endsection
