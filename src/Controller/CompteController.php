<?php
namespace app\Controller;



use Exception;
use App\Entity\Compte;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CompteController
{
    private $entityManager;
    private $userPassewordEncoder;
    private $tokenstorage;
    private $repo;

    public function __construct(EntityManagerInterface $entityManager,UserPasswordEncoderInterface $userPassewordEncoder,TokenStorageInterface $tokenstorage,RoleRepository $repo)
    {
        $this->entityManager=$entityManager;
        $this->userPasswordEncoder=$userPassewordEncoder;
        $this->tokenstorage=$tokenstorage;
        $this->repo=$repo;
    }

    public function __invoke(Compte $data)
    {
        dd($data);
    //partenaire nouveaux
    if ($data->getPartenaire()!=null) 
    {
        $userpassword=$this->userPasswordEncoder->encodePassword($data->getPartenaire()->getUtilisateur()[0],
        $data->getPartenaire()->getUtilisateur()[0]->getPassword());
        $date->getPartenaire()->getUtilisateur()[0]->setPassword($userPasseword);



        //nouveau depot
        $solde=$data->getDepots()[0]->getMontantdepot();
        if ($solde<500000) {
            throw new Exception("dsl votre montant est insuffisant pour cette transaction");
            
        }
        else{
           $data->setSolde($solde);

           $utilisateurcreateur=$this->tokenStorage()->getUtilisateur();
           $data->setUsercreateur( $utilisateurcreateur);

           return $data;
        }
    }
    }
}

