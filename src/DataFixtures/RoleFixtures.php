<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $role = new Role();
        $role->setNomrole( "SupAdmin");
        $manager->persist($role);

        $role1 = new Role();
        $role1->setNomrole( "Admin");
        $manager->persist($role1);

        $role2 = new Role();
        $role2->setNomrole( "Caissier");
        $manager->persist($role2);
        $manager->flush();
        
    }
}
