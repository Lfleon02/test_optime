<?php

namespace App\Controller;

use App\Entity\Productos;
use App\Form\ProductsFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegistroProductosController extends AbstractController
{
    /**
     * @Route("/registro/productos", name="registro_productos")
     */
    public function index(Request $request)
    {	
    	$prod = new Productos();
    	$form = $this->createForm(ProductsFormType::Class, $prod);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$ent = $this->getDoctrine()->getManager();
    		$ent->persist($prod);
    		$ent->flush();
    		$this->addFlash('exito', Productos::REGISTRO_EXITOSO);
    		return $this->redirectToRoute('registro_productos');
    	}
        return $this->render('registro_productos/index.html.twig', [
            'controller_name' => 'Registro de Productos',
            'formulario' =>$form->createView()
        ]);
    }
}
