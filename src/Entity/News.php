<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 */
class News {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeCreated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timeUpdated;

    /**
     * @ORM\Column(type="date")
     */
    private $timePublish;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    function getId (): ?int {
        return $this->id;
    }

    function getTitle (): ?string {
        return $this->title;
    }

    function setTitle (string $title): self {
        $this->title = $title;

        return $this;
    }

    function getDescription (): ?string {
        return $this->description;
    }

    function setDescription (string $description): self {
        $this->description = $description;

        return $this;
    }

    function getTimeCreated (): ?\DateTimeInterface {
        return $this->timeCreated;
    }

    function setTimeCreated (\DateTimeInterface $timeCreated): self {
        $this->timeCreated = $timeCreated;

        return $this;
    }

    function getTimeUpdated (): ?\DateTimeInterface {
        return $this->timeUpdated;
    }

    function setTimeUpdated (\DateTimeInterface $timeUpdated): self {
        $this->timeUpdated = $timeUpdated;

        return $this;
    }

    function getTimePublish (): ?\DateTimeInterface {
        return $this->timePublish;
    }

    function setTimePublish (\DateTimeInterface $timePublish): self {
        $this->timePublish = $timePublish;

        return $this;
    }

    function getIsPublished (): ?bool {
        return $this->isPublished;
    }

    function setIsPublished (bool $isPublished): self {
        $this->isPublished = $isPublished;

        return $this;
    }
}
