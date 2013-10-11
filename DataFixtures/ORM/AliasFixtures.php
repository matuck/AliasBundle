<?php
namespace matuck\AliasBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use matuck\AliasBundle\Entity\Alias;

class AliasFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $alias1 = new Alias();
        $alias1->setAlias('/test1');
        $alias1->setTruepath('/testredirect/test1');
        $manager->persist($alias1);
        
        $alias2 = new Alias();
        $alias2->setAlias('/test2');
        $alias2->setTruepath('/testredirect/johndoe');
        $manager->persist($alias2);
        
        $alias3 = new Alias();
        $alias3->setAlias('/test3');
        $alias3->setTruepath('/nopath/johndoe');
        $manager->persist($alias3);
        $manager->flush();        
    }
}
