<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title">
                <i class="fa fa-cloud"></i>
                <span>QSDB-Manager</span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            
                
            
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>功能区</h3>
                <ul class="nav side-menu">
                    <li <?php if($activeIndex == 1): ?> class="active" <?php endif; ?>>
                        <a href="/qsdb/admin">
                            <i class="fa fa-edit"></i> 权限管理
                        </a>
                    </li>
                    <li <?php if($activeIndex == 0): ?> class="active" <?php endif; ?>>
                        <a>
                            <i class="fa fa-home"></i> QSDB <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="nav child_menu">
                            <li <?php if($activeIndexSecend == 0): ?> class="current-page" <?php endif; ?>><a href="/qsdb/region">区域管理</a></li>
                            <li <?php if($activeIndexSecend == 1): ?> class="current-page" <?php endif; ?>><a href="/qsdb/products">产品模块管理</a></li>
                            <li <?php if($activeIndexSecend == 2): ?> class="current-page" <?php endif; ?>><a href="/qsdb/conf">配置项管理</a></li>
                        </ul>
                    </li>
                    <li <?php if($activeIndex == 2): ?> class="active" <?php endif; ?>>
                        <a>
                            <i class="fa fa-table"></i> 变更记录
                        </a>
                    </li>
                    
                        
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        
                    
                    
                        
                            
                            
                        
                    
                    
                        
                            
                            
                            
                            
                            
                        
                    
                    
                        
                            
                            
                        
                    
                
            
            
                
                
                    
                        
                            
                            
                            
                            
                            
                        
                    
                    
                        
                            
                            
                            
                            
                            
                            
                        
                    
                    
                        
                            
                            
                                
                                    
                                    
                                    
                                    
                                    
                                    
                                
                            
                            
                            
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        
            
                
            
            
                
            
            
                
            
            
                
            
        
        <!-- /menu footer buttons -->
    </div>
</div>