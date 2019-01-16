<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET"})
     */
    public function index()
    {

        $posts = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (empty($posts)) {

            $this->addFlash(
                'notice',
                'Trenutno nema članaka'
            );

        }




        return $this->render('Articles/index.html.twig', array(
            'name' => 'Nino',
            'posts' => $posts

        ));



    }

    /**
     * @Route("/article/new", name="article_new")
     */
    public function newArticleAction(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('body', TextareaType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('category', ChoiceType::class, array(
                'choices'  => array(
                    'PHP' => 'PHP',
                    'JavaScript' => 'JavaScript',
                    'HTML' => 'HTML'
                ),
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Create Article',
                'attr' => array(
                    'class' => 'btn btn-primary'
                )
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $article = $form->getData();

            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'spremljeno u bazu'
            );


        }

        return $this->render('Articles/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/article/single/{id}", name="single_article")
     * @param $id
     * @return Response
     */
    public function singleArticleAction(Request $request, $id)
    {
        // article
        $singleArticle = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['id' => $id]);

        // comments
        $entityManager = $this->getDoctrine()->getManager();
        $newComment = new Comments();

        $commentForm = $this->createFormBuilder($newComment)
            ->add('title', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('comment', TextareaType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Create Article',
                'attr' => array(
                    'class' => 'btn btn-primary'
                )
            ))
            ->getForm();

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {

                $newComment = $commentForm->getData();

                $entityManager->persist($newComment);
                $entityManager->flush();

                $this->addFlash(
                    'notice',
                    'Komentar je spremljen u bazu'
                );

        }


        return $this->render('Articles/singleArticle.html.twig', array(
            'singleArticle' => $singleArticle,
            'newComment' => $newComment
        ));
    }

  


}

