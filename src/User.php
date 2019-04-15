<?php

namespace FaceRecognition;

use ArrayAccess;

class User implements ArrayAccess, UserInterface
{
    use Attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function getId()
    {
        return $this->getAttribute('id');
    }

    public function getGroupId()
    {
        return $this->getAttribute('group_id');
    }

    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function getInfo()
    {
        return $this->getAttribute('info');
    }

    public function getOriginal()
    {
        return $this->getAttribute('original');
    }
}