<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToViewForum = url("forum");



?><h1>New answer</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToViewForum ?>">Go back to forum page</a>
</p>
