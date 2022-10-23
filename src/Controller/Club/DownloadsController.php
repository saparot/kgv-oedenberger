<?php

namespace App\Controller\Club;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use App\Repository\DownloadFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Handler\DownloadHandler;

class DownloadsController extends AbstractController {

    use  BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_CLUB;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addAboutUs(null, $this->generateUrl('clubDownloads'));
    }

    function getPageTitle (): ?string {
        return 'Downloads';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Downloads',
            'icon' => 'plant-pot',
            'text' => 'Hier finden Sie alle Dokumente, Anträge und Formulare rund um den Verein und Ihren Kleingarten. Vom Antrag für Solar bis zum Spendenformular ist hier alles zu finden. Wenn Sie etwas vermissen, lassen Sie uns gerne wissen, dann versuchen wir die entsprechende Information hier anzubieten.',
        ];
    }

    function getTemplate (): string {
        return 'club/downloads/index.twig';
    }

    /**
     * @Route("/verein/downloads", name="clubDownloads")
     * @param Request $request
     * @param DownloadFileRepository $downloadFileRepository
     * @param DownloadHandler $downloadHandler
     *
     * @return Response
     */
    function index (Request $request, DownloadFileRepository $downloadFileRepository, DownloadHandler $downloadHandler): Response {
        $downloads = $this->getDownloads($downloadFileRepository);
        $this->assign('downloads', $downloads);

        return $this->renderPageView();
    }

    /**
     * @Route("/verein/download/file/{id}", name="clubDownloadFile")
     * @param Request $request
     * @param DownloadFileRepository $downloadFileRepository
     * @param DownloadHandler $downloadHandler
     *
     * @return Response
     */
    function download (Request $request, DownloadFileRepository $downloadFileRepository, DownloadHandler $downloadHandler): Response {
        $downloadFile = $downloadFileRepository->findForDownload($request->get('id'));
        if (!$downloadFile) {
            throw new NotFoundHttpException('Die angeforderte Datei wurde nicht gefunden');
        }

        return $downloadHandler->downloadObject($downloadFile, $downloadFile->getFileObjectProperty(), null, $downloadFile->getDownloadFileName());
    }

    private function getDownloads (DownloadFileRepository $downloadFileRepository): array {
        $list = $downloadFileRepository->findAll();

        return $list;
    }
}
