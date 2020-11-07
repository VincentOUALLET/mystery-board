<?php

namespace App\Controller;

use App\Service\UserSecurityService;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;

class AdminController extends EasyAdminController
{
    /**
     * @var UserSecurityService
     */
    private $userSecurityService;

    /**
     * AdminController constructor.
     * @param UserSecurityService $userSecurityService
     */
    public function __construct(UserSecurityService $userSecurityService)
    {
        $this->userSecurityService = $userSecurityService;
    }

    /**
     *
     *
     * @param $eventName
     * @param array $arguments
     */
    protected function dispatch($eventName, array $arguments = array())
    {
        $subject = isset($arguments['entity']) ? $arguments['entity'] : null;

        if ($subject instanceof Users
            && in_array($eventName, [EasyAdminEvents::PRE_PERSIST, EasyAdminEvents::PRE_UPDATE])
        ) {
            $user = $this->request->request->get('user');
            $password = $user['password'];

            if (! empty(trim($password))) {
                $this->userSecurityService->setupUser($subject);
            }
        }

        parent::dispatch($eventName, $arguments);
    }
}