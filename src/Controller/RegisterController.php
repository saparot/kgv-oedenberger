<?php

namespace App\Controller;

use App\Entity\User;
use App\Helper\BreadCrumbsChain;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController {

    use BreadCrumbMixin, PageviewMixin;

    public function __construct (private KgvUrls $kgvUrls, private ManagerRegistry $doctrine) {
    }

    public function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    public function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome('Impressum', null);
    }

    public function getPageTitle (): ?string {
        return 'Registrierung';
    }

    public function getTemplate (): string {
        return 'register/index.twig';
    }

    public function getIntroData (): ?array {
        return null;
    }

    /**
     * @Route("/register", name="register")
     */
    public function index (Request $request, UserPasswordHasherInterface $userPasswordEncoder): Response {
        return $this->redirectToRoute('landingPage'); //disallow registration
    }

    public function indexEnableWhenRequired (Request $request, UserPasswordHasherInterface $userPasswordEncoder): Response {
        $registerForm = $this->createFormBuilder()->add('userName', TextType::class, ['label' => 'Benutzername', 'required' => true,])->add('eMail', EmailType::class, [
            'label' => 'Ihre E-Mail-Adresse',
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
            $user->setUserName($data['userName'])->setPassword($userPasswordEncoder->hashPassword($user, $data['password']))->setEmail($data['eMail']);
            $em = $this->doctrine->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('landingPage');
        }

        return $this->assign('registerForm', $registerForm->createView())->renderPageView();
    }
}
