@extends('layouts.main')
@section('content')


    <div class="col-sm-8 blog-main">
        <form action="/studio/store" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('layouts.error')

            <div class="form-group">
                <label>工作室形象图片</label>
                <input name="avatar" type="file"  placeholder="这里是头像">
            </div>
            <div class="form-group">
                <label>工作室全称</label>
                <input name="name" type="text" class="form-control" placeholder="这里是名称">
            </div>

            <button type="submit" class="btn btn-default">提交</button>
        </form>
        <br>

    </div><!-- /.blog-main -->

@endsection