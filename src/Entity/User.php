<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $userName;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $email;

    function __construct () {
    }

    function getId (): ?int {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    function getUsername (): string {
        return (string) $this->userName;
    }

    function setUserName (string $userName): self {
        $this->userName = $userName;

        return $this;
    }

    /**
     * @see UserInterface
     */
    function getRoles (): array {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    function setRoles (array $roles): self {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    function getPassword (): string {
        return (string) $this->password;
    }

    function setPassword (string $password): self {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    function getSalt (): ?string {
        return null;
    }

    /**
     * @see UserInterface
     */
    function eraseCredentials () {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    function getEmail (): ?string {
        return $this->email;
    }

    function setEmail (string $email): self {
        $this->email = $email;

        return $this;
    }
}
