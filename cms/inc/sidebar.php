 <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
          <a href="dashboard" class="site_title"><i class="fa fa-paw"></i> <span><?php echo SITE_NAME;?></span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
          <div class="profile_pic">
            <img src="<?php echo CMS_IMAGES;?>1.jpg" alt="..." class="img-circle profile_img">
          </div>
          <div class="profile_info">
            <span><?php echo $_SESSION['full_name'];?></span>
            <h2></h2>
          </div>
          <div class="clearfix"></div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <ul class="nav side-menu">
              <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="banner">Banner</a></li>
                  <li><a href="pages">Pages</a></li>
                </ul>
              </li>

               <li><a href="category"><i class="fa fa-sitemap"></i> Category</a></li>
              
               <li><a><i class="fa fa-shopping-basket"></i> Product<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="product-add">Add Product</a></li>
                    <li><a href="product">List Product</a></li>
                  </ul>
               </li>

                <li><a href="users"><i class="fa fa-users"></i> Users</a></li>

                <li><a href="order"><i class="fa fa-shopping-cart"></i> Orders</a></li>
                
                <li><a href="advertisment"><i class="fa fa-dollar"></i>Advertisment</a></li>
            </ul>
          </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
        
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>

    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo CMS_IMAGES;?>1.jpg" alt=""><?php echo $_SESSION['full_name'];?>
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Profile</a></li>
                <li><a href="change-password"> Change Password</a></li>
                <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->