<?php

namespace App\Controller;

use App\Entity\Productos;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ViewProductsController extends AbstractController
{
    /**
     * @Route("/view/products", name="view_products")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
    	$ent = $this->getDoctrine()->getManager();
    	$query = $ent->getRepository(Productos::class)->SearchProducts();
        $pagination = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        5 /*limit per page*/
    );
        return $this->render('view_products/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    public function update_field($id){

        $ent = $this->getDoctrine()->getManager();
        $update = $em->getRepository(Productos::class)->find($id);
        if (!$update) {
            throw $this->createNotFoundException('El registro cin ID '.$id.' no existe');
        }
        $update ->setCategoria('updated');
        $ent->flush();

        return new Response('Registro actualizado con id'.$id.' ' );    

    }

        public function delete_field($id){

        $ent = $this->getDoctrine()->getManager();
        $update = $em->getRepository(Productos::class)->find($id);
        if (!$update) {
            throw $this->createNotFoundException('El registro cin ID '.$id.' no existe');
        }
        $update ->remove($update);
        $ent->flush();

        return new Response('Se a eliminado el registro con id'.$id.' ' );    

    }
}
