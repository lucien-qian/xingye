<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{\Auth::guard('admin')->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @can("systems")
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>系统管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{url('admin/users')}}"><i class="fa fa-circle-o"></i> 用户列表</a></li>
            <li><a href="{{url('admin/roles')}}"><i class="fa fa-circle-o"></i> 角色列表</a></li>
              <li><a href="{{url('admin/permissions')}}"><i class="fa fa-circle-o"></i> 权限列表</a></li>
            <li><a href="{{url('admin/codes')}}"><i class="fa fa-circle-o"></i> 邀请码列表</a></li>
          </ul>
        </li>
        @endcan
        @can("tasks")
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>任务管理</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/tasks')}}"><i class="fa fa-circle-o"></i> 任务列表</a></li>
         </ul>
        </li>
        @endcan
        @can('studios')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>工作室管理</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/studios')}}"><i class="fa fa-circle-o"></i> 工作室列表</a></li>
          </ul>
        </li>
        @endcan
        @can('tags')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>标签管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/tags')}}"><i class="fa fa-circle-o"></i> 标签列表</a></li>

          </ul>
        </li>
        @endcan
        @can('notices')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>通知管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/notices')}}"><i class="fa fa-circle-o"></i> 通知列表</a></li>

          </ul>
        </li>
        @endcan


       </ul>
    </section>
    <!-- /.sidebar -->
  </aside>