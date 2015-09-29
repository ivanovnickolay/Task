<?php

namespace Home\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $Catefory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Task;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Task = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Catefory
     *
     * @param string $catefory
     * @return Category
     */
    public function setCatefory($catefory)
    {
        $this->Catefory = $catefory;

        return $this;
    }

    /**
     * Get Catefory
     *
     * @return string 
     */
    public function getCatefory()
    {
        return $this->Catefory;
    }

    /**
     * Add Task
     *
     * @param \Home\TaskBundle\Entity\Task $task
     * @return Category
     */
    public function addTask(\Home\TaskBundle\Entity\Task $task)
    {
        $this->Task[] = $task;

        return $this;
    }

    /**
     * Remove Task
     *
     * @param \Home\TaskBundle\Entity\Task $task
     */
    public function removeTask(\Home\TaskBundle\Entity\Task $task)
    {
        $this->Task->removeElement($task);
    }

    /**
     * Get Task
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTask()
    {
        return $this->Task;
    }
    /**
     * @var string
     */
    private $Category;


    /**
     * Set Category
     *
     * @param string $category
     * @return Category
     */
    public function setCategory($category)
    {
        $this->Category = $category;

        return $this;
    }

    /**
     * Get Category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->Category;
    }
    public function __toString()
    {
    return $this->getCategory();
    }
}
