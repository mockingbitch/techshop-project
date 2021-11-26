@extends('admin.adminLayout')
@section('content')

        <!-- Content Header (Page header) -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 align="center" style="text-shadow: 1px 1px 5px grey;">Danh sách sản phẩm</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Mô tả sản phẩm</th>
                        <th>Giá</th>
                        <th>Hình ảnh</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->productName}}</td>
                        <td>{{$product->productDescription}}</td>
                        <td>{{number_format($product->productPrice) }} Đ</td>
                        <td><img width="100px" src="{{asset('uploads/product/'.$product->productImage)}}" alt=""></td>
                        <td align="left"><a class="btn btn-success" href="{{route('product.edit',['id' => $product->id])}}"><i class="fas fa-edit"></i></a></td>
                        <td align="left"><a class="btn btn-danger"
                                            href="{{route('product.delete',['id' => $product->id])}}"
                                            onclick="return confirm('Bạn có muốn xoá mục này?');"><i class="far fa-trash-alt"></i>
                            </a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! $products->links("pagination::bootstrap-4") !!}
        </div>

@endsection
