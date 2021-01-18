<?php

namespace Fredde\Question\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Fredde\Question\Question;
use Fredde\Tag\Tag;
use Fredde\User\User;

/**
 * Form to create an item.
 */
class CreateQForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Write new question",
            ],
            [
                "topic" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "question" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                ],

                "tag1" => [
                    "type" => "select",
                    "options" => $this->getAllTags(),
                ],

                "tag2" => [
                    "type" => "select",
                    "options" => $this->getAllTags(),
                ],

                "tag3" => [
                    "type" => "select",
                    "options" => $this->getAllTags(),
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Get all items as array suitable for display in select option dropdown.
     *
     * @return array with key value of all items.
     */
    protected function getAllTags() : array
    {
        $tag = new Tag();
        $tag->setDb($this->di->get("dbqb"));

        $tags = ["" => "Select tag..."];
        foreach ($tag->findAll() as $obj) {
            $tags[$obj->word] = "{$obj->word}";
        }

        return $tags;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $session = $this->di->get("session");
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));
        $question->userid = $session->get("uid");
        $question->useracronym = $session->get("acronym");
        $question->title = $this->form->value("topic");
        $question->content = $this->form->value("question");
        $question->tag1 = $this->form->value("tag1");
        $question->tag2 = $this->form->value("tag2");
        $question->tag3 = $this->form->value("tag3");
        $question->save();
        return true;
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $session = $this->di->get("session");
        $uid = $session->get("uid");
        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $uid);
        $user->activityscore += 1;
        $user->save();
        $this->di->get("response")->redirect("forum")->send();
    }
}
