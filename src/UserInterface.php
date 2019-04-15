<?php

namespace FaceRecognition;

interface UserInterface
{
    public function getId();

    public function getGroupId();

    public function getName();

    public function getInfo();
}