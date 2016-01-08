

    <?php echo btn_add('dashboard/users/create', ' User'); ?>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>E-mail</th>
                <th>Username</th>
                <th>Date Created</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user->first_name . " " . $user->last_name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->created_date; ?></td>
                    <td>

                        <?php echo btn_edit('dashboard/users/edit/' . $user->user_id); ?> |
                        <?php echo btn_delete('dashboard/users/delete/' . $user->user_id); ?> |
                        <?php //echo btn_reset_password('dashboard/users/reset/' . $user->user_id.'/password'); ?> 
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <ul class="pagination">
        <?php echo "<h1>page</h1>"; ?>
    </ul>
