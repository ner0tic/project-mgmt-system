<?php

namespace PMS\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationDeveloperFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        /*
        $builder->add(
            'item-name',
            'entity',
            array(
                'property'  =>  'name',
                'class'     => 'Path\To\Entity'
            )
        );
        */
    }

    public function getName()
    {
        return 'pms_developer_registration';
    }
}
