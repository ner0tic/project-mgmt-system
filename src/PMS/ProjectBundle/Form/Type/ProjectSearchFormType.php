<?php
namespace PMS\ProjectBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use PMS\Project\Entity\Project;

class ProjectSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'query',
            'search'
        );
        $builder->add(
            'status',
            'entity',
            array(
               'property' =>  'name',
               'class' => 'PMS\ProjectBundle\Entity\Status'
            )
        );
        $builder->add(
            'category',
            'entity',
            array(
               'property' =>  'name',
               'class' => 'PMS\ProjectBundle\Entity\Category'
            )
        );
        $builder->add(
            'client',
            'entity',
            array(
               'property' =>  'name',
               'class' => 'PMS\UserBundle\Entity\Client'
            )
        );
    }

    public function getName()
    {
        return 'project_search';
    }
}
