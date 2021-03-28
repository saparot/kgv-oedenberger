<?php

namespace App\Controller;

use App\Form\ContactForm;
use App\Form\ExecutiveType;
use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome('Kontakt', null);
    }

    function getPageTitle (): ?string {
        return 'Kontakt';
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_ESSENTIALS;
    }

    function getTemplate (): string {
        return 'contact/index.html.twig';
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        $form = $this->createForm(ContactForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Ihre Anfrage wurde erfolgreich gesendet');

            return $this->redirectToRoute('landingPage');
        }
        $this->assign('form', $form->createView());

        return $this->renderPageView();
    }
}
