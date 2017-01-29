<?php

namespace sil11\VitrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use sil11\VitrineBundle\Entity\Panier;
use sil11\VitrineBundle\Entity\Order;
use sil11\VitrineBundle\Entity\Order_line;
use sil11\VitrineBundle\Entity\Customer;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of PanierController
 *
 * @author jiyou
 */
class PanierController extends Controller {

    public function contenuPanierAction (Request $request)
    {
        $session = $request->getSession();

        if (!$session->has('panier')) {
            $message = 'Votre panier est vide';
            return $this->render('sil11VitrineBundle:Panier:contenuPanier.html.twig', array('message' => $message));
        } else {
            $panier = $session->get('panier');
            $panierIdQte = $panier->getContenu();
            //évite de créer une erreur de lecture de tableau si la session $panier devient vide
            if (empty($panierIdQte)) {
                $session->clear();
                $response = $this->forward('sil11VitrineBundle:Panier:contenuPanier');
                return $response;
            }
            //récupère les données des produits ajoutés au panier
            foreach ($panierIdQte as $id => $value) {
                $articleCde[] = $this->getDoctrine()->getManager()->getRepository('sil11VitrineBundle:Product')->find($id);
            }
            //calcule le prix total intermédiaire pour chaque article
            foreach ($articleCde as $article) {
                $price = $article->getPrice();
                $qte = $panierIdQte[$article->getId()];
                $total[] = $panier->calculerTotalParArticle($qte, $price);
            }
            //calcule le prix total du panier
            $totalGlobal = $panier->calculerTotalPanier($total);
            //calcule la TVA
            $tva = $panier->calculerTva($totalGlobal);
            return $this->render('sil11VitrineBundle:Panier:contenuPanier.html.twig', array('Qte' => $panierIdQte, 'article' => $articleCde, 'totalInter' => $total,
                        'tva' => $tva, 'total' => $totalGlobal));
        }
    }

    public function ajoutPanierAction ($articleId, $qte = 1, Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier')) {
            $panier = $session->get('panier', new Panier());
            $panier->ajoutArticle($articleId, $qte);
            $session->set('panier', $panier);
        } else {
            $panier = $session->get('panier');
            $panier->ajoutArticle($articleId, $qte);
        }
        $response = $this->forward('sil11VitrineBundle:Panier:contenuPanier');
        return $response;
    }

    public function viderPanierAction(Request $request) {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $panier->viderPanier();
        //supression de la session
        $session->clear();
        //redirection vers l'action contenu panier
        $response = $this->forward('sil11VitrineBundle:Panier:contenuPanier');
        return $response;
    }

    public function voirPanierAsideAction(Request $request) {
        $session = $request->getSession();
        //si la session panier n'existe pas 
        if (!$session->has('panier')) {
            $message = 'Panier vide';
            return $this->render('sil11VitrineBundle:Panier:asidePanier.html.twig', array('message' => $message));
        } else {
            $panier = $session->get('panier');
            $nbArticle = count($panier->getContenu());
            return $this->render('sil11VitrineBundle:Panier:asidePanier.html.twig', array('nbArticle' => $nbArticle));
        }
    }

    public function ajouterQteArticleAction($articleId, Request $request) {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $articleCde = $panier->getContenu();
        //lit le tableau $articleCde pour extraire la quantité
        foreach ($articleCde as $id => $stockValue) {
            if ($id == $articleId) {
                $qte = $stockValue;
            }
        }
        //récupère le stock du produit concerné par l'augmentation de quantité     
        $article = $this->getDoctrine()->getManager()->getRepository('sil11VitrineBundle:Product')->find($articleId);
        $articleStock = $article->getQuantity();
        //si la quantité en stock est supérieure à la quantité demandée par l'utilisateur
        if ($articleStock >= $qte + 1) {
            $panier->augmenteQteArticle($articleId);
            $session->set('panier', $panier);
            $response = $this->forward('sil11VitrineBundle:Panier:contenuPanier');
            return $response;
        } else {
            $session->getFlashBag()->add('info', 'Stock insuffisant');
            return $this->redirect($this->generateUrl('sil11_vitrine_contenuPanier'));
        }
    }

    public function retirerQteArticleAction($articleId, Request $request) {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $articleCde = $panier->getContenu();
        foreach ($articleCde as $id => $stockValue) {
            if ($id == $articleId) {
                $qte = $stockValue;
            }
        }
        if ($qte > 1) {
            $panier->diminueQteArticle($articleId);
        } elseif ($qte == 1) {
            $panier->supprimeArticle($articleId);
        }
        $session->set('panier', $panier);
        $response = $this->forward('sil11VitrineBundle:Panier:contenuPanier');
        return $response;
    }

    public function supprimerArticleAction($articleId, Request $request) {
        $session = $request->getSession();
        $panier = $session->get('panier');
        $panier->supprimeArticle($articleId);
        $session->set('panier', $panier);
        $response = $this->forward('sil11VitrineBundle:Panier:contenuPanier');
        return $response;
    }

    public function validerPanierAction(Request $request) {
        $session = $request->getSession();

        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') or $this->get('security.authorization_checker')->isGranted('ROLE_USER')){

            $panier = $session->get('panier');
            $user=$this->getUser();
            $customerId = $user->getId();
        
            $em = $this->getDoctrine()->getManager();

            $order = new Order();
            $date = date('Y-m-d');
            $customer = $em->getRepository('sil11VitrineBundle:Customer')->find($customerId);
            $order->setCustomer($customer);
            $order->setDate(new \DateTime($date));
            $order->setSubmited("yes");
            
            $em->persist($order);
            $em->flush();
            
            $articleCde = $panier->getContenu();

            //lit le tableau $articleCde pour extraire la quantité
            foreach ($articleCde as $idProduct => $QuantiteCde) {

                $order_line = new Order_line();
                $product = $em->getRepository('sil11VitrineBundle:Product')->find($idProduct);
                $order_line->setProduct($product);
                $order_line->setOrderQuantity($QuantiteCde);
                $order_line->setPrice($product->getPrice());
                $order_line->setOrder($order);

                $em->persist($order_line);

                // mise à jour des stocks
                $product=$em->getRepository('sil11VitrineBundle:Product')->find($idProduct);
                $product->setQuantity($product->getQuantity() - $QuantiteCde);

            }

            $em->flush();
            
            $lastOrder=$em->getRepository('sil11VitrineBundle:Order')->findOneByCustomer($customerId);

            return $this->render('sil11VitrineBundle:Panier:validationPanier.html.twig', array('orderId' => $lastOrder->getId()));

        } else {
            $message = 'Veuillez SVP vous connecter ou bien créer un compte client';
            return $this->render('sil11VitrineBundle:Panier:contenuPanier.html.twig', array('message' => $message));
        }
    }
}
