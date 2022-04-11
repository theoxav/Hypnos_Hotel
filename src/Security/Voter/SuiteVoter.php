<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Entity\Suite;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class SuiteVoter extends Voter
{
    public const EDIT = 'SUITE_EDIT';
    public const DELETE = 'SUITE_DELETE';

    public function __construct(private Security $security){}

    protected function supports(string $attribute, $suite): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT, self::DELETE])
            && $suite instanceof Suite;
    }


    protected function voteOnAttribute(string $attribute, $suite, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        // on verifie si l'annonce a un propriétaire
        //if(null === $suite->getUser()) return false;


        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                // logic to determine if the user can EDIT
                return $this->canEdit($suite, $user);
                // return true or false
                break;
            case self::DELETE:
                // logic to determine if the user can DELETE
                return $this->canDelete($suite,$user);
                // return true or false
                break;
        }

        return false;
    }

    private function canEdit(Suite $suite, User $user)
    {
        // le propriétaire de la suite peut la modifier
        return $user === $suite->getUser();
    }

    private function canDelete(Suite $suite, User $user)
    {
        // le propriétaire de la suite peut la supprimer
        if($this->security->isGranted('ROLE_ADMIN')) return true;
        return $user === $suite->getUser();
    }
}
