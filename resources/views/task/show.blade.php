@extends('layouts.main')
@section('content')



        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <div style="display:inline-flex">
                    <h2 class="blog-post-title">{{$task->title}}</h2>
                    @can('update',$task)
                    <p>
                    <a href="{{ url('tasks/'.$task->id.'/edit') }}" class="btn btn-success">编辑</a>
                    </p>
                    @endcan
                    @can('delete',$task)
                    <form action="{{ url('tasks/'.$task->id) }}" method="POST" style="display: inline;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                    @endcan
                </div>

                <p class="blog-post-meta">{{$task->created_at->toFormattedDateString()}} by <a href="/users/{{$task->user_id}}">{{$task->user->name}}</a></p>
                <h4>标签:</h4>
                <p>
                    @foreach($task->tags as $tag)
                        <a href="/tag/{{$tag->id}}" class="label label-default">{{$tag->name}}</a>
                    @endforeach

                </p>
                <h4>福利待遇：</h4>
                <p>{{$task->welfare}}</p>
                <h4>写手要求：</h4>
                <p>{!! $task->requireContent !!}</p>
                <h4>续写详情：</h4>
                <p>{!! $task->taskContent !!}</p>

                    <h4>申请人：</h4>
                <p>
                    @foreach($task->applies as $apply)
                    <a href="/users/{{$apply->user_id}}" class="label label-default">{{$apply->user->name}}</a>
                    @endforeach
                </p>


                <div>
                    @if($task->user_id!=\Auth::id())
                    @if($task->apply(\Auth::id())->exists())
                        <a href="{{url('tasks/'.$task->id.'/unApply')}}" type="button" class="btn btn-default btn-lg">取消申请</a>
                    @else
                        <a href="{{url('tasks/'.$task->id.'/apply')}}" type="button" class="btn btn-primary btn-lg">申请任务</a>
                    @endif
                    @endif
                </div>


            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">留言</div>

                <!-- List group -->
                <ul class="list-group">
                    @foreach($task->comments as $comment)
                    <li class="list-group-item">
                        <h5>{{$comment->created_at}} by <a href="/users/{{$comment->user_id}}">{{$comment->user->name}}</a></h5>
                        <div>
                        {{$comment->content}}
                        </div>
                    </li>
                     @endforeach
                {{$task->comments->links()}}
                </ul>
            </div>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">发表留言</div>

                <!-- List group -->
                <ul class="list-group">
                    <form action="/tasks/{{$task->id}}/comment" method="post">
                        {{csrf_field()}}
                        @include('layouts.error')

                        <li class="list-group-item">
                            <textarea name="content" class="form-control" rows="10"></textarea>
                            <button class="btn btn-default" type="submit">提交</button>
                        </li>
                    </form>

                </ul>
            </div>

        </div><!-- /.blog-main -->



@endsection