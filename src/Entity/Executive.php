<?php

namespace App\Entity;

use App\Repository\ExecutiveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExecutiveRepository::class)
 */
class Executive {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $position;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $sort;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $phone;

    function getId (): ?int {
        return $this->id;
    }

    function getName (): ?string {
        return $this->name;
    }

    function setName (?string $name): self {
        $this->name = $name;

        return $this;
    }

    function getPosition (): ?string {
        return $this->position;
    }

    function setPosition (string $position): self {
        $this->position = $position;

        return $this;
    }

    function getSort (): ?int {
        return $this->sort;
    }

    function setSort (int $sort): self {
        $this->sort = $sort;

        return $this;
    }

    function getEmail (): ?string {
        return $this->email;
    }

    function setEmail (?string $email): self {
        $this->email = $email;

        return $this;
    }

    function getPhone (): ?string {
        return $this->phone;
    }

    function setPhone (?string $phone): self {
        $this->phone = $phone;

        return $this;
    }
}
