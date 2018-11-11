<?php

namespace UnitTests\Routing\Router;

use EOF\Routing\BaseRouter;
use EOF\Routing\Route\Route;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class BaseRouterTest extends TestCase
{
    /**
     * @covers EOF\Routing\BaseRouter::add
     * @covers EOF\Routing\BaseRouter::dispatch
     */
    public function testDispatchToOneRoute()
    {
        $fakeRoute = $this->createMock(Route::class);
        $fakeRoute
            ->expects($this->once())
            ->method('canHandle')
            ->willReturn(true);
        $fakeRoute
            ->expects($this->once())
            ->method('handle')
            ->willReturn($fakeRoute);

        $testSubject = new BaseRouter();

        $testSubject
            ->add($fakeRoute)
            ->dispatch(new Request());
    }
}
