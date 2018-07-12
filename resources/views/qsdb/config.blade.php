@extends('layout.master')
@section('title', '配置项管理')

{{--@section('header-tab')--}}
    {{--@include('components.headerTab')--}}
{{--@endsection--}}

{{--@section('header-nav')--}}
    {{--@include('components.headerNav',['activeIndex'=>1,'lang'=>$data['lang']])--}}
{{--@endsection--}}

@section('custom-style')
    <link href="{{asset('/vendors/sidebar/sidebar-menu.css')}}" rel="stylesheet">
    <style>
        .even .btn{
            margin:0 0 ;
            padding: 0 10px 0 10px;
        }
    </style>
@endsection
{{--@section('index-nav')--}}
{{--@include('components.indexNav')--}}
{{--@endsection--}}
@section('content')
    <div class="container body">
        <div class="main_container">
                @include('components.indexNav',['activeIndex'=>0,'activeIndexSecend'=>2])
                @include('components.headerNav',['activeIndex'=>1])
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>配置项管理 <small>在这里新增修改配置项管理</small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li><a class="add-link" data-toggle="modal" data-target="#addModel"><i class="fa fa-plus-circle"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2">
                                    <aside class="main-sidebar">
                                        <section  class="sidebar">
                                            <ul class="sidebar-menu">
                                                <li class="header">产品-模块</li>
                                                @foreach($data as $key=>$products)
                                                    @foreach($products as $product => $modules)
                                                        <li class="treeview">
                                                            <a href="#">
                                                                <i class="fa fa-product-hunt"></i>
                                                                <span>{{$product}}</span>
                                                                <span class="label label-primary pull-right">{{count($modules)}}</span>
                                                            </a>
                                                            <ul class="treeview-menu" style="display: none;">
                                                                @foreach($modules as $module)
                                                                    <li><a href="#"><i class="fa fa-calendar-o"></i>{{$module}}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        @endforeach
                                                @endforeach
                                            </ul>
                                        </section>
                                    </aside>
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                    <div class="x_content">
                                        <div class="table-responsive">
                                            <div class="input-group">
                                                {{--<label>请选择地域查询</label>--}}
                                                {{--<input type="text" class="form-control" placeholder="请选择地域查询">--}}
                                                <select class="form-control show-tick selectpicker" id="region" name="region">
                                                    <option value="-1">请选择地域查询</option>
                                                </select>
                                                {{--<span class="input-group-btn">--}}
                                                    {{--<button class="btn btn-default" type="button">Go!</button>--}}
                                                {{--</span>--}}
                                            </div>
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                <tr class="headings">
                                                    {{--<th>--}}
                                                    {{--<input type="checkbox" id="check-all" class="flat">--}}
                                                    {{--</th>--}}
                                                    <th class="column-title">ID</th>
                                                    <th class="column-title">产品</th>
                                                    <th class="column-title">模块</th>
                                                    <th class="column-title">配置类型</th>
                                                    <th class="column-title">配置名</th>
                                                    <th class="column-title">配置值</th>
                                                    <th class="column-title">更新时间</th>
                                                    <th class="column-title"><span class="nobr">Action</span>操作</th>
                                                    <th class="bulk-actions" colspan="4">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> )<i class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                {{--@foreach($data['region'] as $item)--}}
                                                <tr class="even pointer">
                                                    <td class=" ">1</td>
                                                    <td class=" ">1</td>
                                                    <td class=" ">1</td>
                                                    <td class=" ">1</td>
                                                    <td class=" ">1</td>
                                                    <td class=" ">1</td>
                                                    <td class=" ">1</td>
                                                    <td class=" ">
                                                        <button type="button" data-content="1" class="btn btn-round btn-primary" name="modify">修改</button>
                                                        <button type="button" data-content="1" class="btn btn-round btn-danger" name="rollback">回滚</button>
                                                    </td>
                                                </tr>
                                                {{--@endforeach--}}
                                                </tbody>
                                            </table>
                                            <nav>
                                                {{--{!! $data['region']->links() !!}--}}
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->
        </div>
    </div>
    <div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">区域管理</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label>英文短写（eg:bj/sh/gz）</label>
                            <input type="text" class="form-control" style="display: none" name="region-id" id="region-id" value="-1">
                            <input type="text" class="form-control" placeholder="请输入英文短写" name="en-name" id="en-name">
                            <label class="error" for="en-name"></label>
                        </div>
                        <div class="form-group">
                            <label>中文名称（eg:广州open专区/北京region）</label>
                            <input type="text" class="form-control" placeholder="请输入中文名称" name="ch-name" id="ch-name">
                            <label class="error" for="ch-name"></label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="modify-region">提交更改</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section('custom-script')
    <script src="{{asset('/vendors/sidebar/sidebar-menu.js')}}"></script>
    <script>
        $.sidebarMenu($('.sidebar-menu'))
    </script>
@endsection