<?php

namespace App\Controller;

use App\Entity\Echange;
use App\Form\EchangeType;
use App\Repository\EchangeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropositionRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Serializer\SerializerInterface;

 class EchangeController extends AbstractController
{

    
    private $serializer;
     public function __construct(
       SerializerInterface $serializer
        )
    {
         $this->serializer = $serializer;
 

    }
 
    #[Route('/api/echange/{id}', name: 'app_echange_new', methods: ['GET', 'POST'])]
    public function new(EntityManagerInterface $add,Request $request, EchangeRepository $echangeRepository,$id,PropositionRepository $propositionRepository): Response
    {
        $bidn =  $propositionRepository->find($id);
        $bidn->setEtatproposition("ECHANGE_EFFECTUE");
        $add->persist($bidn);
        $echange = new Echange();
        $echange->setIdentifiantproposition($bidn);
        $echange->setArticlerecu($bidn->getArticlequirecoistrue());
        $echange->setArticledemande($bidn->getArticledemande());
        $echange->setUserquirecoit($bidn->getUserquirecois());
        $echange->setUserquidemande($bidn->getUserquidemande());
        $echange->setDatechange(new \DateTime());
        $add->persist($echange);
        $add->flush();

        
        $response = [
            'code' => 200,
            'error' => false,
            'data' => "echange ok",
        ];
        
         return new Response($this->serializer->serialize($response, "json"));

        
    }

     
}
