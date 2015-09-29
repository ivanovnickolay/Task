<?php

namespace Home\TaskBundle\Controller;

use Home\TaskBundle\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Home\TaskBundle\Entity\Subtask;
use Home\TaskBundle\Form\SubtaskType;
use Symfony\Component\Validator\Constraints\IdenticalTo;

class SubtaskController extends Controller
{
   // public function indexAction($name)
   // {
   //     return $this->render('', array('name' => $name));
    //}
    public function NewAction($id_task)
    {
        // добавление Подзадачи к Задаче c Id = Id_task,
        $t=$this->getTask($id_task);
        $st= new Subtask();
        $st->setTask($t);
        $NewST=$this->createSubtaskForm($st, $id_task);
        return $this->render('HomeTaskBundle:Subtask:form.html.twig', array(
            'form'=>$NewST->createView(),
        ));

    }

 public function createAction(Request $request, $id_task)
 {
// вызывается при нажатии кнопки "создать" на форме
     $t=$this->getTask($id_task);
     $entity = new Subtask();
     $entity->setTask($t);
     $form = $this->createSubtaskForm($entity, $id_task);
     // Получаем ответ от формы
     $form->handleRequest($request);
     if ($form->isValid()) {
         // если нажата клавиша "сохранить"
         $em = $this->getDoctrine()->getManager();
         $em->persist($entity);
         $em->flush();
         // сохраняем введенные данные
         // и перенаправляем на страницук просмотра введенных данных
         return $this->redirect($this->generateUrl('task_show', array('id' => $id_task)));
     }
     return $this->redirect($this->generateUrl('task_show', array('id' => $id_task)));
 }


 public  function createSubtaskForm(Subtask $entity, $id_task)
 {
        $form = $this->createForm(new SubtaskType(), $entity, [
            'action' => $this->generateUrl('subtask_create', array('id_task'=>$id_task)),
            'method' => 'POST',
        ]);
     $form->add('submit', 'submit', array('label' => 'Обновить'));
   // Скрытое поле с номером записи задачи
   //  $form->add('Task','hidden',array('data'=>$id_task));
    return $form;
 }
    public function getTask($Id_task)
    {
     $em=$this->getDoctrine()->getManager()->getRepository('HomeTaskBundle:Task')->find($Id_task);
        return $em;
    }

    public function editAction($id_sub)
    {
        $id = $id_sub;
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeTaskBundle:Subtask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HomeTaskBundle:Subtask:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function updateAction(Request $request, $id_sub)
    {
        $id=$id_sub;
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeTaskBundle:Subtask')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $id_task = $entity->getTask()->getId();
            return $this->redirect($this->generateUrl('task_show', array('id' => $id_task)));
        }

        return $this->render('HomeTaskBundle:subask:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    private function createEditForm(Subtask $entity)
    {
        $form = $this->createForm(new SubtaskType(), $entity, array(
            'action' => $this->generateUrl('subtask_update', array('id_sub' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Обновить'));

        return $form;
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subtask_delete', array('id_sub' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить задачу'))
            ->getForm()
            ;
    }

}
