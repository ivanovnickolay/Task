<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 17.10.14
 * Time: 19:38
 */

namespace Home\TaskBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SubtaskType extends AbstractType
{
    public function getName()
    {
        return 'home_taskbundle_Subtasktask';
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // TODO:  Сделать что бы дата вводилась форматировано 
        $builder
        ->add('Subtask',null,array('label'=>"Наименование подзадачи"))
        ->add('begin',null,array('format'=>'dd-MM-yyyy','label'=>'Начало работы ','widget'=>'single_text'))
        ->add('end','date',array('format'=>'dd-MM-yyyy','label'=>'Окончание работы','widget'=>'single_text' ))
        ->Add('percent','text',array('label'=>'Процент выполнения',))
        ->Add('final','checkbox',array('label'=>'Подзадача завершена?','required'=>false,));
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\TaskBundle\Entity\Subtask'
        ));
    }
}