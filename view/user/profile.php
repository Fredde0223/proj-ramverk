<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$users = isset($users) ? $users : null;

?><h1><?= $loggedin ?>'s profile</h1>

<?php $urlToLogout = url("profile/logout"); ?>

<?php foreach ($users as $user) : ?>
    <?php if ($user->acronym == $loggedin) : ?>
        <?php
            $email = "$user->email";
            $default = "https://i.gyazo.com/69d92e75dc334490d7c73180db14aa7a.png";
            $size = 100;

            $gravatar = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;

            $urlToUpdate = url("profile/update/{$user->id}");
        ?>

    <p><img src="<?php echo $gravatar; ?>" alt="" /></p>
    <p>Email: <?= $user->email ?></p>
    <p>City: <?= $user->city ?></p>
    <p>Country: <?= $user->country ?></p>
    <p>Activity Score: <?= $user->activityscore ?></p>
    <p><a href="<?= $urlToUpdate ?>">Update profile info</a></p>
    <?php endif; ?>
<?php endforeach; ?>

<p><a href="<?= $urlToLogout ?>">Log out</a></p>
