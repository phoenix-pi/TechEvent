<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseProfileFormType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('username')
            ->remove('current_password')
            ->remove('email')
            ->remove('form.label.delete')
            ->add('firstName')
            ->add('lastName')
            ->add('phone',NumberType::class)
            ->add('address')
            ->add('username')
            ->add('devisFile', VichImageType::class,['label' => false,'required' => false])
            ->add('email',EmailType::class)
            ->add('plainPassword',PasswordType::class);



    }

    public function getParent()
    {
        return BaseProfileFormType::class;

    }
}
