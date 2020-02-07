<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Exceptions\UmovException;
use Src\Resources\ServiceLocal;
use Src\Umov;

class UmovTest extends TestCase
{
    protected $uMov;

    protected function setUp(): void
    {
        parent::setUp();

        $this->uMov = new Umov;
    }

    public function testCanResolveClassThroughMain()
    {
        self::assertInstanceOf(ServiceLocal::class, $this->uMov->serviceLocal);
    }

    public function testExceptionWhenAccessNonExistentMethod()
    {
        $this->expectException(UmovException::class);
        $this->expectExceptionMessage('This resource aren\'t avaliable');

        $this->uMov->nonExistentResource;
    }
}
