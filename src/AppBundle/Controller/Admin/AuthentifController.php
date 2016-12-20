<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 *
 * @Route("/admin/auth")
 * @Security("has_role('Admin') or has_role('Student')")
 */
class AuthentifController extends Controller
{
    /**
     * Redirect to right panel.
	 *
     * @Route("/", name="admin_index")
     * @Route("/", name="admin_auth_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        if(in_array("Admin", $this->getUser()->getRoles()))
			return $this->redirectToRoute('admin_user_index');
		else if(in_array("Student", $this->getUser()->getRoles()))
			return $this->redirectToRoute('admin_student_index');
    }
}
