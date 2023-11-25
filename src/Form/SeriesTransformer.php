<?php

namespace App\Form;

use Symfony\Component\Form\DataTransformerInterface;

class SeriesTransformer implements DataTransformerInterface
{
    public function __construct() {

    }

    public function transform(mixed $value)
    {
        // TODO: Implement transform() method.
    }

    public function reverseTransform(mixed $value)
    {
        // TODO: Implement reverseTransform() method.
    }
}