<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Defines the form used to create and manipulate admin users.
 */
class TeacherType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('username', null, array(
                'attr' => array('autofocus' => true),
                'label' => 'label.username',
            ))
            ->add('email', 'email', array('label' => 'label.email'))
			->add('firstname', 'text', array('label' => 'label.firstname'))
			->add('lastname', 'text', array('label' => 'label.lastname'))
			->add('password', 'password', array('label' => 'label.password'))
			->add('grade', 'text', array('label' => 'label.grade'))
			->add('department')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Teacher',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_teacher';
    }
}
