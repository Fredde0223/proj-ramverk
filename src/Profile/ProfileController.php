<?php

namespace Fredde\Profile;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Fredde\Profile\HTMLForm\UpdateForm;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class ProfileController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * Show all items.
     *
     * @return object as a response object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $session = $this->di->get("session");
        $userData = new Profile();
        $userData->setDb($this->di->get("dbqb"));
        $acronym = $session->get("acronym");

        if ($acronym != null) {
            $page->add("user/profile", [
                "users" => $userData->findAll(),
                "loggedin" => $acronym,
            ]);
        } else {
            $page->add("nouser/nouser");
        }

        return $page->render([
            "title" => "Profile page",
        ]);
    }

    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function updateAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new UpdateForm($this->di, $id);
        $form->check();

        $page->add("user/update", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "Update profile",
        ]);
    }

    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     */
    public function logoutAction()
    {
        $session = $this->di->get("session");
        $session->set("acronym", null);
        $session->set("uid", null);

        $this->di->get("response")->redirect("")->send();
    }
}
