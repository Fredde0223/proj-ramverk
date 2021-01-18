<?php

namespace Fredde\CommentQ;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Answer answer class.
 */
class CommentQTest extends TestCase
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
    public function testComQ()
    {
        $comment = new CommentQ();
        $comment->setDb($this->di->get("dbqb"));
        $this->assertInstanceOf("\Fredde\CommentQ\CommentQ", $comment);

        $commentForm = new HTMLForm\CreateCQForm($this->di, 1);
        $this->assertInstanceOf("\Fredde\CommentQ\HTMLForm\CreateCQForm", $commentForm);
    }
}
