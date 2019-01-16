<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class ProductController extends AbstractController
{
    /**
     * @Route("product/", name="product_homepage")
     */
    public function showAll()
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->findAll();

        if(!$product){
            throw $this->createNotFoundException(
                'Nema Proizvoda'
            );
        }

        return $this->render('Products/index.html.twig', array('products' => $product));
    }

    /**
     * @Route("/product/single/{id}", name="product_single_id")
     */
    public function showById($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if(!$product){
            throw $this->createNotFoundException(
                'Nema Proizvoda sa ovim id: ' . $id
            );
        }

        return $this->render('Products/single.html.twig', array('products' => $product));
    }

    /**
     * @Route("/product/show/{name}", name="product_show")
     */
    public function show($name)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(['name' => $name]);

        if(!$product){
            throw $this->createNotFoundException(
                'Nema Proizvoda'
            );
        }

        return $this->render('Products/name.html.twig', array('products' => $product));
    }
}