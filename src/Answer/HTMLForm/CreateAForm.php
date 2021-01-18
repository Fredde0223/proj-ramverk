<?php

namespace Fredde\Answer\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Fredde\Answer\Answer;
use Fredde\User\User;

/**
 * Form to create an item.
 */
class CreateAForm extends FormModel
{
    public $redirectid;

    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, int $id)
    {
        $this->redirectid = $id;

        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Write new question",
            ],
            [
                "QID" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $id,
                ],

                "content" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
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
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $session = $this->di->get("session");
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $answer->userid = $session->get("uid");
        $answer->useracronym = $session->get("acronym");
        $answer->questionid = $this->form->value("QID");
        $answer->content = $this->form->value("content");
        $answer->save();
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
        $this->di->get("response")->redirect("forum/question/$this->redirectid")->send();
    }
}
