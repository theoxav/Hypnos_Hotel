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
        
        $faker = Faker\Factory::create('fr-FR');
       
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

        $jane = new User;
        $jane->setEmail('janegoodall@example.com');
        $jane->setFirstName('Jane');
        $jane->setLastName('Goodall');
        $jane->setPassword(
            $this->passwordEncoder->hashPassword($jane, 'testtestManager')
        );
        $jane->setRoles(['ROLE_MANAGER']);
        $manager->persist($jane);

        $user2 = new User;
        $user2->setEmail('jackparis@example.com');
        $user2->setFirstName('Jack');
        $user2->setLastName('Paris');
        $user2->setPassword(
            $this->passwordEncoder->hashPassword($user2, 'testtestManager')
        );
        $user2->setRoles(['ROLE_MANAGER']);
        $manager->persist($user2);

        
        $user3 = new User;
        $user3->setEmail('markdoe@example.com');
        $user3->setFirstName('Mark');
        $user3->setLastName('Doe');
        $user3->setPassword(
            $this->passwordEncoder->hashPassword($user3, 'testtestManager')
        );
        $user3->setRoles(['ROLE_MANAGER']);
        $manager->persist($user3);

        $user4 = new User;
        $user4->setEmail('jeantorin@example.com');
        $user4->setFirstName('Jean');
        $user4->setLastName('Torin');
        $user4->setPassword(
            $this->passwordEncoder->hashPassword($user4, 'testtestManager')
        );
        $user4->setRoles(['ROLE_MANAGER']);
        $manager->persist($user4);

        $user5 = new User;
        $user5->setEmail('Juliettekaty@example.com');
        $user5->setFirstName('Juliette');
        $user5->setLastName('Katy');
        $user5->setPassword(
            $this->passwordEncoder->hashPassword($user5, 'testtestManager')
        );
        $user5->setRoles(['ROLE_MANAGER']);
        $manager->persist($user5);

        
        

        // ESTABLISHEMENT

        // London
        $london = new Establishement;

        $london->setName('The Fabulous');
        $london->setSlug($this->slugger->slug($london->getName())->lower());
        $london->setAddress('4 square Blank');
        $london->setPostalCode('EC2P 2E');
        $london->setCity('London');
        $london->setDescription($faker->realText($faker->numberBetween(30,100)));
        $london->setSubtitle('The place to be');
        $london->setIllustration('london.jpg');
        $london->setBanner('londonbanner.jpg');
        $london->setIsBest(0);
        $london->setUser($jane);

        $manager->persist($london);

        // Paris
        $paris = new Establishement;

        $paris->setName('Le grand Palais');
        $paris->setSlug($this->slugger->slug($paris->getName())->lower());
        $paris->setAddress('5 avenue des champs Élysée');
        $paris->setPostalCode('75015');
        $paris->setCity('Paris');
        $paris->setDescription($faker->realText($faker->numberBetween(10,30)));
        $paris->setSubtitle('Luxe et élégance');
        $paris->setIllustration('paris.jpg');
        $paris->setBanner('parisbanner.jpg');
        $paris->setIsBest(0);
        $paris->setUser($user2);

        $manager->persist($paris);

        // Nice
        $nice = new Establishement;

        $nice->setName('Le Majestic');
        $nice->setSlug($this->slugger->slug($nice->getName())->lower());
        $nice->setAddress('1 place du sauveur');
        $nice->setPostalCode('60000');
        $nice->setCity('Nice');
        $nice->setDescription($faker->realText($faker->numberBetween(10,30)));
        $nice->setSubtitle('Luxe et prestige');
        $nice->setIllustration('nice.jpg');
        $nice->setBanner('nicebanner.jpg');
        $nice->setIsBest(0);
        $nice->setUser($user3);

        $manager->persist($nice);

        // Caen
        $caen = new Establishement;

        $caen->setName('Le Normandy');
        $caen->setSlug($this->slugger->slug($caen->getName())->lower());
        $caen->setAddress('5 avenue de la République');
        $caen->setPostalCode('14000');
        $caen->setCity('Caen');
        $caen->setDescription($faker->realText($faker->numberBetween(10,30)));
        $caen->setSubtitle('Un Havre de paix ');
        $caen->setIllustration('caen.jpg');
        $caen->setBanner('caenbanner.jpg');
        $caen->setIsBest(0);
        $caen->setUser($user4);

        $manager->persist($caen);

      

        $deauville = new Establishement;

        $deauville->setName('Le Royal Deauville');
        $deauville->setSlug($this->slugger->slug($deauville->getName())->lower());
        $deauville->setAddress('5 impasse de la prairie');
        $deauville->setPostalCode('14800');
        $deauville->setCity('Deauville-Trouville');
        $deauville->setDescription($faker->realText($faker->numberBetween(10,30)));
        $deauville->setSubtitle('Une bulle d\'oxygène face à la mer');
        $deauville->setIllustration('deauville.jpg');
        $deauville->setBanner('deauvillebanner.jpg');
        $deauville->setIsBest(0);
        $deauville->setUser($user5);

        $manager->persist($deauville);
      
        $manager->flush();

    }
}
