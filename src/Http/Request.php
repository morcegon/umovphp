<?php

namespace Src\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Src\Builder;
use Src\Exceptions\ClientException;

/**
 * Class Request
 * @package Src\Http
 * @method get(string $target, array $options = []): Response
 * @method post(string $target, array $options = []): Response
 */
class Request
{
    protected $builder;
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->builder = new Builder;
    }

    /**
     * @param $type
     * @param $target
     * @param array $options
     * @return Response
     */
    private function makeRequest($type, $target, $options = []): ResponseInterface
    {
        $this->builder->setTarget($target);
        $endpoint = $this->builder->buildEndpoint($options);
        $query = $this->builder->getParms($options);

        return call_user_func_array([$this->client, $type], [$endpoint, $query]);
    }

    /**
     * @param $name
     * @param array $args
     * @return Response
     * @throws ClientException
     */
    public function __call($name, $args = [])
    {
        if (in_array($name, ['get', 'post']) === false) {
            throw new ClientException('Method not allowed');
        }

        $options = $args[1] ?? [];
        return $this->makeRequest($name, $args[0], $options);
    }
}
