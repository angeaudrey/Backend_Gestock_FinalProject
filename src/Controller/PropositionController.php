<?php

namespace App\Controller;

use App\Entity\Proposition;
use App\Repository\ArticlesRepository;
use App\Repository\UserRepository;
use App\Repository\PropositionRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;



class PropositionController extends AbstractController
{

     private $serializer;
private $requestStack;
     public function __construct(
        SerializerInterface $serializer,RequestStack $requestStack
        )
    {
         $this->serializer = $serializer;
 
         $this->requestStack = $requestStack;

    }

    
    #[Route('/proposition', name: 'app_proposition')]
    public function index(): Response
    {
        return $this->render('proposition/index.html.twig', [
            'controller_name' => 'PropositionController',
        ]);
    }

    #[Route('/api/proposition/new', name: 'app_proposition_add')]
    public function indexproposition(Request $request, EntityManagerInterface $add ,SerializerInterface $serializer,UserRepository $userReposirory ,ArticlesRepository $articleRepository): Response
    {
        $etatproposition="EN_ATTENTE";
      $data = json_decode($request->getContent() , true);

       $articlequirecoistrue = $articleRepository->find($data['articlequirecoistrue']);
     
      
      $articledemande = $articleRepository->find($data['articledemande']);

      $userquirecois1 = $articleRepository->findBy(array('id' => intval($data['articlequirecoistrue'])));
       $userquirecois = $userReposirory->find($userquirecois1[0]->getId());

       
      $userIdh = $this->getUser()->getId();
 
      $userId = $userReposirory->find($userIdh);
       

      $propo = new Proposition();
      $propo->setDateproposition(new \DateTime('now'));
      $propo->setMesssage($data['message']);
      $propo->setEtatproposition($etatproposition);	
      $propo->setUserquidemande($userId);
      $propo->setUserquirecois($userquirecois);
      $propo->setArticledemande($articledemande);
      $propo->setArticlequirecoistrue($articlequirecoistrue);
      $add->persist($propo);
      $add->flush();
     

      $response = [
        'code' => 200,
        'error' => false,
        'data' => "La proposition a ete bien envoye",
    ];
    
     return new Response($this->serializer->serialize($response, "json"));
 

    
    }

    #[Route('/api/propositionenattente', name: 'app_propositionenattente')]
    public function propositionenattente(PropositionRepository $propositionRepository,SerializerInterface $serializer)
    {
        $etatproposition="EN_ATTENTE";

        $userIdh = $this->getUser()->getId();


        $proposition = $propositionRepository->findby(array('userquidemande' => intval($userIdh),'etatproposition' => $etatproposition));
        $request = $this->requestStack->getCurrentRequest();
        $host = $request->getSchemeAndHttpHost(); // ex: http://localhost:8000
        $basePath = $request->getBasePath(); // 
        


        $retour = array();
        foreach($proposition as $cat){
            $retour[] = array(
                'id' => $cat->getId(),
                'utilisateurquidemande' => $cat->getUserquidemande()->getName(),
                'utilisateurquirecois' => $cat->getUserquirecois()->getName(),

                'message' => $cat->getMesssage(),
                'photodemande' =>  $host.'/uploads/img/'.$cat->getArticledemande()->getPhoto(),
                'photorecois' =>  $host.'/uploads/img/'.$cat->getArticlequirecoistrue()->getPhoto(),
                'dateproposition' => $cat->getDateproposition(),
                'etatproposition' => $cat->getEtatproposition(),
                'articledemande' => $cat->getArticledemande()->getDesignation(),
                'articlequirecoistrue' => $cat->getArticlequirecoistrue()->getDesignation(),
                'montantestimationrecois' => $cat->getArticlequirecoistrue()->getMontantestimation(),
                'montantestimationdemande' => $cat->getArticledemande()->getMontantestimation(),


                
               
                
               
            );
        }
        $response = [
            'code' => 200,
            'error' => false,
            'data' => $retour,
        ];
        
         return new Response($this->serializer->serialize($retour, "json"));
    }

    #[Route('/api/propositionenattentedevalidation', name: 'app_propositionenattentedevalidation')]
    public function propositionenattentedevalidation(PropositionRepository $propositionRepository,SerializerInterface $serializer)
    {
        $etatproposition="EN_ATTENTE";

        $userIdh = $this->getUser()->getId();


        $proposition = $propositionRepository->findby(array('userquirecois' => intval($userIdh),'etatproposition' => $etatproposition));
        $proposition = $propositionRepository->findby(array('userquirecois' => intval($userIdh),'etatproposition' => $etatproposition));

        $request = $this->requestStack->getCurrentRequest();
        $host = $request->getSchemeAndHttpHost(); // ex: http://localhost:8000
        $basePath = $request->getBasePath(); // 
        


        $retour = array();
        foreach($proposition as $cat){
            $retour[] = array(
                'id' => $cat->getId(),
                'utilisateurquidemande' => $cat->getUserquidemande()->getName(),
                'utilisateurquirecois' => $cat->getUserquirecois()->getName(),

                'message' => $cat->getMesssage(),
                'photodemande' =>  $host.'/uploads/img/'.$cat->getArticledemande()->getPhoto(),
                'photorecois' =>  $host.'/uploads/img/'.$cat->getArticlequirecoistrue()->getPhoto(),
                'dateproposition' => $cat->getDateproposition(),
                'etatproposition' => $cat->getEtatproposition(),
                'articledemande' => $cat->getArticledemande()->getDesignation(),
                'articlequirecoistrue' => $cat->getArticlequirecoistrue()->getDesignation(),
                'montantestimationrecois' => $cat->getArticlequirecoistrue()->getMontantestimation(),
                'montantestimationdemande' => $cat->getArticledemande()->getMontantestimation(),


                
               
                
               
            );
        }
        $response = [
            'code' => 200,
            'error' => false,
            'data' => $retour,
        ];
        
         return new Response($this->serializer->serialize($retour, "json"));
    }
}