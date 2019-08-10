<?php
namespace App\Entity;

class Instrument
{
    protected $name;
    protected $description;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription()
    {
        $this->description = $description;
    }
}