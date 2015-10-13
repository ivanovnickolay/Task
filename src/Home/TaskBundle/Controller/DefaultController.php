<?php

namespace Home\TaskBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Home\TaskBundle\Entity\Category;
use Home\TaskBundle\Entity\CategoryRepository;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //$em=$this->getDoctrine()->getManager();
        //$Cat= $em->getRepository('HomeTaskBundle:Category')->getCategoryToCount();
        //$Cat= $this->get('TaskModel')->getCategory();
        //return $this->render('HomeTaskBundle:Default:index.html.twig', array('categories' => $Cat));
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('HomeTaskBundle:Task')->findAll();
        return $this->render('HomeTaskBundle:Task:index.html.twig', array(
            'entities' => $entities,

        ));
    }
}

