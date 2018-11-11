<?php

namespace UnitTests\Router\Router;

use EOF\Routing\BaseRouter;
use PHPUnit\Framework\TestCase;

final class BaseRouterTest extends TestCase
{

    public function testDispatchOK()
    {
        $testSubject = new BaseRouter();

        $this->assertEquals(
            true,
            false
        );
    }

}
