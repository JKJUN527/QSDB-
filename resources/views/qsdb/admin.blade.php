@extends('layout.master')
@section('title', '权限管理')

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
        .input-group{
            margin-top: 1rem;
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
                @include('components.indexNav',['activeIndex'=>1,'activeIndexSecend'=>0])
            {{--@endsection--}}
{{--            @section('header-nav')--}}
                @include('components.headerNav',['activeIndex'=>1])
            {{--@endsection--}}
            <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    @if($data['has_auth'] == 0)
                                        <div class="x_title">
                                            <h2>你暂无权限进入该目录，请联系超级管理员</h2>
                                            <div class="clearfix"></div>
                                        </div>
                                    @else
                                        <div class="x_title">
                                            <h2>权限管理 <small>在这里新增修改权限设置</small></h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
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
                                                        <th class="column-title">ID </th>
                                                        <th class="column-title">更新时间</th>
                                                        <th class="column-title">人员</th>
                                                        <th class="column-title">权限列表</th>
                                                        <th class="column-title">最近处理人</th>
                                                        <th class="column-title"><span class="nobr">Action</span>操作</th>
                                                        <th class="bulk-actions" colspan="4">
                                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach($data['auth'] as $item)
                                                        <tr class="even pointer">
                                                            <td class=" ">{{$item->id}}</td>
                                                            <td class=" ">{{$item->updated_at}}</td>
                                                            <td class=" ">{{$item->username}}</td>
                                                            <td class=" ">
                                                                @if($item->auth == "all")
                                                                    超级管理员
                                                                @else
                                                                    {{$item->auth}}
                                                                @endif
                                                            </td>
                                                            <td class=" ">{{$item->admin}}</td>
                                                            <td class=" ">
                                                                {{--<button type="button" data-content="{{$item->id}}" class="btn btn-round btn-primary" name="modify">修改</button>--}}
                                                                <button type="button" data-content="{{$item->id}}" class="btn btn-round btn-danger" name="delete">删除</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <nav>
                                                    {!! $data['auth']->links() !!}
                                                </nav>
                                            </div>


                                        </div>
                                    @endif
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
                    <h4 class="modal-title" id="myModalLabel">权限管理</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label>用户RTX Name（企业英文名称）</label>
                            {{--<input type="text" class="form-control" style="display: none" name="user_id" id="user_id" value="-1">--}}
                            <input type="text" class="form-control" placeholder="请输入人员英文全名" name="rtx_name" id="rtx_name">
                            <label class="error" for="rtx_name"></label>
                        </div>
                        <div class="form-group">
                            <label>用户中文全名</label>
                            <input type="text" class="form-control" placeholder="请输入中文名" name="ch_name" id="ch_name">
                            <label class="error" for="ch_name"></label>
                        </div>
                        <div class="form-group">
                            <label>权限列表</label>
                            <select class="form-control show-tick selectpicker" id="auth_list" name="auth_list">
                                <option value="-1">请选择相应权限(可多选)</option>
                                <option value="0">all(超级管理员)</option>
                                <option value="1">conf(新增、修改、回退配置项管理)</option>
                                <option value="2">region(新增、修改地域配置)</option>
                                <option value="3">products(新增、修改产品模块配置)</option>
                            </select>
                            <div class="input-group">
                                <p class="form-control" name="auth_info" id="auth_info"></p>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick="clearAuth()">清除</button>
                                </span>
                            </div><!-- /input-group -->
                            <label class="error" for="auth_list"></label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="modify-auth">提交更改</button>
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
        $("#modify-auth").click(function () {
            var rtx_name = $("input[name='rtx_name']");
            var ch_name = $("input[name='ch_name']");
            var auth_list = $("#auth_list");
            var auth_info = $("#auth_info").text();
            var reg = /^[A-Za-z]+$/; // 判断输入的是不是字母

            if (rtx_name.val() === "") {
                setError(rtx_name, "rtx_name", "不能为空");
                return;
            } else if(! reg.test(rtx_name.val())) {
                setError(rtx_name, "rtx_name", "只能填写英文字母");
                return;
            }else{
                removeError(rtx_name, "rtx_name");
            }

            if (ch_name.val() === "") {
                setError(ch_name, "ch-name", "不能为空");
                return;
            } else{
                removeError(ch_name, "ch-name");
            }
            if(auth_info === ""){
                setError(auth_list, "auth_list", "不能为空");
                return;
            }else{
                removeError(auth_list, "auth_list");
            }

            var formData = new FormData();
            formData.append('rtx_name', rtx_name.val());
            formData.append('ch_name', ch_name.val());
            formData.append('auth_info', auth_info);

            $.ajax({
                url: "/qsdb/admin/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status,result.msg,$('#addModel'));
                }
            })
        });
        $('button[name="delete"]').click(function () {
            var id = $(this).attr('data-content');
            var formData = new FormData();
            formData.append('id',id);
            $.ajax({
                url: "/qsdb/admin/delete" ,
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
        $('#auth_list').change(function () {
            var auth_info = $("#auth_info");
            var auth_list = $("#auth_list");
            var auth_value = auth_info.html();
            if(auth_list.val() == 0){
                auth_value = "all;";
            }else if(auth_list.val() == 1){
                auth_value += "conf;";
            }else if(auth_list.val() == 2){
                auth_value += "region;";
            }else if(auth_list.val() == 3){
                auth_value += "products;";
            }
            auth_info.html(auth_value);
        });
        function clearAuth() {
            var auth_info = $('#auth_info');
            auth_info.html("");
            $('#auth_list').val(-1);
        }
    </script>
@endsection