<?php

namespace Fredde\Profile;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Answer answer class.
 */
class ProfileTest extends TestCase
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
    public function testProfile()
    {
        $session = $this->di->get("session");

        $updateForm = new HTMLForm\UpdateForm($this->di, 1);
        $this->assertInstanceOf("\Fredde\Profile\HTMLForm\UpdateForm", $updateForm);

        $session->set("acronym", null);
        $profClass = new ProfileController();
        $profClass->setDI($this->di);
        $result = $profClass->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $result);

        $session->set("acronym", "Olle");
        $profClass2 = new ProfileController();
        $profClass2->setDI($this->di);
        $result2 = $profClass2->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $result2);

        $result3 = $profClass2->updateAction(1);
        $this->assertInstanceOf(ResponseUtility::class, $result3);

        $profClass2->logoutAction();
        $this->assertNull($session->get("acronym"));
    }
}
