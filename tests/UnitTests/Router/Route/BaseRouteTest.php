<?php

namespace UnitTests\Router\Route;

use EOF\Routing\Route\BaseRoute;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class BaseRouteTest extends TestCase
{

    private $testSubject;

    public function setUp()
    {
        $this->testSubject = new BaseRoute('GET', '/foo/bar');
    }

    public function testCanHandleWithGoodRequest()
    {
        $request = new Request([], [], [], [], [], [ 'REQUEST_URI' => '/foo/bar', 'REQUEST_METHOD' => 'GET' ]);

        $this->assertEquals(
            true,
            $this->testSubject->canHandle($request)
        );
    }

    public function testCanHandleWithWrongRequestURI()
    {
        $request = new Request([], [], [], [], [], [ 'REQUEST_URI' => '/wrong/path', 'REQUEST_METHOD' => 'GET' ]);

        $this->assertEquals(
            false,
            $this->testSubject->canHandle($request)
        );
    }

    public function testCanHandleWithWrongRequestMethod()
    {
        $request = new Request([], [], [], [], [], [ 'REQUEST_URI' => '/foo/bar', 'REQUEST_METHOD' => 'POST' ]);

        $this->assertEquals(
            false,
            $this->testSubject->canHandle($request)
        );
    }

    public function testCanHandleWithWrongRequest()
    {
        $request = new Request();

        $this->assertEquals(
            false,
            $this->testSubject->canHandle($request)
        );
    }

}
