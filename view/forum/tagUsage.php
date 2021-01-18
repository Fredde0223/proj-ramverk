<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$questions = isset($questions) ? $questions : null;

?><h1>Usage for <?= $tag ?></h1>

<p>This tag was used in the following questions asked:</p>



<?php foreach ($questions as $question) : ?>
    <?php if ($question->tag1 == $tag || $question->tag2 == $tag || $question->tag3 == $tag) : ?>
        <p>
            <a href="<?= url("forum/question/{$question->id}"); ?>"><?= $question->content ?></a>
        </p>
    <?php endif; ?>
<?php endforeach; ?>
