<?php

namespace App\Controller;

use App\Entity\EmergencyContact;
use App\Form\EmergencyContactType;
use App\Model\EmergencyContactModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/emergencycontact")
 */
class EmergencyContactController extends AbstractController
{
    //admin show all emergency contacts
    /**
     * @Route("/admin", name="emergency_contact_index", methods={"GET"})
     */
    public function index(): Response
    {
        // $emergencyContacts = $this->getDoctrine()
        //     ->getRepository(EmergencyContact::class)
        //     ->findAll();
        $entityManager = $this->getDoctrine()->getManager();
        $emergencyContactModel = new EmergencyContactModel();
        $emergencyContacts = $emergencyContactModel->getAllEmergencyContacts($entityManager);

        return $this->render('emergency_contact/index.html.twig', [
            'emergency_contacts' => $emergencyContacts,
        ]);
    }

    //admin add emergency contact
    /**
     * @Route("/admin/new", name="emergency_contact_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $emergencyContact = new EmergencyContact();
        $emergencyContactModel = new EmergencyContactModel();
        $form = $this->createForm(EmergencyContactType::class, $emergencyContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($emergencyContact);
            // $entityManager->flush();
            $emergencyContactModel->addEmergencyContact($emergencyContact, $entityManager);
            return $this->redirectToRoute('emergency_contact_index');
        }

        return $this->render('emergency_contact/new.html.twig', [
            'emergency_contact' => $emergencyContact,
            'form' => $form->createView(),
        ]);
    }

    //admin show emergenecy contact details
    /**
     * @Route("/admin/{id}", name="emergency_contact_show", methods={"GET"})
     */
    public function show(EmergencyContact $emergencyContact): Response
    {
        return $this->render('emergency_contact/show.html.twig', [
            'emergency_contact' => $emergencyContact,
        ]);
    }

    //admin edit emergency contact details
    /**
     * @Route("/admin/{id}/edit", name="emergency_contact_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EmergencyContact $emergencyContact): Response
    {
        $form = $this->createForm(EmergencyContactType::class, $emergencyContact);
        $form->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        $emergencyContactModel = new EmergencyContactModel();

        if ($form->isSubmitted() && $form->isValid()) {
            // $this->getDoctrine()->getManager()->flush();
            $emergencyContactModel->changeEmergencyContact($emergencyContact, $entityManager);
            return $this->redirectToRoute('emergency_contact_index');
        }

        return $this->render('emergency_contact/edit.html.twig', [
            'emergency_contact' => $emergencyContact,
            'form' => $form->createView(),
        ]);
    }

    //admin delete emergency contact
    /**
     * @Route("/admin/{id}", name="emergency_contact_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EmergencyContact $emergencyContact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emergencyContact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->remove($emergencyContact);
            // $entityManager->flush();
            $emergencyContactModel = new EmergencyContactModel();
            $emergencyContactModel->deleteEmergencyContact($emergencyContact, $entityManager);
        }

        return $this->redirectToRoute('emergency_contact_index');
    }

    //employee view personal emergency conacts
    /**
     * @Route("/emp/{empId}", name="emergency_contact_emp", methods={"GET"})
     */
    public function empEmergencyContacts($empId): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $empId = $user->getEmpId();
        $entityManager = $this->getDoctrine()->getManager();
        $emergencyContactModel = new EmergencyContactModel();
        $emergencyContacts = $emergencyContactModel->getEmpEmergencyContacts($empId,$entityManager);

        return $this->render('emergency_contact/emp.html.twig', [
            'emergency_contacts' => $emergencyContacts,
            'emp_id' =>$empId,
        ]);
    }
}
