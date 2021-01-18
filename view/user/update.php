<?php

namespace Anax\View;

/**
 * View to update user info.
 */

// Gather incoming variables and use default values if not set
$user = isset($user) ? $user : null;

// Create urls for navigation
$urlToView = url("profile");

?><h1>Update profile info</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToView ?>">Back to profile</a>
</p>
