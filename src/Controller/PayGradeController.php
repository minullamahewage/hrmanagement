<?php

namespace App\Controller;

use App\Entity\PayGrade;
use App\Form\PayGradeType;
use App\Model\PayGradeModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/paygrade")
 */
class PayGradeController extends AbstractController
{
    /**
     * @Route("/", name="pay_grade_index", methods={"GET"})
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $payGradeModel = new PayGradeModel();
        $payGrades = $payGradeModel->getAllPayGrades($entityManager);
        return $this->render('pay_grade/index.html.twig', [
            'pay_grades' => $payGrades,
        ]);
    }

    /**
     * @Route("/new", name="pay_grade_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $payGrade = new PayGrade();
        $entityManager = $this->getDoctrine()->getManager();
        $payGradeModel = new PayGradeModel();
        $form = $this->createForm(PayGradeType::class, $payGrade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $payGradeModel->addPayGrade($payGrade, $entityManager);

            return $this->redirectToRoute('pay_grade_index');
        }

        return $this->render('pay_grade/new.html.twig', [
            'pay_grade' => $payGrade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{payGrade}", name="pay_grade_show", methods={"GET"})
     */
    public function show(PayGrade $payGrade): Response
    {
        return $this->render('pay_grade/show.html.twig', [
            'pay_grade' => $payGrade,
        ]);
    }

    /**
     * @Route("/{payGrade}/edit", name="pay_grade_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PayGrade $payGrade): Response
    {
        $form = $this->createForm(PayGrade1Type::class, $payGrade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pay_grade_index');
        }

        return $this->render('pay_grade/edit.html.twig', [
            'pay_grade' => $payGrade,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{payGrade}", name="pay_grade_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PayGrade $payGrade): Response
    {
        if ($this->isCsrfTokenValid('delete'.$payGrade->getPayGrade(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($payGrade);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pay_grade_index');
    }
}
