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
            /*margin:0 0 ;*/
            padding: 0 10px 0 10px;
            margin-bottom: 2px;
        }
        .info_module{
            background-color: #EDEDED;
            padding: 10px 10px;
            display: none;
        }
        .conf_value{
            vertical-align: top;
            width: 500px;
            padding: 0;
            height: 2.2rem;
            background-color:rgba(0,0,0,0);
            border: none;
            padding-right: 20px;
        }
        .last_conf_value{
            vertical-align: top;
            width: 200px;
            padding: 0;
            height: 2.2rem;
            background-color:rgba(0,0,0,0);
            border: none;
            padding-right: 20px;
        }
        .info_title{
            display: block;
            font-size: 1.7rem;
            color: coral;
        }
        .modify-cdb{
            display: none;
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
                                                @foreach($data['products_module'] as $key=>$products)
                                                    @foreach($products as $product => $modules)
                                                        <li class="treeview @if($data['condition']['productId'] == $key) active @endif">
                                                            <a href="#">
                                                                <i class="fa fa-product-hunt"></i>
                                                                <span class="product_name @if($data['condition']['productId'] == $key) active @endif">{{$product}}</span>
                                                                <span class="label label-primary pull-right">{{count($modules)}}</span>
                                                            </a>
                                                            <ul class="treeview-menu" style="display: @if($data['condition']['productId'] == $key) block @else none @endif ;">
                                                                @foreach($modules as $module)
                                                                    <li class ="module @if($data['condition']['moduleId'] == $module['moduleId']) active @endif" data-target="{{$key}}" data-content="{{$module['moduleId']}}">
                                                                        <a href="#"><i class="fa fa-calendar-o"></i>
                                                                            <span>{{$module['name']}}</span>
                                                                        </a>
                                                                    </li>
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
                                                    @if(isset($data['region']))
                                                        <option value="-1">请选择地域查询</option>
                                                        @foreach($data['region'] as $item)
                                                            <option value="{{$item['region']}}" @if($data['condition']['region'] == $item['region']) selected @endif>{{$item['region']}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="-1">请先选择产品--模块</option>
                                                    @endif
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
                                                    <th class="column-title">历史配置值</th>
                                                    <th class="column-title">更新时间</th>
                                                    <th class="column-title"><span class="nobr">Action</span>操作</th>
                                                    <th class="bulk-actions" colspan="4">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> )<i class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @if(isset($data['conf']))
                                                    @forelse($data['conf'] as $item)
                                                    <tr class="even pointer">
                                                        <td class=" ">{{$item->confId}}</td>
                                                        <td class="product_name"></td>
                                                        <td class="module_name"></td>
                                                        <td class="conf_type">
                                                            @if($item->type == 0)
                                                                key-value
                                                            @elseif($item->type == 1)
                                                                cdb
                                                            @else
                                                                cvm
                                                            @endif
                                                        </td>
                                                        <td class=" ">{{$item->confName}}</td>
                                                        <td class=" ">
                                                            <textarea rows="1" class="conf_value">{{$item->value}}</textarea>
                                                        </td>
                                                        <td class=" ">
                                                            <textarea rows="1" class="last_conf_value">{{$item->lastValue}}</textarea>
                                                        </td>
                                                        <td class=" ">{{$item->updateTime}}</td>
                                                        <td class=" ">
                                                            <button type="button" data-content="{{$item->confId}}" class="btn btn-round btn-primary" name="modify" >修改</button>
                                                            <button type="button" data-content="{{$item->confId}}" class="btn btn-round btn-danger" name="rollback">回滚</button>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                        <tr>
                                                            <td class=" ">暂无配置，点击右上角新增配置</td>
                                                        </tr>
                                                    @endforelse
                                                    <nav>
                                                        {!! $data['conf']->links() !!}
                                                    </nav>
                                                @else
                                                    <tr class="even pointer">
                                                        <td class=" ">请先选择产品模块--区域</td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>

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
                    <h4 class="modal-title" id="myModalLabel">配置项管理</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label>产品名</label>
                            <input type="text" class="form-control" style="display: none" name="confId" id="confId" value="-1">
                            <input type="text" class="form-control" placeholder="" name="product_name" id="product_name" data-content="{{$data['condition']['productId']}}" disabled>
                        </div>
                        <div class="form-group">
                                <label>模块名</label>
                            <input type="text" class="form-control" placeholder="" name="module_name" id="module_name" data-content="{{$data['condition']['moduleId']}}" disabled>
                        </div>
                        <div class="form-group">
                            <label>配置类型</label>
                            <select class="form-control show-tick selectpicker" id="conf_type" name="conf_type">
                                <option value="-1">请选择配置类型</option>
                                <option value="0">key(配置值，通用key-value)</option>
                                <option value="1">cdb(配置值，用于mysql信息记录)</option>
                                <option value="2">cvm(配置值，用于服务器信息记录)</option>
                            </select>
                            <label class="error" for="conf_type"></label>
                        </div>
                        <div class="keyvalue info_module">
                            <div class="form-group">
                                <label>配置名称</label>
                                <input type="text" class="form-control" placeholder="请输入配置名称" name="key_conf_name" id="key_conf_name">
                                <label class="error" for="key_conf_name"></label>
                            </div>
                            <div class="form-group">
                                <label>配置值</label>
                                <input type="text" class="form-control" placeholder="请输入配置值" name="key_conf_value" id="key_conf_value">
                                <label class="error" for="key_conf_value"></label>
                            </div>
                        </div>
                        <div class="cvm info_module">
                            <div class="form-group">
                                <label>配置名称</label>
                                <input type="text" class="form-control" placeholder="请输入配置名称" value="iplist" disabled>
                            </div>
                            <div class="form-group">
                                <label>配置值导入方式</label>
                                <select class="form-control show-tick selectpicker" id="cvm_inport_type" name="cvm_inport_type">
                                    <option value="-1">请选择配置值导入方式</option>
                                    <option value="0">手动输入,多个IP用分号分隔,固定IP</option>
                                    <option value="1">从四级业务模块id导入,后续会同步更新(推荐)</option>
                                </select>
                                <input type="text" class="form-control" style="margin-top: 1rem;" placeholder="请输入配置值" name="cvm_conf_value" id="cvm_conf_value">
                                <label class="error" for="cvm_conf_value"></label>
                            </div>
                        </div>
                        <div class="cdb info_module">
                            <div class="form-group">
                                <label class="info_title">主库信息，必填</label>
                                <label>db-conf-name</label>
                                <input type="text" class="form-control" placeholder="说明此DB的用途-配置名称" name="cdb_conf_name" id="cdb_conf_name">
                                <label class="error" for="cdb_conf_name"></label>
                                <label>db-name</label>
                                <input type="text" class="form-control" placeholder="此DB的名称" name="cdb_db_name" id="cdb_db_name">
                                <label class="error" for="cdb_db_name"></label>
                                <label>db-ip</label>
                                <input type="text" class="form-control" placeholder="此DB的IP" name="cdb_db_ip" id="cdb_db_ip">
                                <label class="error" for="cdb_db_ip"></label>
                                <label>db-port</label>
                                <input type="text" class="form-control" placeholder="此DB的PORT" name="cdb_db_port" id="cdb_db_port">
                                <label class="error" for="cdb_db_port"></label>
                                <label>db-user</label>
                                <input type="text" class="form-control" placeholder="此DB的用户名" name="cdb_db_user" id="cdb_db_user">
                                <label class="error" for="cdb_db_user"></label>
                                <label>db-pass</label>
                                <input type="text" class="form-control" placeholder="此DB的连接密码" name="cdb_db_pass" id="cdb_db_pass">
                                <label class="error" for="cdb_db_pass"></label>
                            </div>
                            <div class="form-group">
                                <label class="info_title">mysql-db从库信息,没有可为空</label>
                                <label>db-slave-name</label>
                                <input type="text" class="form-control" placeholder="此DB的名称" name="cdb_db_slave_name" id="cdb_db_slave_name">
                                <label class="error" for="cdb_db_slave_name"></label>
                                <label>db-slave-ip</label>
                                <input type="text" class="form-control" placeholder="db-slave-ip" name="cdb_db_slave_ip" id="cdb_db_slave_ip">
                                <label class="error" for="cdb_db_slave_ip"></label>
                                <label>db-slave-port</label>
                                <input type="text" class="form-control" placeholder="db-slave-port" name="cdb_db_slave_port" id="cdb_db_slave_port">
                                <label class="error" for="cdb_db_slave_port"></label>
                                <label>db-slave-user</label>
                                <input type="text" class="form-control" placeholder="db-slave-user" name="cdb_db_slave_user" id="cdb_db_slave_user">
                                <label class="error" for="cdb_db_slave_user"></label>
                                <label>db-slave-pass</label>
                                <input type="text" class="form-control" placeholder="db-slave-pass" name="cdb_db_slave_pass" id="cdb_db_slave_pass">
                                <label class="error" for="cdb_db_slave_pass"></label>
                            </div>
                            <div class="form-group">
                                <label class="info_title">mysql-只读DB信息,没有可为空</label>
                                <label>db-read-slave-name</label>
                                <input type="text" class="form-control" placeholder="此DB的名称" name="cdb_db_read_slave_name" id="cdb_db_read_slave_name">
                                <label class="error" for="cdb_db_read_slave_name"></label>
                                <label>db-read-slave-ip</label>
                                <input type="text" class="form-control" placeholder="db-slave-ip" name="cdb_db_read_slave_ip" id="cdb_db_read_slave_ip">
                                <label class="error" for="cdb_db_read_slave_ip"></label>
                                <label>db-read-slave-port</label>
                                <input type="text" class="form-control" placeholder="db-slave-port" name="cdb_db_read_slave_port" id="cdb_db_read_slave_port">
                                <label class="error" for="cdb_db_read_slave_port"></label>
                                <label>db-read-slave-user</label>
                                <input type="text" class="form-control" placeholder="db-slave-user" name="cdb_db_read_slave_user" id="cdb_db_read_slave_user">
                                <label class="error" for="cdb_db_read_slave_user"></label>
                                <label>db-read-slave-pass</label>
                                <input type="text" class="form-control" placeholder="db-slave-pass" name="cdb_db_read_slave_pass" id="cdb_db_read_slave_pass">
                                <label class="error" for="cdb_db_read_slave_pass"></label>
                            </div>
                            <div class="modify-cdb form-group">
                                <label class="info_title">修改DB配置信息</label>
                                <label>db-name</label>
                                <input type="text" class="form-control" placeholder="此DB的名称" name="modify_db_name" id="modify_db_name">
                                <label class="error" for="modify_db_name"></label>
                                <label>db-ip</label>
                                <input type="text" class="form-control" placeholder="db-ip" name="modify_db_ip" id="modify_db_ip">
                                <label class="error" for="modify_db_ip"></label>
                                <label>db-port</label>
                                <input type="text" class="form-control" placeholder="db-port" name="modify_db_port" id="modify_db_port">
                                <label class="error" for="modify_db_port"></label>
                                <label>db-user</label>
                                <input type="text" class="form-control" placeholder="db-slave-user" name="modify_db_user" id="modify_db_user">
                                <label class="error" for="modify_db_user"></label>
                                <label>db-pass</label>
                                <input type="text" class="form-control" placeholder="db-pass" name="modify_db_pass" id="modify_db_pass">
                                <label class="error" for="modify_db_pass"></label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="modify-conf">提交更改</button>
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
        var NEWDB = false;
        var NEWSLAVE = false;
        var NEWREADE = false;
        var MSG = "";
        var  ip_test= /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/; // 判断输入的是不是ip地址
        var  port_test= /^([0-9]|[1-9]\d|[1-9]\d{2}|[1-9]\d{3}|[1-5]\d{4}|6[0-4]\d{3}|65[0-4]\d{2}|655[0-2]\d|6553[0-5])$/; // 判断输入的是不是端口号
        var  reg = /^\w+$/; // 判断输入的是不是字母+数字+下划线
        $(function () {
            var region = $('#region').val();
            var confId = $("#confId");
            confId.val(-1);//重置模块框为新增状态
            if(region != -1){
                //获取选中的产品模块名称
                var product_name = $('.treeview').find('span.active').html();
                var module_name = $(".treeview-menu").find("li.active").find('a').find('span').html();
                console.log(product_name);
                console.log(module_name);
                //设置配置详情表格中的产品模块名（当前选中）
                $('.product_name').html(product_name);
                $('.module_name').html(module_name);
                //设置配置项管理中产品模块名（当前选中）
                $('#product_name').val(product_name);
                $('#module_name').val(module_name);
            }
        });
        $.sidebarMenu($('.sidebar-menu'));
        $(".module").click(function () {
            var productId = $(this).attr('data-target');
            var moduleId = $(this).attr('data-content');
            var region = $("#region").val();
            window.location.href = "/qsdb/conf?productId=" + productId +"&moduleId=" + moduleId + "&region=" + region ;
        });
        $("#region").change(function () {
            var productId = $(".treeview-menu").find("li.active").attr('data-target');
            var moduleId = $(".treeview-menu").find("li.active").attr('data-content');
            var region = $(this).val();
            window.location.href = "/qsdb/conf?productId=" + productId +"&moduleId=" + moduleId + "&region=" + region;

        });
        function showInfoModule(value) {
            $('.info_module').slideUp(500);
            if(value == 0)
                $('.keyvalue').slideDown(500);
            else if(value == 1)
                $('.cdb').slideDown(500);
            else if(value == 2)
                $('.cvm').slideDown(500);
        }
        $('#conf_type').change(function () {
            var id = $(this).val();
            showInfoModule(id);
        });
        //点击修改按钮
        $("button[name='modify']").click(function () {
            $('.info_module').hide();//关闭所有编辑页面

            var confId = $(this).attr('data-content');
            var region =  $("#region").val();
            var formData = new FormData();
            formData.append('confId', confId);
            formData.append('region', region);
            $.ajax({
                url: "/qsdb/conf/modifyCheck",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.status == 200){
                        //设置编辑界面，填充默认值
                        var addModel = $("#addModel");
                        var conf_type = $("#conf_type");
                        var confId = $("#confId");
                        var keyvalue = $(".keyvalue");
                        var cdb = $(".cdb");
                        var cvm = $(".cvm");
                        console.log(result.conf);
                        if(result.conf.type == 0){//key-value
                            conf_type.val(0);
                            conf_type.attr('disabled','disabled');
                            keyvalue.find('#key_conf_name').val(result.conf.confName);
                            keyvalue.find('#key_conf_value').val(result.confvalue.value);
                            confId.val(result.conf.confId);//设置模态框为修改状态
                            keyvalue.show();
                            addModel.modal();
                        }else if(result.conf.type == 1){//cdb
                            var modify_cdb = $('.modify-cdb');
                            conf_type.val(1);
                            conf_type.attr('disabled','disabled');
                            cdb.find('.form-group').hide(); //隐藏新增编辑框
                            modify_cdb.show(); //打开修改DB编辑框
                            var db_value = JSON.parse(result.confvalue.value);//获取DB信息
                            modify_cdb.find('#modify_db_name').val(db_value.default);
                            modify_cdb.find('#modify_db_ip').val(db_value.host);
                            modify_cdb.find('#modify_db_port').val(db_value.port);
                            modify_cdb.find('#modify_db_user').val(db_value.user);
                            modify_cdb.find('#modify_db_pass').val(db_value.passwd);
                            confId.val(result.conf.confId);//设置模态框为修改状态
                            cdb.show();
                            addModel.modal();
                        }else if(result.conf.type == 21 || result.conf.type == 22){//cvm方式
                            conf_type.val(2);
                            conf_type.attr('disabled','disabled');
                            var db_value = JSON.parse(result.confvalue.value);//获取DB信息
                            if(result.conf.type == 21) cvm.find('#cvm_inport_type').val(0);
                            else if(result.conf.type == 22) cvm.find('#cvm_inport_type').val(1);
                            cvm.find('#cvm_conf_value').val(db_value.default);
                            confId.val(result.conf.confId);//设置模态框为修改状态
                            cvm.show();
                            addModel.modal();
                        }
                        console.log(result.confvalue);
                    }else{
                        checkResult(result.status,result.msg,null);
                    }
                }
            })
        });
        $('#modify-conf').click(function () {
            var conf_type = $('#conf_type');
            var region = $('#region');
            var productId = $(".treeview-menu").find("li.active").attr('data-target');
            var moduleId = $(".treeview-menu").find("li.active").attr('data-content');
            var confId = $("#confId"); //配置ID 如为-1则新增状态  否则val()值为具体待修改配置值

            if(productId == undefined || moduleId == undefined){
                swal("","请先选择新增配置所在产品模块","error");
                return;
            }
            if(region.val() == -1){
                swal("","请先选择新增配置所在地域","error");
                return;
            }
            var formData = new FormData();
            formData.append('conf_type', conf_type.val());
            formData.append('region', region.val());
            formData.append('productId', productId);
            formData.append('moduleId', moduleId);

            if(conf_type.val() == -1){
                setError(conf_type, "conf_type", "请选择配置类型");
                return;
            }else if(conf_type.val() == 0){//key-value
                removeError(conf_type,'conf_type');

                var key_conf_name = $('#key_conf_name');
                var key_conf_value = $('#key_conf_value');

                if(key_conf_name.val() == ""){
                    setError(key_conf_name, "key_conf_name", "配置名称不能为空");
                    return;
                }else if(! reg.test(key_conf_name.val())){
                    setError(key_conf_name, "key_conf_name", "配置名称由数字、字母、下划线组成");
                    return;
                }else{
                    removeError(key_conf_name,'key_conf_name');
                }
                if(key_conf_value.val() == ""){
                    setError(key_conf_value, "key_conf_value", "配置值不能为空");
                    return;
                }else{
                    removeError(key_conf_value,'key_conf_value');
                }
                formData.append('key_conf_name', key_conf_name.val());
                formData.append('key_conf_value', key_conf_value.val());
                MSG = "你选择了KEY-VALUE模式输入，请确认填写正确";
            }else if(conf_type.val() == 1){
                removeError(conf_type,'conf_type');

                var cdb_conf_name = $('#cdb_conf_name'); //配置名称
                var cdb_db_name = $('#cdb_db_name'); //数据库名称
                var cdb_db_ip = $('#cdb_db_ip');
                var cdb_db_port = $('#cdb_db_port');
                var cdb_db_user = $('#cdb_db_user');
                var cdb_db_pass = $('#cdb_db_pass');

                var cdb_db_slave_name = $('#cdb_db_slave_name'); //数据库名称
                var cdb_db_slave_ip = $('#cdb_db_slave_ip');
                var cdb_db_slave_port = $('#cdb_db_slave_port');
                var cdb_db_slave_user = $('#cdb_db_slave_user');
                var cdb_db_slave_pass = $('#cdb_db_slave_pass');

                var cdb_db_read_slave_name = $('#cdb_db_read_slave_name'); //数据库名称
                var cdb_db_read_slave_ip = $('#cdb_db_read_slave_ip');
                var cdb_db_read_slave_port = $('#cdb_db_read_slave_port');
                var cdb_db_read_slave_user = $('#cdb_db_read_slave_user');
                var cdb_db_read_slave_pass = $('#cdb_db_read_slave_pass');

                var cdb_modify_db_name = $('#modify_db_name'); //修改数据库信息
                var cdb_modify_db_ip = $('#modify_db_ip');
                var cdb_modify_db_port = $('#modify_db_port');
                var cdb_modify_db_user = $('#modify_db_user');
                var cdb_modify_db_pass = $('#modify_db_pass');

                if(confId == -1){
                    if(cdb_conf_name.val() == "" || cdb_db_name.val() == "" || cdb_db_ip.val() == "" || cdb_db_port.val() == "" || cdb_db_user.val() == "" || cdb_db_pass.val() == ""){
                        setError(cdb_conf_name, "cdb_conf_name", "必填字段区域");
                        return;
                    }else{
                        removeError(cdb_conf_name,'cdb_conf_name');
                    }
                    if(!reg.test(cdb_conf_name.val())){
                        setError(cdb_conf_name, "cdb_conf_name", "配置名称由数字、字母、下划线组成");
                        return;
                    }else{
                        removeError(cdb_db_name,'cdb_db_name');
                    }
                    if(!reg.test(cdb_db_name.val())){
                        setError(cdb_db_name, "cdb_db_name", "数据库名称由数字、字母、下划线组成");
                        return;
                    }else{
                        removeError(cdb_db_name,'cdb_db_name');
                    }
                    if(!ip_test.test(cdb_db_ip.val())){
                        setError(cdb_db_ip, "cdb_db_ip", "IP地址不符合规范");
                        return;
                    }else{
                        removeError(cdb_db_ip,'cdb_db_ip');
                    }
                    if(!port_test.test(cdb_db_port.val())){
                        setError(cdb_db_port, "cdb_db_port", "端口不符合规范");
                        return;
                    }else{
                        removeError(cdb_db_port,'cdb_db_port');
                    }
                    formData.append('cdb_conf_name', cdb_conf_name.val());
                    formData.append('cdb_db_name', cdb_db_name.val());
                    formData.append('cdb_db_ip', cdb_db_ip.val());
                    formData.append('cdb_db_port', cdb_db_port.val());
                    formData.append('cdb_db_user', cdb_db_user.val());
                    formData.append('cdb_db_pass', cdb_db_pass.val());
                    NEWDB = true;//key-value 填写正确

                    //判断mysql_从库信息是否填写完整
                    if(cdb_db_slave_name.val() != "" && cdb_db_slave_ip.val() != "" && cdb_db_slave_port.val() != "" &&  cdb_db_slave_user.val() != "" && cdb_db_slave_pass.val() != ""){
                        if(!ip_test.test(cdb_db_slave_ip.val())){
                            setError(cdb_db_slave_ip, "cdb_db_slave_ip", "IP地址不符合规范");
                            return;
                        }else{
                            removeError(cdb_db_slave_ip,'cdb_db_slave_ip');
                        }
                        if(!port_test.test(cdb_db_slave_port.val())){
                            setError(cdb_db_slave_port, "cdb_db_slave_port", "端口不符合规范");
                            return;
                        }else{
                            removeError(cdb_db_slave_port,'cdb_db_slave_port');
                        }
                        formData.append('cdb_db_slave_name', cdb_db_slave_name.val());
                        formData.append('cdb_db_slave_ip', cdb_db_slave_ip.val());
                        formData.append('cdb_db_slave_port', cdb_db_slave_port.val());
                        formData.append('cdb_db_slave_user', cdb_db_slave_user.val());
                        formData.append('cdb_db_slave_pass', cdb_db_slave_pass.val());
                        formData.append('NEWSLAVE', NEWSLAVE);
                        NEWSLAVE = true;//key-value 填写正确
                    }
                    //判断只读DB信息是否填写完整
                    if(cdb_db_read_slave_name.val() != "" && cdb_db_read_slave_ip.val() != "" && cdb_db_read_slave_port.val() != "" &&  cdb_db_read_slave_user.val() != "" && cdb_db_read_slave_pass.val() != ""){
                        if(!ip_test.test(cdb_db_read_slave_ip.val())){
                            setError(cdb_db_read_slave_ip, "cdb_db_read_slave_ip", "IP地址不符合规范");
                            return;
                        }else{
                            removeError(cdb_db_read_slave_ip,'cdb_db_read_slave_ip');
                        }
                        if(!port_test.test(cdb_db_read_slave_port.val())){
                            setError(cdb_db_read_slave_port, "cdb_db_read_slave_port", "端口不符合规范");
                            return;
                        }else{
                            removeError(cdb_db_read_slave_port,'cdb_db_read_slave_port');
                        }
                        formData.append('cdb_db_read_slave_name', cdb_db_read_slave_name.val());
                        formData.append('cdb_db_read_slave_ip', cdb_db_read_slave_ip.val());
                        formData.append('cdb_db_read_slave_port', cdb_db_read_slave_port.val());
                        formData.append('cdb_db_read_slave_user', cdb_db_read_slave_user.val());
                        formData.append('cdb_db_read_slave_pass', cdb_db_read_slave_pass.val());
                        formData.append('NEWREADE', NEWREADE);
                        NEWREADE = true;//key-value 填写正确
                        MSG = "你选择了CDB模式输入,并且确认填写信息有：";
                        if(NEWDB) MSG += "主库信息";
                        if(NEWSLAVE) MSG += "、从库信息";
                        if(NEWREADE) MSG += "、只读库信息";
                    }
                }else{
                    //判断修改数据库信息是否填写完整
                    if(cdb_modify_db_name.val() != "" && cdb_modify_db_ip.val() != "" &&  cdb_modify_db_port.val() != "" && cdb_modify_db_user.val() != "" && cdb_modify_db_pass.val() != ""){
                        if(!ip_test.test(cdb_modify_db_ip.val())){
                            setError(cdb_modify_db_ip, "cdb_modify_db_ip", "IP地址不符合规范");
                            return;
                        }else{
                            removeError(cdb_modify_db_ip,'cdb_modify_db_ip');
                        }
                        if(!port_test.test(cdb_modify_db_port.val())){
                            setError(cdb_modify_db_port, "cdb_modify_db_port", "端口不符合规范");
                            return;
                        }else{
                            removeError(cdb_modify_db_port,'cdb_modify_db_port');
                        }
                        formData.append('cdb_modify_db_name', cdb_modify_db_name.val());
                        formData.append('cdb_modify_db_ip', cdb_modify_db_ip.val());
                        formData.append('cdb_modify_db_port', cdb_modify_db_port.val());
                        formData.append('cdb_modify_db_user', cdb_modify_db_user.val());
                        formData.append('cdb_modify_db_pass', cdb_modify_db_pass.val());
                    }
                }

            } else if (conf_type.val() == 2) { // CVM模式输入
                removeError(conf_type,'conf_type');

                var cvm_inport_type = $('#cvm_inport_type');
                var cvm_conf_value = $('#cvm_conf_value');
                if(cvm_inport_type.val() != 1 && cvm_inport_type.val() != 0){
                    setError(cvm_inport_type, "cvm_inport_type", "请选择配置导入方式");
                    return;
                }else{
                    removeError(cvm_inport_type,'cvm_inport_type');
                }
                if(cvm_conf_value.val() == ""){
                    setError(cvm_conf_value, "cvm_conf_value", "请输入配置值");
                    return;
                }else if(cvm_conf_value.val() != "" && cvm_inport_type.val() == 0){ //判断手动输入IP是否";"分割
                    var iplists = cvm_conf_value.val().split(';');
                    var flag = false;
                    $.each(iplists,function(index,obj){
                        console.log(obj);
                        //判断ip地址是否合法
                        if(!ip_test.test(obj)){
                            setError(cvm_conf_value, "cvm_conf_value", "有IP地址不符合规范");
                            flag = true;
                            return false;
                        }
                    });
                    if(flag) return false;
                } else {
                    removeError(cvm_conf_value,'cvm_conf_value');
                }
                formData.append('cvm_inport_type', cvm_inport_type.val());
                formData.append('cvm_conf_value', cvm_conf_value.val());
                //生成提示信息
                MSG = "你选择了CVM模式输入,并且采用了";
                if(cvm_inport_type.val() == 0) MSG += "手动输入IPlist方式";
                else MSG += "从模块ID导入的方式";
            }
            if(confId.val() == -1){//新增配置项
                swal({
                        title: "确认添加配置信息",
                        text: MSG,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确定！",
                        cancelButtonText: "取消！",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            $.ajax({
                                url: "/qsdb/conf/add",
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
                        } else {
                            swal("取消！", "重新检查你的配置信息)", "error");
                        }
                    });
            }else{
                formData.append('confId', confId.val());
                swal({
                        title: "确认提交修改配置？",
                        text: MSG,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "确定！",
                        cancelButtonText: "取消！",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            $.ajax({
                                url: "/qsdb/conf/modifyPost",
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
                        } else {
                            swal("取消！", "重新检查你的配置信息)", "error");
                        }
                    });
            }

        });
        $("button[name='rollback']").click(function () {
            var confId = $(this).attr('data-content');
            var region = $('#region');

            if(region.val() == -1){
                swal('','地域值不正确，试试刷新!','error');
                return ;
            }
            var formData = new FormData();
            formData.append('confId', confId);
            formData.append('region', region.val());
            swal({
                    title: "确定回滚配置吗？",
                    text: "回滚后再次回滚即可恢复原配置！",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                    closeOnConfirm: false
                },
                function(){
                        $.ajax({
                            url: "/qsdb/conf/rollback",
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
                        })
                });
        });
    </script>
@endsection