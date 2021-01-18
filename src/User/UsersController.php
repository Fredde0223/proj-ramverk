<?php

namespace Fredde\User;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Fredde\Question\Question;
use Fredde\Answer\Answer;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class UsersController implements ContainerInjectableInterface
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
        $users = new User();
        $users->setDb($this->di->get("dbqb"));
        $acronym = $session->get("acronym");

        if ($acronym != null) {
            $page->add("user/users", [
                "users" => $users->findAll(),
            ]);
        } else {
            $page->add("nouser/nouser");
        }

        return $page->render([
            "title" => "Users page",
        ]);
    }

    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function activityAction(string $acronym) : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $answer = new Answer();
        $question->setDb($this->di->get("dbqb"));
        $answer->setDb($this->di->get("dbqb"));

        $page->add("user/activity", [
            "questions" => $question->findAll(),
            "answers" => $answer->findAll(),
            "user" => $acronym,
        ]);

        return $page->render([
            "title" => "User activity",
        ]);
    }
}
