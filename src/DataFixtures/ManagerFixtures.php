<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Establishement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ManagerFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $passwordEncoder, private SluggerInterface $slugger){}
   
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('en_US');
       
        // ADMIN
        $admin = new User;
        $admin->setEmail('admin@example.com');
        $admin->setFirstName('John');
        $admin->setLastName('Hypnos');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'testtestAdmin1')
        );
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        
      

        // MANAGER

        $user = new User;
        $user->setEmail('janelondon@example.com');
        $user->setFirstName('Jane');
        $user->setLastName('London');
        $user->setPassword(
            $this->passwordEncoder->hashPassword($user, 'testtestManager')
        );
        $user->setRoles(['ROLE_MANAGER']);
        $manager->persist($user);

        $user2 = new User;
        $user2->setEmail('jackparis@example.com');
        $user2->setFirstName('Jack');
        $user2->setLastName('Paris');
        $user2->setPassword(
            $this->passwordEncoder->hashPassword($user, 'testtestManager')
        );
        $user2->setRoles(['ROLE_MANAGER']);
        $manager->persist($user2);

        
        $user3 = new User;
        $user3->setEmail('markLisbonne@example.com');
        $user3->setFirstName('Mark');
        $user3->setLastName('Lisbonne');
        $user3->setPassword(
            $this->passwordEncoder->hashPassword($user, 'testtestManager')
        );
        $user3->setRoles(['ROLE_MANAGER']);
        $manager->persist($user3);

        $user4 = new User;
        $user4->setEmail('jeansantorin@example.com');
        $user4->setFirstName('Jean');
        $user4->setLastName('Santorin');
        $user4->setPassword(
            $this->passwordEncoder->hashPassword($user, 'testtestManager')
        );
        $user4->setRoles(['ROLE_MANAGER']);
        $manager->persist($user4);

        $user5 = new User;
        $user5->setEmail('JulietteVenise@example.com');
        $user5->setFirstName('Juliette');
        $user5->setLastName('Venise');
        $user5->setPassword(
            $this->passwordEncoder->hashPassword($user, 'testtestManager')
        );
        $user5->setRoles(['ROLE_MANAGER']);
        $manager->persist($user5);

        
        

        // ESTABLISHEMENT
        $london = new Establishement;

        $london->setName('The Fabulous');
        $london->setSlug($this->slugger->slug($london->getName())->lower());
        $london->setAddress('4 square Blank');
        $london->setPostalCode('EC2P 2E');
        $london->setCity('London');
        $london->setDescription($faker->realText($faker->numberBetween(10,30)));
        $london->setSubtitle($faker->title);
        $london->setIsBest(0);
        $london->setUser($user5);

        $manager->persist($london);

        $venise = new Establishement;

        $venise->setName('The great Italian');
        $venise->setSlug($this->slugger->slug($venise->getName())->lower());
        $venise->setAddress('98 via flavia');
        $venise->setPostalCode('30100');
        $venise->setCity('Venise');
        $venise->setDescription($faker->realText($faker->numberBetween(10,30)));
        $venise->setSubtitle('Viva Italia');
        $venise->setIsBest(0);
        $venise->setUser($user);

        $manager->persist($venise);

        $santorin = new Establishement;

        $santorin->setName('The greek God');
        $santorin->setSlug($this->slugger->slug($santorin->getName())->lower());
        $santorin->setAddress('4 thira');
        $santorin->setPostalCode('847000');
        $santorin->setCity('Santorin');
        $santorin->setDescription($faker->realText($faker->numberBetween(10,30)));
        $santorin->setSubtitle($faker->title);
        $santorin->setIsBest(0);
        $santorin->setUser($user4);

        $manager->persist($santorin);

        $paris = new Establishement;

        $paris->setName('The Classic');
        $paris->setSlug($this->slugger->slug($paris->getName())->lower());
        $paris->setAddress('5 avenue des champs Élysée');
        $paris->setPostalCode('75015');
        $paris->setCity('Paris');
        $paris->setDescription($faker->realText($faker->numberBetween(10,30)));
        $paris->setSubtitle($faker->title);
        $paris->setIsBest(0);
        $paris->setUser($user2);

        $manager->persist($paris);

        $lisbonne = new Establishement;

        $lisbonne->setName('The Palacio ');
        $lisbonne->setSlug($this->slugger->slug($lisbonne->getName())->lower());
        $lisbonne->setAddress('campo de Santa Clara');
        $lisbonne->setPostalCode('1728');
        $lisbonne->setCity('Lisbonne');
        $lisbonne->setDescription($faker->realText($faker->numberBetween(10,30)));
        $lisbonne->setSubtitle($faker->title);
        $lisbonne->setIsBest(0);
        $lisbonne->setUser($user3);

        $manager->persist($lisbonne);
      
        $manager->flush();

    }
}
