<?php

namespace App\Controller;

use App\Form\ContactForm;
use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

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
        return 'contact/index.twig';
    }

    function getIntroData (): ?array {
        return null;
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param MailerInterface $mailer
     *
     * @return Response
     */
    function index (Request $request, MailerInterface $mailer): Response {
        $form = $this->createForm(ContactForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->send($form, $mailer);
            $this->addFlash('success', 'Ihre Anfrage wurde erfolgreich gesendet!');

            return $this->redirectToRoute('landingPage');
        }
        $this->assign('form', $form->createView());

        return $this->renderPageView();
    }

    private function send (FormInterface $form, MailerInterface $mailer) {
        $mailer->send($this->generateEmail($form));
    }

    private function generateEmail (FormInterface $form): Email {
        return (new Email())->from($this->getFrom())->to($this->getTo())->subject($this->getSubject($form))->text($this->getBody($form))->addReplyTo($this->getEmail($form));
    }

    /**
     * @return string
     * @throws Exception
     */
    private function getTo (): string {
        return $_ENV['CONTACT_FORM_TO'] ?? $this->throw("CONTACT_FORM_TO env value is not defined");
    }

    /**
     * @return string
     * @throws Exception
     */
    private function getFrom (): string {
        return $_ENV['CONTACT_FORM_FROM'] ?? $this->throw("CONTACT_FORM_FROM env value is not defined");
    }

    /**
     * @param string $error
     *
     * @throws Exception
     */
    private function throw (string $error) {
        throw new Exception("unable to {$error}");
    }

    private function getEmail (FormInterface $form): string {
        return $form->get('email')->getData();
    }

    private function getSubject (FormInterface $form): string {
        return 'Anfrage: Test';
    }

    private function getBody (FormInterface $form): string {
        return sprintf("%s hat eine Frage neue Anfrage gestellt:\n\n%s", $form->get('name')->getData(), $form->get('request')->getData());
    }
}
