<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Builder;

class BuilderTest extends TestCase
{
    protected $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new Builder;
    }

    public function testCanBuildEndPoint()
    {
        $this->builder->setTarget('item');
        $endpoint = $this->builder->buildEndpoint();

        self::assertEquals('item.xml', $endpoint);
    }

    public function testCanBuildEndpointWithParams()
    {
        $this->builder->setTarget('item');
        $endpoint = $this->builder->buildEndpoint(['params' => [
            'foo' => 'bar',
            'foo2' => 'bar2'
        ]]);

        self::assertEquals(
            'item.xml?foo=bar&foo2=bar2',
            $endpoint
        );
    }

    public function testCanBuildEndpointWithId()
    {
        $this->builder->setTarget('item');
        $endpoint = $this->builder->buildEndpoint(['id' => 1]);

        self::assertEquals(
            'item/1.xml',
            $endpoint
        );
    }

    public function testCanBuilEndpointWithAlternativeIdentifier()
    {
        $this->builder->setTarget('item');
        $endpoint = $this->builder->buildEndpoint(['alternative' => 1]);

        self::assertEquals(
            'item/alternativeIdentifier/1.xml',
            $endpoint
        );
    }
}
