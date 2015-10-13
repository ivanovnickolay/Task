<?php

namespace Home\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nametask',null,array('label'=>'Наименование задачи'))
            //->add('begin_task')
            ->add('begintask','date',array('format'=>'dd.MM.yyyy','label'=>'Начало работы над задачей','widget'=>'single_text'))
            ->add('endtask','date',array('format'=>'dd.MM.yyyy','label'=>'Окончание работы над задачей','widget'=>'single_text' ))
            ->Add('Category',null,array('label'=>'Категория задачи' ))
            ->Add('description',null,array('label'=>'Описание задачи' ))
            ->Add('vajnoct','choice',array('label'=>'Важность задачи','choices'=> array('Важно' => 'Важно', 'Средне' => 'Средне', 'Не горит' => 'Не горит')))
            ->Add('final','checkbox',array('label'=>'Задача завершена?','required'=>false,))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\TaskBundle\Entity\Task'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'task';
    }
}
