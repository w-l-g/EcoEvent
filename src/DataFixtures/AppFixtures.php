<?php
namespace App\DataFixtures;


use App\Entity\Question;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $everybody = [];
        $i = 0;
        foreach ($this->getQuestionData() as [$value, $type, $rubric]) {
            $i++;
            $question = new Question();
            $question->setValue($value);
            $question->setType($type);
            $question->setRubric($rubric);
            $manager->persist($question);
            //  $this->addReference($email, $user);
            //$everybody[$roles[0]][] = $user;
        }
        $manager->flush();
    }

    private function getQuestionData(): array
    {
        return [
            ['Jane', 'Bonchemin', new DateTime('10-10-1990'), 'kitten', 'jane_admin@symfony.com', 'ROLE_ADMIN'],
            ['Iwan', 'Le louer', new DateTime('10-10-1990'), 'kitten', 'tom_admin@symfony.com', 'ROLE_ADMIN'],
            ['Dylan', 'Conin', new DateTime('10-10-1990'), 'kitten', 'john_user@symfony.com', 'ROLE_USER'],
            ['Aymeric', 'Pinault', new DateTime('10-10-1990'), 'a', 'mono', 'ROLE_INSTRUCTOR'],
            ['Alphonse', 'Durant', new DateTime('10-10-1990'), 'a', 'admin', 'ROLE_ADMIN'],
            ['Jerome', 'Phillipe', new DateTime('10-10-1990'), 'a', 'user-manager', 'ROLE_USER'],
            ['Quentin', 'Lemar', new DateTime('10-10-1990'), 'a', 'a', 'ROLE_USER'],
            ['Laurent', 'Houtan', new DateTime('10-10-1990'), 'a', 'b', 'ROLE_INSTRUCTOR'],
            ['Sacha', 'Prioux', new DateTime('10-10-1990'), 'a', 'c', 'ROLE_USER'],
            ['Aurélien', 'Bourdeille', new DateTime('10-10-1990'), 'a', 'd', 'ROLE_USER'],
            ['Cassandre', 'Maertens', new DateTime('10-10-1990'), 'a', 'e', 'ROLE_USER'],
            ['Joachim', 'Tristant', new DateTime('10-10-1990'), 'a', 'f', 'ROLE_USER'],
            ['Clément', 'Mauguen', new DateTime('10-10-1990'), 'a', 'g', 'ROLE_USER'],
            ['Camille', 'Mambangui', new DateTime('10-10-1990'), 'a', 'h', 'ROLE_USER'],
            ['Laure', 'Monbert', new DateTime('10-10-1990'), 'a', 'i', 'ROLE_USER'],
            ['François', 'Doe', new DateTime('10-10-1990'), 'a', 'j', 'ROLE_INSTRUCTOR'],
            ['Tristan', 'Doe', new DateTime('10-10-1990'), 'a', 'k', 'ROLE_USER'],
            ['Assou', 'Doe', new DateTime('10-10-1990'), 'a', 'l', 'ROLE_INSTRUCTOR'],
            ['Cow', 'Cow', new DateTime('10-10-1990'), '1234', 'coco', 'ROLE_ADMIN'],
        ];
    }
}