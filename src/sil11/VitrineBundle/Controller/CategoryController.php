<?php

namespace sil11\VitrineBundle\Controller;

use sil11\VitrineBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{
    /**
     * Lists all category entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('sil11VitrineBundle:Category')->findAll();

        return $this->render('category/index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new category entity.
     *
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm('sil11\VitrineBundle\Form\CategoryType', $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$category->getFile();
            $fileName = $this->get('app.picture_uploader')->upload($file);
            $category->setFile($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush($category);

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/new.html.twig', array(
            'category' => $category,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a category entity.
     *
     */
    public function showAction(Category $category)
    {
        $deleteForm = $this->createDeleteForm($category);

        return $this->render('category/show.html.twig', array(
            'category' => $category,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     */
    public function editAction(Request $request, Category $category)
    {
        //on stocke le fichier de l'image actuelle
        $currentFile = $category->getFile();

        //on crée une instance de l'objet File en prévision d'un changement d'image
        $category->setFile(
            new File($this->getParameter('pictures_directory').'/'.$category->getFile())
        );
        $editForm = $this->createForm('sil11\VitrineBundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            //si aucune image est téléchargée, alors on garde l'image déjà utilisée
            if($editForm->get('file')->getData() == null){

                $category->setFile($currentFile);
                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $em->flush($category);
                return $this->redirectToRoute('category_index');

            } else {

                $file=$editForm->get('file')->getData();
                $fileName = $this->get('app.picture_uploader')->upload($file);
                $category->setFile($fileName);
                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $em->flush($category);
                return $this->redirectToRoute('category_index');
            }
        }

        return $this->render('category/edit.html.twig', array(
            'category' => $category,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a category entity.
     *
     */
    public function deleteAction(Request $request, Category $category)
    {

            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush($category);

        return $this->redirectToRoute('category_index');
    }

    /**
     * Creates a form to delete a category entity.
     *
     * @param Category $category The category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
