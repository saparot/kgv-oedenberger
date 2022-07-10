<?php

namespace App\Controller\Administration;

use App\Entity\News;
use App\Form\NewsType;
use App\Helper\BreadCrumbsChain;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use App\Repository\NewsRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/news")
 */
class NewsController extends AbstractController {

    use BreadCrumbMixin, PageviewMixin;

    public function __construct (private KgvUrls $kgvUrls, private ManagerRegistry $doctrine) {
    }

    public function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    public function getBreadCrumbChain (): ?BreadCrumbsChain {
        return $this->addAdministration(null, null)->add('Neuigkeiten', $this->generateUrl('administrationNews'));
    }

    public function getPageTitle (): ?string {
        return 'Administration Neuigkeiten';
    }

    public function getTemplate (): string {
        return 'administration/news/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Administration Neuigkeiten',
            'icon' => 'flower-with-pot-colored',
            'text' => 'Hier können Neuigkeiten anlegt, bearbeitet und gelöscht werden. Alle Neuigkeiten erscheinen ohne den eigenen Klarnamen, somit immer im Namen des Vorstandes. Es werden nur die letzten 20 Neuigkeiten angezeigt, ältere aktuell noch nicht.',
        ];
    }

    /**
     * @Route("/", name="administrationNews", methods={"GET"})
     */
    public function index (NewsRepository $newsRepository): Response {
        $this->assign('news', $newsRepository->findForAdminPage());

        return $this->renderPageView();
    }

    /**
     * @Route("/new", name="administration_news_new", methods={"GET","POST"})
     */
    public function new (Request $request): Response {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->doctrine->getManager();
            $news->setTimeCreated(new DateTime());
            $news->setTimeUpdated(new DateTime());
            $news->setTimePublish(new DateTime()); //Todo provide by form
            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('administrationNews');
        }

        return $this->render('administration/news/new.twig', [
            'news' => $news,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="administration_news_edit", methods={"GET","POST"})
     */
    public function edit (Request $request, News $news): Response {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->doctrine->getManager()->flush();
            $news->setTimeUpdated(new DateTime());
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($news);
            $entityManager->flush();

            $this->addFlash('success', 'Änderung erfolgreich gespeichert');

            return $this->redirectToRoute('administrationNews');
        }

        return $this->render('administration/news/edit.twig', [
            'news' => $news,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administration_news_delete", methods={"POST"})
     */
    public function delete (Request $request, News $news): Response {
        if ($this->isCsrfTokenValid('delete' . $news->getId(), $request->request->get('_token'))) {
            $entityManager = $this->doctrine->getManager();
            $entityManager->remove($news);
            $entityManager->flush();
        }

        return $this->redirectToRoute('administrationNews');
    }
}
