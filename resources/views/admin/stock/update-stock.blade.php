@extends('admin.adminLayout')
@section('content')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 align="center" style="text-shadow: 1px 1px 5px grey;">Cập nhật kho sản phẩm</h1>
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
                                <h3 class="card-title"> <small><span></span></small></h3>
                            </div>
                            @if(isset($msg))
                                <span style="color: red"> *{{$msg}}</span>
                            @endif
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="quickForm" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="card-body col-md-6">
                                        <div class="form-group">
                                            <label for="menu">Nhập</label>
                                            <input type="number" name="import" min="0" class="form-control">
                                        </div>
                                    </div>
                                    <div class="card-body col-md-6">
                                        <div class="form-group">
                                            <label for="menu">Xuất</label>
                                            <input type="number" name="export" min="0" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="add" class="btn btn-primary">Cập nhật</button>
                                    <button type="submit" class="btn btn-danger"><a href="{{route('stock.index')}}" style="color: white">Trở về</a></button>
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
