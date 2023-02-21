<?php

namespace App\Controller;

use App\Entity\Rekod;
use App\Form\RekodType;

use App\Repository\RekodRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rekod")
 */
class RekodController extends AbstractController
{
    /**
     * @Route("/", name="app_rekod_index", methods={"GET"})
     */
    public function index(RekodRepository $rekodRepository): Response
    {
        return $this->render('rekod/index.html.twig', [
            'rekods' => $rekodRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_rekod_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RekodRepository $rekodRepository): Response
    {
        $rekod = new Rekod();
        $form = $this->createForm(RekodType::class, $rekod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rekodRepository->add($rekod, true);

            return $this->redirectToRoute('app_rekod_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rekod/new.html.twig', [
            'rekod' => $rekod,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/cemerlang", name="app_rekod_cemerlang", methods={"GET", "POST"})
     */
    public function cemerlang(Request $request, RekodRepository $rekodRepository): Response
    {
        $key = 'Cemerlang';
        $rekod = new Rekod();
        $rekod->setNama($key);
        $rekod->setCreatedAt(new \DateTimeImmutable('now'));
        $form = $this->createForm(RekodType::class, $rekod);
        $form->handleRequest($request);

        if ($this->isCsrfTokenValid('Cemerlang', $request->request->get('_token'))) {

            $rekodRepository->add($rekod, true);

            $this->addFlash('success','Terima kasih');
            return $this->redirectToRoute('homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'rekod' => $rekod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/baik", name="app_rekod_baik", methods={"GET", "POST"})
     */
    public function baik(Request $request, RekodRepository $rekodRepository): Response
    {
        $key = 'Baik';
        $rekod = new Rekod();
        $rekod->setNama($key);
        $rekod->setCreatedAt(new \DateTimeImmutable('now'));
        $form = $this->createForm(RekodType::class, $rekod);
        $form->handleRequest($request);

        if ($this->isCsrfTokenValid('Baik', $request->request->get('_token'))) {

            $rekodRepository->add($rekod, true);

            $this->addFlash('success','Terima kasih');
            return $this->redirectToRoute('homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'rekod' => $rekod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tidak", name="app_rekod_tidak", methods={"GET", "POST"})
     */
    public function tidak(Request $request, RekodRepository $rekodRepository): Response
    {
        $key = 'Tidak';
        $rekod = new Rekod();
        $rekod->setNama($key);
        $rekod->setCreatedAt(new \DateTimeImmutable('now'));
        $form = $this->createForm(RekodType::class, $rekod);
        $form->handleRequest($request);

        if ($this->isCsrfTokenValid('Tidak', $request->request->get('_token'))) {

            $rekodRepository->add($rekod, true);

            $this->addFlash('success','Terima kasih');
            return $this->redirectToRoute('homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'rekod' => $rekod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_rekod_show", methods={"GET"})
     */
    public function show(Rekod $rekod): Response
    {
        return $this->render('rekod/show.html.twig', [
            'rekod' => $rekod,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_rekod_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Rekod $rekod, RekodRepository $rekodRepository): Response
    {
        $form = $this->createForm(RekodType::class, $rekod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rekodRepository->add($rekod, true);

            return $this->redirectToRoute('app_rekod_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rekod/edit.html.twig', [
            'rekod' => $rekod,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_rekod_delete", methods={"POST"})
     */
    public function delete(Request $request, Rekod $rekod, RekodRepository $rekodRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rekod->getId(), $request->request->get('_token'))) {
            $rekodRepository->remove($rekod, true);
        }

        return $this->redirectToRoute('app_rekod_index', [], Response::HTTP_SEE_OTHER);
    }
}
