<?php

namespace App\Controller;

use App\Entity\JobTitle;
use App\Form\JobTitleType;
use App\Model\JobTitleModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/jobtitle")
 */
class JobTitleController extends AbstractController
{
    /**
     * @Route("/", name="job_title_index", methods={"GET"})
     */
    public function index(): Response
    {
        $entityManager=$this->getDoctrine()->getManager();
        $jobTitleModel=new JobTitleModel();
        // $jobTitles = $this->getDoctrine()
        //     ->getRepository(JobTitle::class)
        //     ->findAll();
        $jobTitles=$jobTitleModel->getAllJobTitles($entityManager);
        return $this->render('job_title/index.html.twig', [
            'job_titles' => $jobTitles,
        ]);
    }

    /**
     * @Route("/new", name="job_title_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jobTitle = new JobTitle();
        $jobTitleModel = new JobTitleModel();
        $form = $this->createForm(JobTitleType::class, $jobTitle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($jobTitle);
            // $entityManager->flush();
            $jobTitleModel->addJobTitle($jobTitle, $entityManager);
            return $this->redirectToRoute('job_title_index');
        }

        return $this->render('job_title/new.html.twig', [
            'job_title' => $jobTitle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{jobTitleId}", name="job_title_show", methods={"GET"})
     */
    public function show(JobTitle $jobTitle): Response
    {
        return $this->render('job_title/show.html.twig', [
            'job_title' => $jobTitle,
        ]);
    }

    /**
     * @Route("/{jobTitleId}/edit", name="job_title_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, JobTitle $jobTitle): Response
    {
        $jobTitleModel = new JobTitleModel();
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(JobTitleType::class, $jobTitle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $this->getDoctrine()->getManager()->flush();
            $jobTitleModel->changeJobTitle($jobTitle,$entityManager);
            return $this->redirectToRoute('job_title_index');
        }

        return $this->render('job_title/edit.html.twig', [
            'job_title' => $jobTitle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{jobTitleId}", name="job_title_delete", methods={"DELETE"})
     */
    public function delete(Request $request, JobTitle $jobTitle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobTitle->getJobTitleId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jobTitle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_title_index');
    }
}
