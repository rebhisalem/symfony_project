<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Form\SectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Section;

/**
 *
 * @Route("/admin/section")
 * @Security("has_role('Admin')")
 *
 */
class SectionController extends Controller
{
    /**
     * Lists all Sections.
	 *
     * @Route("/", name="admin_section_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $sections = $entityManager->getRepository('AppBundle:Section')->findAll();

        return $this->render('admin/section/index.html.twig', array('sections' => $sections));
    }
	
	/**
     * Creates a new Section.
     *
     * @Route("/newSection", name="admin_section_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newSectionAction(Request $request)
    {
		$passwordEncoder = $this->container->get('security.password_encoder');
        $section = new Section();

        $form = $this->createForm(new SectionType(), $section)
            ->add('saveAndCreateNew', 'submit');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($section);
            $entityManager->flush();

            $this->addFlash('success', 'section.created_successfully');

            return $this->redirectToRoute('admin_section_index');
        }

        return $this->render('admin/section/newSection.html.twig', array(
            'section' => $section,
            'form' => $form->createView(),
        ));
    }
	
	/**
     * Deletes a Section.
     *
     * @Route("/{id}", name="admin_section_delete")
     * @Method({"GET", "DELETE"})
     *
     */
    public function deleteAction(Section $section)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($section);
        $entityManager->flush();
		$this->addFlash('success', 'section.deleted_successfully');
		
        return $this->redirectToRoute('admin_section_index');
    }
}
