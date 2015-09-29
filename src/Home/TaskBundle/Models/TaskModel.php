<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 09.10.14
 * Time: 21:34
 */

namespace Home\TaskBundle\Models;

use Doctrine\ORM\EntityManager;
use Home\TaskBundle\Controller\SubtaskController;
use Home\TaskBundle\Entity;
use Home\TaskBundle\DependencyInjection;
use Home\TaskBundle\Form\SubtaskType;



class TaskModel {

    protected $Entity;

   public function __construct(EntityManager $em)
   {
       $this->Entity=$em;
   }


    public function getCategory()
    {
        // $em=$this->getDoctrine()->getManager();
       $Cat= $this->Entity->getRepository('HomeTaskBundle:Category')->getCategoryToCount();
        return $Cat;
    }

    public function getSubtask($id_task)
     {
       $Subt=$this->Entity->getRepository('HomeTaskBundle:Subtask')->getSubtaskByTask($id_task);
         return $Subt;
     }
    public function getSubtaskForm()
    {
      $st= new Entity\Subtask();
        $f= new SubtaskController();
      $form=$f->createSubtaskForm($st);
        return $form;
    }
    public function getIdTask($Id_task)
    {
        $em=$this->Entity->getRepository('HomeTaskBundle:Task')->find($Id_task);
        return $em;
    }

    public function HotTaskBegin()
    {
        // Получение Горящих задач
        $HotTask=$this->Entity->getRepository('HomeTaskBundle:Task')->getHotTaskBegin();
        return $HotTask;
    }

} 