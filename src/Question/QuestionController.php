<?php

namespace Fredde\Question;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Fredde\Question\HTMLForm\CreateQForm;
use Fredde\Answer\HTMLForm\CreateAForm;
use Fredde\CommentQ\HTMLForm\CreateCQForm;
use Fredde\CommentA\HTMLForm\CreateCAForm;
use Fredde\Answer\Answer;
use Fredde\CommentQ\CommentQ;
use Fredde\CommentA\CommentA;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class QuestionController implements ContainerInjectableInterface
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
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $acronym = $session->get("acronym");

        if ($acronym != null) {
            $page->add("forum/index", [
                "questions" => $question->findAll(),
            ]);
        } else {
            $page->add("nouser/nouser");
        }

        return $page->render([
            "title" => "Forum page",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function newquestionAction() : object
    {
        $page = $this->di->get("page");
        $form = new CreateQForm($this->di);
        $form->check();

        $page->add("forum/createQuestion", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "New question",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function questionAction(int $id) : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $answer = new Answer();
        $commentQ = new CommentQ();
        $commentA = new CommentA();
        $question->setDb($this->di->get("dbqb"));
        $answer->setDb($this->di->get("dbqb"));
        $commentQ->setDb($this->di->get("dbqb"));
        $commentA->setDb($this->di->get("dbqb"));

        $page->add("forum/question", [
            "questions" => $question->findAll(),
            "answers" => $answer->findAll(),
            "qcoms" => $commentQ->findAll(),
            "acoms" => $commentA->findAll(),
            "currentid" => $id,
        ]);

        return $page->render([
            "title" => "Question",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function answerAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new CreateAForm($this->di, $id);
        $form->check();

        $page->add("forum/createAnswer", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "New answer",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function qcommentAction(int $id) : object
    {
        $page = $this->di->get("page");
        $form = new CreateCQForm($this->di, $id);
        $form->check();

        $page->add("forum/createCommentQ", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "New question comment",
        ]);
    }

    /**
     * Handler with form to create a new item.
     *
     * @return object as a response object
     */
    public function acommentAction(int $id, int $ansid) : object
    {
        $page = $this->di->get("page");
        $form = new CreateCAForm($this->di, $id, $ansid);
        $form->check();

        $page->add("forum/createCommentA", [
            "form" => $form->getHTML(),
        ]);

        return $page->render([
            "title" => "New answer comment",
        ]);
    }
}
