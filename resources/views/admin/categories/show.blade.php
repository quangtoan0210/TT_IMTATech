@extends('admin.layouts.master')
@section('title')
Chi tiết danh mục
@endsection
@section('content')
    <!-- End of Topbar -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-info">Chi tiết danh mục</h6>
          

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                       
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Ảnh</th>
                                    <th>Trạng thái</th>
                                    <th style="text-align: center;"><i class="fas fa-fw fa-cog"></i></th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td> {{$category->name}}</td>
                                    <td>
                                        <div style="width: 100px; height: 100px;">
                                            <img src="{{Storage::url($category->cover)}}" style="max-width: 100%; max-height: 100%;" alt="">                    </div>
                                    </td>
                                    <td>
                                        {!! $category->is_active ? '<span class="badge bg-success"> Hoạt động </span>' :
                                            ' <span class="badge bg-danger"> Không hoạt động </span>'!!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    
                </div>
            </div>
        </div>

    </div>
    <!-- Begin Page Content -->
    
   
    @endsection