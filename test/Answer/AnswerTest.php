<?php

namespace Fredde\Answer;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Answer answer class.
 */
class AnswerTest extends TestCase
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
    public function testAnswer()
    {
        $answer = new Answer();
        $answer->setDb($this->di->get("dbqb"));
        $this->assertInstanceOf("\Fredde\Answer\Answer", $answer);

        $answerForm = new HTMLForm\CreateAForm($this->di, 1);
        $this->assertInstanceOf("\Fredde\Answer\HTMLForm\CreateAForm", $answerForm);
    }
}
