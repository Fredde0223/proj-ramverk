<?php

namespace Fredde\User;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Answer answer class.
 */
class UserTest extends TestCase
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
    public function testUser()
    {
        $session = $this->di->get("session");

        $userClass = new User();
        $userClass->setDb($this->di->get("dbqb"));
        $userClass->setPassword("testpw");
        $result = $userClass->verifyPassword("testuser", "testpw");
        $this->assertIsBool($result);

        $userClass2 = new UserController();
        $userClass2->setDI($this->di);
        $result2 = $userClass2->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $result2);

        $result3 = $userClass2->loginAction();
        $this->assertInstanceOf(ResponseUtility::class, $result3);

        $result4 = $userClass2->createAction();
        $this->assertInstanceOf(ResponseUtility::class, $result4);

        $session->set("acronym", null);
        $userClass3 = new UsersController();
        $userClass3->setDI($this->di);
        $result5 = $userClass3->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $result5);

        $session->set("acronym", "Olle");
        $userClass4 = new UsersController();
        $userClass4->setDI($this->di);
        $result6 = $userClass4->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $result6);

        $result7 = $userClass4->activityAction(1);
        $this->assertInstanceOf(ResponseUtility::class, $result7);

        $session->set("acronym", null);
    }
}
