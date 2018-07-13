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
        .info_module{
            background-color: #EDEDED;
            padding: 10px 10px;
            display: none;
        }
        .conf_value{
            vertical-align: top;
            width: 600px;
            padding: 0;
            height: 2.2rem;
            background-color:rgba(0,0,0,0);
            border: none;
        }
        .info_title{
            display: block;
            font-size: 1.7rem;
            color: coral;
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
                                                            @elseif($item->type == 2)
                                                                cvm
                                                            @endif
                                                        </td>
                                                        <td class=" ">{{$item->confName}}</td>
                                                        <td class=" ">
                                                            <textarea rows="1" class="conf_value">{{$item->value}}</textarea>
                                                        </td>
                                                        <td class=" ">{{$item->updateTime}}</td>
                                                        <td class=" ">
                                                            <button type="button" data-content="1" class="btn btn-round btn-primary" name="modify" >修改</button>
                                                            <button type="button" data-content="1" class="btn btn-round btn-danger" name="rollback">回滚</button>
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
                            <input type="text" class="form-control" style="display: none" name="region-id" id="region-id" value="-1">
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
                                <label>db-name</label>
                                <input type="text" class="form-control" placeholder="说明此DB的用途" name="cdb_db_name" id="cdb_db_name">
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
                                <label>db-slave-ip</label>
                                <input type="text" class="form-control" placeholder="db-slave-ip" name="cdb_db_read_slave_ip" id="cdb_db_read_slave_ip">
                                <label class="error" for="cdb_db_read_slave_ip"></label>
                                <label>db-slave-port</label>
                                <input type="text" class="form-control" placeholder="db-slave-port" name="cdb_db_read_slave_port" id="cdb_db_read_slave_port">
                                <label class="error" for="cdb_db_read_slave_port"></label>
                                <label>db-slave-user</label>
                                <input type="text" class="form-control" placeholder="db-slave-user" name="cdb_db_read_slave_user" id="cdb_db_read_slave_user">
                                <label class="error" for="cdb_db_read_slave_user"></label>
                                <label>db-slave-pass</label>
                                <input type="text" class="form-control" placeholder="db-slave-pass" name="cdb_db_read_slave_pass" id="cdb_db_read_slave_pass">
                                <label class="error" for="cdb_db_read_slave_pass"></label>
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
        $(function () {
            var region = $('#region').val();
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
            window.location.href = "/qsdb/conf?productId=" + productId +"&moduleId=" + moduleId + "&region=-1";
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
        $('#modify-conf').click(function () {
            var conf_type = $('#conf_type').val();
            var formData = new FormData();
            formData.append('conf_type', conf_type);
            if(conf_type == -1){
                setError(conf_type, "conf_type", "请选择配置类型");
                return;
            }else if(conf_type == 0){//key-value
                var key_conf_name = $('#key_conf_name').val();
                var key_conf_value = $('#key_conf_value').val();
                var reg = /^\w+$/; // 判断输入的是不是字母+数字+下划线

                if(key_conf_name == ""){
                    setError(key_conf_name, "key_conf_name", "配置名称不能为空");
                    return;
                }else if(! reg.test(key_conf_name)){
                    setError(key_conf_name, "key_conf_name", "配置名称由数字、字母、下划线组成");
                    return;
                }
                if(key_conf_value == ""){
                    setError(key_conf_value, "key_conf_value", "配置值不能为空");
                    return;
                }
                formData.append('key_conf_name', key_conf_name);
                formData.append('key_conf_value', key_conf_value);
            }else if(conf_type == 1){
                var  ip_test= /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/; // 判断输入的是不是ip地址
                var  port_test= /^([1-9]|[1-9]\\d{1,3}|[1-6][0-5][0-5][0-3][0-5])$/; // 判断输入的是不是端口号
                var reg = /^\w+$/; // 判断输入的是不是字母+数字+下划线

                var cdb_db_name = $('#cdb_db_name').val(); //配置名称
                var cdb_db_ip = $('#cdb_db_ip').val();
                var cdb_db_port = $('#cdb_db_port').val();
                var cdb_db_user = $('#cdb_db_user').val();
                var cdb_db_pass = $('#cdb_db_pass').val();

                var cdb_db_slave_ip = $('#cdb_db_slave_ip').val();
                var cdb_db_slave_port = $('#cdb_db_slave_port').val();
                var cdb_db_slave_user = $('#cdb_db_slave_user').val();
                var cdb_db_slave_pass = $('#cdb_db_slave_pass').val();

                var cdb_db_read_slave_ip = $('#cdb_db_read_slave_ip').val();
                var cdb_db_read_slave_port = $('#cdb_db_read_slave_port').val();
                var cdb_db_read_slave_user = $('#cdb_db_read_slave_user').val();
                var cdb_db_read_slave_pass = $('#cdb_db_read_slave_pass').val();

                if(cdb_db_name == "" || cdb_db_ip == "" || cdb_db_port == "" || cdb_db_user == "" || cdb_db_pass == ""){
                    setError(cdb_db_name, "cdb_db_name", "必填字段区域");
                    return;
                }
                if(!reg.test(cdb_db_name)){
                    setError(cdb_db_name, "cdb_db_name", "配置名称由数字、字母、下划线组成");
                    return;
                }
                if(!ip_test.test(cdb_db_ip)){
                    setError(cdb_db_ip, "cdb_db_ip", "IP地址不符合规范");
                    return;
                }
                if(!port_test.test(cdb_db_port)){
                    setError(cdb_db_port, "cdb_db_port", "端口不符合规范");
                    return;
                }
                formData.append('cdb_db_name', cdb_db_name);
                formData.append('cdb_db_ip', cdb_db_ip);
                formData.append('cdb_db_port', cdb_db_port);
                formData.append('cdb_db_user', cdb_db_user);
                formData.append('cdb_db_pass', cdb_db_pass);

                //判断


            }
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
        });
    </script>
@endsection