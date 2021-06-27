<?php

namespace App\Controller\Administration;

use App\Entity\DownloadFile;
use App\Form\DownloadFileUploadFormType;
use App\Helper\BreadCrumbsChain;
use App\Mixin\LinkListMixin;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use App\Repository\DownloadFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/download/file")
 */
class DownloadFileController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): ?BreadCrumbsChain {
        return $this->addAdministration(null, null)->add('Downloads', $this->generateUrl('administrationDownloads'));
    }

    function getPageTitle (): ?string {
        return 'Administration Downloads';
    }

    function getTemplate (): string {
        return 'administration/download_file/index.html.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Administration Downloads',
            'icon' => 'flower-with-pot-colored',
            'text' => 'Hier können Dateien hochgeladen und gelöscht werden, die zum Download angeboten werden sollen. ',
        ];
    }

    /**
     * @Route("/", name="administrationDownloads", methods={"GET"})
     */
    public function index (DownloadFileRepository $downloadFileRepository): Response {
        $this->assign('downloadFiles', $downloadFileRepository->findAll());

        return $this->renderPageView();
    }

    /**
     * @Route("/new", name="download_file_new", methods={"GET","POST"})
     */
    public function new (Request $request): Response {
        $downloadFile = new DownloadFile();
        $form = $this->createForm(DownloadFileUploadFormType::class, $downloadFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($downloadFile);
            $entityManager->flush();

            return $this->redirectToRoute('administrationDownloads');
        }

        return $this->render('administration/download_file/new.html.twig', [
            'download_file' => $downloadFile,
            'form' => $form->createView(),
        ]);
    }

    ///**
    // * @Route("/{id}", name="download_file_show", methods={"GET"})
    // */
    //public function show (DownloadFile $downloadFile): Response {
    //    return $this->render('administration/download_file/show.html.twig', [
    //        'download_file' => $downloadFile,
    //    ]);
    //}

    /**
     * @Route("/{id}/edit", name="download_file_edit", methods={"GET","POST"})
     */
    public function edit (Request $request, DownloadFile $downloadFile): Response {
        $form = $this->createForm(DownloadFileUploadFormType::class, $downloadFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('administrationDownloads');
        }

        return $this->render('administration/download_file/edit.twig', [
            'download_file' => $downloadFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="download_file_delete", methods={"GET","POST"})
     */
    public function delete (Request $request, DownloadFile $downloadFile): Response {
        //$entityManager = $this->getDoctrine()->getManager();
        //$entityManager->remove($downloadFile);
        //$entityManager->flush();

        return $this->redirectToRoute('administrationDownloads');
    }
}
