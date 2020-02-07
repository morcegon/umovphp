<?php

namespace Src;

use Illuminate\Support\Str;
use Src\Exceptions\UmovException;

class Umov
{
    /**
     * @param string $resource
     * @return mixed
     * @throws UmovException
     */
    public function __get(string $resource)
    {
        $class = $this->resolveClassPath($resource);

        if (class_exists($class)) {
            return new $class();
        } else {
            throw new UmovException('This resource aren\'t avaliable');
        }
    }

    private function resolveClassPath(string $resource)
    {
        return '\\Src\\Resources\\' . Str::studly($resource);
    }
}
