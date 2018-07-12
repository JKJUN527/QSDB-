@extends('layout.master')
@section('title', '区域管理')

{{--@section('header-tab')--}}
    {{--@include('components.headerTab')--}}
{{--@endsection--}}

{{--@section('header-nav')--}}
    {{--@include('components.headerNav',['activeIndex'=>1,'lang'=>$data['lang']])--}}
{{--@endsection--}}

@section('custom-style')
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
            {{--@section('index-nav')--}}
                @include('components.indexNav',['activeIndex'=>0,'activeIndexSecend'=>0])
            {{--@endsection--}}
{{--            @section('header-nav')--}}
                @include('components.headerNav',['activeIndex'=>1])
            {{--@endsection--}}
            <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        {{--<div class="page-title">--}}
                            {{--<div class="title_left">--}}
                                {{--<h3>区域管理 <small>在这里新增修改区域配置</small></h3>--}}
                            {{--</div>--}}
                            {{--<div class="title_right">--}}
                                {{--<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">--}}
                                    {{--<div class="input-group">--}}
                                        {{--<input type="text" class="form-control" placeholder="Search for...">--}}
                                        {{--<span class="input-group-btn">--}}
                                            {{--<button class="btn btn-default" type="button">Go!</button>--}}
                                        {{--</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>区域管理 <small>在这里新增修改区域配置</small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            {{--<li class="dropdown">--}}
                                                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                                                {{--<ul class="dropdown-menu" role="menu">--}}
                                                    {{--<li><a href="#">Settings 1</a>--}}
                                                    {{--</li>--}}
                                                    {{--<li><a href="#">Settings 2</a>--}}
                                                    {{--</li>--}}
                                                {{--</ul>--}}
                                            {{--</li>--}}
                                            <li><a class="add-link" data-toggle="modal" data-target="#addModel"><i class="fa fa-plus-circle"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="x_content">

                                        {{--<p>Add class <code>bulk_action</code> to table for bulk actions options on row select</p>--}}

                                        <div class="table-responsive">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                <tr class="headings">
                                                    {{--<th>--}}
                                                        {{--<input type="checkbox" id="check-all" class="flat">--}}
                                                    {{--</th>--}}
                                                    <th class="column-title">region </th>
                                                    <th class="column-title">名称</th>
                                                    <th class="column-title">类型</th>
                                                    <th class="column-title">更新时间</th>
                                                    <th class="column-title"><span class="nobr">Action</span>操作</th>
                                                    <th class="bulk-actions" colspan="4">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($data['region'] as $item)
                                                    <tr class="even pointer">
                                                        {{--<td class="a-center ">--}}
                                                            {{--<input type="checkbox" class="flat" name="table_records">--}}
                                                        {{--</td>--}}
                                                        <td class=" ">{{$item->region}}</td>
                                                        <td class=" ">{{$item->name}}</td>
                                                        <td class=" ">{{$item->type}}</td>
                                                        <td class=" ">{{$item->createTime}}</td>
                                                        <td class=" ">
                                                            <button type="button" data-content="{{$item->id}}" class="btn btn-round btn-primary" name="modify">修改</button>
                                                            {{--<button type="button" data-content="{{$item->id}}" class="btn btn-round btn-danger" name="delete">删除</button>--}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <nav>
                                                {!! $data['region']->links() !!}
                                            </nav>
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
    <script>
        $("#en-name").blur(function(){
            var en_name = $("input[name='en-name']");
            var formData = new FormData();
            formData.append('region', en_name.val());
            $.ajax({
                url: "/qsdb/region/check",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    var en_name = $("input[name='en-name']");
                    var submit = $('#modify-region');
                    if(result.status == 400){
                        setError(en_name, "en-name", "名称已占用");
                        submit.attr('disabled','disabled');
                        return;
                    }else{
                        removeError(en_name, "en-name");
                        submit.removeAttr('disabled');
                    }
                }
            })
        });
        $("#modify-region").click(function () {
            var rid = $("input[name='region-id']");
            var ch_name = $("input[name='ch-name']");
            var en_name = $("input[name='en-name']");
            var reg = /^[A-Za-z]+$/; // 判断输入的是不是字母

            if (en_name.val() === "") {
                setError(en_name, "en-name", "不能为空");
                return;
            } else if(! reg.test(en_name.val())) {
                setError(en_name, "en-name", "只能填写英文字母");
                return;
            }else{
                removeError(en_name, "en-name");
            }

            if (ch_name.val() === "") {
                setError(ch_name, "ch-name", "不能为空");
                return;
            } else{
                removeError(ch_name, "ch-name");
            }

            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('en_name', en_name.val());
            formData.append('ch_name', ch_name.val());

            $.ajax({
                url: "/qsdb/region/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status,result.msg,$('#addModel'));
//                    checkResult(result.status, "技能特长已添加", result.msg);
                }
            })
        });
        $('button[name="modify"]').click(function () {
            var rid = $(this).attr('data-content');
            $.ajax({
                url: "/qsdb/region/modify?rid="+ rid ,
                type: "get",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.status == 400){
                        checkResult(result.status,result.msg,null);
                    }else{
                        $('#region-id').val(result.detail.id);
                        $('#ch-name').val(result.detail.name);
                        $('#en-name').val(result.detail.region);
                        toggleModel($('#addModel'));
                    }
                }
            });
        });
        $('button[name="delete"]').click(function () {
            var rid = $(this).attr('data-content');
            var formData = new FormData();
            formData.append('rid',rid);
            $.ajax({
                url: "/qsdb/region/delete" ,
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status,result.msg,null);
                }
            });
        });
    </script>
@endsection