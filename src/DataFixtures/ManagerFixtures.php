<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Establishement;
use App\Entity\ServiceHotel;
use App\Entity\Suite;
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
        $admin->setEmail('johnhypnos@example.com');
        $admin->setFirstName('John');
        $admin->setLastName('Hypnos');
        $admin->setPassword('$2y$13$tK76w11.tqA4FfxqggSeYuYkQngMhqoNRolA3BOKf4cUFl0KrwZgO');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        
      

        // MANAGER

        $jane = new User;
        $jane->setEmail('janegoodall@example.com');
        $jane->setFirstName('Jane');
        $jane->setLastName('Goodall');
        $jane->setPassword('$2y$13$hl7HzY5fGJf.jd418uXv7OkPHRwZD4Zo9TKIkBz6pSweyQWop0s3G');
        $jane->setRoles(['ROLE_MANAGER']);
        $manager->persist($jane);

        $user2 = new User;
        $user2->setEmail('jackparis@example.com');
        $user2->setFirstName('Jack');
        $user2->setLastName('Paris');
        $user2->setPassword('$2y$13$9q/XmsJMUVsymvgNJPrYuuOtS7dcG3WKa2D1wBsVBfM7fezZkDnpe');
        $user2->setRoles(['ROLE_MANAGER']);
        $manager->persist($user2);

        
        $user3 = new User;
        $user3->setEmail('markdoe@example.com');
        $user3->setFirstName('Mark');
        $user3->setLastName('Doe');
        $user3->setPassword('$2y$13$hBzSKdRQpHxNWXZQurK0feyY5XSVA9kNy4VkCIXXgWxO8OsRFgEOy');
        $user3->setRoles(['ROLE_MANAGER']);
        $manager->persist($user3);

        $user4 = new User;
        $user4->setEmail('jeantorin@example.com');
        $user4->setFirstName('Jean');
        $user4->setLastName('Torin');
        $user4->setPassword(' $2y$13$yNMyhLIg0O7QeYtUyjz7m.Yx9z91tieWvnCb6smWzWXRvQ6EJAwiq');
        $user4->setRoles(['ROLE_MANAGER']);
        $manager->persist($user4);

        $user5 = new User;
        $user5->setEmail('Juliettekaty@example.com');
        $user5->setFirstName('Juliette');
        $user5->setLastName('Katy');
        $user5->setPassword('$2y$13$eJMdRc2nPOavFqMCYSqBZeskI8j412UlMMTDYzhYj5NtOalrhEcjG');
        $user5->setRoles(['ROLE_MANAGER']);
        $manager->persist($user5);

        $user6 = new User;
        $user6->setEmail('johndoe@example.com');
        $user6->setFirstName('John');
        $user6->setLastName('Doe');
        $user6->setPassword('$2y$13$1rAfeg2nw1AcozDGL1tkqOqCSo2e9pu909Z1b4HmsukynUlKzcNCK');
        $manager->persist($user6);


        
        

        // ESTABLISHEMENT

        // London
        $london = new Establishement;

        $london->setName('The Fabulous');
        $london->setSlug($this->slugger->slug($london->getName())->lower());
        $london->setAddress('4 square Blank');
        $london->setPostalCode('EC2P 2E');
        $london->setCity('London');
        $london->setDescription($faker->realText($faker->numberBetween(30,200)));
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
        $paris->setDescription($faker->realText($faker->numberBetween(30,200)));
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
        $nice->setDescription($faker->realText($faker->numberBetween(30,200)));
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
        $caen->setDescription($faker->realText($faker->numberBetween(30,200)));
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
        $deauville->setDescription($faker->realText($faker->numberBetween(30,200)));
        $deauville->setSubtitle('Une bulle d\'oxygène face à la mer');
        $deauville->setIllustration('deauville.jpg');
        $deauville->setBanner('deauvillebanner.jpg');
        $deauville->setIsBest(0);
        $deauville->setUser($user5);

        $manager->persist($deauville);

        // SUITES
        $londons1 = new Suite;

        $londons1->setName('Un Homme et une Femme');
        $londons1->setDescription($faker->realText($faker->numberBetween(30,200)));
        $londons1->setPrice(8000);
        $londons1->setIllustration('londonsuite.jpg');
        $londons1->setEstablishement($london);
        $londons1->setUser($jane);

        $manager->persist($londons1);

        $londons2 = new Suite;

        $londons2->setName('Signature British');
        $londons2->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $londons2->setPrice(8500);
        $londons2->setIllustration('londonsuite2.jpg');
        $londons2->setEstablishement($london);
        $londons2->setUser($jane);

        $manager->persist($londons2);

        $paris1 = new Suite;

        $paris1->setName('Signature George V');
        $paris1->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $paris1->setPrice(12500);
        $paris1->setIllustration('parissuite.jpg');
        $paris1->setEstablishement($paris);
        $paris1->setUser($user2);

        $manager->persist($paris1);

        $paris2 = new Suite;

        $paris2->setName('Signature Arc de Triomphe');
        $paris2->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $paris2->setPrice(18500);
        $paris2->setIllustration('parissuite2.jpg');
        $paris2->setEstablishement($paris);
        $paris2->setUser($user2);

        $manager->persist($paris2);

        $nices1 = new Suite;

        $nices1->setName('Chambre Deluxe Mer');
        $nices1->setPrice(3500);
        $nices1->setIllustration('nicesuite.jpg');
        $nices1->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $nices1->setEstablishement($nice);
        $nices1->setUser($user3);

        $manager->persist($nices1);

        $nices2 = new Suite;

        $nices2->setName('Chambre Prestige Mer');
        $nices2->setPrice(7500);
        $nices2->setIllustration('nicesuite2.jpg');
        $nices2->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $nices2->setEstablishement($nice);
        $nices2->setUser($user3);

        $manager->persist($nices2);

        $caens1 = new Suite;

        $caens1->setName('Le Prestige');
        $caens1->setPrice(14500);
        $caens1->setIllustration('caensuite.jpg');
        $caens1->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $caens1->setEstablishement($caen);
        $caens1->setUser($user4);

        $manager->persist($caens1);

        $caens2 = new Suite;

        $caens2->setName('La petite prairie');
        $caens2->setPrice(14500);
        $caens2->setIllustration('caensuite2.jpg');
        $caens2->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $caens2->setEstablishement($caen);
        $caens2->setUser($user4);

        $manager->persist($caens2);

        $deauvilles1 = new Suite;
        $deauvilles1->setName('Beauté Campagne');
        $deauvilles1->setPrice(12500);
        $deauvilles1->setIllustration('deauvillesuite.jpg');
        $deauvilles1->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $deauvilles1->setEstablishement($deauville);
        $deauvilles1->setUser($user5);

        $manager->persist($deauvilles1);


        $deauvilles2 = new Suite;
        $deauvilles2->setName('Douce nuit');
        $deauvilles2->setPrice(12500);
        $deauvilles2->setIllustration('deauvillesuite2.jpg');
        $deauvilles2->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $deauvilles2->setEstablishement($deauville);
        $deauvilles2->setUser($user5);

        $manager->persist($deauvilles2);

        // SERVICES

        $spa = new ServiceHotel;

        $spa->setTitle('SPA');
        $spa->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $spa->setIllustration('spa.jpg');

        $manager->persist($spa);

        $gastronomy = new ServiceHotel;

        $gastronomy->setTitle('Gastronomy');
        $gastronomy->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $gastronomy->setIllustration('gastronomy.jpg');

        $manager->persist($gastronomy);
      
        $manager->flush();

        $casino = new ServiceHotel;

        $casino->setTitle('Casino');
        $casino->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $casino->setIllustration('casino.jpg');

        $manager->persist($casino);

        $cinema = new ServiceHotel;

        $cinema->setTitle('Cinema');
        $cinema->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $cinema->setIllustration('casino.jpg');

        $manager->persist($cinema);

        $sport = new ServiceHotel;

        $sport->setTitle('Sport');
        $sport->setDescription($faker->realText($faker->numberBetween(30, 200)));
        $sport->setIllustration('sport.jpg');

        $manager->persist($sport);

        $manager->flush();

    }
}
