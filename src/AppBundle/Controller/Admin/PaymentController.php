<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Form\SessionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 *
 * @Route("/admin/payment")
 * @Security("has_role('Admin')")
 *
 */
class PaymentController extends Controller
{
	
	
	/**
     * View Payment File.
	 *
     * @Route("/viewPayment/{id}", requirements={"id" = "\d+"}, name="admin_payment_view")
     * @Method("GET")
     */
    public function viewPaymentAction(Payment $payment, Request $request)
    {

        return $this->render('admin/payment/single.html.twig', array('session' => $session));
    }
    
}
