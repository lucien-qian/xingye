
@extends('layouts.main')
@section('content')



    <div class="col-sm-8">
        <blockquote>
            <p>{{$tag->name}}</p>
            <footer>任务：{{$tag->task_tags_count}}</footer>
        </blockquote>
    </div>

    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">任务</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                @foreach($tasks as $task)
                        <div class="blog-post" style="margin-top: 30px">
                          <p class=""><a href="{{url('user/'.$task->user_id)}}">{{$task->user->name}}</a> 1个月前</p>
                            <p class=""><a href="{{url('tasks/'.$task->id)}}" >{{$task->title}}</a></p>
                            <p>{!!$task->taskContent!!}</p>
                        </div>
                @endforeach
                    {{$tasks->links()}}
                </div>

            </div>
            <!-- /.tab-content -->
        </div>


    </div><!-- /.blog-main -->


@endsection
