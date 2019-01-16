<?php

namespace App\Controller;

use App\Entity\Pagination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;




class PaginationController extends AbstractController
{
    /** @var integer */
    const POST_LIMIT = 3;
    /** @var EntityManagerInterface */
    private $entityManager;
    /** @var \Doctrine\Common\Persistence\ObjectRepository */
    private $paginationRepository;
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->paginationRepository = $entityManager->getRepository('App:Pagination');

    }
    /**
     * @Route("/pagination/", name="pagination_page")
     *
     */
    public function indexAction(Request $request)
    {
        $page = 1;
        if ($request->get('page')) {
            $page = $request->get('page');
        }

        return $this->render('Pagination/index.html.twig', [
            'pagination' => $this->paginationRepository->getAllPosts($page, self::POST_LIMIT),
            'totalBlogPosts' => $this->paginationRepository->getPostCount(),
            'page' => $page,
            'entryLimit' => self::POST_LIMIT
        ]);
    }

    /**
     * @Route("/pagination/single/{$id}/", name="single_post")
     * @param $id
     * @return Response
     */
    public function singlePostAction($id)
    {
        $singlePost = $this->getDoctrine()
            ->getRepository(Pagination::class)
            ->find($id);

        return $this->render('Pagination/singlePost.html.twig', array(
            'singlePost' => $singlePost
        ));
    }

}
