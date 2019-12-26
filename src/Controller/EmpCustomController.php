<?php

namespace App\Controller;

use App\Entity\EmpCustom;
use App\Form\EmpCustomType;
use App\Model\EmpCustomModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


//admin only
/**
 * @Route("/empcustom")
 */
class EmpCustomController extends AbstractController
{
    /**
     * @Route("/", name="emp_custom_index", methods={"GET"})
     */
    public function index(): Response
    {
        //$empCustoms = $this->getDoctrine()
        //    ->getRepository(EmpCustom::class)
        //    ->findAll();
        $entityManager = $this->getDoctrine()->getManager();
        $empCustomModel = new EmpCustomModel();
        $empCustoms= $empCustomModel->getAllCustomAttributes($entityManager);

        return $this->render('emp_custom/index.html.twig', [
            'emp_customs' => $empCustoms,
        ]);
    }

    /**
     * @Route("/new", name="emp_custom_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $empCustom = new EmpCustom();
        $form = $this->createForm(EmpCustomType::class, $empCustom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($empCustom);
            //$entityManager->flush();
            $empCustomModel = new EmpCustomModel();
            $empCustomAttr = str_replace(' ','_', $empCustom->getAttribute());
            $empCustom->setAttribute($empCustomAttr);
            $empCustomModel->addCustomAttribute($empCustom, $entityManager);

            return $this->redirectToRoute('emp_custom_index');
        }

        return $this->render('emp_custom/new.html.twig', [
            'emp_custom' => $empCustom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{attribute}", name="emp_custom_show", methods={"GET"})
     */
    public function show(EmpCustom $empCustom): Response
    {
        return $this->render('emp_custom/show.html.twig', [
            'emp_custom' => $empCustom,
        ]);
    }

    /**
     * @Route("/{attribute}", name="emp_custom_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EmpCustom $empCustom): Response
    {
        if ($this->isCsrfTokenValid('delete'.$empCustom->getAttribute(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->remove($empCustom);
            //$entityManager->flush();
            $empCustomModel = new EmpCustomModel();
            $empCustomModel->deleteCustomAttribute($empCustom, $entityManager);
        }

        return $this->redirectToRoute('emp_custom_index');
    }
}
