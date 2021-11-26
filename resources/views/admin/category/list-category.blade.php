@extends('admin.adminLayout')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3 align="center" style="text-shadow: 1px 1px 5px grey;">Danh sách danh mục</h3>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả danh mục</th>
{{--                    <th>Trạng thái</th>--}}
                    <th>Sửa</th>
                    <th>Xoá</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->categoryName}}</td>
                    <td>{{$category->categoryDescription}}</td>
{{--                    <td align="left">--}}
{{--                        <div  class="switch demo3">--}}
{{--                            <input  type="checkbox" value="{{$category->status}}"--}}
{{--                            @if ({{$category->status}}==1)--}}
{{--                            {--}}
{{--                                 "name='deactivate' checked  ";--}}
{{--                            }--}}
{{--                            @elseif($result['status']==0){--}}
{{--                                 "name='activate'";--}}
{{--                            }--}}
{{--                            @endif--}}
{{--                            >--}}
{{--                            <label><i></i></label>--}}
{{--                        </div></td>--}}
                    <td align="left"><a class="btn btn-success" href="{{route('category.edit',['id' => $category->id])}}"><i class="fas fa-edit"></i></a></td>
                    <td align="left"><a class="btn btn-danger"
                                        href="{{route('category.delete',['id' => $category->id])}}"
                                        onclick="return confirm('Bạn có muốn xoá mục này?');"><i class="far fa-trash-alt"></i>
                        </a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function(){--}}
{{--            $("input[name='activate']").change(function(){--}}
{{--                let id = $(this).attr('value');--}}

{{--                $.ajax({--}}
{{--                    url: '?activate=' + id,--}}
{{--                    type: 'GET',--}}
{{--                    success:function(response) {--}}
{{--                        window.location.reload()--}}
{{--                        alert('Đã kích hoạt')--}}

{{--                    }--}}
{{--                })--}}
{{--            });--}}
{{--            $("input[name='deactivate']").change(function(){--}}
{{--                let id = $(this).attr('value');--}}
{{--                $.ajax({--}}
{{--                    url: '?deactivate=' + id,--}}
{{--                    type: 'GET',--}}
{{--                    success:function(response) {--}}
{{--                        window.location.reload()--}}
{{--                        alert('Huỷ kích hoạt')--}}
{{--                    }--}}
{{--                })--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
@endsection
