<?php

namespace Home\TaskBundle\Controller;

use Home\TaskBundle\Entity\Subtask;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Home\TaskBundle\Entity\Task;
use Home\TaskBundle\Form\TaskType;

//use Home\TaskBundle\Entity\Subtask;
//use Home\TaskBundle\Form\SubtaskType;


//use Home\TaskBundle\Controller\DefaultController as DC;

/**
 * Task controller.
 *
 */
class TaskController extends Controller
{

    /**
     * Lists all Task entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('HomeTaskBundle:Task')->findAll();
       // $em1=$this->getDoctrine()->getManager();
       // $Cat= $em1->getRepository('HomeTaskBundle:Category')->getCategoryToCount();
        //$Cat=$this->get('TaskModel')->getCategory();

        return $this->render('HomeTaskBundle:Task:index.html.twig', array(
            'entities' => $entities,

        ));

    }

    public function TaskByCategoryAction($id_cat)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('HomeTaskBundle:Task')->getTaskByCategory($id_cat);
       // $em1=$this->getDoctrine()->getManager();
        //$Cat= $em1->getRepository('HomeTaskBundle:Category')->getCategoryToCount();
        $Cat=$this->get('TaskModel')->getCategory();
        return $this->render('HomeTaskBundle:Task:index.html.twig', array(
            'entities' => $entities,
            'categories'=>$Cat
        ));
    }
    /**
     * Creates a new Task entity.
     *
     */
    public function createAction(Request $request)
    {
        // вызывается при нажатии кнопки "создать" на форме
        $entity = new Task();
        $form = $this->createCreateForm($entity);
        // Получаем ответ от формы
        $form->handleRequest($request);

        if ($form->isValid()) {
            // если нажата клавиша "сохранить"
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            // сохраняем введенные данные
            // и перенаправляем на страницук просмотра введенных данных
            return $this->redirect($this->generateUrl('task_show', array('id' => $entity->getId())));
        }
        // если нажата клавиша "Не сохранять" то создаем новую страницу ???
        $Cat=$this->get('TaskModel')->getCategory();
        return $this->render('HomeTaskBundle:Task:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'categories'=>$Cat
        ));
    }

    /**
     * Creates a form to create a Task entity.
     *
     * @param Task $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Task $entity)
    {
        $form = $this->createForm(new TaskType(), $entity, array(
            'action' => $this->generateUrl('task_create'),
            'method' => 'POST',
        ));
        // переопределяем значение полей что бы дату по умолчанию, при создании новой задачи, ставило текущуу
        $form->add('submit', 'submit', array('label' => 'Создать задачу'));
        $form->add('begintask','date',array('format'=>'dd.MM.yyyy','label'=>'Начало работы над задачей', 'data'=> new \DateTime,'widget'=>'single_text'));
        $form->add('endtask','date',array('format'=>'dd.MM.yyyy','label'=>'Окончание работы над задачей','data'=> new \DateTime,'widget'=>'single_text' ));
        $form->add('description',null,array('label'=>'Описание задачи'));
        $form->add('vajnoct','choice',array('label'=>'Важность задачи','choices'=> array('Важно' => 'Важно', 'Средне' => 'Средне', 'Не горит' => 'Не горит')));



        return $form;
    }

    /**
     * Displays a form to create a new Task entity.
     *
     */
    public function newAction()
    {
        //вызывает форму создания новой задачи

        $entity = new Task();
        $form   = $this->createCreateForm($entity);
        $cat=$this->get('TaskModel')->getCategory();
        return $this->render('HomeTaskBundle:Task:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'categories'=>$cat,

        ));
    }

    /**
     * Finds and displays a Task entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeTaskBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Нет задачи с указанным id');
        }
        $deleteForm = $this->createDeleteForm($id);
        $cat=$this->get('TaskModel')->getCategory();
        $t=$this->get('TaskModel')->getIdTask($id);
        $SubT=$this->get('TaskModel')->getSubtask($t);
        //Subtask
        //$SubTForm=$this->get('TaskModel')->getSubtaskForm();
       return $this->render('HomeTaskBundle:Task:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'categories'=>$cat,
            'subtasks'=>$SubT,
            //'SubTForm'=>$SubTForm,
        ));
    }

    /**
     * Displays a form to edit an existing Task entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeTaskBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HomeTaskBundle:Task:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Task entity.
    *
    * @param Task $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Task $entity)
    {
        $form = $this->createForm(new TaskType(), $entity, array(
            'action' => $this->generateUrl('task_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Обновить'));

        return $form;
    }
    /**
     * Edits an existing Task entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeTaskBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Task entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('task_show', array('id' => $id)));
        }

        return $this->render('HomeTaskBundle:Task:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Task entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HomeTaskBundle:Task')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Task entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('task'));
    }

    /**
     * Creates a form to delete a Task entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('task_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить задачу'))
            ->getForm()
        ;
    }

    public function HotTaskAction()
    {
        // Формирование горящих задач и подзадач
        //todo добавить функциональность - задачи с прострроченым окончанием
        //todo подзадачи не законченные
        //Получаем задачи которые прострочены по началу
        $HotBegin=$this->get('TaskModel')->HotTaskBegin();
        return $this->render('HomeTaskBundle:Task:showHot.html.twig', array(
            'entities'      => $HotBegin,
        ));
    }

}
