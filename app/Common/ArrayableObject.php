<?php

namespace App\Common;

use App\Common\Traits\ArrayAccessTrait;
use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

abstract class ArrayableObject implements Arrayable, ArrayAccess, JsonSerializable
{
    use ArrayAccessTrait;

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    abstract public function toArray(): array;
}
