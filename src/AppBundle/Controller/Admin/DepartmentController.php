<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Form\DepartmentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Department;

/**
 *
 * @Route("/admin/department")
 * @Security("has_role('Admin')")
 *
 */
class DepartmentController extends Controller
{
    /**
     * Lists all Departments.
	 *
     * @Route("/", name="admin_department_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $departments = $entityManager->getRepository('AppBundle:Department')->findAll();

        return $this->render('admin/department/index.html.twig', array('departments' => $departments));
    }
	
	/**
     * Creates a new department.
     *
     * @Route("/newDepartment", name="admin_department_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newDepartmentAction(Request $request)
    {
		$passwordEncoder = $this->container->get('security.password_encoder');
        $department = new department();

        $form = $this->createForm(new DepartmentType(), $department)
            ->add('saveAndCreateNew', 'submit');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($department);
            $entityManager->flush();

            $this->addFlash('success', 'department.created_successfully');

            return $this->redirectToRoute('admin_department_index');
        }

        return $this->render('admin/department/newDepartment.html.twig', array(
            'department' => $department,
            'form' => $form->createView(),
        ));
    }
	
	/**
     * Deletes a department.
     *
     * @Route("/{id}", name="admin_department_delete")
     * @Method({"GET", "DELETE"})
     *
     */
    public function deleteAction(Department $department)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($department);
        $entityManager->flush();
		$this->addFlash('success', 'department.deleted_successfully');
		
        return $this->redirectToRoute('admin_department_index');
    }
}
