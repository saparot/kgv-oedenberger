<?php

namespace App\Controller;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController {

    use  BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return null;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_MEMBERS;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addMembers('Login', $this->generateUrl('app_login'));
    }

    function getPageTitle (): ?string {
        return 'Login';
    }

    function getTemplate (): string {
        return 'security/login.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Vereinsmitglieder Login',
            'icon' => 'wheel-barrow-colored',
            'text' => 'Aktuell ist ein Login nur für den Vorstand möglich. Wir arbeiten daran hier für interessierte Vereinsmitglieder eine Möglichkeit für digitialen Datenaustausch zur Verfügung zu stellen, wie z.B. das Melden von Wasseruhrständen und Ähnlichem.',
        ];
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login (AuthenticationUtils $authenticationUtils): Response {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        $this->assign('last_username', $authenticationUtils->getLastUsername());
        $this->assign('error', $authenticationUtils->getLastAuthenticationError());

        return $this->renderPageView();
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout (): void {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
