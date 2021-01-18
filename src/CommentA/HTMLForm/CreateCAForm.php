<?php

namespace Fredde\CommentA\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Fredde\CommentA\CommentA;

/**
 * Form to create an item.
 */
class CreateCAForm extends FormModel
{
    public $redirectid;
    public $ansid;

    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di, int $id, int $ansid)
    {
        $this->redirectid = $id;
        $this->ansid = $ansid;

        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Write new question",
            ],
            [
                "AID" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $ansid,
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
        $commentA = new CommentA();
        $commentA->setDb($this->di->get("dbqb"));
        $commentA->userid = $session->get("uid");
        $commentA->useracronym = $session->get("acronym");
        $commentA->answerid = $this->form->value("AID");
        $commentA->content = $this->form->value("content");
        $commentA->save();
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
