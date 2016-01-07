<nav>
    <section class="navbar navbar-inverse">
        <div class="collapse navbar-collapse" id="">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo site_url('dashboard/');?>">Home</a></li>
                <li><a href="<?php echo site_url('dashboard/users'); ?>">User</a></li>
                <li><a href="<?php echo site_url('dashboard/categories'); ?>">Category</a></li>
                <li><a href="<?php echo site_url('dashboard/posts'); ?>">Post</a></li>
                <li><a href="<?php echo site_url('dashboard/medias'); ?>">Media</a></li>
                <li><a href="<?php echo site_url('dashboard/posts/order'); ?>">Order Posts</a></li>
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