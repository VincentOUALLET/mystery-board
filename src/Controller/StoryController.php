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
     */
    public function index(StoryRepository $storyRepository): Response
    {
        return $this->render('story/index.html.twig', [
            'stories' => $storyRepository->findAll(),
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/{story_id}",
     *  name="story_show",
     *  methods={"GET"},
     *  requirements={
     *      "story_id"  =   "\d",
     *      "custom_id" =   "[A-Za-z0-9]*",
     *  })
     * @param int $story_id
     */
    public function show(
        UserLastStepsRepository $userLastStepsRepository,
        StoryRepository $storyRepository,
        int $story_id
        )
    {
        $user = $this->getUser();
        if ($user === null)
        {
            return $this->render('security/login.html.twig', ['last_username' => null, 'error' => null]);
        }
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
        // dd($last_step);
        $isStep1AnEnding = $last_step->getChoice1() === null;
        $isStep2AnEnding = $last_step->getChoice2() === null;

        return $this->render('story/show.html.twig', [
            'user' => $user,
            'story' => $story,
            'step' => $last_step,
            'isStep1AnEnding' => $isStep1AnEnding,
            'isStep2AnEnding' => $isStep2AnEnding,
        ]);
    }

    /**
     * @Route("/{story_id}/custom/{custom_id}",
     *  name="set_last_step",
     *  methods={"GET"},
     *  requirements={
     *      "story_id"  =   "\d",
     *      "custom_id" =   "[A-Za-z0-9]*",
     *  })
     */
    public function setLastStep(
        UserLastStepsRepository $userLastStepsRepository,
        StoryRepository $storyRepository,
        StepRepository $stepRepository,
        int $story_id,
        string $custom_id
        )
    {
        $user = $this->getUser();
        if ($user === null)
        {
            return $this->render('security/login.html.twig', ['last_username' => null, 'error' => null]);
        }
        $story = $storyRepository->find($story_id);

        $newStep = $stepRepository->findBy(
            [
                "story" => $story,
                "custom_id" => $custom_id,
            ]
            );

        
        $userLastStep = $userLastStepsRepository->findBy(
            [
                'user' => $user,
                'story' => $story,
            ],
        );

        $userLastStep[0]->setLastStep($newStep[0]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($userLastStep[0]);
        $entityManager->flush();

        return $this->render('story/show.html.twig', [
            'user' => $user,
            'story' => $story,
            'step' => $newStep[0],
        ]);
    }

    /**
     * @Route("/reset/{story_id}",
     *  name="reset_last_step",
     *  methods={"GET"},
     *  requirements={
     *      "story_id"  =   "\d",
     *      "custom_id" =   "[A-Za-z0-9]*",
     *  })
     */
    public function resetLastStep(
        UserLastStepsRepository $userLastStepsRepository,
        StoryRepository $storyRepository,
        StepRepository $stepRepository,
        int $story_id
        )
    {
        $user = $this->getUser();
        if ($user === null)
        {
            return $this->render('security/login.html.twig', ['last_username' => null, 'error' => null]);
        }
        $story = $storyRepository->find($story_id);
        
        $userLastStep = $userLastStepsRepository->findBy(
            [
                'user' => $user,
                'story' => $story,
            ],
        );

        $userLastStep[0]->setLastStep($story->getFirstStep());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($userLastStep[0]);
        $entityManager->flush();

        $newStep = $userLastStep[0]->getLastStep();

        return $this->render('story/show.html.twig', [
            'user' => $user,
            'story' => $story,
            'step' => $newStep,
        ]);
    }

    
}
