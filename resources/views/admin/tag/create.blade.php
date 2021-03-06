@extends('admin.layouts.main')
@section('content')


            <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">增加标签</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{url('admin/tags')}}" method="POST">
                             {{csrf_field()}}
                             @include('admin.layouts.error')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">标签名</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- /.content -->

 @endsection