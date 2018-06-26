@extends('admin.layouts.main')
@section('content')


            <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">标签列表</h3>
                    </div>
                    <a type="button" class="btn " href="{{url('admin/tags/create')}}" >增加标签</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>标签名称</th>
                                <th>操作</th>
                            </tr>
                            @foreach($tags as $tag)
                               <tr>
                                    <td>{{$tag->id}}</td>
                                    <td>{{$tag->name}}</td>
                                    <td>
                                        <a type="button" class="btn resource-delete" delete-url="{{url('admin/tags/'.$tag->id)}}" >删除</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- /.content -->

 @endsection