<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Entity\Vehicle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RentalType;

#[Route('/rental')]
class RentalController extends AbstractController
{
    #[Route('/', name: 'rental_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('rental/index.html.twig', [
            'title' => 'Location de voitures'
        ]);
    }

    #[Route('/vehicles', name: 'rental_vehicles', methods: ['GET'])]
    public function listVehicles(EntityManagerInterface $entityManager): Response
    {
        $vehicles = $entityManager->getRepository(Vehicle::class)->findAll();
        
        return $this->render('rental/vehicles.html.twig', [
            'vehicles' => $vehicles
        ]);
    }

    #[Route('/confirmation/{id}', name: 'rental_confirmation')]
    public function confirmation(Rental $rental): Response
    {
        return $this->render('rental/confirmation.html.twig', [
            'rental' => $rental,
            'vehicle' => $rental->getVehicle(),
            'customer' => $rental->getCustomer()
        ]);
    }

    #[Route('/rental/book/{id}', name: 'rental_book')]
    public function book(Request $request, Vehicle $vehicle, EntityManagerInterface $entityManager): Response
    {
        $rental = new Rental();
        $rental->setVehicle($vehicle);
        
        $form = $this->createForm(RentalType::class, $rental);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Calcul du prix total
            $interval = $rental->getStartDate()->diff($rental->getEndDate());
            $days = $interval->days + 1;
            $rental->setTotalPrice($vehicle->getDailyPrice() * $days);

            // Marquer le véhicule comme indisponible
            $vehicle->setIsAvailable(false);
            
            // Sauvegarder en base de données
            $entityManager->persist($rental);
            $entityManager->flush();

            $this->addFlash('success', 'Réservation effectuée avec succès');
            return $this->redirectToRoute('rental_confirmation', ['id' => $rental->getId()]);
        }

        return $this->render('rental/book.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ]);
    }
} 