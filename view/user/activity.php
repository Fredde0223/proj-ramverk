<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$questions = isset($questions) ? $questions : null;
$answers = isset($answers) ? $answers : null;

?><h1>Activity for <?= $user ?></h1>

<h2>The user has asked the following questions:</h2>

<?php foreach ($questions as $question) : ?>
    <?php if ($question->useracronym == $user) : ?>
        <p style="line-height: 10px">
            <a href="<?= url("forum/question/{$question->id}"); ?>"><?= $question->content ?></a>
        </p>
    <?php endif; ?>
<?php endforeach; ?>

<h2>The user has provided the following answers:</h2>

<?php foreach ($answers as $answer) : ?>
    <?php if ($answer->useracronym == $user) : ?>
        <p style="margin-bottom: 0;line-height: 10px"><?= $answer->content ?></p>
        <a style="font-size: 15px;" href="<?= url("forum/question/{$answer->questionid}"); ?>">See question</a>
    <?php endif; ?>
<?php endforeach; ?>
