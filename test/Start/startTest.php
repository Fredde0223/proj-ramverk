<?php

namespace Fredde\Start;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Fredde\Question\Question;
use Fredde\User\User;
use Fredde\Tag\Tag;

/**
 * Answer answer class.
 */
class StartTest extends TestCase
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
    public function testStart()
    {
        $startClass = new Start();
        $qobj = new Question();
        $qobj->setDb($this->di->get("dbqb"));
        $questions = $startClass->getNew($qobj);
        $this->assertIsArray($questions);

        $uobj = new User();
        $uobj->setDb($this->di->get("dbqb"));
        $users = $startClass->getActive($uobj);
        $this->assertIsArray($users);

        $tobj = new Tag();
        $tobj->setDb($this->di->get("dbqb"));
        $tags = $startClass->getUsed($tobj, $qobj);
        $this->assertIsArray($tags);

        $startClass2 = new StartController();
        $startClass2->setDI($this->di);
        $result2 = $startClass2->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $result2);
    }
}
