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
class SoutenanceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('student', null, array('label' => false, 'query_builder' => function(EntityRepository $er) {
				return $er->createQueryBuilder('u')
					->orderBy('u.firstname', 'ASC');
			}, 'choice_attr' => function($choice, $key, $value) {
				return ['data-section' => $choice->getSection()->getId(), 'data-affected' => $choice->getAffected()];
			  }))
			->add('examinateur', null, array('label' => false, 'query_builder' => function(EntityRepository $er) {
				return $er->createQueryBuilder('u')
					->orderBy('u.firstname', 'ASC');
			}, 'empty_value' => false))
			->add('encadrant', null, array('label' => false, 'attr'   =>  array(
                'disabled'   => 'disabled')))
			->add('eTuteur', null, array('label' => false, 'attr'   =>  array(
                'disabled'   => 'disabled')))
			->add('subject', null, array('label' => false, 'attr'   =>  array(
                'disabled'   => 'disabled' ),  'choice_attr' => function($choice, $key, $value) {
    return ['data-student' => $choice->getStudent()->getId(), 'data-encadrant' => $choice->getEncadrant()->getId(), 'data-company' => $choice->getCompany()->getId(), 'data-etuteur' => $choice->getEtuteur()->getId()];
  }))
			->add('company', null, array('label' => false, 'attr'   =>  array(
                'disabled'   => 'disabled')))
			->add('stime', 'time', array('label' => false))
			
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Soutenance',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_soutenance';
    }
}
