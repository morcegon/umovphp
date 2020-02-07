<?php

namespace Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Src\Http\Request;

class RequestTest extends TestCase
{
    protected $container = [];
    protected $request;

    protected function setUp(): void
    {
        parent::setUp();

        $mockHttp = new MockHandler([
            new Response(200),
            new Response(200),
        ]);

        $history = Middleware::history($this->container);

        $handlerStack = HandlerStack::create($mockHttp);
        $handlerStack->push($history);

        $this->request = new Request(new Client(['handler' => $handlerStack]));
    }

    public function testCanMakeARequest()
    {
        $response = $this->request->get('foo/bar');

        self::assertEquals(200, $response->getStatusCode());

        self::assertEquals(
            'GET',
            $this->container[0]['request']->getMethod()

        );
        self::assertEquals(
            'foo/bar.xml',
            $this->container[0]['request']->getUri()->getPath()
        );
    }

    public function testCanMakeARequestWithParams()
    {
        $this->request->get('bar/foo', [
            'params' => [
                'foo' => 'bar',
                'baz' => 'foo',
            ],
        ]);

        self::assertEquals(
            'foo=bar&baz=foo',
            $this->container[0]['request']->getUri()->getQuery()
        );
    }
}
