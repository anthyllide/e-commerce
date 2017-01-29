<?php

namespace sil11\VitrineBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

class Panier 
{
    
    private $contenu;     //Tableau - contenu[i] = quantite d'article d’id=i dans le panier) 
 
    public function __construct() 
    {   // initialise le contenu     
        return $this->contenu=array();
    } 
    
    public function getContenu()
    {     // getter    
        return $this->contenu;     
    } 
    
    public function ajoutArticle ($articleId, $qte = 1) 
    {  
        // ajoute l'article $articleId au contenu, en quantité $qte     //  (vérifier si l'article n'y est pas déjà)   
        if (array_key_exists($articleId, $this->contenu)){   
            $this->contenu[$articleId]=$this->contenu[$articleId]+$qte;   
        } else { 
            $this->contenu[$articleId]=$qte;
        }      
    }
    
    //augmente la quentité d'un article de +1
    public function augmenteQteArticle($articleId)
    { 
        $this->contenu[$articleId]=$this->contenu[$articleId]+1;
    }
    
    //diminue la quantité d'un article de -1
    public function diminueQteArticle($articleId)
    {  
        $this->contenu[$articleId]=$this->contenu[$articleId]-1;          
    }
    
    //supprime un article du contenu
    public function supprimeArticle($articleId)
    {
        unset($this->contenu[$articleId]);        
    }
 
     // vide le contenu  
    public function viderPanier() 
    {  
        return $this->contenu = array();
    }
    
    //calcule un total intermédiaire pour un article
    public function calculerTotalParArticle($qte, $price)   
    {
        return number_format($qte*$price, 2, '.', ' ');
    }
    
    //calcule le total du panier (en TTC)
    public function calculerTotalPanier(Array $totalIntermedaire)
    {
       return number_format(array_sum ($totalIntermedaire), 2, '.', ' ');
    }
    
    //clacule la TVA
    public function calculerTva($totalGlobal)
    {
        $resultTva = $totalGlobal -($totalGlobal/1.2);
        return number_format($resultTva, 2, '.', ' ');
    }
    
    
}
