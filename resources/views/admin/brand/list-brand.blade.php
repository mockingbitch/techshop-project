@extends('admin.adminLayout')
@section('content')
        <!-- Content Header (Page header) -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3 align="center" style="text-shadow: 1px 1px 5px grey;">Danh sách thương hiệu</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên thương hiệu</th>
                        <th>Mô tả </th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($brands as $brand)
                    <tr>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->brandName}}</td>
                        <td>{{$brand->brandDescription}}</td>
                        <td align="left"><a class="btn btn-success" href="{{route('brand.edit',['id' => $brand->id])}}"><i class="fas fa-edit"></i></a></td>
                        <td align="left"><a class="btn btn-danger"
                                            href="{{route('brand.delete',['id' => $brand->id])}}"
                                            onclick="return confirm('Bạn có muốn xoá mục này?');"><i class="far fa-trash-alt"></i>
                            </a></td>
                    </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@endsection
