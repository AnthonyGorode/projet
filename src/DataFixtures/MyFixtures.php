<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MyFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');


        $arrayCategory = "";
        $arrayUser = "";
        $gender = ["male", "female"];

        $arrayCategory = ["news","sport","economie"];

        for($i = 0; $i <= 2; $i++ ){
            $category = new Category();

            $category->setName($faker->word);
            $manager->persist($category);

            if($i == 0){
                $arrayCategory = $category;
            }
        }

        for($i = 0; $i <= 10; $i++ ){
            $user = new User();

            $user->setName($faker->lastName)
                 ->setFirstName($faker->firstName($gender[mt_rand(0,1)]))
                 ->setEmail($faker->email)
                 ->setPassword('password');
            $manager->persist($user);

            if($i == 0){
                $arrayUser = $user;
            }
        }

        for($i = 0; $i <= 10; $i++){
            $article = new Article();

            $article->setName($faker->catchPhrase)
                    ->setContent($faker->text(200))
                    ->setCreatedAt($faker->dateTimeBetween('-3 months','now'))
                    ->setCategoryId($arrayCategory)
                    ->setUserId($arrayUser);
                    
            $manager->persist($article);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
