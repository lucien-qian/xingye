@extends('layouts.main')
@section('content')


        <div class="col-sm-8 blog-main">
            <form action="/tasks" method="POST">
                {{csrf_field()}}
                @include('layouts.error')
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="这里是标题">
                </div>
                <div class="form-group">
                    <label>价格（/千字）</label>
                    <input name="price" type="text" class="form-control" placeholder="这里是价格">
                </div>
                <div class="form-group">
                    <label>写手要求</label>
                    <textarea  style="height:200px;max-height:500px;" name="requireContent" class="form-control" placeholder="这里是写手要求"></textarea>
                </div>
                <div class="form-group">
                    <label>续写内容</label>
                    <textarea id="content"  style="height:400px;max-height:500px;" name="taskContent" class="form-control" placeholder="这里是内容"></textarea>
                </div>
                <div class="form-group">
                    <label>标签</label>
                    <div>
                        @foreach($tags as $tag)
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" name="tags[]" value="{{$tag->id}}"> {{$tag->name}}
                    </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label>写手福利</label>
                    <input name="welfare" type="text" class="form-control" placeholder="这里是福利">
                </div>
                <button type="submit" class="btn btn-default">提交</button>
            </form>
            <br>

        </div><!-- /.blog-main -->

@endsection