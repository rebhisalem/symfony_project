<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Form\SessionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Soutenance;

/**
 *
 * @Route("/admin/soutenance")
 * @Security("has_role('Admin')")
 *
 */
class SoutenanceController extends Controller
{

	/**
     * Deletes a soutenance.
     *
     * @Route("/{id}", name="admin_soutenance_delete")
     * @Method({"GET", "DELETE"})
     *
     */
    public function deleteAction(Soutenance $soutenance)
    {
        $entityManager = $this->getDoctrine()->getManager();
		$soutenance->getStudent()->setAffected(0);
        $entityManager->remove($soutenance);
        $entityManager->flush();
		return '';
    }
	
}
