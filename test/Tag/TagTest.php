<?php

namespace Fredde\Tag;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Answer answer class.
 */
class TagTest extends TestCase
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
    public function testTag()
    {
        $session = $this->di->get("session");

        $session->set("acronym", null);
        $tagClass = new TagController();
        $tagClass->setDI($this->di);
        $result = $tagClass->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $result);

        $session->set("acronym", "Olle");
        $tagClass2 = new TagController();
        $tagClass2->setDI($this->di);
        $result2 = $tagClass2->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $result2);

        $result3 = $tagClass2->usageAction("Boll");
        $this->assertInstanceOf(ResponseUtility::class, $result3);

        $session->set("acronym", null);
    }
}
