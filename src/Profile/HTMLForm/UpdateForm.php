<?php

namespace Fredde\Profile\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Fredde\Profile\Profile;

/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(ContainerInterface $di, $id)
    {
        parent::__construct($di);
        $user = $this->getUserDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update details for $user->acronym",
            ],
            [
                "ID" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->id,
                ],

                "Acronym" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->acronym,
                ],

                "Password" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->password,
                ],

                "Email" => [
                    "type" => "text",
                    "value" => $user->email,
                ],

                "City" => [
                    "type" => "text",
                    "value" => $user->city,
                ],

                "Country" => [
                    "type" => "text",
                    "value" => $user->country,
                ],

                "Score" => [
                    "type" => "hidden",
                    "readonly" => true,
                    "value" => $user->activityscore,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Profile
     */
    public function getUserDetails($id) : object
    {
        $user = new Profile();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $id);
        return $user;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return bool true if okey, false if something went wrong.
     */
    public function callbackSubmit() : bool
    {
        $user = new Profile();
        $user->setDb($this->di->get("dbqb"));
        $user->find("id", $this->form->value("ID"));
        $user->acronym = $this->form->value("Acronym");
        $user->email = $this->form->value("Email");
        $user->city = $this->form->value("City");
        $user->country = $this->form->value("Country");
        $user->activityscore = $this->form->value("Score");
        $user->save();
        return true;
    }
}
