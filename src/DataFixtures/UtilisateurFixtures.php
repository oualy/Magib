<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Partenaire;
use App\Entity\Utilisateur;
use App\Repository\RoleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurFixtures extends Fixture
{
    private $encoder;
    private $ripo;
    
    public function __construct(UserPasswordEncoderInterface $encoder,RoleRepository $repo  )
    {
        $this->encoder = $encoder;
        $this->repo = $repo;
      
    }

    public function load(ObjectManager $manager)
    {

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

        $role3 = new Role();
        $role3->setNomrole( "Partenaire");
        $manager->persist($role3);
        $manager->flush();

        $part = new Partenaire();
        $part->setNinea(1230);
        $part->setRc("httt");
        $manager->persist($part);
        $manager->flush();


        $user = new Utilisateur();
        
        
        $role=$this->repo->findOneBy(["nomrole"=>"SupAdmin"]);
         $user->SetRole($role)
        ->setRoles(["ROLE_".$role->getNomrole()])
        ->setNomcomplet("OualyAnsou")
        ->setUsername("SupAdmin")
        ->setIsActive(true)
        ->setPassword($this->encoder->encodePassword($user, "super"));
        // $product = new Product();
       
       

        $manager->persist($user);
        $manager->flush();
        
         // $manager->persist($product);

      

        
    }
}
