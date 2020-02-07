<?php

namespace Src;

use Illuminate\Support\Str;

class Umov
{
    public function __get(string $name)
    {
        return $this->make($name);
    }

    private function make(string $resource)
    {
        $class = $this->resolveClassPath($resource);
        return new $class();
    }

    private function resolveClassPath(string $resource)
    {
        return '\\Src\\Resources\\' . Str::studly($resource);
    }
}
