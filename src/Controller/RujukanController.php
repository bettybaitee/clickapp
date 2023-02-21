<?php

namespace App\Controller;

use App\Entity\Rujukan;
use App\Form\RujukanType;
use App\Repository\RujukanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rujukan")
 */
class RujukanController extends AbstractController
{
    /**
     * @Route("/", name="app_rujukan_index", methods={"GET"})
     */
    public function index(RujukanRepository $rujukanRepository): Response
    {
        return $this->render('rujukan/index.html.twig', [
            'rujukans' => $rujukanRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_rujukan_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RujukanRepository $rujukanRepository): Response
    {
        $rujukan = new Rujukan();
        $form = $this->createForm(RujukanType::class, $rujukan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rujukanRepository->add($rujukan, true);

            return $this->redirectToRoute('app_rujukan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rujukan/new.html.twig', [
            'rujukan' => $rujukan,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_rujukan_show", methods={"GET"})
     */
    public function show(Rujukan $rujukan): Response
    {
        return $this->render('rujukan/show.html.twig', [
            'rujukan' => $rujukan,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_rujukan_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Rujukan $rujukan, RujukanRepository $rujukanRepository): Response
    {
        $form = $this->createForm(RujukanType::class, $rujukan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rujukanRepository->add($rujukan, true);

            return $this->redirectToRoute('app_rujukan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rujukan/edit.html.twig', [
            'rujukan' => $rujukan,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_rujukan_delete", methods={"POST"})
     */
    public function delete(Request $request, Rujukan $rujukan, RujukanRepository $rujukanRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rujukan->getId(), $request->request->get('_token'))) {
            $rujukanRepository->remove($rujukan, true);
        }

        return $this->redirectToRoute('app_rujukan_index', [], Response::HTTP_SEE_OTHER);
    }
}
