<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Form\ClassroomType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Classroom;

/**
 *
 * @Route("/admin/classroom")
 * @Security("has_role('Admin')")
 *
 */
class ClassroomController extends Controller
{
    /**
     * Lists all Classrooms.
	 *
     * @Route("/", name="admin_classroom_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $classrooms = $entityManager->getRepository('AppBundle:Classroom')->findAll();

        return $this->render('admin/classroom/index.html.twig', array('classrooms' => $classrooms));
    }
	
	/**
     * Creates a new classroom.
     *
     * @Route("/newClassroom", name="admin_classroom_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newClassroomAction(Request $request)
    {
        $classroom = new Classroom();

        $form = $this->createForm(new ClassroomType(), $classroom)
            ->add('saveAndCreateNew', 'submit');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classroom);
            $entityManager->flush();

            $this->addFlash('success', 'classroom.created_successfully');

            return $this->redirectToRoute('admin_classroom_index');
        }

        return $this->render('admin/classroom/newClassroom.html.twig', array(
            'classroom' => $classroom,
            'form' => $form->createView(),
        ));
    }
	
	/**
     * Deletes a classroom.
     *
     * @Route("/{id}", name="admin_classroom_delete")
     * @Method({"GET", "DELETE"})
     *
     */
    public function deleteAction(Classroom $classroom)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($classroom);
        $entityManager->flush();
		$this->addFlash('success', 'classroom.deleted_successfully');
		
        return $this->redirectToRoute('admin_classroom_index');
    }
}
