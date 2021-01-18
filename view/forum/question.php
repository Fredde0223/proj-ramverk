<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$questions = isset($questions) ? $questions : null;
$answers = isset($answers) ? $answers : null;
$qcoms = isset($qcoms) ? $qcoms : null;
$acoms = isset($acoms) ? $acoms : null;

// Create urls for navigation
$urlToGoBack = url("forum");

?>



<?php foreach ($questions as $question) : ?>
    <?php if ($question->id == $currentid) : ?>
        <h1><?= $question->title ?></h1>
        <p><a href="<?= $urlToGoBack ?>">Back to forum index page</a></p>
        <p><?= $question->content ?></p>
        <p>
            Tags: <?= $question->tag1 ?>
            <?php if ($question->tag2 != null) : ?>
                , <?= $question->tag2 ?>
                <?php if ($question->tag3 != null) : ?>
                    , <?= $question->tag3 ?>
                <?php endif; ?>
            <?php endif; ?>
        </p>
        <p style="font-size: 15px">Asked by <?= $question->useracronym ?></p>
        <p style="font-size: 15px;line-height: 0">
            <a href="<?= url("forum/qcomment/$currentid"); ?>">Comment</a> | <a href="<?= url("forum/answer/$currentid"); ?>">Answer</a>
        </p>
    <?php endif; ?>
<?php endforeach; ?>

<?php foreach ($qcoms as $qcom) : ?>
    <?php if ($qcom->questionid == $currentid) : ?>
        <p style="font-size: 15px;line-height: 0"><?= $qcom->useracronym ?>: <?= $qcom->content ?></p>
    <?php endif; ?>
<?php endforeach; ?>

<?php foreach ($answers as $answer) : ?>
    <?php if ($answer->questionid == $currentid) : ?>
        <div style="border-top: 1px solid; margin-top: 40px;">
            <p><?= $answer->content ?></p>
            <p style="font-size: 15px">Aswered by <?= $answer->useracronym ?></p>
            <p style="font-size: 15px;line-height: 0"><a href="<?= url("forum/acomment/$currentid/$answer->id"); ?>">Comment</a></p>
            <?php foreach ($acoms as $acom) : ?>
                <?php if ($acom->answerid == $answer->id) : ?>
                    <p style="font-size: 15px;line-height: 0"><?= $acom->useracronym ?>: <?= $acom->content ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
