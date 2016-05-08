<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Loại Bệnh<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="view-add-benh.php">Thêm Bệnh</a>
                                </li>
                                <li>
                                    <a href="view-list-benh.php">Danh Sách Bệnh</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="glyphicon glyphicon-home fa-fw"></i> Hãng thuốc<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="view-add-hang.php">Thêm hãng thuốc</a>
                                </li>
                                <li>
                                    <a href="view-list-hang.php">Liệt kê hãng thuốc</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Thuốc<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="ControllerThuoc.php?action=getadd">Thêm thuốc</a>
                                </li>
                                <li>
                                    <a href="view-list-thuoc.php">Liệt kê thuốc</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Nhập Thuốc<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="ControllerNhapThuoc.php?action=add">Thêm đơn hàng</a>
                                </li>
                                <li>
                                    <a href="view-list-nhap-hang.php">List đơn hàng</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-minus fa-fw"></i> Xuất thuốc<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="ControllerXuatThuoc.php?action=getexport">Xuất đơn hàng </a>
                                </li>
                                <li>
                                    <a href="view-list-xuat-thuoc.php">Liệt kê đơn hàng xuất</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <?php if($_SESSION['user']['level'] == 1) : ?>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="view-add-user.php">Add User</a>
                                </li>
                                <li>
                                    <a href="view-list-user.php">List User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                         <?php endif; ?>
                         
                       	
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>