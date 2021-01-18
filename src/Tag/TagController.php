<?php

namespace Fredde\Tag;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Fredde\Question\Question;

/**
 * A sample controller to show how a controller class can be implemented.
 */
class TagController implements ContainerInjectableInterface
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
        $tags = new Tag();
        $tags->setDb($this->di->get("dbqb"));
        $acronym = $session->get("acronym");

        if ($acronym != null) {
            $page->add("forum/tags", [
                "tags" => $tags->findAll(),
            ]);
        } else {
            $page->add("nouser/nouser");
        }

        return $page->render([
            "title" => "Tags page",
        ]);
    }

    /**
     * Handler with form to update an item.
     *
     * @param int $id the id to update.
     *
     * @return object as a response object
     */
    public function usageAction(string $tag) : object
    {
        $page = $this->di->get("page");
        $question = new Question();
        $question->setDb($this->di->get("dbqb"));

        $page->add("forum/tagUsage", [
            "questions" => $question->findAll(),
            "tag" => $tag,
        ]);

        return $page->render([
            "title" => "User activity",
        ]);
    }
}
