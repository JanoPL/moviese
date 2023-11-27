<?php

namespace App\Form;

use Symfony\Component\Form\DataTransformerInterface;

class NameTransformer implements DataTransformerInterface
{
    public function transform(mixed $value)
    {
        if ($value->getName() == null) {
            return $value->getName();
        }

        return $value->setName(preg_replace('/[^a-zA-Z0-9]/', ' ', $value->getName()));
    }

    public function reverseTransform(mixed $value)
    {
        return $value->setName(preg_replace('/[^a-zA-Z0-9]/', ' ', $value->getName()));
    }
}