<?php

namespace SONUser\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;

use SONUser\Entity\User;

class UserLoad extends AbstractFixture {
    
    public function load(ObjectManager $manager) {
        
        $user = new User();
        $user->setNome("Rafael")
                ->setPassword('123456')
                ->setEmail('rafael@gmail.com')
                ->setActive(true);
        
        $manager->persist($user);
        $manager->flush();
        
        $user = new User();
        $user->setNome("Admin")
                ->setPassword('123456')
                ->setEmail('admin@teste.com')
                ->setActive(true);
        
        $manager->persist($user);
        $manager->flush();
    }
}
