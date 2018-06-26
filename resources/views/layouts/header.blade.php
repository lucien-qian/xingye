
<div class="container">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <a class="blog-nav-item " href="/">首页</a>
        </li>
        <li>
            <a class="blog-nav-item" href="/tasks/create">发任务</a>
        </li>
        <li>
            <a class="blog-nav-item" href="/notices">通知</a>
        </li>
        <li>
            <input name="query" type="text" value="" class="form-control" style="margin-top:10px" placeholder="搜索词">
        </li>
        <li>
            <button class="btn btn-default" style="margin-top:10px" type="submit">Go!</button>
        </li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        @guest
        <li><a  href="/login" class="blog-nav-item">登陆</a></li>
        @else
        <li class="dropdown">
            <div>

                <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Auth::user()->name}}<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/users/{{\Auth::id()}}">我的主页</a></li>
                    <li><a href="/user/me/setting">个人设置</a></li>
                    <li><a href="/logout">登出</a></li>
                </ul>
            </div>
        </li>
        @endguest
    </ul>
</div>