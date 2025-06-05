<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobController extends AbstractController
{
    #[Route('/jobs', name: 'app_job_list')]
    public function list(Request $request, JobRepository $jobRepository): Response
    {
        $jobs = $jobRepository->findAll();
        return $this->render('job/list.html.twig', ['jobs' => $jobs]);


    $criteria = [];
    if ($request->query->get('country')) {
        $criteria['country'] = $request->query->get('country');
    }
    if ($request->query->get('remote') === '1') {
        $criteria['remoteAllowed'] = true;
    }

    $jobs = $jobRepository->findBy($criteria);

    return $this->render('job/list.html.twig', [
        'jobs' => $jobs,
    ]);
}


    #[Route('/job/{id}', name: 'app_job_show')]
    public function show(Job $job): Response
    {
    return $this->render('job/show.html.twig', ['job' => $job]);
    }
    


}
