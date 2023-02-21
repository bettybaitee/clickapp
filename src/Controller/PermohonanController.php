<?php

namespace App\Controller;

use App\Entity\Permohonan;
use App\Entity\Rujukan;
use App\Form\PermohonanType;
use App\Repository\PermohonanRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/permohonan")
 */
class PermohonanController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    /**
     * @Route("/", name="app_permohonan_index", methods={"GET"})
     */
    public function index(PermohonanRepository $permohonanRepository): Response
    {
        return $this->render('permohonan/index.html.twig', [
            'permohonans' => $permohonanRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_permohonan_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PermohonanRepository $permohonanRepository): Response
    {
        $data_ruj = $this->doctrine->getRepository(Rujukan::class)->findOneBy(['flag' => '1', 'id' => '1']);

        $permohonan = new Permohonan();
        $permohonan->setSor($data_ruj->getTemplate());
        $form = $this->createForm(PermohonanType::class, $permohonan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $permohonanRepository->add($permohonan, true);

            return $this->redirectToRoute('app_permohonan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('permohonan/new.html.twig', [
            'permohonan' => $permohonan,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_permohonan_show", methods={"GET"})
     */
    public function show(Permohonan $permohonan): Response
    {
        return $this->render('permohonan/show.html.twig', [
            'permohonan' => $permohonan,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_permohonan_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Permohonan $permohonan, PermohonanRepository $permohonanRepository): Response
    {
        $form = $this->createForm(PermohonanType::class, $permohonan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $permohonanRepository->add($permohonan, true);

            return $this->redirectToRoute('app_permohonan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('permohonan/edit.html.twig', [
            'permohonan' => $permohonan,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_permohonan_delete", methods={"POST"})
     */
    public function delete(Request $request, Permohonan $permohonan, PermohonanRepository $permohonanRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$permohonan->getId(), $request->request->get('_token'))) {
            $permohonanRepository->remove($permohonan, true);
        }

        return $this->redirectToRoute('app_permohonan_index', [], Response::HTTP_SEE_OTHER);
    }
}
