<?php

namespace Src;

class Builder
{
    protected $target;

    public function buildEndpoint($options = []): string
    {
        $uri = [
            'target' => $this->target,
            'id' => $options['id'] ?? null,
            'alternative' => $options['alternative']
                ? "alternativeIdentifier/{$options['alternative']}" : null,
        ];

        $uri = implode("/", array_filter($uri));

        return "{$uri}.xml";
    }

    public function getParms($options)
    {
        return !empty($options['params'])
            ? ['query' => $options['params']] : [];
    }

    public function setTarget($target)
    {
        $this->target = $target;
    }
}
