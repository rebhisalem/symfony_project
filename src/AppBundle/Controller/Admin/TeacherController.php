<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Teacher;
use AppBundle\Form\MyFileType;
use AppBundle\Form\SubjectLoad;

/**
 *
 * @Route("/admin/teacher")
 * @Security("has_role('Admin')")
 *
 */
class TeacherController extends Controller
{
	
	/**
     * Teacher Load List.
	 *
     * @Route("/", name="admin_teacher_load")
     * @Method({"GET", "POST"})
     */
    public function loadTeachersAction(Request $request)
    {
		$file = new MyFileType();
		$form = $this->createForm(new SubjectLoad(), $file);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
			$myfile = $form['sourceFile']->getData();
			$handle = fopen($myfile->getPathname(), "r");
			$count = 0;
			while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
				if($count != 0){
					$teacher = new Teacher();
					$teacher->setFirstname($data[0]);
					$teacher->setLastname($data[1]);
					$teacher->setDepartment($data[3]);
					$teacher->setGrade($data[2]);
					$teacher->setEmail($data[4]);
					$entityManager = $this->getDoctrine()->getManager();
					$department = $entityManager->getRepository('AppBundle:Department')->findOneByLabel($data[3]);
					$teacher->setDepartment($department);
					$teacher->setUsername($data[4]);
					$teacher->setPassword($data[0]);
					$teacher->setRoles(array('Teacher'));
					$entityManager->persist($teacher);
					$entityManager->flush();
					
				}
				$count++;	
			}
			return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/teacher/load_teacher.html.twig', array(
			'file' => $file,
            'form' => $form->createView(),
        ));
    }
	
	/**
     * View List.
	 *
     * @Route("/viewEngList/{id}", requirements={"id" = "\d+"}, name="admin_teacher_englistview")
     * @Method("GET")
     */
    public function viewEngListAction(Teacher $teacher, Request $request)
    {
		$entityManager = $this->getDoctrine()->getManager();
        $sessions = $entityManager->getRepository('AppBundle:Session')->findByStype(0);
		$array_president = array();
		$array_examinateur = array();
		$array_encadrant = array();
		foreach($sessions as $session){
			if($session->getPresident()==$teacher){
				$array_president[]=$session;
			}else{
				$soutenances = $session->getSoutenances();
				foreach($soutenances as $soutenance){
					if($soutenance->getExaminateur()==$teacher){
						if(!in_array($session, $array_examinateur))
							$array_examinateur[] = $session;
					}else if($soutenance->getEncadrant()==$teacher){
						if(!in_array($session, $array_encadrant))
							$array_encadrant[] = $session;
					}
				}
			}
		}
        return $this->render('admin/teacher/englist.html.twig', array('sessions_president' => $array_president, 'sessions_examinateur' => $array_examinateur, 'sessions_encadrant' => $array_encadrant, 'teacher' => $teacher));
    }
	
	/**
     * View List.
	 *
     * @Route("/viewEngListJuin/{id}", requirements={"id" = "\d+"}, name="admin_teacher_englistjuinview")
     * @Method("GET")
     */
    public function viewEngListJuinAction(Teacher $teacher, Request $request)
    {
		$entityManager = $this->getDoctrine()->getManager();
        $sessions = $entityManager->getRepository('AppBundle:Session')->findByStype(0);
		$array_president = array();
		$array_examinateur = array();
		$array_encadrant = array();
		foreach($sessions as $session){
			if($session->getPresident()==$teacher){
				$array_president[]=$session;
			}else{
				$soutenances = $session->getSoutenances();
				foreach($soutenances as $soutenance){
					if($soutenance->getExaminateur()==$teacher){
						if(!in_array($session, $array_examinateur))
							$array_examinateur[] = $session;
					}else if($soutenance->getEncadrant()==$teacher){
						if(!in_array($session, $array_encadrant))
							$array_encadrant[] = $session;
					}
				}
			}
		}
        return $this->render('admin/teacher/englist_juin.html.twig', array('sessions_president' => $array_president, 'sessions_examinateur' => $array_examinateur, 'sessions_encadrant' => $array_encadrant, 'teacher' => $teacher));
    }
	
	/**
     * View List.
	 *
     * @Route("/viewLicList/{id}", requirements={"id" = "\d+"}, name="admin_teacher_liclistview")
     * @Method("GET")
     */
    public function viewLicListAction(Teacher $teacher, Request $request)
    {
		$entityManager = $this->getDoctrine()->getManager();
        $sessions = $entityManager->getRepository('AppBundle:Session')->findByStype(1);
		$array_president = array();
		$array_examinateur = array();
		$array_encadrant = array();
		foreach($sessions as $session){
			if($session->getPresident()==$teacher){
				$array_president[]=$session;
			}else{
				$soutenances = $session->getSoutenances();
				foreach($soutenances as $soutenance){
					if($soutenance->getExaminateur()==$teacher){
						if(!in_array($session, $array_examinateur))
							$array_examinateur[] = $session;
					}else if($soutenance->getEncadrant()==$teacher){
						if(!in_array($session, $array_encadrant))
							$array_encadrant[] = $session;
					}
				}
			}
		}
        return $this->render('admin/teacher/liclist.html.twig', array('sessions_president' => $array_president, 'sessions_examinateur' => $array_examinateur, 'sessions_encadrant' => $array_encadrant, 'teacher' => $teacher));
    }
	
	/**
     * View List.
	 *
     * @Route("/viewLicListJuin/{id}", requirements={"id" = "\d+"}, name="admin_teacher_liclistjuinview")
     * @Method("GET")
     */
    public function viewLicListJuinAction(Teacher $teacher, Request $request)
    {
		$entityManager = $this->getDoctrine()->getManager();
        $sessions = $entityManager->getRepository('AppBundle:Session')->findByStype(1);
		$array_president = array();
		$array_examinateur = array();
		$array_encadrant = array();
		foreach($sessions as $session){
			if($session->getPresident()==$teacher){
				$array_president[]=$session;
			}else{
				$soutenances = $session->getSoutenances();
				foreach($soutenances as $soutenance){
					if($soutenance->getExaminateur()==$teacher){
						if(!in_array($session, $array_examinateur))
							$array_examinateur[] = $session;
					}else if($soutenance->getEncadrant()==$teacher){
						if(!in_array($session, $array_encadrant))
							$array_encadrant[] = $session;
					}
				}
			}
		}
        return $this->render('admin/teacher/liclist.html.twig', array('sessions_president' => $array_president, 'sessions_examinateur' => $array_examinateur, 'sessions_encadrant' => $array_encadrant, 'teacher' => $teacher));
    }
	
	/**
     * View List.
	 *
     * @Route("/viewLicListFiche/{id}", requirements={"id" = "\d+"}, name="admin_teacher_liclistficheview")
     * @Method("GET")
     */
    public function viewLicListFicheAction(Teacher $teacher, Request $request)
    {
		$entityManager = $this->getDoctrine()->getManager();
        $sessions = $entityManager->getRepository('AppBundle:Session')->findByStype(1);
		$array_president = array();
		$array_examinateur = array();
		$array_encadrant = array();
		foreach($sessions as $session){
			$soutenances = $session->getSoutenances();
			foreach($soutenances as $soutenance){
				if($soutenance->getSubject()->getEncadrant()==$teacher || $soutenance->getSubject()->getCoEncadrant()==$teacher){
					if(!in_array($session, $array_encadrant))
						$array_encadrant[] = $session;
				}
			}
		}
        return $this->render('admin/teacher/fiche_lic.html.twig', array('sessions_encadrant' => $array_encadrant, 'teacher' => $teacher));
    }
	
	/**
     * View List.
	 *
     * @Route("/viewIngListFiche/{id}", requirements={"id" = "\d+"}, name="admin_teacher_inglistficheview")
     * @Method("GET")
     */
    public function viewIngListFicheAction(Teacher $teacher, Request $request)
    {
		$entityManager = $this->getDoctrine()->getManager();
        $sessions = $entityManager->getRepository('AppBundle:Session')->findByStype(0);
		$array_president = array();
		$array_examinateur = array();
		$array_encadrant = array();
		foreach($sessions as $session){
			$soutenances = $session->getSoutenances();
			foreach($soutenances as $soutenance){
				if($soutenance->getSubject()->getEncadrant()==$teacher || $soutenance->getSubject()->getCoEncadrant()==$teacher){
					if(!in_array($session, $array_encadrant))
						$array_encadrant[] = $session;
				}
			}
		}
        return $this->render('admin/teacher/fiche_ing.html.twig', array('sessions_encadrant' => $array_encadrant, 'teacher' => $teacher));
    }
}
