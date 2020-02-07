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

        if (isset($options['params']) && !empty($options['params'])) {
            $uri_params = '?' . http_build_query($options['params']);
        }

        $uri = implode("/", array_filter($uri));

        return "{$uri}.xml{$uri_params}";
    }

    public function setTarget($target)
    {
        $this->target = $target;
    }
}
