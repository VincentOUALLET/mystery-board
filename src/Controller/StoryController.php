<?php

namespace App\Controller;

use App\Repository\StoryRepository;
use App\Repository\UserLastStepsRepository;
use App\Repository\StepRepository;
use App\Entity\UserLastSteps;
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
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/{story_id}/{user_id}", name="story_show", methods={"GET"})
     */
    public function show(
        UserLastStepsRepository $userLastStepsRepository,
        StoryRepository $storyRepository,
        int $story_id
        )
    {
        // dd(0);
        $user = $this->getUser();
        $story = $storyRepository->find($story_id);
        $userLastStep = $userLastStepsRepository->findBy(
            [
                'user' => $user,
                'story' => $story,
            ],
        );

        if ($userLastStep)
        {
            $last_step = $userLastStep[0]->getLastStep();
        } else {
            $userLastStep = new UserLastSteps();
            $userLastStep->setLastStep($story->getFirstStep())
                        ->setStory($story)
                        ->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userLastStep);
            $entityManager->flush();

            $last_step = $userLastStep->getLastStep();

        }

        return $this->render('story/show.html.twig', [
            'user' => $user,
            'story' => $story,
            'step' => $last_step,
        ]);
    }

    /**
     * @Route("/{story_id}/{custom_id}", name="set_last_step", methods={"GET"})
     */
    public function setLastStep(
        UserLastStepsRepository $userLastStepsRepository,
        StoryRepository $storyRepository,
        StepRepository $stepRepository,
        int $story_id,
        int $custom_id
        )
    {
        $user = $this->getUser();
        dd($user);

        $newStep = $stepRepository->findBy(
            [
                "story_id" => $story_id,
                "custom_id" => $custom_id,
            ]
            );

        
        $userLastStep = $userLastStepsRepository->findBy(
            [
                'user' => $user,
                'story' => $story,
            ],
        );

        $userLastStep->setLastStep($newStep);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($userLastStep);
        $entityManager->flush();

        return $this->render('story/show.html.twig', [
            'user' => $user,
            'story' => $story,
            'step' => $newStep,
        ]);
    }
}
