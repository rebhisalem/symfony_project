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
use Doctrine\ORM\EntityRepository;
/**
 * Defines the form used to create and manipulate admin users.
 */
class SessionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
			->add('section', null, array('label' => false, 'query_builder' => function(EntityRepository $er) {
				return $er->createQueryBuilder('u')
					->orderBy('u.label', 'ASC');
			},'empty_value' => false))
			->add('president', null, array('label' => false, 'query_builder' => function(EntityRepository $er) {
				return $er->createQueryBuilder('u')
					->orderBy('u.firstname', 'ASC');
			}, 'empty_value' => false, 'attr'   =>  array(
                'class'   => '')
            ))
			->add('classroom', null, array('label' => false, 'empty_value' => false, 'attr'   =>  array(
                'class'   => '')
            ))
			->add('soutenances', new SoutenanceType());
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Session',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_session';
    }
}
