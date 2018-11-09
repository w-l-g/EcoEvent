<?php
namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Analysis;
use App\Entity\Survey;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


final class EventFixtures extends Fixture
{
    public function load(ObjectManager $em) : void
    {
        foreach ($this->getEventData() as [$name, $fbId, $date, $survey, $analysis])
        {
            $event = new Event();
            $event->setName($name)
                  ->setsetFacebookId($fbId)
                  ->setDate($date)
                  ->addQuestionnaire($survey)
                  ->setAnalysis($analysis);
            
            $em->persist($event);
        }

        $em->flush();
    }


    public function getEventData() : array
    {
        return [
            ['Prestival', null, new DateTime('now'), null, null],
            ['Helfest', null, new DateTime('10-08-2017'), null, null],
            ['Festival des Charus', null, new DateTime('now'), null, null],
            ['Art to Play', null, new DateTime('now'), null, null]
        ];
    }


    public function getDependencies() : array
    {
        return array(
            Analysis::class,
            Survey::class
        );
    }
}