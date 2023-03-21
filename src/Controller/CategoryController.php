<?php

namespace App\Controller;
use App\Entity\Category;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class CategoryController extends AbstractController
{
    #[Route('/api/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository, SerializerInterface $serializer): JsonResponse
    {
        
        // Permet de manipuler les entitées
        $category = $categoryRepository->findAll();
        $retour = array();
        foreach($category as $cat){
            $retour[] = array(
                'id' => $cat->getId(),
                'designation' => $cat->getDesignation(),
               
            );
        }
        $response = [
            'code' => 200,
            'error' => false,
            'data' => $retour,
        ];
        
        // Convertir les données en Json via la serializer
        $categoryJson = $serializer->serialize($response, 'json');

        return new JsonResponse($categoryJson, 200, [], true);
    }

 

    #[Route('/api/category/create',name:'addCategory',methods:['POST'])]
    public function addCategory(Request $request, EntityManagerInterface $add ,SerializerInterface $serializer):JsonResponse  
    {
        $category = $serializer->deserialize($request->getContent(), Category::class,'json');
        $add->persist($category);
        $add->flush();

        $jsonCategory = $serializer->serialize($category,'json');
        return new JsonResponse($jsonCategory, Response::HTTP_CREATED, [],true);

    }

    #[Route('/api/category/update/{id}',name:'category_update',methods:['PUT'])]
    public function updateCategory(Category $category,Request $request,EntityManagerInterface $update,SerializerInterface $serializer): JsonResponse 
    {
        $category = $serializer->deserialize($request->getContent(),Category::class,'json',['object_to_populate' => $category]);
        $update->persist($category);
        $update->flush();

        $jsonCategory = $serializer->serialize($category,'json');
        return new JsonResponse($jsonCategory, Response::HTTP_OK,[],true);
        
    }

    #[Route('api/category/delete/{id}',name:'deleteCategory',methods:['DELETE'])]
    public function deleteCategory(Category $category,EntityManagerInterface $delete):JsonResponse 
    {
        $delete->remove($category);
        $delete->flush();
        return new JsonResponse('La categorie a été supprimée avec succès',Response::HTTP_OK);
    }
}
