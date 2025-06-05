<?php

namespace App\Controller;

use App\Entity\Application;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApplicationController extends AbstractController
{
    #[Route('/apply/{jobId}', name: 'app_apply', methods: ['POST'])]
public function apply(int $jobId, Request $request, EntityManagerInterface $em, JobRepository $jobRepository, Security $security): Response
{
    $job = $jobRepository->find($jobId);
    if (!$job) {
        throw $this->createNotFoundException();
    }

    $application = new Application();
    $application->setJob($job);
    $application->setUser($security->getUser());
    $application->setCoverLetter($request->request->get('coverLetter'));
    $application->setCreatedAt(new \DateTimeImmutable());

    $em->persist($application);
    $em->flush();

    $this->addFlash('success', 'Candidature envoyée avec succès !');

    return $this->redirectToRoute('app_job_show', ['id' => $jobId]);
}

}
