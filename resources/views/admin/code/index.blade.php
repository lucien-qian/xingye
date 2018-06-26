@extends('admin.layouts.main')
@section('content')


            <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">邀请码列表</h3>
                    </div>
                    <a type="button" class="btn " href="{{url('admin/codes/create')}}" >生成邀请码</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>邀请码</th>
                                <th>操作</th>
                            </tr>
                            @foreach($codes as $code)
                               <tr>
                                    <td>{{$code->id}}</td>
                                    <td>{{$code->vCode}}</td>
                                    <td>
                                        <a type="button" class="btn code-send" code-id="{{$code->id}}" >激活</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                          </table>
                        {{$codes->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- /.content -->

 @endsection