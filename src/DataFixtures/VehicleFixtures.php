<?php

namespace App\DataFixtures;

use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $vehicles = [
            [
                'brand' => 'Renault',
                'model' => 'Clio',
                'dailyPrice' => 200.00,
                'image' => 'clio.jpg',
            ],
            [
                'brand' => 'Peugeot',
                'model' => '208',
                'dailyPrice' => 200.00,
                'image' => 'p208.jpg',
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Golf',
                'dailyPrice' => 300.00,
                'image' => 'golf.jpg',
            ],
            [
                'brand' => 'Mercedes',
                'model' => 'Classe A',
                'dailyPrice' => 400.00,
                'image' => 'mercedesa.jpg',
            ],
            [
                'brand' => 'BMW',
                'model' => 'Série 1',
                'dailyPrice' => 400.00,
                'image' => 'bmws1.jpg',
            ],
            [
                'brand' => 'Audi',
                'model' => 'A3',
                'dailyPrice' => 400.00,
                'image' => 'a3.jpg',
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Yaris',
                'dailyPrice' => 200.00,
                'image' => 'yaris.webp',
            ],
            [
                'brand' => 'Volvo',
                'model' => 'XC40',
                'dailyPrice' => 300.00,
                'image' => 'xc40.jpg',
            ],
            [
                'brand' => 'Skoda',
                'model' => 'Octavia',
                'dailyPrice' => 250.00,
                'image' => 'octavia.webp',
            ],
            [
                'brand' => 'Fiat',
                'model' => 'Panda',
                'dailyPrice' => 150.00,
                'image' => 'panda.jpg',
            ],
            [
                'brand' => 'Ford',
                'model' => 'Focus',
                'dailyPrice' => 200.00,
                'image' => 'focus.jpeg',
            ],
            [
                'brand' => 'Alfa Romeo',
                'model' => 'Giulia',
                'dailyPrice' => 350.00,
                'image' => 'giulia.jpg',
            ],
            [
                'brand' => 'BENTLEY',
                'model' => 'Flying Spur',
                'dailyPrice' => 650.00,
                'image' => 'bentley-flying-spur.jpg',
            ],
            [
                'brand' => 'Léon',
                'model' => 'Cupra',
                'dailyPrice' => 300.00,
                'image' => 'cupra.jpg',
            ],
            [
                'brand' => 'Porsche',
                'model' => 'Cayenne',
                'dailyPrice' => 800.00,
                'image' => 'cayenne.jpeg',
            ],
            [
                'brand' => 'Range Rover',
                'model' => 'Evoque',
                'dailyPrice' => 600.00,
                'image' => 'evoque.jpg',
            ],
            [
                'brand' => 'Jaguar',
                'model' => 'F-PACE',
                'dailyPrice' => 550.00,
                'image' => 'fpace.webp',
            ],
            [
                'brand' => 'Maserati',
                'model' => 'Ghibli',
                'dailyPrice' => 750.00,
                'image' => 'ghuibli.jpg',
            ],
            [
                'brand' => 'Tesla',
                'model' => 'Model 3',
                'dailyPrice' => 450.00,
                'image' => 'tesla.jpg',
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'Tucson',
                'dailyPrice' => 300.00,
                'image' => 'tucson.png',
            ],
            [
                'brand' => 'Kia',
                'model' => 'Sportage',
                'dailyPrice' => 280.00,
                'image' => 'sportage.jpeg',
            ],
            [
                'brand' => 'Dacia',
                'model' => 'Duster',
                'dailyPrice' => 180.00,
                'image' => 'duster.jpg',
            ],
            [
                'brand' => 'Mini',
                'model' => 'Cooper S',
                'dailyPrice' => 350.00,
                'image' => 'cooper.jpg',
            ],
            [
                'brand' => 'Citroën',
                'model' => 'C4',
                'dailyPrice' => 220.00,
                'image' => 'c4.jpg',
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            $vehicle = new Vehicle();
            $vehicle->setBrand($vehicleData['brand']);
            $vehicle->setModel($vehicleData['model']);
            $vehicle->setDailyPrice($vehicleData['dailyPrice']);
            $vehicle->setImageFilename($vehicleData['image']);
            $vehicle->setIsAvailable(true);

            $manager->persist($vehicle);
        }

        $manager->flush();
    }
} 