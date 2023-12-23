<?php

namespace App\Entity\Rest;

use Countable;

class OutputJsonDto
{
    private array|Countable $data;
    private int $count;

    /**
     * @return array|Countable
     */
    public function getData(): Countable|array
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData(array|Countable $data): self
    {
        $this->data = $data;

        if ($count = count($this->getData())) {
            $this->count = $count;
        } else {
            $this->count = 0;
        }

        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}