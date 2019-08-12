<?php

namespace App\Controller;

use App\Entity\Instrument;
use App\Form\InstrumentType;
use App\Repository\InstrumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @Route("/instrument")
 */
class InstrumentController extends AbstractController
{
    /**
     * @Route("/", name="instrument_index", methods={"GET"})
     */
    public function index(InstrumentRepository $instrumentRepository): Response
    {
        return $this->render('instrument/index.html.twig', [
            'instruments' => $instrumentRepository->findAll(),
            'instrument' => "",
        ]);
    }
    /**
     * @Route("/index/{id}", name="instrument_index2", methods={"GET"})
     */
    public function index2(InstrumentRepository $instrumentRepository,Instrument $instrument): Response
    {
        return $this->render('instrument/index.html.twig', [
            'instruments' => $instrumentRepository->findAll(),
            'instrument' => $instrument,
        ]);
    }

    /**
     * @Route("/new", name="instrument_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $instrument = new Instrument();
        $form = $this->createForm(InstrumentType::class, $instrument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $instrument->getImage();
  
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $ext=$file->guessExtension();

            $cvDir = $file_name=time().".".$ext;
            $file->move("upload", $fileName);

            $instrument->setImage($fileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($instrument);
            $entityManager->flush();

            return $this->redirectToRoute('instrument_index');
        }

        return $this->render('instrument/new.html.twig', [
            'instrument' => $instrument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="instrument_show", methods={"GET"})
     */
    public function show(Instrument $instrument): Response
    {
        return $this->render('instrument/show.html.twig', [
            'instrument' => $instrument,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="instrument_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Instrument $instrument): Response
    {
        $fileNameBefore='upload/'.$instrument->getImage();
        $form = $this->createForm(InstrumentType::class, $instrument);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            unlink($fileNameBefore);
            $file = $instrument->getImage();
  
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $ext=$file->guessExtension();

            $cvDir = $file_name=time().".".$ext;
            $file->move("upload", $fileName);

            $instrument->setImage($fileName);
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('instrument_index');
        }

        return $this->render('instrument/edit.html.twig', [
            'instrument' => $instrument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="instrument_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Instrument $instrument): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instrument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            unlink('upload/'.$instrument->getImage());
            $entityManager->remove($instrument);
            $entityManager->flush();
        }

        return $this->redirectToRoute('instrument_index');
    }
}
