<?php

namespace App\Controller\News;

use App\Entity\News;
use App\Entity\User;
use App\Helper\BreadCrumbsChain;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use DateTime;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class ListController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

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
     *
     * @return Response
     */
    function index (Request $request): Response {
        $newsForm = $this->createFormBuilder()->add('title', TextType::class, ['label' => 'Überschrift', 'required' => false,])->add('news', CKEditorType::class, [
            'config' => ['toolbar' => 'full'],
            'label' => 'die Neuigkeit',
            'required' => true,
        ])->add('speichern', SubmitType::class)->getForm();

        $newsForm->handleRequest($request);

        if ($newsForm->isSubmitted()) {
            $data = $newsForm->getData();

            $news = (new News())->setTitle($data['title'])->setDescription($data['news'])->setTimeCreated(new DateTime())->setTimeUpdated(new DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('newsList');
        }

        return $this->assign('newsForm', $newsForm->createView())->renderPageView();

        return $this->renderPageView();
    }
}
