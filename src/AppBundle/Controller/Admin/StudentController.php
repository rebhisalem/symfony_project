<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Student;

/**
 *
 * @Route("/admin/student")
 * @Security("has_role('Student')")
 *
 */
class StudentController extends Controller
{
    /**
     * Student homepage.
	 *
     * @Route("/", name="admin_student_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('admin/student/index.html.twig', array());
    }	
}
