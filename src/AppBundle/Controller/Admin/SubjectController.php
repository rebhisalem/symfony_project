<?php

namespace AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Subject;
use AppBundle\Form\MyFileType;
use AppBundle\Form\SubjectLoad;

use AppBundle\Entity\Student;
use AppBundle\Entity\Company;
use AppBundle\Entity\ETuteur;
use AppBundle\Entity\EResponsable;
/**
 *
 * @Route("/admin/subject/load")
 * @Security("has_role('Admin')")
 *
 */
class SubjectController extends Controller
{
	
	/**
     * Subject Load List.
	 *
     * @Route("/", name="admin_subject_load")
     * @Method({"GET", "POST"})
     */
    public function loadSubjectsAction(Request $request)
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
					$student = new Student();
					$student->setFirstname($data[0]);
					$student->setLastname($data[1]);
					$student->setCIN($data[2]);
					$student->setBirthdate($data[3]);
					$student->setBirthplace($data[4]);
					$student->setAddress($data[5]);
					$student->setPostcode($data[6]);
					$student->setCity($data[7]);
					$student->setEmail($data[8]);
					$student->setGSM($data[9]);
					$student->setbac_section($data[10]);
					$student->setbac_grade($data[11]);
					$student->setbac_year($data[12]);
					$student->setinscriptionNbr($data[14]);
					$student->setinscriptionYear($data[15]);
					$student->setotherDegree($data[16]);
					$student->setotherDegreeYear($data[17]);
					$entityManager = $this->getDoctrine()->getManager();
					$section = $entityManager->getRepository('AppBundle:Section')->findOneByLabel($data[13]);
					$student->setSection($section);
					$student->setUsername($data[2]);
					$student->setPassword($data[14]);
					$student->setRoles(array('Student'));
					$entityManager->persist($student);
					$entityManager->flush();
					
					$company = new Company();
					$company->setname($data[19]);
					$company->setaddress($data[23]);
					$company->setpostcode($data[24]);
					$company->setcountry($data[25]);
					$company->setphone($data[26]);
					$company->setfax($data[27]);
					$entityManager->persist($company);
					$entityManager->flush();
					
					$eresponsable = new EResponsable();
					$eresponsable->setFirstname($data[20]);
					$eresponsable->setLastname($data[21]);
					$eresponsable->setgrade($data[22]);
					$entityManager->persist($eresponsable);
					$entityManager->flush();
					
					$etuteur = new ETuteur();
					$etuteur->setFirstname($data[28]);
					$etuteur->setLastname($data[29]);
					$etuteur->setgrade($data[30]);
					$etuteur->setgsm($data[31]);
					$etuteur->setemail($data[32]);
					$entityManager->persist($etuteur);
					$entityManager->flush();
					
					$subject = new Subject();
					$subject->setsubjectTitle($data[18]);
					$subject->setCompany($company);
					$subject->setEResponsable($eresponsable);
					$subject->setETuteur($etuteur);
					
					$encadrant = $entityManager->getRepository('AppBundle:Teacher')->findOneBy(array('firstname' => $data[33], 'lastname' => $data[34]));
					$subject->setEncadrant($encadrant);
					
					$coencadrant = $entityManager->getRepository('AppBundle:Teacher')->findOneBy(array('firstname' => $data[35], 'lastname' => $data[36]));
					if($coencadrant) $subject->setCoEncadrant($coencadrant);
					
					$subject->setStudent($student);
					$entityManager->persist($subject);
					$entityManager->flush();
					
				}
				$count++;
			}
			return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/subject/load_subject.html.twig', array(
			'file' => $file,
            'form' => $form->createView(),
        ));
    }
	
}
