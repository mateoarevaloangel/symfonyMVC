<?php
namespace App\Entity;

class Kind
{
    protected $name;
    protected $description;

    public function getName()
    {
        return $this->task;
    }

    public function setName($task)
    {
        $this->task = $task;
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