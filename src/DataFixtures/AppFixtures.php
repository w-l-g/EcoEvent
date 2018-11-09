<?php
namespace App\DataFixtures;


use DateTime;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
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
            ['Jane', 'Bonchemin', 'Alimentation',new DateTime('10-10-1990'), 'kitten', 'jane_admin@symfony.com', 'ROLE_ADMIN'],
            ['Iwan', 'Le louer', 'Alimentation',new DateTime('10-10-1990'), 'kitten', 'tom_admin@symfony.com', 'ROLE_ADMIN'],
            ['Dylan', 'Conin', 'Alimentation',new DateTime('10-10-1990'), 'kitten', 'john_user@symfony.com', 'ROLE_USER'],
            ['Aymeric', 'Pinault', 'Alimentation',new DateTime('10-10-1990'), 'a', 'mono', 'ROLE_INSTRUCTOR'],
            ['Alphonse', 'Durant', 'Alimentation',new DateTime('10-10-1990'), 'a', 'admin', 'ROLE_ADMIN'],
            ['Jerome', 'Phillipe', 'Accessibilité',new DateTime('10-10-1990'), 'a', 'user-manager', 'ROLE_USER'],
            ['Quentin', 'Lemar', 'Accessibilité',new DateTime('10-10-1990'), 'a', 'a', 'ROLE_USER'],
            ['Laurent', 'Houtan', 'Accessibilité',new DateTime('10-10-1990'), 'a', 'b', 'ROLE_INSTRUCTOR'],
            ['Sacha', 'Prioux', 'Accessibilité',new DateTime('10-10-1990'), 'a', 'c', 'ROLE_USER'],
            ['Aurélien', 'Bourdeille', 'Accessibilité',new DateTime('10-10-1990'), 'a', 'd', 'ROLE_USER'],
            ['Cassandre', 'Maertens', 'Accessibilité',new DateTime('10-10-1990'), 'a', 'e', 'ROLE_USER'],
            ['Joachim', 'Tristant', 'Accessibilité',new DateTime('10-10-1990'), 'a', 'f', 'ROLE_USER'],
            ['Clément', 'Mauguen', 'Accessibilité',new DateTime('10-10-1990'), 'a', 'g', 'ROLE_USER'],
            ['Camille', 'Mambangui', 'Accessibilité',new DateTime('10-10-1990'), 'a', 'h', 'ROLE_USER'],
            ['Laure', 'Monbert', 'Accessibilité',new DateTime('10-10-1990'), 'a', 'i', 'ROLE_USER'],
            ['François', 'Doe', 'Déchet',new DateTime('10-10-1990'), 'a', 'j', 'ROLE_INSTRUCTOR'],
            ['Tristan', 'Doe', 'Déchet',new DateTime('10-10-1990'), 'a', 'k', 'ROLE_USER'],
            ['Assou', 'Doe', 'Déchet',new DateTime('10-10-1990'), 'a', 'l', 'ROLE_INSTRUCTOR'],
            ['Cow', 'Cow', 'Déchet',new DateTime('10-10-1990'), '1234', 'coco', 'ROLE_ADMIN'],
        ];
    }
}