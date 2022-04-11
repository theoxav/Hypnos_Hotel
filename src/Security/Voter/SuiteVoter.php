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
    public function __construct(private Security $security)
    {}
    

    protected function supports(string $attribute, $suite): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['SUITE_EDIT', 'SUITE_DELETE'])
            && $suite instanceof \App\Entity\Suite;
    }

    protected function voteOnAttribute(string $attribute, $suite, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) return false;

        // Si la suite a un proprietaire
        if(null === $suite->getUser()) return false;

        

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'SUITE_EDIT':
                // logic to determine if the user can EDIT
                return $this->canEdit($suite, $user) || $this->security->isGranted('ROLE_ADMIN');
                // return true or false
                break;
            case 'SUITE_DELETE':
                // logic to determine if the user can DELETE
                return $this->canDelete($suite, $user) || $this->security->isGranted('ROLE_ADMIN');
                // return true or false
                break;
        }

        return false;
    }

    private function canEdit(Suite $suite, User $user) {
        // le proprio de l'annonce peut la modifier
        return $user === $suite->getUser();
    }

    private function canDelete(Suite $suite, User $user) {
        return $user === $suite->getUser();
    }

}
