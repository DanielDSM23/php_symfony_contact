<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class ShowContactController extends AbstractController
{
    #[Route('/show/{id}', name: 'showContact')]
    public function index($id, ManagerRegistry $doctrine): Response
    {
        $contact = $doctrine ->getRepository(Contact::class)->find($id);
        return $this->render('show_contact/index.html.twig', [
            'contact' => $contact,
        ]);
    }
    #[Route('/delete/{id}', name: 'deleteContact')]
    public function delete($id, ManagerRegistry $doctrine): Response
    {
        $contact = $doctrine->getRepository(Contact::class)->find($id);
        $entityManager = $doctrine ->getManager();
        $entityManager->remove($contact);
        $entityManager->flush();
        return $this ->redirectToRoute('app_index');
    }
    #[Route('/new', name: 'newContact')]
    public function add(ManagerRegistry $doctrine, Request $request) 
    {
        //$this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager= $doctrine->getManager();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();
            return $this->redirectToRoute('app_index');
        }

        return $this->renderForm('contact/form-add.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/edit/{id}', name: 'editContact')]
    public function edit(ManagerRegistry $doctrine,Request $request,$id)
    {
        $entityManager= $doctrine->getManager();
        $contact = $doctrine->getRepository(Contact::class)->find($id);

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }
        return $this->renderForm('contact/form-edit.html.twig', [
            'form' => $form,
        ]);
    }
}
