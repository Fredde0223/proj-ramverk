<?php

namespace Fredde\Start;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Fredde\Question\Question;
use Fredde\User\User;
use Fredde\Tag\Tag;
use Fredde\Start\Start;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class StartController implements ContainerInjectableInterface
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
        $question = new Question();
        $user = new User();
        $tag = new Tag();
        $start = new Start();
        $question->setDb($this->di->get("dbqb"));
        $user->setDb($this->di->get("dbqb"));
        $tag->setDb($this->di->get("dbqb"));

        $newQ = $start->getNew($question);
        $activeU = $start->getActive($user);
        $usedT = $start->getUsed($tag, $question);

        $page->add("start/start", [
            "questions" => $newQ,
            "users" => $activeU,
            "tags" => $usedT,
        ]);

        return $page->render([
            "title" => "Home page",
        ]);
    }
}
