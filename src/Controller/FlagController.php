<?php

namespace App\Controller;

use App\Entity\Flag;
use App\Form\FlagType;
use App\Repository\FlagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/flag")
 */
class FlagController extends AbstractController
{
    /**
     * @Route("/", name="app_flag_index", methods={"GET"})
     */
    public function index(FlagRepository $flagRepository): Response
    {
        return $this->render('flag/index.html.twig', [
            'flags' => $flagRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_flag_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FlagRepository $flagRepository): Response
    {
        $flag = new Flag();
        $form = $this->createForm(FlagType::class, $flag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flagRepository->add($flag, true);

            return $this->redirectToRoute('app_flag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('flag/new.html.twig', [
            'flag' => $flag,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_flag_show", methods={"GET"})
     */
    public function show(Flag $flag): Response
    {
        return $this->render('flag/show.html.twig', [
            'flag' => $flag,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_flag_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Flag $flag, FlagRepository $flagRepository): Response
    {
        $form = $this->createForm(FlagType::class, $flag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flagRepository->add($flag, true);

            return $this->redirectToRoute('app_flag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('flag/edit.html.twig', [
            'flag' => $flag,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_flag_delete", methods={"POST"})
     */
    public function delete(Request $request, Flag $flag, FlagRepository $flagRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flag->getId(), $request->request->get('_token'))) {
            $flagRepository->remove($flag, true);
        }

        return $this->redirectToRoute('app_flag_index', [], Response::HTTP_SEE_OTHER);
    }
}
