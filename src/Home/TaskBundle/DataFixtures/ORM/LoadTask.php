<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 22.09.14
 * Time: 18:30
 * ------------------
 * загрузка первоначальных данных в базу командой doctrine:fixtures:load
 * ------------------
 */

namespace Home\TaskBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
Use Home\TaskBundle\Entity\Task;
class LoadTask implements FixtureInterface {

    public function load(ObjectManager $em)
    {
        $F=new Task();
        $F->setNameTask('First');
        $F->setBeginTask( new \DateTime('01-01-2014'));
        $F->setEndTask(new \DateTime('31-12-2014'));
        $em->persist($F);
        $T=new Task();
        $T->setNameTask('Two');
        $T->setBeginTask( new \DateTime('01-01-2014'));
        $T->setEndTask(new \DateTime('31-12-2014'));
        $em->persist($T);
        $em->flush();
    }
}