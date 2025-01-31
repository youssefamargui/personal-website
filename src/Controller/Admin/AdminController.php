<?php

namespace App\Controller\Admin;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/vehicles', name: 'admin_vehicles')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $vehicles = $entityManager->getRepository(Vehicle::class)->findAll();
        
        return $this->render('admin/vehicles.html.twig', [
            'vehicles' => $vehicles
        ]);
    }

    #[Route('/vehicle/new', name: 'admin_vehicle_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('vehicle_images_directory'),
                        $newFilename
                    );
                    $vehicle->setImageFilename($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de l\'upload de l\'image');
                }
            }

            $entityManager->persist($vehicle);
            $entityManager->flush();

            $this->addFlash('success', 'Véhicule ajouté avec succès');
            return $this->redirectToRoute('admin_vehicles');
        }

        return $this->render('admin/vehicle_form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Ajouter un véhicule'
        ]);
    }

    #[Route('/vehicle/edit/{id}', name: 'admin_vehicle_edit')]
    public function edit(Request $request, Vehicle $vehicle, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('vehicle_images_directory'),
                        $newFilename
                    );
                    
                    // Supprimer l'ancienne image si elle existe
                    if ($vehicle->getImageFilename()) {
                        $oldFilePath = $this->getParameter('vehicle_images_directory').'/'.$vehicle->getImageFilename();
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }
                    
                    $vehicle->setImageFilename($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de l\'upload de l\'image');
                }
            }

            $entityManager->flush();
            $this->addFlash('success', 'Véhicule modifié avec succès');
            return $this->redirectToRoute('admin_vehicles');
        }

        return $this->render('admin/vehicle_form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modifier le véhicule',
            'vehicle' => $vehicle
        ]);
    }
} 