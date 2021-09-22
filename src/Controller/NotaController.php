<?php

namespace App\Controller;

use App\Entity\Estudiante;
use App\Entity\Nota;
use App\Form\NotaType;
use App\Repository\NotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/nota')]
class NotaController extends AbstractController
{
    #[Route('/', name: 'nota_index', methods: ['GET'])]
    public function index(NotaRepository $notaRepository): Response
    {
       /*  $estudiante = New Estudiante;
        $nota= $notaRepository->findByEstudiante($estudiante);
        $suma = array_sum($nota);
        $total_numeros = 2;
        $nota_media =  $suma / $total_numeros; */
        return $this->render('nota/index.html.twig', [
            'notas' => $notaRepository->findAll(),
/*             "nota_media" => $nota_media
 */        ]);
    }

    

    #[Route('/new', name: 'nota_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $notum = new Nota();
        $form = $this->createForm(NotaType::class, $notum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($notum);
            $entityManager->flush();

            return $this->redirectToRoute('nota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nota/new.html.twig', [
            'notum' => $notum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'nota_show', methods: ['GET'])]
    public function show(Nota $notum): Response
    {
        return $this->render('nota/show.html.twig', [
            'notum' => $notum,
        ]);
    }

    #[Route('/{id}/edit', name: 'nota_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nota $notum): Response
    {
        $form = $this->createForm(NotaType::class, $notum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nota/edit.html.twig', [
            'notum' => $notum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'nota_delete', methods: ['POST'])]
    public function delete(Request $request, Nota $notum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$notum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($notum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nota_index', [], Response::HTTP_SEE_OTHER);
    }
}
