<?php
$attributes = array('class' => 'form-horizontal');
?>
    <?php echo validation_errors(); ?>

    <spam> Create User </spam>
    <hr>

        <?php echo form_open(current_url(), $attributes); ?>

        <div class="form-group" >
            <label class="col-md-4 control-label"  for="inputFirstName">First Name</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="firstname" value="<?php echo $datatoinsert["first_name"]; ?>" id="inputFirstName" placeholder="First Name" />
            </div>
        </div>

        <div class="form-group" >
            <label class="col-md-4 control-label" for="inputLastName">Last Name</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="lastname"  value="<?php echo $datatoinsert["last_name"]; ?>" id="inputLastName" placeholder="Last Name" />
            </div>
        </div>
        <div class="form-group" >
            <label class="col-md-4 control-label" for="inputUserName">Username</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="username"  value="<?php echo $datatoinsert["username"]; ?>" id="inputUserName" placeholder="Username" />
                <?php echo form_error('username'); ?>
            </div>
        </div>

        <div class="form-group" >
            <label class="col-md-4 control-label" for="inputEmail">Email</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="email" value="<?php echo $datatoinsert["email"]; ?>" id="inputEmail" placeholder="Email" />
                <?php echo form_error('email'); ?>
            </div>
        </div>

        <div class="form-group" >
            <label class="col-md-4 control-label" for="inputUserType">User Type</label>
            <div class="col-md-4">
                <?php
                ($datatoinsert["user_role"] == null) ? $usertypeid = "2" : $usertypeid = $datatoinsert["user_role"];

                $options = array(1 => "Administrator", 2 => "Web Admin", 3 => 'Author');
                $attr = 'id="inputUserType" class="form-control"';
                echo form_dropdown('usertype', $options, $usertypeid, $attr);
                ?>

            </div>
        </div>

        <div class="form-group" >
            <label class="col-md-4 control-label" for="inputPassword">Password</label>
            <div class="col-md-4">
                <input type="password" name="password" id="inputPassword" placeholder="Password" class="form-control" />
            </div>
        </div>
        <div class="form-group" >
            <label class="col-md-4 control-label" for="inputPassword"></label>
            <div class="col-md-4">
                <input type="password" name="confirmpassword" id="inputConfirmPassword" placeholder="Confirm Password"  class="form-control">
            </div>
        </div>

        <div class="form-group" >
            <div class="col-md-offset-4 col-md-4">
                <button type="submit" class="btn">Create</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    <hr>
    <div>
        <?php echo anchor('dashboard/users', 'Back To List ', 'title="user list"'); ?>
    </div>


