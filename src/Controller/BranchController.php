<?php

namespace App\Controller;

use App\Entity\Branch;
use App\Form\BranchType;
use App\Model\BranchModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/branch")
 */
class BranchController extends AbstractController
{
    //admin show all branches
    /**
     * @Route("/", name="branch_index", methods={"GET"})
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $branchModel = new BranchModel();
        $branches= $branchModel->getAllBranches($entityManager);
        // $branches = $this->getDoctrine()
        //     ->getRepository(Branch::class)
        //     ->findAll();

        return $this->render('branch/index.html.twig', [
            'branches' => $branches,
        ]);
    }

    //admin add new branch
    /**
     * @Route("/new", name="branch_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $branch = new Branch();
        $form = $this->createForm(BranchType::class, $branch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $branchModel = new BranchModel();
            $branchModel->addBranch($branch, $entityManager);
            // $entityManager->persist($branch);
            // $entityManager->flush();

            return $this->redirectToRoute('branch_index');
        }

        return $this->render('branch/new.html.twig', [
            'branch' => $branch,
            'form' => $form->createView(),
        ]);
    }

    //admin show branch details
    /**
     * @Route("/{branchId}", name="branch_show", methods={"GET"})
     */
    public function show(Branch $branch): Response
    {
        return $this->render('branch/show.html.twig', [
            'branch' => $branch,
        ]);
    }

    //admin edit branch details
    /**
     * @Route("/{branchId}/edit", name="branch_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Branch $branch): Response
    {
        $form = $this->createForm(BranchType::class, $branch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('branch_index');
        }

        return $this->render('branch/edit.html.twig', [
            'branch' => $branch,
            'form' => $form->createView(),
        ]);
    }

    //admin delete branch
    /**
     * @Route("/{branchId}", name="branch_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Branch $branch): Response
    {
        if ($this->isCsrfTokenValid('delete'.$branch->getBranchId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $branchModel = new BranchModel();
            $branchModel->deleteBranch($branch, $entityManager);
            // $entityManager->remove($branch);
            // $entityManager->flush();
        }

        return $this->redirectToRoute('branch_index');
    }
}
