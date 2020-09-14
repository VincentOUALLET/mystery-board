<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StepController extends AbstractController
{
    /**
     * @Route("/step", name="step")
     */
    public function index()
    {
        return $this->render('step/index.html.twig', [
            'controller_name' => 'StepController',
        ]);
    }
}
