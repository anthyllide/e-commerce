<?php

namespace sil11\VitrineBundle\Controller;

use sil11\VitrineBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('sil11VitrineBundle:Product')->findAll();

        return $this->render('product/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Creates a new product entity.
     *
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('sil11\VitrineBundle\Form\ProductType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$product->getFile();
            $fileName = $this->get('app.picture_uploader')->upload($file);
            $product->setFile($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush($product);

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     */
    public function showAction(Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('product/show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     */
    public function editAction(Request $request, Product $product)
    {
        //on stocke le fichier de l'image actuelle
        $currentFile = $product->getFile();

        //on crée une instance de l'objet File en prévision d'un changement d'image
        $product->setFile(
            new File($this->getParameter('pictures_directory').'/'.$product->getFile())
        );

        $editForm = $this->createForm('sil11\VitrineBundle\Form\ProductType', $product);
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {

            //si aucune image est téléchargée, alors on garde l'image déjà utilisée
            if($editForm->get('file')->getData() == null){

                $product->setFile($currentFile);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush($product);
                return $this->redirectToRoute('product_index');

            } else {

                $file=$editForm->get('file')->getData();
                $fileName = $this->get('app.picture_uploader')->upload($file);
                $product->setFile($fileName);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush($product);
                return $this->redirectToRoute('product_index');
            }

        }

        return $this->render('product/edit.html.twig', array(
            'product' => $product,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a product entity.
     *
     */
    public function deleteAction(Request $request, Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush($product);

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
