<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Form\SessionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Session;

/**
 *
 * @Route("/admin/session")
 * @Security("has_role('Admin')")
 *
 */
class SessionController extends Controller
{
	
	/**
     * Lists all Sessions.
	 *
     * @Route("/", name="admin_session_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $sessions = $entityManager->getRepository('AppBundle:Session')->findAll();

        return $this->render('admin/session/index.html.twig', array('sessions' => $sessions));
    }
	
	/**
     * View Session.
	 *
     * @Route("/viewSession/{id}", requirements={"id" = "\d+"}, name="admin_session_view")
     * @Method("GET")
     */
    public function viewSessionAction(Session $session, Request $request)
    {
		$entityManager = $this->getDoctrine()->getManager();
        $sessions = $entityManager->getRepository('AppBundle:Session')->findBySection($session->getSection());
		$nbr = array_search($session, $sessions)+1;
		if(substr( $session->getSection(), 0, 2 )==="LA") $nbr = "L".substr( $session->getSection(), 2, 1 ).$nbr;
		else $nbr = substr( $session->getSection(), 0, 1 ).$nbr;
        return $this->render('admin/session/single.html.twig', array('session' => $session, 'nbr' => $nbr));
    }
	
	/**
     * Edit Session.
	 *
     * @Route("/editSession/{id}", requirements={"id" = "\d+"}, name="admin_session_edit")
     * @Method({"GET", "POST"})
     */
    public function editSessionAction(Session $session, Request $request)
    {
		$session2 = new Session();

        $form = $this->createForm(new SessionType(), $session2);

        $form->handleRequest($request);
		
        return $this->render('admin/session/editSession.html.twig', array('session' => $session, 'form' => $form->createView(),));
    }
    
	/**
     * Creates a new session.
     *
     * @Route("/newSession", name="admin_session_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newSessionAction(Request $request)
    {
		
        $session = new Session();

        $form = $this->createForm(new SessionType(), $session);

        $form->handleRequest($request);

        return $this->render('admin/session/newSession.html.twig', array(
            'session' => $session,
            'form' => $form->createView(),
        ));
    }
	
	/**
     * Deletes a session.
     *
     * @Route("/{id}", name="admin_session_delete")
     * @Method({"GET", "DELETE"})
     *
     */
    public function deleteAction(Session $session)
    {
        $entityManager = $this->getDoctrine()->getManager();
		foreach($soutenances = $session->getSoutenances() as $soutenance){
			$soutenance->getStudent()->setAffected(0);
			$entityManager->remove($soutenance);
		}
        $entityManager->remove($session);
        $entityManager->flush();
		$this->addFlash('success', 'session.deleted_successfully');
		
        return $this->redirectToRoute('admin_session_index');
    }
	
}
