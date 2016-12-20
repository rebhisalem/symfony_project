<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Form\AdminType;
use AppBundle\Form\StudentType;
use AppBundle\Form\TeacherType;
use AppBundle\Form\ResponsableType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\User;
use AppBundle\Entity\Admin;
use AppBundle\Entity\Student;
use AppBundle\Entity\Subject;
use AppBundle\Entity\Teacher;
use AppBundle\Entity\Responsable;

/**
 *
 * @Route("/admin/user")
 * @Security("has_role('Admin')")
 *
 */
class UserController extends Controller
{
    /**
     * Lists all Users.
     * @Route("/", name="admin_user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $entityManager->getRepository('AppBundle:User')->findAll();

        return $this->render('admin/user/index.html.twig', array('users' => $users));
    }
	
	/**
     * Creates a new Admin.
     *
     * @Route("/newAdmin", name="admin_admin_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newAdminAction(Request $request)
    {
		$passwordEncoder = $this->container->get('security.password_encoder');
        $admin = new Admin();

        $form = $this->createForm(new AdminType(), $admin)
            ->add('saveAndCreateNew', 'submit');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $admin->setRoles(array('Admin'));
			$encodedPassword = $passwordEncoder->encodePassword($admin, $admin->getPassword());
			$admin->setPassword($encodedPassword);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($admin);
            $entityManager->flush();

            $this->addFlash('success', 'admin.created_successfully');

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/newAdmin.html.twig', array(
            'admin' => $admin,
            'form' => $form->createView(),
        ));
    }
	
	/**
     * Creates a new Responsable.
     *
     * @Route("/newResponsable", name="admin_responsable_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newResponsableAction(Request $request)
    {
		$passwordEncoder = $this->container->get('security.password_encoder');
        $responsable = new responsable();

        $form = $this->createForm(new ResponsableType(), $responsable)
            ->add('saveAndCreateNew', 'submit');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $responsable->setRoles(array('Responsable'));
			$encodedPassword = $passwordEncoder->encodePassword($responsable, $responsable->getPassword());
			$responsable->setPassword($encodedPassword);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($responsable);
            $entityManager->flush();

            $this->addFlash('success', 'responsable.created_successfully');

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/newResponsable.html.twig', array(
            'responsable' => $responsable,
            'form' => $form->createView(),
        ));
    }
	
	
	/**
     * Creates a new Student.
     *
     * @Route("/newStudent", name="admin_student_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newStudentAction(Request $request)
    {
		$passwordEncoder = $this->container->get('security.password_encoder');
        $student = new Student();

        $form = $this->createForm(new StudentType(), $student)
            ->add('saveAndCreateNew', 'submit');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $student->setRoles(array('Student'));
			$encodedPassword = $passwordEncoder->encodePassword($student, $student->getPassword());
			$student->setPassword($encodedPassword);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            $this->addFlash('success', 'student.created_successfully');

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/newStudent.html.twig', array(
            'student' => $student,
            'form' => $form->createView(),
        ));
    }
	
	/**
     * Creates a new Teacher.
     *
     * @Route("/newTeacher", name="admin_teacher_new")
     * @Method({"GET", "POST"})
     *
     */
    public function newTeacherAction(Request $request)
    {
		$passwordEncoder = $this->container->get('security.password_encoder');
        $teacher = new Teacher();

        $form = $this->createForm(new TeacherType(), $teacher)
            ->add('saveAndCreateNew', 'submit');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $teacher->setRoles(array('Teacher'));
			$encodedPassword = $passwordEncoder->encodePassword($teacher, $teacher->getPassword());
			$teacher->setPassword($encodedPassword);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($teacher);
            $entityManager->flush();

            $this->addFlash('success', 'teacher.created_successfully');

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/newTeacher.html.twig', array(
            'teacher' => $teacher,
            'form' => $form->createView(),
        ));
    }
	
	/**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{id}/edit", requirements={"id" = "\d+"}, name="admin_user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(User $user, Request $request)
    {
		if(in_array("Admin", $user->getRoles())){
			$entityManager = $this->getDoctrine()->getManager();

			$editForm = $this->createForm(new AdminType(), $user);

			$editForm->handleRequest($request);

			if ($editForm->isSubmitted() && $editForm->isValid()) {
				
				$entityManager->flush();

				$this->addFlash('success', 'post.updated_successfully');

				return $this->redirectToRoute('admin_user_edit', array('id' => $user->getId()));
			}

			return $this->render('admin/user/editAdmin.html.twig', array(
				'user'        => $user,
				'edit_form'   => $editForm->createView(),
			));
		}
		
		if(in_array("Responsable", $user->getRoles())){
			$entityManager = $this->getDoctrine()->getManager();

			$editForm = $this->createForm(new ResponsableType(), $user);

			$editForm->handleRequest($request);

			if ($editForm->isSubmitted() && $editForm->isValid()) {
				
				$entityManager->flush();

				$this->addFlash('success', 'post.updated_successfully');

				return $this->redirectToRoute('admin_user_edit', array('id' => $user->getId()));
			}

			return $this->render('admin/user/editResponsable.html.twig', array(
				'user'        => $user,
				'edit_form'   => $editForm->createView(),
			));
		}
		
		if(in_array("Student", $user->getRoles())){
			$entityManager = $this->getDoctrine()->getManager();

			$editForm = $this->createForm(new StudentType(), $user);

			$editForm->handleRequest($request);

			if ($editForm->isSubmitted() && $editForm->isValid()) {
				
				$entityManager->flush();

				$this->addFlash('success', 'post.updated_successfully');

				return $this->redirectToRoute('admin_user_edit', array('id' => $user->getId()));
			}

			return $this->render('admin/user/editStudent.html.twig', array(
				'user'        => $user,
				'edit_form'   => $editForm->createView(),
			));
		}
		
		if(in_array("Teacher", $user->getRoles())){
			$entityManager = $this->getDoctrine()->getManager();

			$editForm = $this->createForm(new TeacherType(), $user);

			$editForm->handleRequest($request);

			if ($editForm->isSubmitted() && $editForm->isValid()) {
				
				$entityManager->flush();

				$this->addFlash('success', 'post.updated_successfully');

				return $this->redirectToRoute('admin_user_edit', array('id' => $user->getId()));
			}

			return $this->render('admin/user/editTeacher.html.twig', array(
				'user'        => $user,
				'edit_form'   => $editForm->createView(),
			));
		}
    }
	
	/**
     * Deletes a User.
     *
     * @Route("/{id}", name="admin_user_delete")
     * @Method({"GET", "DELETE"})
     *
     */
    public function deleteAction(User $user)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();
		$this->addFlash('success', 'user.deleted_successfully');
        return $this->redirectToRoute('admin_user_index');
    }
	
}
