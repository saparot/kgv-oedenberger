<?php

namespace App\Controller\Administration;

use App\Entity\DownloadFile;
use App\Form\DownloadFileType;
use App\Helper\BreadCrumbsChain;
use App\Repository\DownloadFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/download/file")
 */
class DownloadFileController extends AbstractController {

    use \App\Mixin\LinkListMixin, \App\Mixin\BreadCrumbMixin, \App\Mixin\PageviewMixin;

    function getBreadCrumbChain (): ?BreadCrumbsChain {
        return $this->addAdministration(null, null)->add('Downloads', $this->generateUrl('administrationDownloads'));
    }

    function getPageTitle (): ?string {
        return 'Administration Downloads';
    }

    function getTemplate (): string {
        return 'administration/download_file/index.html.twig';
    }

    private function getIntroData (): ?array {
        return [
            'title' => 'Administration Ankündigungen',
            'icon' => 'flower-with-pot-colored',
            'text' => 'Hier können Ankündigungen anlegt, bearbeitet und gelöscht werden. Alle Ankündigungen erscheinen ohne den eigenen Klarnamen, so mit immer im Namen des Vorstandes. Es werden nur die letzten 20 Ankündigungen angezeigt, ältere aktuell noch nicht.',
        ];
    }

    /**
     * @Route("/", name="download_file_index", methods={"GET"})
     */
    public function index (DownloadFileRepository $downloadFileRepository): Response {
        return $this->render('administration/download_file/index.html.twig', [
            'download_files' => $downloadFileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="administrationDownloads", methods={"GET","POST"})
     */
    public function new (Request $request): Response {
        $downloadFile = new DownloadFile();
        $form = $this->createForm(DownloadFileType::class, $downloadFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($downloadFile);
            $entityManager->flush();

            return $this->redirectToRoute('download_file_index');
        }

        return $this->render('administration/download_file/new.html.twig', [
            'download_file' => $downloadFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="download_file_show", methods={"GET"})
     */
    public function show (DownloadFile $downloadFile): Response {
        return $this->render('administration/download_file/show.html.twig', [
            'download_file' => $downloadFile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="download_file_edit", methods={"GET","POST"})
     */
    public function edit (Request $request, DownloadFile $downloadFile): Response {
        $form = $this->createForm(DownloadFileType::class, $downloadFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('download_file_index');
        }

        return $this->render('administration/download_file/edit.html.twig', [
            'download_file' => $downloadFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="download_file_delete", methods={"POST"})
     */
    public function delete (Request $request, DownloadFile $downloadFile): Response {
        if ($this->isCsrfTokenValid('delete' . $downloadFile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($downloadFile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('download_file_index');
    }
}
