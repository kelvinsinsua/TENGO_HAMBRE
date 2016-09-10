<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use RestaurantBundle\Entity\Restaurant;
use RestaurantBundle\Entity\Menu;
use RestaurantBundle\Entity\Ingredient;

class LoadRestaurantsData implements FixtureInterface {
    
    public function load(ObjectManager $manager)
    {
        
    }
   
}
