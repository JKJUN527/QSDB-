<?php $__env->startSection('title', 'test'); ?>

<?php $__env->startSection('header-tab'); ?>
    <?php echo $__env->make('components.headerTab', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


    


<?php $__env->startSection('custom-style'); ?>
    <style>
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid" id='cModule'>

        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#region" role="tab" data-toggle="tab">区域列表</a>
            </li>
            <li role="presentation"><a href="#module" role="tab" data-toggle="tab">模块列表</a>
            </li>
            <li role="presentation"><a href="#conf" role="tab" data-toggle="tab">配置列表</a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="region">
                <div>
                    <button data-toggle="modal" data-target="#addRegion">新增</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>region</th>
                            <th>名称</th>
                            <th>创建时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="module">
                <div>
                    <button data-toggle="modal" data-target="#addModule">新增</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>模块名</th>
                            <th>创建时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{1</td>
                            <td>2</td>
                            <td>{3</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <?php echo $__env->make('components.myfooter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-script'); ?>
    <script src="/static/config.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>