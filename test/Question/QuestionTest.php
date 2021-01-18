<?php

namespace Fredde\Question;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Answer answer class.
 */
class QuestionTest extends TestCase
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
    public function testQuestion()
    {
        $session = $this->di->get("session");

        $createForm = new HTMLForm\CreateQForm($this->di);
        $this->assertInstanceOf("\Fredde\Question\HTMLForm\CreateQForm", $createForm);

        $session->set("acronym", null);
        $quesClass = new QuestionController();
        $quesClass->setDI($this->di);
        $result = $quesClass->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $result);

        $session->set("acronym", "Olle");
        $quesClass2 = new QuestionController();
        $quesClass2->setDI($this->di);
        $result2 = $quesClass2->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $result2);

        $result3 = $quesClass2->newquestionAction();
        $this->assertInstanceOf(ResponseUtility::class, $result3);

        $result4 = $quesClass2->questionAction(1);
        $this->assertInstanceOf(ResponseUtility::class, $result4);

        $result5 = $quesClass2->answerAction(1);
        $this->assertInstanceOf(ResponseUtility::class, $result5);

        $result6 = $quesClass2->qcommentAction(1);
        $this->assertInstanceOf(ResponseUtility::class, $result6);

        $result7 = $quesClass2->acommentAction(1, 1);
        $this->assertInstanceOf(ResponseUtility::class, $result7);

        $session->set("acronym", null);
    }
}
