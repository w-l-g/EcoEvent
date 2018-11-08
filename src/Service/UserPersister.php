<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\EmailAlreadyExistException;
use Doctrine\ORM\EntityManagerInterface;

class UserPersister
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param $email
     * @throws EmailAlreadyExistException
     */
    private function checkEmail($email)
    {
        $userRepo = $this->em->getRepository('App:User')->findBy([
           'username' => $email
        ]);

        if (count($userRepo) !== 0)
        {
            throw new EmailAlreadyExistException();
        }

    }

    public function persistUser(array $data)
    {
        $user = new User();
        $this->checkEmail($data['email']);
        $user->setUsername($data['email']);
        $user->setPhotoFb($data['image']);
        $user->setFacebookId(intval($data['id']));
        $user->setPassword($data['token']);
        $user->setFullName($data['name']);
        $user->setRoles('ROLES_USER');
        $this->em->persist($user);
        $this->em->flush();
    }


}