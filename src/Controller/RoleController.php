<?php

namespace App\Controller;

use App\Entity\Role;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RoleController extends AbstractController
{
    #[Route('/role', name: 'app_role')]
    // public function index(): JsonResponse
    // {
    //     return $this->json([
    //         'message' => 'Welcome to your new controller!',
    //         'path' => 'src/Controller/RoleController.php',
    //     ]);
    // }
     public function index(RoleRepository $roleRepository, SerializerInterface $serializer): JsonResponse
    {   
        // Permet de manipuler les entitées
        $roles = $roleRepository->findAll();
        
        // Convertir les données en Json via la serializer
        $rolesJson = $serializer->serialize($roles, 'json');

        return new JsonResponse($rolesJson, 200, [], true);
    }

    #[Route('/role/create',name:'addRole',methods:['POST'])]
    public function addRole(Request $request, EntityManagerInterface $add ,SerializerInterface $serializer):JsonResponse  
    {
        $role = $serializer->deserialize($request->getContent(), Role::class,'json');
        $add->persist($role);
        $add->flush();

        $jsonRole = $serializer->serialize($role,'json');
        return new JsonResponse($jsonRole, Response::HTTP_CREATED, [],true);

    }

    #[Route('/api/role/update/{id}',name:'role_update',methods:['PUT'])]
    public function updateRole(Role $role,Request $request,EntityManagerInterface $update,SerializerInterface $serializer): JsonResponse 
    {
        $role = $serializer->deserialize($request->getContent(),Role::class,'json',['object_to_populate' => $role]);
        $update->persist($role);
        $update->flush();

        $jsonRole = $serializer->serialize($role,'json');
        return new JsonResponse($jsonRole, Response::HTTP_OK,[],true);
        ;
    }

    #[Route('api/role/delete/{id}',name:'deleteRole',methods:['DELETE'])]
    public function deleteRole(Role $role,EntityManagerInterface $delete):JsonResponse 
    {
        $delete->remove($role);
        $delete->flush();
        return new JsonResponse('Le role a été supprimé avec succès',Response::HTTP_OK);
    }
}
