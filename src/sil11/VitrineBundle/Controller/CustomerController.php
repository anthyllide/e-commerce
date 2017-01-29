<?php

namespace sil11\VitrineBundle\Controller;

use sil11\VitrineBundle\Entity\Customer;
use sil11\VitrineBundle\sil11VitrineBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Customer controller.
 *
 */
class CustomerController extends Controller
{
    /**
     * Lists all customer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $customers = $em->getRepository('sil11VitrineBundle:Customer')->findAll();

        return $this->render('customer/index.html.twig', array(
            'customers' => $customers,
        ));
    }

    /**
     * Creates a new customer entity.
     *
     */
    public function newAction(Request $request)
    {

        $newCustomer = new Customer();
        $form = $this->createForm('sil11\VitrineBundle\Form\CustomerType', $newCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $customers = $em->getRepository('sil11VitrineBundle:Customer')->findAll();

            foreach ($customers as $oneCustomer){

                if ($oneCustomer->getMail() == $newCustomer->getMail()){
                    $this->get('session')->getFlashBag() ->add('message','Ce login existe déjà dans la base.');
                    return $this->redirect($this->generateUrl("customer_new"));
                }
            }

            $encoder = $this->container->get('security.password_encoder');
            // On récupère l'encodeur défini dans security.yml
            $encoded = $encoder->encodePassword($newCustomer, $newCustomer->getPassword());
            // On encode le mot de passe issu du formulaire
            $newCustomer->setPassword($encoded);
            // On met à jour le mot de passe

            $em->persist($newCustomer);
            $em->flush($newCustomer);

            $messageSuccess = 'Enregistrement réussi ! Pour vous connecter à votre compte, saisissez votre login et votre mot de passe.';

            return $this->render('sil11VitrineBundle:Security:login.html.twig', array(
                'messageSuccess' => $messageSuccess
            ));
        }

        return $this->render('customer/new.html.twig', array(
            'customer' => $newCustomer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a customer entity.
     *
     */
    public function showAction(Customer $customer)
    {
        $deleteForm = $this->createDeleteForm($customer);

        return $this->render('customer/show.html.twig', array(
            'customer' => $customer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing customer entity.
     *
     */
    public function editAction(Request $request, Customer $customer)
    {
        $deleteForm = $this->createDeleteForm($customer);
        $editForm = $this->createForm('sil11\VitrineBundle\Form\CustomerType', $customer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            // On récupère l'encodeur défini dans security.yml
            $encoder = $this->container->get('security.password_encoder');

            // On encode le mot de passe issu du formulaire
            $encoded = $encoder->encodePassword($customer, $editForm->get('password')->getData());

            $customer->setPassword($encoded);
            // On met à jour le mot de passe

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('customer_show', array('id' => $customer->getId()));
        }

        return $this->render('customer/edit.html.twig', array(
            'customer' => $customer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a customer entity.
     *
     */
    public function deleteAction(Request $request, Customer $customer)
    {
        $form = $this->createDeleteForm($customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush($customer);
        }

        return $this->redirectToRoute('customer_index');
    }

    /**
     * Creates a form to delete a customer entity.
     *
     * @param Customer $customer The customer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Customer $customer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('customer_delete', array('id' => $customer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function loginAction (Request $request){
        $customer = new Customer();
        $form=$this->createFormBuilder($customer)
            ->add('mail','email')
            ->add('password','password')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager()->getRepository('sil11VitrineBundle:Customer') ;
            $customers=$em->findAll();

            // on récupère les données du formulaire
            $email = $form["mail"]->getData();
            $password = $form["password"]->getData();

            foreach($customers as $oneCustomer){
                 if(($oneCustomer->getMail() == $email) && ($oneCustomer->getPassword() == $password)){
                     $session = $request->getSession();
                     $session->get('customer', $oneCustomer);
                     $session->set('customer', $oneCustomer->getId());

                     return $this->render('sil11VitrineBundle:Default:index.html.twig');
                 }
            }

        }

        return $this->render('sil11VitrineBundle:Default:login.html.twig', array('form'=>$form->createView()));

    }

    public function afficheNomClientAction(Request $request){
        $session = $request->getSession();
        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager()->getRepository('sil11VitrineBundle:Customer') ;
        $customerConnected=$em->findById($user->getId());

        foreach ($customerConnected as $data){

            $nameCustomer = $data->getFirstName();
        }

        return $this->render('sil11VitrineBundle:Default:nameClient.html.twig', array(
            "nameCustomer" => $nameCustomer
            ));

    }

    public function logoutAction(Request $request){
        $session = $request->getSession();
        $session->remove('customer');
        //supression de la session
        return $this->render('sil11VitrineBundle:Default:index.html.twig');
    }
}
