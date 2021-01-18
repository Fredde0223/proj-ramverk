<?php

namespace Anax\View;

/**
 * View to display all books.
 */

// Gather incoming variables and use default values if not set
$questions = isset($questions) ? $questions : null;

// Create urls for navigation
$urlToCreate = url("forum/newquestion");



?><h1>Forum</h1>

<p><a href="<?= $urlToCreate ?>">Write new question</a></p>


<?php foreach (array_reverse($questions) as $question) : ?>
<div style="background-color: #43ab35;
            padding: 0.5rem;
            border: 2px solid black;
            margin-bottom: 1rem;
            width: 600px;
            line-height: 10px">
    <p>
        <a href="<?= url("forum/question/{$question->id}"); ?>"><?= $question->title ?></a>
    </p>
    <p>
        <?php if ($question->tag1 != null) : ?>
            Tags: <?= $question->tag1 ?>
            <?php if ($question->tag2 != null) : ?>
                , <?= $question->tag2 ?>
                <?php if ($question->tag3 != null) : ?>
                    , <?= $question->tag3 ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php else : ?>
            No tags
        <?php endif; ?>
    </p>
    <p style="font-size: 15px"> Asked by <?= $question->useracronym ?></p>
</div>
<?php endforeach; ?>
