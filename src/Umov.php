<?php

namespace Src;

use Illuminate\Support\Str;
use Src\Exceptions\UmovException;
use Src\Resources\Item;
use Src\Resources\ServiceLocal;

/**
 * @method Item item()
 * @method ServiceLocal serviceLocal()
 */
class Umov
{
    public function __get(string $name)
    {
        return $this->make($name);
    }

    public function __call($name, $arguments)
    {
        if (! in_array($name, get_class_methods(get_class()))) {
            return $this->{$name};
        }
    }

    /**
     * @param string $resource
     * @return mixed
     * @throws UmovException
     */
    public function make(string $resource)
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
