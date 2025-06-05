<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Company;
use App\Entity\Job;
use App\Entity\Category;
use App\Entity\Type;
use App\Entity\Application;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // 1. USERS
        $admin = new User();
        $admin->setName('Ruth Biaou');
        $admin->setEmail('biaoufunke@gmail.com');
        $admin->setRoles(["ROLE_ADMIN"]);
        $admin->setPassword($this->hasher->hashPassword($admin, '$2y$13$1vYoea.jbKyPViNTTFWUq.OXPpgXnY37.FeMzLWs2Yuo0mzulm/Tm'));
        $manager->persist($admin);

        $user = new User();
        $user->setName('Audrey Biaou');
        $user->setEmail('audrey.biaou@gmail.com');
        $user->setRoles(["ROLE_USER"]);
        $user->setPassword($this->hasher->hashPassword($user, '$2y$13$MfhdD2FoiSjLNMmbO9O2HucAlG6cGt2cakDJzrWIq31FJ0A93nsuy'));
        $manager->persist($user);

        // 2. TYPES
        $types = [];
        foreach (['CDI', 'CDD', 'Stage', 'Freelance'] as $typeName) {
            $type = new Type();
            $type->setName($typeName);
            $manager->persist($type);
            $types[] = $type;
        }

        // 3. CATEGORIES
        $categories = [];
        foreach ([
            'Développement Web',
            'Réseau et sécurité',
            'Data Science',
            'Administration Système',
        ] as $catName) {
            $cat = new Category();
            $cat->setName($catName);
            $manager->persist($cat);
            $categories[] = $cat;
        }

        // 4. COMPANIES
        $company = new Company();
        $company->setName('TechCorp');
        $company->setDescription('Entreprise innovante spécialisée en IA');
        $company->setAddress('12 Rue de l’Innovation');
        $company->setCity('Paris');
        $company->setCountry('France');
        $manager->persist($company);

        // 5. JOBS
        $job = new Job();
        $job->setTitle('Développeur Full-Stack Symfony');
        $job->setDescription('Nous recherchons un développeur Symfony passionné.');
        $job->setCity('Paris');
        $job->setCountry('France');
        $job->setRemoteAllowed(true);
        $job->setSalaryRange(45000);
        $job->setCompany($company);
        $job->setType($types[0]); // CDI
        $job->addCategory($categories[0]); // Dév Web
        $job->addCategory($categories[2]); // Data
        $manager->persist($job);

        // 6. APPLICATIONS
        $application = new Application();
        $application->setUser($user);
        $application->setJob($job);
        $application->setCoverLetter('Je suis très motivé par ce poste.');
        $application->setCreatedAt(new \DateTimeImmutable());
        $manager->persist($application);

        // SAVE ALL
        $manager->flush();
    }
}
