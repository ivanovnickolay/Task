<?php

namespace Home\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\True;

/**
 * Task
 */
class Task
{
    /**
     * @var integer
     */
    private $id;


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
     * @var string
     */
    private $nametask;

    /**
     * @var \DateTime
     */
    private $begintask;

    /**
     * @var \DateTime
     */
    private $endtask;


    /**
     * Set name_task
     *
     * @param string $nameTask
     * @return Task
     */
    public function setNameTask($nameTask)
    {
        $this->nametask = $nameTask;

        return $this;
    }

    /**
     * Get name_task
     *
     * @return string 
     */
    public function getNameTask()
    {
        return $this->nametask;
    }

    /**
     * Set begin_task
     *
     * @param \DateTime $beginTask
     * @return Task
     */
    public function setBeginTask($beginTask)
    {
        $this->begintask = $beginTask;

        return $this;
    }

    /**
     * Get begin_task
     *
     * @return \DateTime 
     */
    public function getBeginTask()
    {
        return $this->begintask;
    }

    /**
     * Set end_task
     *
     * @param \DateTime $endTask
     * @return Task
     */
    public function setEndTask($endTask)
    {
        $this->endtask = $endTask;

        return $this;
    }

    /**
     * Get end_task
     *
     * @return \DateTime 
     */
    public function getEndTask()
    {
        return $this->endtask;
    }

   public function isEnd_task_valid(){
   // $Interval = date_diff($this->end_task,$this->begin_task);
    // дата конца не может быть раньше деты начала
      if ($this->begintask>$this->endtask)
      {return false;}
      else {return true;}
   }
   public static function loadValidatorMetadata(ClassMetadata $metadata)
  {
     $metadata->addGetterConstraint('end_task_valid', new True(array(
        'message' => 'Дата окончания должна быть больше даты начала',
  )));
  }
    /**
     * @var \Home\TaskBundle\Entity\Category
     */
    private $Category;


    /**
     * Set Category
     *
     * @param \Home\TaskBundle\Entity\Category $category
     * @return Task
     */
    public function setCategory(\Home\TaskBundle\Entity\Category $category = null)
    {
        $this->Category = $category;

        return $this;
    }

    /**
     * Get Category
     *
     * @return \Home\TaskBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->Category;
    }

    /**
     * @var \Home\TaskBundle\Entity\Subtask
     */
    private $Subtask;


    /**
     * Set Subtask
     *
     * @param \Home\TaskBundle\Entity\Subtask $subtask
     * @return Task
     */
    public function setSubtask(\Home\TaskBundle\Entity\Subtask $subtask = null)
    {
        $this->Subtask = $subtask;

        return $this;
    }

    /**
     * Get Subtask
     *
     * @return \Home\TaskBundle\Entity\Subtask 
     */
    public function getSubtask()
    {
        return $this->Subtask;
    }

    public function __toString()
    {
        return $this->getId();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Subtask = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Subtask
     *
     * @param \Home\TaskBundle\Entity\Subtask $subtask
     * @return Task
     */
    public function addSubtask(\Home\TaskBundle\Entity\Subtask $subtask)
    {
        $this->Subtask[] = $subtask;

        return $this;
    }

    /**
     * Remove Subtask
     *
     * @param \Home\TaskBundle\Entity\Subtask $subtask
     */
    public function removeSubtask(\Home\TaskBundle\Entity\Subtask $subtask)
    {
        $this->Subtask->removeElement($subtask);
    }
    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $vajnoct;

    /**
     * @var boolean
     */
    private $final;


    /**
     * Set description
     *
     * @param string $description
     * @return Task
     */
    public function setDescription($description)
    { // Описание задачи
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set vajnoct
     *
     * @param string $vajnoct
     * @return Task
     */
    public function setVajnoct($vajnoct)
    { // указание важности
        $this->vajnoct = $vajnoct;

        return $this;
    }

    /**
     * Get vajnoct
     *
     * @return string 
     */
    public function getVajnoct()
    {
        return $this->vajnoct;
    }

    /**
     * Set final
     *
     * @param boolean $final
     * @return Task
     */
    public function setFinal($final)
    { //отметка о завершении проекта
        $this->final = $final;

        return $this;
    }

    /**
     * Get final
     *
     * @return boolean 
     */
    public function getFinal()
    {
        return $this->final;
    }
}
