<?php

namespace sil11\VitrineBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller{
    
    public function indexAction(Request $request)
    {

        return $this->render('sil11VitrineBundle:Default:index.html.twig');
    }
    
    public function mentionsAction()
    {
        return $this->render('sil11VitrineBundle:Default:mentions.html.twig');        
    }
    
    public function catalogueAction()
    {    
        $listCategories = $this->getDoctrine()->getManager()->getRepository('sil11VitrineBundle:Category')->findAll();
        
        if (!$listCategories) {
            throw $this->createNotFoundException('Pas de catégorie');
        }
     
        return $this->render('sil11VitrineBundle:Default:catalogue.html.twig',
                array('listCategories' => $listCategories));
    }
    
    public function articlesParCategorieAction($id)
    {
        $category = $this->getDoctrine()->getManager()->getRepository('sil11VitrineBundle:Category')->findOneByid($id);
        
        $listProducts = $this->getDoctrine()->getManager()->getRepository('sil11VitrineBundle:Product')->findBycategory($id);
        
        if (!$listProducts) {
            throw $this->createNotFoundException('Pas de produits pour cette catégorie');
        }
          
        return $this->render('sil11VitrineBundle:Default:articlesParCategorie.html.twig', 
                array('listProducts' => $listProducts,'category' => $category));    
    }
    
    public function articlesLesPlusVendusAction()
    {

        $articles =$this->getDoctrine()->getRepository('sil11VitrineBundle:Order_line')->findPlusVendus();

        return $this->render('sil11VitrineBundle:Default:articlesLesPlusVendus.html.twig', array(
            'listArticles' => $articles
            ));
    }

    public function articleAction($id){

        $article = $this->getDoctrine()->getManager()->getRepository('sil11VitrineBundle:Product')->findOneByid($id);

        return $this->render('sil11VitrineBundle:Default:article.html.twig', array(
            'article' => $article
        ));

    }
}