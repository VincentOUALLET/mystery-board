<?php
namespace App\Service;

use App\Entity\Users;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserSecurityService
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function setupUser(Users $user): void
    {
        try {
            $user->setSalt(bin2hex(random_bytes(12)));
        } catch(\Exception $e) {
            $user->setSalt(uniqid(time()));
        }

        $password = $this->passwordEncoder->encodePassword($user, $user->getPassword());

        $user->setPassword($password);
    }
}