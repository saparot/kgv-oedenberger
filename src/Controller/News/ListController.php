<?php

namespace App\Controller\News;

use App\Entity\News;
use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use App\Repository\NewsRepository;
use DateTime;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    /**
     * @var KgvUrls
     */
    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_CLUB;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome(null, null);
    }

    function getPageTitle (): ?string {
        return 'Ankündigungen';
    }

    function getTemplate (): string {
        return 'news/list/index.html.twig';
    }

    /**
     * @Route("/news", name="newsList")
     * @param Request $request
     * @param NewsRepository $newsRepository
     *
     * @return Response
     */
    function index (Request $request, NewsRepository $newsRepository): Response {
        ;
        $newsForm = $this->getNewsForm();
        $newsForm->handleRequest($request);

        if ($newsForm->isSubmitted()) {
            return $this->save($newsForm);
        }
        $this->addNewsList($newsRepository);

        return $this->assign('newsForm', $newsForm->createView())->renderPageView();
    }

    private function getIntroData (): ?array {
        return [
            'title' => 'Ankündigungen',
            'icon' => 'fence',
            'text' => 'Auf dieser Seite finden Sie die aktuellen Ankündigungen rund um den Verein, die Anlage und Gärten, wie z. B. Termine für das An- und Abstellen des Wassers. Besuchen Sie diese Seite regelmäßig um keine Ankündigung zu verpassen!',
        ];
    }

    private function addNewsList (NewsRepository $newsRepository) {
        $this->assign('newsList', $newsRepository->findForNewsPage());
    }

    private function getNewsForm (): FormInterface {
        return $this->createFormBuilder()->add('title', TextType::class, ['label' => 'Überschrift', 'required' => false,])->add('news', CKEditorType::class, [
            'config' => ['toolbar' => 'full'],
            'label' => 'die Neuigkeit',
            'required' => true,
        ])->add('speichern', SubmitType::class)->getForm();
    }

    private function save (FormInterface $newsForm) {
        $data = $newsForm->getData();

        $news = (new News())->setTitle($data['title'])->setDescription($data['news'])->setTimeCreated(new DateTime())->setTimeUpdated(new DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($news);
        $em->flush();

        return $this->redirectToRoute('newsList');
    }
}
