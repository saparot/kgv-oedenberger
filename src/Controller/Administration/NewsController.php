<?php

namespace App\Controller\Administration;

use App\Entity\News;
use App\Form\NewsType;
use App\Helper\BreadCrumbsChain;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use App\Repository\NewsRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/news")
 */
class NewsController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): ?BreadCrumbsChain {
        return $this->addAdministration(null, null)->add('Neuigkeiten', $this->generateUrl('administrationNews'));
    }

    function getPageTitle (): ?string {
        return 'Administration Neuigkeiten';
    }

    function getTemplate (): string {
        return 'administration/news/index.html.twig';
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
    function index (NewsRepository $newsRepository): Response {
        $this->assign('news', $newsRepository->findForAdminPage());

        return $this->renderPageView();
    }

    /**
     * @Route("/new", name="administration_news_new", methods={"GET","POST"})
     */
    function new (Request $request): Response {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $news->setTimeCreated(new DateTime());
            $news->setTimeUpdated(new DateTime());
            $news->setTimePublish(new DateTime()); //Todo provide by form
            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('administrationNews');
        }

        return $this->render('administration/news/new.html.twig', [
            'news' => $news,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="administration_news_edit", methods={"GET","POST"})
     */
    function edit (Request $request, News $news): Response {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $news->setTimeUpdated(new DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($news);
            $entityManager->flush();

            $this->addFlash('success', 'Änderung erfolgreich gespeichert');

            return $this->redirectToRoute('administrationNews');
        }

        return $this->render('administration/news/edit.html.twig', [
            'news' => $news,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administration_news_delete", methods={"POST"})
     */
    function delete (Request $request, News $news): Response {
        if ($this->isCsrfTokenValid('delete' . $news->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($news);
            $entityManager->flush();
        }

        return $this->redirectToRoute('administrationNews');
    }
}
