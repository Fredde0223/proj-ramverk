<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$users = isset($users) ? $users : null;

?><h1>Registered users</h1>



<table style="text-align: center;width: 400px;">
    <tr>
        <th>Avatar</th>
        <th>Username</th>
        <th>Score</th>
    </tr>
    <?php foreach ($users as $user) : ?>
        <tr>
            <?php
                $email = "$user->email";
                $default = "https://i.gyazo.com/69d92e75dc334490d7c73180db14aa7a.png";
                $size = 100;

                $gravatar = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
            ?>

            <td><img style="height: 40px" src="<?php echo $gravatar; ?>" alt="" /></td>
            <td><a href="<?= url("users/activity/$user->acronym"); ?>"><?= $user->acronym ?></a></td>
            <td><?= $user->activityscore ?></td>
        </tr>
    <?php endforeach; ?>
</table>
