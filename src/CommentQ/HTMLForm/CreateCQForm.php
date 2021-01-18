<?php

namespace Fredde\CommentQ\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Fredde\CommentQ\CommentQ;

/**
 * Form to create an item.
 */
class CreateCQForm extends FormModel
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
        $commentQ = new CommentQ();
        $commentQ->setDb($this->di->get("dbqb"));
        $commentQ->userid = $session->get("uid");
        $commentQ->useracronym = $session->get("acronym");
        $commentQ->questionid = $this->form->value("QID");
        $commentQ->content = $this->form->value("content");
        $commentQ->save();
        return true;
    }



    /**
     * Callback what to do if the form was successfully submitted, this
     * happen when the submit callback method returns true. This method
     * can/should be implemented by the subclass for a different behaviour.
     */
    public function callbackSuccess()
    {
        $this->di->get("response")->redirect("forum/question/$this->redirectid")->send();
    }
}
