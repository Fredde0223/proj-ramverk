<?php

namespace Fredde\CommentA;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Answer answer class.
 */
class CommentATest extends TestCase
{
    protected $di;

    /**
     * Setup $di
     */
    protected function setUp()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->di = $di;
    }

    /**
     * testing
     */
    public function testComA()
    {
        $comment = new CommentA();
        $comment->setDb($this->di->get("dbqb"));
        $this->assertInstanceOf("\Fredde\CommentA\CommentA", $comment);

        $commentForm = new HTMLForm\CreateCAForm($this->di, 1, 1);
        $this->assertInstanceOf("\Fredde\CommentA\HTMLForm\CreateCAForm", $commentForm);
    }
}
