@extends('admin.adminLayout')
@section('content')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 align="center" style="text-shadow: 1px 1px 5px grey;">Thêm sản phẩm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                            <li class="breadcrumb-item active">Menu</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title"> <small><span style="color: green">
                                            @if(isset($msg))
                                                {{$msg}}
                                                @endif
                                        </span></small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="card-body col-md-8">
                                        <div class="form-group">
                                            <label for="menu">Tên sản phẩm</label>
                                            <input type="text" name="productName" class="form-control" id="menu"
                                                   placeholder="Nhập tên sản phẩm">
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả ngắn</label>
                                            <textarea name="productDescription" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả chi tiết</label>
                                            <textarea id="editor1"  name="productContent" class="form-control" cols="30" rows="10"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="menu">Giá sản phẩm</label>
                                            <input type="number" name="productPrice" class="form-control"
                                                   placeholder="Nhập giá">
                                        </div>
                                        <div class="form-group">
                                            <label for="menu">Số lượng</label>
                                            <input type="number" name="productQuantity" class="form-control"
                                                   placeholder="Nhập số lượng">
                                        </div>
                                        <div class="form-group">
                                            <label for="menu">Hình ảnh sản phẩm</label>
                                            <input type="file" name="productImage" class="form-control"
                                                   placeholder="Nhập hình ảnh sản phẩm">
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="margin: 50px auto" >
                                        <div class="form-group">
                                            <label for="menu">Danh mục:</label>
                                            <select name="categoryId" style="width:50%;height:50px;margin-left:17px " class="select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                <option>-----------Danh mục---------</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="menu">Thương hiệu:</label>
                                            <select name="brandId" style="width:50%;height:50px;" class="select form-select-lg mb-3" aria-label=".form-select-lg example">
                                                <option>-----------Thương hiệu---------</option>
                                               @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->brandName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="add" class="btn btn-primary">Thêm</button>
                                </div>

                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    <script>
        CKEDITOR.replace('editor1');
    </script>
@endsection
