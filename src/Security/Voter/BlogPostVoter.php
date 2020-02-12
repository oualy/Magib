<?php

namespace App\Security\Voter;

use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class BlogPostVoter extends Voter

{
    const ROLE_SUPER_ADMIN ='ROLE_SUPER_ADMIN';
    const  ROLE_ADMIN='ROLE_ADMIN';
    const ROLE_CAISSIER='ROLE_CAISSIER';
    const ROLE_PARTENAIRE="ROLE_PARTENAIRE";
    private $security;
    private $decisionManager;
    protected $tokenStorage;


    public function __construct(Security $security ,AccessDecisionManagerInterface $decisionManager,
    TokenStorageInterface $tokenStorage)
    {
        $this->decisionManager = $decisionManager;
        $this->tokenStorage = $tokenStorage;
        $this->security = $security;
    }
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['POST','ADD','VIEW'])
            && $subject instanceof \App\Entity\Utilisateur;
    }
    /** @var Utilisateur $subject */
     /**
        * @param Utilisateur $subject
        */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUtilisateur();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        if($user->getRoles()[0] === 'ROLE_SUPER_ADMIN')
        {
          return true;
        }
        if($this->tokenStorage->getToken()->getRoles()[0]==self::ROLE_ADMIN){

            if ($subject->getRoles()[0]==self::ROLE_SUPER_ADMIN 
            || $subject->getRoles()[0]==self::ROLE_ADMIN){
                return false;
            }
            elseif ($this->tokenStorage->getToken()->getRoles()[0]==self::ROLE_CAISSIER){

                if ($subject->getRoles()[0]==self::ROLE_SUPER_ADMIN 
                 || $subject->getRoles()[0]==self::ROLE_ADMIN
                 ||$subject->getRoles()[0]==self::ROLE_CAISSIER)
                 {
                    return false;
                 }
                }elseif($this->tokenStorage->getToken()->getRoles()[0]==self::ROLE_PARTENAIRE){

                    if ($subject->getRoles()[0]==self::ROLE_SUPER_ADMIN 
                    || $subject->getRoles()[0]==self::ROLE_ADMIN
                    || $subject->getRoles()[0]==self::ROLE_PARTENAIRE
                    || $subject->getRoles()[0]==self::ROLE_CAISSIER)
                    {
                        return false;
                    }
                    
                }
                $user = $token->getUser();
                // if the user is anonymous, do not grant access
                if (!$user instanceof User) {
                    return false;
                }
            }

                 // ... (check conditions and return true to grant permission) ...
                switch ($attribute) {
                case'EDIT':
                if ($this->security->isGranted(self::ROLE_ADMIN)){
                    return true;
                }
                break;
    
    
                case'ADD':
                if ($this->security->isGranted(self::ROLE_ADMIN) || $this->security->isGranted(self::ROLE_PARTENAIRE)){
                    return true;
                }   

                 
                // logic to determine if the user can EDIT
                // return true or false
                break;
                case'VIEW':
                    if ($this->security->isGranted(self::ROLE_ADMIN)){
                        return true;
                    }
                    break;
                    case'DELET':
                    if ($this->tokenStorage->getToken()->getRoles()[0]==self::ROLE_ADMIN)
                    {
                      if ($subject->getRoles()[0]==self::ROLE_CAISSIER){
                       
                        return true;
                      }
                   }
                   
                   return false;
                    default:
        
                    throw new \Exception(sprintf('Impossible d\'accedeb dsl', $attribute));
                break;
                    
                }
            }
         }
