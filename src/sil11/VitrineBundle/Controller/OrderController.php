<?php

namespace sil11\VitrineBundle\Controller;

use sil11\VitrineBundle\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Order controller.
 *
 */
class OrderController extends Controller
{
    /**
     * Lists all order entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //if (!$session->has('customer')) {
            $orders = $em->getRepository('sil11VitrineBundle:Order')->findAll();
            return $this->render('order/index.html.twig', array(
                'orders' => $orders,
            ));
    }

    /**
     * Creates a new order entity.
     *
     */
    public function newAction(Request $request)
    {
        $order = new Order();
        $form = $this->createForm('sil11\VitrineBundle\Form\OrderType', $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush($order);

            return $this->redirectToRoute('order_show', array('id' => $order->getId()));
        }

        return $this->render('order/new.html.twig', array(
            'order' => $order,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a order entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('sil11VitrineBundle:Order')->findByCustomer($id);
        return $this->render('order/show.html.twig', array(
            'orders' => $orders
        ));
    }

    /**
     * Displays a form to edit an existing order entity.
     *
     */
    public function editAction(Request $request, Order $order)
    {

        //$editForm = $this->createForm('sil11\VitrineBundle\Form\OrderType', $order);
        $editForm=$this->createFormBuilder($order)
            ->setMethod('GET')
            ->add('submited','text')
            ->getForm();

        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/edit.html.twig', array(
            'order' => $order,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a order entity.
     *
     */
    public function deleteAction(Request $request, Order $order)
    {
        $form = $this->createDeleteForm($order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($order);
            $em->flush($order);
        }

        return $this->redirectToRoute('order_index');
    }

    /**
     * Creates a form to delete a order entity.
     *
     * @param Order $order The order entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Order $order)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('order_delete', array('id' => $order->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
