<?php

namespace App\Controller;

use App\Entity\User;
use App\Helper\BreadCrumbsChain;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return null;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome('Impressum', null);
    }

    function getPageTitle (): ?string {
        return 'Registrierung';
    }

    function getTemplate (): string {
        return 'register/index.html.twig';
    }

    function getIntroData (): ?array {
        return null;
    }

    /**
     * @Route("/register", name="register")
     */
    function index (Request $request, UserPasswordEncoderInterface $userPasswordEncoder): Response {
        $registerForm = $this->createFormBuilder()->add('userName', TextType::class, ['label' => 'Benutzername', 'required' => true,])->add('eMail', EmailType::class, [
            'label' => 'E-Mail-Adresse',
            'required' => true,
        ])->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => true,
            'first_options' => ['label' => 'Passwort'],
            'second_options' => ['label' => 'Passwort wiederholen'],
        ])->add('registrieren', SubmitType::class)->getForm();

        $registerForm->handleRequest($request);

        if ($registerForm->isSubmitted()) {
            $data = $registerForm->getData();

            $user = new User();
            $user->setUserName($data['userName'])->setPassword($userPasswordEncoder->encodePassword($user, $data['password']))->setEmail($data['eMail']);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('landingPage');
        }

        return $this->assign('registerForm', $registerForm->createView())->renderPageView();
    }
}
