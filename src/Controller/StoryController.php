<?php

namespace App\Controller;

use App\Repository\StoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/histoires")
 */
class StoryController extends AbstractController
{
    
    /**
     * @Route("/", name="story_index", methods={"GET"})
     * @param StoryRepository $storyRepository
     * @return Response
     */
    public function index(StoryRepository $storyRepository): Response
    {
        return $this->render('story/index.html.twig', [
            'stories' => $storyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{title}/{step}", name="story_show", methods={"GET"})
     */
    public function show(Story $story, Step $step)
    {

        return $this->render('story/show.html.twig', [
            'story' => $storyRepository
                        ->find(),
        ]);
    }
}
