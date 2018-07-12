<?php $__env->startSection('title', '产品模块管理'); ?>
<?php $__env->startSection('custom-style'); ?>
    <style>
        .even .btn{
            margin:0 0 ;
            padding: 0 10px 0 10px;
        }
        .new-products{
            background-color: cornsilk;
            padding: 10px 10px;
            display: none;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container body">
        <div class="main_container">

                <?php echo $__env->make('components.indexNav',['activeIndex'=>0,'activeIndexSecend'=>1], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <?php echo $__env->make('components.headerNav',['activeIndex'=>1], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>产品模块管理 <small>在这里新增修改产品模块配置</small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li><a class="add-link" data-toggle="modal" data-target="#addModel"><i class="fa fa-plus-circle"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="x_content">

                                        

                                        <div class="table-responsive">
                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead>
                                                <tr class="headings">
                                                    
                                                        
                                                    
                                                    <th class="column-title">产品（中文名） </th>
                                                    <th class="column-title">模块</th>
                                                    <th class="column-title">负责人</th>
                                                    <th class="column-title">更新时间</th>
                                                    <th class="column-title"><span class="nobr">Action</span>操作</th>
                                                    <th class="bulk-actions" colspan="4">
                                                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php $__currentLoopData = $data['products_module']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="even pointer">
                                                        <td class=" "><?php echo e($item->productName); ?>(<?php echo e($item->productDesc); ?>)</td>
                                                        <td class=" "><?php echo e($item->moduleName); ?></td>
                                                        <td class=" "><?php echo e($item->modulePrincipal); ?></td>
                                                        <td class=" "><?php echo e($item->createTime); ?></td>
                                                        <td class=" ">
                                                            <button type="button" data-content="<?php echo e($item->moduleId); ?>" class="btn btn-round btn-primary" name="modify">修改</button>
                                                            
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                            <nav>
                                                <?php echo $data['products_module']->links(); ?>

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
                    <h4 class="modal-title" id="myModalLabel">产品模块管理</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label>产品英文名（eg:qcloud）</label>
                            <input type="text" class="form-control" style="display: none" name="module-id" id="module-id" value="-1">
                            <select class="form-control show-tick selectpicker" id="products" name="products">
                               <?php $__currentLoopData = $data['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->productId); ?>"><?php echo e($item->productName); ?>(<?php echo e($item->productDesc); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <option value="-1">新增产品</option>
                            </select>
                            <label class="error" for="products"></label>
                        </div>
                        <div class="new-products">
                            <div class="form-group">
                                <label>产品英文名（eg:qcloud）</label>
                                <input type="text" class="form-control" placeholder="请输入产品英文名" name="products-en-name" id="products-en-name">
                                <label class="error" for="products-en-name"></label>
                            </div>
                            <div class="form-group">
                                <label>产品中文名(别名)</label>
                                <input type="text" class="form-control" placeholder="请输入产品中文名（选填）" name="products-ch-name" id="products-ch-name">
                                <label class="error" for="products-ch-name"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>模块英文名</label>
                            <input type="text" class="form-control" placeholder="请输入模块英文名" name="module-en-name" id="module-en-name">
                            <label class="error" for="module-en-name"></label>
                        </div>
                        <div class="form-group">
                            <label>模块中文名</label>
                            <input type="text" class="form-control" placeholder="请输入模块中文名（选填）" name="module-ch-name" id="module-ch-name">
                            <label class="error" for="module-ch-name"></label>
                        </div>
                        <div class="form-group">
                            <label>模块负责人(多个rtx_name使用英文 ; 隔开)</label>
                            <input type="text" class="form-control" placeholder="请输入模块负责人" name="module-principal" id="module-principal">
                            <label class="error" for="module-principal"></label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="modify-products">提交更改</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('components.myfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
    <script>
        //打开关闭新增产品标签页
        function showNewProduct() {
            var new_product = $('.new-products');
//            new_product.children("input").val("");
            new_product.slideDown(500);
        }
        function hideNewProduct() {
            var new_product = $('.new-products');
            new_product.slideUp(500);
        }
        //选择新增产品打开编辑框
        $('#products').change(function () {
            var id = $(this).val();
            if(id == -1){
                showNewProduct();
            }else{
                hideNewProduct();
            }
        });
        $("#modify-products").click(function () {
            var pid = $('#products').val();
            var mid = $('#module-id').val();
            var products_en_name = $("input[name='products-en-name']");
            var products_ch_name = $("input[name='products-ch-name']");

            var module_en_name = $("input[name='module-en-name']");
            var module_ch_name = $("input[name='module-ch-name']");
            var module_principal = $("input[name='module-principal']");
            var reg = /^[A-Za-z]+$/; // 判断输入的是不是字母
            var reg1 = /^[A-Za-z;]+$/; // 判断输入的是不是字母+;的组合

            if(pid == -1){
                if (products_en_name.val() === "") {
                    setError(products_en_name, "products-en-name", "不能为空");
                    return;
                } else if(! reg.test(products_en_name.val())) {
                    setError(products_en_name, "products-en-name", "只能填写英文字母");
                    return;
                }else{
                    removeError(products_en_name, "products-en-name");
                }
            }
            if (module_en_name.val() === "") {
                setError(module_en_name, "module-en-name", "不能为空");
                return;
            } else if(! reg.test(module_en_name.val())) {
                setError(module_en_name, "module-en-name", "只能填写英文字母");
                return;
            }else{
                removeError(module_en_name, "module-en-name");
            }
            if (module_principal.val() === "") {
                setError(module_principal, "module-principal", "不能为空");
                return;
            } else if(! reg1.test(module_principal.val())) {
                setError(module_principal, "module-principal", "只能填写英文字母");
                return;
            }else{
                removeError(module_principal, "module-principal");
            }

            var formData = new FormData();
            formData.append('productid', pid);
            formData.append('mid', mid);
            formData.append('products_en_name', products_en_name.val());
            formData.append('products_ch_name', products_ch_name.val());
            formData.append('module_en_name', module_en_name.val());
            formData.append('module_ch_name', module_ch_name.val());
            formData.append('module_principal', module_principal.val());

            $.ajax({
                url: "/qsdb/products/add",
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
                url: "/qsdb/products/modify?rid="+ rid ,
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
                        $("input[name='module-en-name']").val(result.detail.moduleName);
                        $("input[name='module-ch-name']").val(result.detail.moduleDesc);
                        $("input[name='module-principal']").val(result.detail.modulePrincipal);
                        $("input[name='module-id']").val(result.detail.moduleId);

                        var select_id = "#products option[value=" + result.detail.productId + "]";
                        $("#products").children().removeAttr('selected');
                        $(select_id).attr("selected","selected");

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>