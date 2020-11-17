<?php

namespace App\Controller;

use App\Repository\StoryRepository;
use App\Repository\UserLastStepsRepository;
use App\Repository\UserEndingStepsRecordsRepository;
use App\Repository\StepRepository;
use App\Entity\UserLastSteps;
use App\Entity\UserEndingStepsRecords;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/histoires")
 * @IsGranted("ROLE_USER", statusCode=403,
 * message="Vous n'êtes pas ou plus connecté, retournez vous connecter et plus jamais rien ne vous sera refusé! (l'état d'avancée de votre histoire a été sauvegardé)")
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
     *      "custom_id" =   "[A-Za-z0-9_]*",
     *  })
     */
    public function show(
        UserLastStepsRepository $userLastStepsRepository,
        StoryRepository $storyRepository,
        int $story_id
        )
    {
        $currentUser = $this->getUser();
        if ($currentUser === null)
        {
            return $this->render('security/login.html.twig', ['last_username' => null, 'error' => null]);
        }
        $currentStory = $storyRepository->find($story_id);
        $currentUserSLastStep = $userLastStepsRepository->findBy(
            [
                'user' => $currentUser,
                'story' => $currentStory,
            ],
        );

        if ($currentUserSLastStep)
        {
            $currentLastStep = $currentUserSLastStep[0]->getLastStep();
        } else {
            $currentUserSLastStep = new UserLastSteps();
            $currentUserSLastStep->setLastStep($currentStory->getFirstStep())
                        ->setStory($currentStory)
                        ->setUser($currentUser);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($currentUserSLastStep);
            try {
                $entityManager->flush();
            } catch(\Exception $e) {
                dd($e);
                
            ////////////////////////////////////////////////
            // GALLARIAN'S GOOD CODING PRACTICES TO IMPLEMENT IF POSSIBLE
            // $this->getDoctrine()->resetManager();
            //     $logger->add("Group", "add", "danger", "There was a problem saving, please try again later", $e->getMessage());
            //    // $this->addFlash("danger", $translator->trans("error.flush"));
            // /////////////////////////////////////////////
            
                    $this->addFlash("danger", "Problème d'accès au sauvegardes ou au serveur! Pas de panique, vous pourrez toujours rééssayer plus tard!");
    
    
                    return $this->redirectToRoute("story_show", [
                        'story_id' => $story_id,
                        'custom_id' => $custom_id]);
            } 

            $currentLastStep = $currentUserSLastStep->getLastStep();

        }

        return $this->render('story/show.html.twig', [
            'user' => $currentUser,
            'story' => $currentStory,
            'step' => $currentLastStep,
        ]);
    }

    /**
     * @Route("/{story_id}/custom/{custom_id}",
     *  name="set_last_step",
     *  methods={"GET"},
     *  requirements={
     *      "story_id"  =   "\d",
     *      "custom_id" =   "[A-Za-z0-9_]*",
     *  })
     */
    public function setLastStep(
        UserLastStepsRepository $userLastStepsRepository,
        UserEndingStepsRecordsRepository $userEndingStepsRecordsRepository,
        StoryRepository $storyRepository,
        StepRepository $stepRepository,

        int $story_id,
        string $custom_id
        )
    {
        $currentUser = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        if ($currentUser === null)
        {
            return $this->render('security/login.html.twig', ['last_username' => null, 'error' => null]);
        }
        $currentStory = $storyRepository->find($story_id);

        $newStep = $stepRepository->findBy(
            [
                "story" => $currentStory,
                "custom_id" => $custom_id,
            ]
        );

        // save the new number of times the current step has been played (stats)
        $newPlayedNumber = $newStep[0]->getPlayedNumber() +1;
        $newStep[0]->setPlayedNumber($newPlayedNumber);
        $newStep[0]->setUpdatedAt(new \DateTime('now'));
        $entityManager->persist($newStep[0]);
        
        $currentUserSLastStep = $userLastStepsRepository->findBy(
            [
                'user' => $currentUser,
                'story' => $currentStory,
            ],
        );

        if ($newStep[0]->getCustomId() != "postscriptum")
        {
            $currentUserSLastStep[0]->setLastStep($newStep[0]);

            $entityManager->persist($currentUserSLastStep[0]);
        }

        // //////////////////////
        // WIP - adding ending templates tests in purpose to add 1 to the total of the current user's ended templates (stats)
        $isStep1AnEnding = $newStep[0]->getChoice1() === null;
        $isStep2AnEnding = $newStep[0]->getChoice2() === null;

        // save the current userEndingStepsRecords if step is an ending and not if it's the postscriptum's one (credits)
        if ($isStep1AnEnding && $isStep2AnEnding && $newStep[0]->getCustomId() !="postscriptum" )
        {
            $newEndingStep = new UserEndingStepsRecords();

            $newEndingStep->setUser($currentUser);
            $newEndingStep->setStory($currentStory);
            $newEndingStep->setStep($newStep[0]);
            // dd($newEndingStep);

            $newEndingStepCheckIfExist = $userEndingStepsRecordsRepository->findBy(
                [
                    'user' => $currentUser,
                    'story' => $currentStory,
                    'step' => $newStep[0],
                ],
            );
            if (!$newEndingStepCheckIfExist)
            {
                $entityManager->persist($newEndingStep);
            }

        }

        try {
            $entityManager->flush();
        } catch(\Exception $e) {
            dd($e);

            ////////////////////////////////////////////////
            // GALLARIAN'S GOOD CODING PRACTICES TO IMPLEMENT IF POSSIBLE
            // $this->getDoctrine()->resetManager();
            //     $logger->add("Group", "add", "danger", "There was a problem saving, please try again later", $e->getMessage());
            //    // $this->addFlash("danger", $translator->trans("error.flush"));
            // /////////////////////////////////////////////

                $this->addFlash("danger", "Problème de sauvegarde! Pas de panique, l'étape précédente a été sauvegardée!");


                return $this->redirectToRoute("story_show", [
                    'story_id' => $story_id,
                    'custom_id' => $custom_id]);
        } 

        return $this->render('story/show.html.twig', [
            'user' => $currentUser,
            'story' => $currentStory,
            'step' => $newStep[0],
        ]);
    }

    /**
     * @Route("/reset/{story_id}",
     *  name="reset_last_step",
     *  methods={"GET"},
     *  requirements={
     *      "story_id"  =   "\d"
     *  })
     */
    public function resetLastStep(
        UserLastStepsRepository $userLastStepsRepository,
        StoryRepository $storyRepository,
        StepRepository $stepRepository,
        int $story_id
        )
    {
        $currentUser = $this->getUser();
        if ($currentUser === null)
        {
            return $this->render('security/login.html.twig', ['last_username' => null, 'error' => null]);
        }
        $story = $storyRepository->find($story_id);
        
        $currentUserSLastStep = $userLastStepsRepository->findBy(
            [
                'user' => $currentUser,
                'story' => $story,
            ],
        );

        // setting the current user's last step to the first one of the story
        $currentUserSLastStep[0]->setLastStep($story->getFirstStep());

        // setting the number of times where the current user restarted the current story (stats)
        $newRestartNumber = $currentUserSLastStep[0]->getRestartNumber() + 1;
        $currentUserSLastStep[0]->setRestartNumber($newRestartNumber);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($currentUserSLastStep[0]);
        
        try {
            $entityManager->flush();
        } catch(\Exception $e) {
            dd($e);

            ////////////////////////////////////////////////
            // GALLARIAN'S GOOD CODING PRACTICES TO IMPLEMENT IF POSSIBLE
            // $this->getDoctrine()->resetManager();
            //     $logger->add("Group", "add", "danger", "There was a problem saving, please try again later", $e->getMessage());
            //    // $this->addFlash("danger", $translator->trans("error.flush"));
            // /////////////////////////////////////////////
            
                $this->addFlash("danger", "Problème de sauvegarde empêchant de recommencer! S'il vous plaît rééssayez plus tard");


                return $this->redirectToRoute("story_show", ['story_id' => $story_id]);
        } 
        

        $newStep = $currentUserSLastStep[0]->getLastStep();

        return $this->render('story/show.html.twig', [
            'user' => $currentUser,
            'story' => $story,
            'step' => $newStep,
        ]);
    }

}
