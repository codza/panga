<nav>
    <section class="navbar navbar-inverse">
        <div class="collapse navbar-collapse" id="">
            <ul class="nav navbar-nav">
                <li class=""><a href="<?php echo site_url('dashboard/users');?>">Home</a></li>
                <li class="<?php echo (strcmp(uri_string(),"dashboard/users") ==0) ?"active":""; ?>"><a href="<?php echo site_url('dashboard/users'); ?>">User</a></li>
                <li class="<?php echo (strcmp(uri_string(),"dashboard/categories") ==0) ?"active":""; ?>"><a href="<?php echo site_url('dashboard/categories'); ?>">Category</a></li>
                <li class="<?php echo (strcmp(uri_string(),"dashboard/posts") ==0) ?"active":""; ?>"><a href="<?php echo site_url('dashboard/posts'); ?>">Post</a></li>
                <li class="<?php echo (strcmp(uri_string(),"dashboard/medias") ==0) ?"active":""; ?>"><a href="<?php echo site_url('dashboard/medias'); ?>">Media</a></li>
                <li class="<?php echo (strcmp(uri_string(),"dashboard/rabc") ==0) ?"active":""; ?>"><a href="<?php echo site_url('dashboard/rabc'); ?>">Access Management</a></li>
                
                <li class="<?php echo (strcmp(uri_string(),"dashboard/posts/order") ==0) ?"active":""; ?>"><a href="<?php echo site_url('dashboard/posts/order'); ?>">Order Posts</a></li>
            </ul>
            <!-- nav -->
            <!-- the left side of the nav bar -->
            <ul class="nav navbar-nav navbar-right">
                <li class=""><a href="<?php echo site_url('dashboard/settings'); ?>"><spam class="icon-edit"></spam><?php echo $this->userSession->username; ?></a></li>
                <li class=""><a href="<?php echo site_url('dashboard/users/logout'); ?>"><spam class="glyphicon glyphicon-off"></spam>log out</a></li>
            </ul>
        </div>
    </section><!-- navbar -->
</nav>