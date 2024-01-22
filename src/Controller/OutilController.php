<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TagRepository;
use App\Repository\OutilRepository;

class OutilController extends AbstractController
{
    public function __construct(
        private TagRepository $tagRepository,
        private OutilRepository $outilRepository,
    ){

    }
    #[Route('/outil', name: 'app_outil')]
    public function index(): Response
    {
        $tags = $this->tagRepository->findAll();
        $outils = $this->outilRepository->findAll();
        return $this->render('outil/index.html.twig', [
            'tags' => $tags,
            'outils' => $outils,
        ]);
    }

    #[Route('/outil/{id}', name: 'outil_detail')]
    public function detail(int $id): Response
    {
        $outil = $this->outilRepository->find($id);
        return $this->render('outil/detail.html.twig', [
            'outil' => $outil,
        ]);
    }
}