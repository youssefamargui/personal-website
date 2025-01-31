<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/vehicles', name: 'admin_vehicles')]
    public function index(VehicleRepository $vehicleRepository): Response
    {
        return $this->render('admin/vehicles.html.twig', [
            'vehicles' => $vehicleRepository->findAll(),
        ]);
    }

    #[Route('/admin/vehicle/new', name: 'admin_vehicle_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vehicle);
            $entityManager->flush();

            $this->addFlash('success', 'Le véhicule a été ajouté avec succès.');
            return $this->redirectToRoute('admin_vehicles');
        }

        return $this->render('admin/vehicle_form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Ajouter un véhicule'
        ]);
    }

    #[Route('/admin/vehicle/{id}/edit', name: 'admin_vehicle_edit')]
    public function edit(Request $request, Vehicle $vehicle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Le véhicule a été modifié avec succès.');
            return $this->redirectToRoute('admin_vehicles');
        }

        return $this->render('admin/vehicle_form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modifier le véhicule'
        ]);
    }

    #[Route('/admin/vehicle/{id}/delete', name: 'admin_vehicle_delete')]
    public function delete(Vehicle $vehicle, EntityManagerInterface $entityManager): RedirectResponse
    {
        // Supprime l'image si elle existe
        if ($vehicle->getImageFilename()) {
            $imagePath = $this->getParameter('kernel.project_dir') . '/public/uploads/vehicles/' . $vehicle->getImageFilename();
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $entityManager->remove($vehicle);
        $entityManager->flush();

        $this->addFlash('success', 'Le véhicule a été supprimé avec succès.');

        return $this->redirectToRoute('admin_vehicles');
    }
} 