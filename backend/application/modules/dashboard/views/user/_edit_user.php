<?php
$attributes = array('class' => 'form-horizontal');
?>
<div class="container-fluid">
    <?php echo validation_errors(); ?>
    <fieldset >
        <legend> Edit User</legend>
        <?php echo form_open(current_url(), $attributes); ?>
        <input type='hidden' name='userid' value="<?php echo $user->user_id; ?>" />

        <div class="form-group" >
            <label class="col-md-4 control-label" for="inputFirstName">First Name</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="inputFirstName" name="firstname" placeholder="First Name" value="<?php echo $user->first_name; ?>" />
            </div>
        </div>

        <div class="form-group" >
            <label class="col-md-4 control-label" for="inputLastName">Last Name</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="inputLastName" name="lastname" placeholder="Last Name" value="<?php echo $user->last_name; ?>" />
            </div>
        </div>



        <div class="form-group" >
            <label class="col-md-4 control-label" for="inputEmail">Email</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?php echo $user->email; ?>" />
            </div>
        </div>

        <div class="form-group" >
            <label class="col-md-4 control-label" for="inputUserType">User Type</label>
            <div class="col-md-4">
                <?php
               // $roles_option = array(1 => "Administrator", 2 => "Web Adnin", 3 => 'Author');
                $attr = 'id="inputUserType" class="form-control" ';
                echo form_dropdown('usertype', $roles_option, $user->user_role, $attr);
                ?>
            </div>
        </div>

        <div class="form-group" >
            <div class="col-md-offset-4 col-md-4">
                <button type="submit" class="btn">Update</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </fieldset>
    <div>
        <?php echo anchor('dashboard/users', 'Back To List ', 'title="user list"'); ?>
    </div>
</div>

