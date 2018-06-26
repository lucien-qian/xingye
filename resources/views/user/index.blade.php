@extends('layouts.main')
@section('content')


        <div class="col-sm-8">
            <blockquote>
                <p>
                    @if($user->studio()->exists())
                   {{$user->studio->name}}
                    @endif
                    {{$user->name}}
                </p>
                <footer>关注：{{$user->stars_count}}｜粉丝：{{$user->fans_count}}｜任务：{{$user->tasks_count}}</footer>
                @include('user.badges.like',['target_user'=>$user])
            </blockquote>
        </div>
        <div class="col-sm-8 blog-main">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @if($user->id==\Auth::id())
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">我发布的任务</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">我的关注</a></li>
                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">我的粉丝</a></li>
                    <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">我申请的任务</a></li>
                     @else
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">ta发布的任务</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">ta的关注</a></li>
                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">ta的粉丝</a></li>
                        <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">ta申请的任务</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @foreach($tasks as $task)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><a href="/users/{{$task->user_id}}">{{$task->user->name}}</a> {{$task->created_at->diffForHumans()}}</p>
                            <p class=""><a href="/tasks/{{$task->id}}" >{{$task->title}}</a></p>
                            <p>{!! str_limit($task->taskContent,100,'...') !!}</p>
                        </div>
                        @endforeach
                        {{$tasks->links()}}
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        @foreach($susers as $suser)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">{{$suser->name}}</p>
                                <p class="">关注：{{$suser->stars_count}} | 粉丝：{{$suser->fans_count}}｜ 任务：{{$suser->tasks_count}}</p>

                                @include('user.badges.like',['target_user'=>$suser])

                            </div>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        @foreach($fusers as $fuser)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">{{$fuser->name}}</p>
                                <p class="">关注：{{$fuser->stars_count}} | 粉丝：{{$fuser->fans_count}}｜ 任务：{{$fuser->tasks_count}}</p>

                                @include('user.badges.like',['target_user'=>$fuser])

                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane " id="tab_4">
                        @foreach($applies as $task)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class=""><a href="/users/{{$task->user_id}}">{{$task->user->name}}</a> {{$task->created_at->diffForHumans()}}</p>
                                <p class=""><a href="/tasks/{{$task->id}}" >{{$task->title}}</a></p>
                                <p>{!! str_limit($task->taskContent,100,'...') !!}</p>
                            </div>
                        @endforeach

                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>


        </div><!-- /.blog-main -->





@endsection