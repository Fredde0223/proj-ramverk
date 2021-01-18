<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$questions = isset($questions) ? $questions : null;
$users = isset($users) ? $users : null;
$tags = isset($tags) ? $tags : null;

?><img style="display: block;margin-left: auto;margin-right: auto;" src="../htdocs/image/logo.png">

<h3 style="text-align: center;padding-bottom: 40px">Welcome to a place where u can ask anything about football!</h3>

<h2>Latest Questions</h2>

<?php foreach ($questions as $question) : ?>
        <p style="line-height: 10px"><?= $question ?></p>
<?php endforeach; ?>

<h2>Most Active Users</h2>

<?php foreach (array_keys($users) as $user) : ?>
        <p style="line-height: 10px"><?= $user ?></p>
<?php endforeach; ?>

<h2>Top Tags</h2>

<?php foreach (array_keys($tags) as $tag) : ?>
        <p style="line-height: 10px"><?= $tag ?></p>
<?php endforeach; ?>
