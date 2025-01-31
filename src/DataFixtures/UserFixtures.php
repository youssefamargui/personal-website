<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('youssef@gmail.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword(
            $this->passwordHasher->hashPassword($admin, 'admin')
        );

        $admin2 = new User();
        $admin2->setEmail('salah@gmail.com');
        $admin2->setRoles(['ROLE_ADMIN']);
        $admin2->setPassword(
            $this->passwordHasher->hashPassword($admin2, 'admin')
        );

        $admin3 = new User();
        $admin3->setEmail('hicham@gmail.com');
        $admin3->setRoles(['ROLE_ADMIN']);
        $admin3->setPassword(
            $this->passwordHasher->hashPassword($admin3, 'admin')
        );

        $manager->persist($admin);
        $manager->persist($admin2);
        $manager->persist($admin3);

        $manager->flush();
    }
} 