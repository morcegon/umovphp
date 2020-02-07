<?php

namespace Src;

class Builder
{
    protected $target;

    public function buildEndpoint($params = []): string
    {
        $result_params = null;

        if (!empty($params)) {
            $result_params = '?' . http_build_query($params);
        }

        return "{$this->target}.xml{$result_params}";
    }

    public function setTarget($target)
    {
        $this->target = $target;
    }
}
