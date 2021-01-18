<?php

namespace Anax\View;

// Gather incoming variables and use default values if not set
$tags = isset($tags) ? $tags : null;

?><h1>List of usable tags</h1>



<?php foreach ($tags as $tag) : ?>
    <p style="line-height: 10px"><?= $tag->id ?>. <a href="<?= url("tags/usage/$tag->word"); ?>"><?= $tag->word ?></a></p>
<?php endforeach; ?>
