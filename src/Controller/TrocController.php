<?php

namespace App\Controller;
use App\Entity\Troc;
use App\Repository\TrocRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TrocController extends AbstractController
{
    #[Route('/api/troc', name: 'app_troc')]
    public function index(TrocRepository $trocRepository,SerializerInterface $serializer): JsonResponse
    {
        $troc = $trocRepository->findAll();
        $trocJson = $serializer->serialize($troc,'json');

        return new JsonResponse($trocJson,200,[],true);
    }

    #[Route('/api/troc/create',name:'addTroc',methods:['POST'])]
    public function addTroc(Request $request, EntityManagerInterface $add, SerializerInterface $serializer) :JsonResponse
    {
        $troc = $serializer->deserialize($request->getContent(),Troc::class,'json');
        $add->persist($troc);
        $add->flush();

        $JsonTroc = $serializer->serialize($troc,'json');
        return new JsonResponse($JsonTroc,Response::HTTP_CREATED,[],true);
    }
}
