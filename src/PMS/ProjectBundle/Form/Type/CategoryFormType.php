<?php
namespace PMS\ProjectBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use PMS\Project\Entity\Category;

class CategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('description');
        $builder->add('parent', 'choice');
        $builder->add(
            'parent',
            'entity',
            array(
               'property' =>  'name',
               'class' => 'PMS\ProjectBundle\Entity\Category',
               'empty_value' => false
            )
        );
    }

    public function getName()
    {
        return 'category';
    }
}
