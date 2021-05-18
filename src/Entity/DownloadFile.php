<?php

namespace App\Entity;

use App\Repository\DownloadFileRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=DownloadFileRepository::class)
 * @Vich\Uploadable
 */
class DownloadFile {

    private const FILE_OBJECT_PROPERTY = 'fileObject';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $fileName = null;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Vich\UploadableField(mapping="downloads", fileNameProperty="fileName")
     *
     * @var File|null
     */
    private ?File $fileObject = null;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTimeInterface|null
     */
    private ?\DateTimeInterface $timeUpdated;

    function getFileObjectProperty (): string {
        return self::FILE_OBJECT_PROPERTY;
    }

    function getDownloadFileName (): string {
        $name = preg_replace('/[^a-z0-9A-Z]/', ' ', $this->getName());
        $name = preg_replace('/\s+/', ' ', $name);
        $name = mb_strtolower(preg_replace('/ /', '-', $name));
        $tmp = explode('.', $this->getFileName());
        $fileEnding = array_pop($tmp);

        return sprintf("%s.%s", $name, $fileEnding);
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $fileObject
     */
    function setFileObject (?File $fileObject = null): void {
        $this->fileObject = $fileObject;

        if (null !== $fileObject) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->timeUpdated = new DateTime();
        }
    }

    function getFileObject (): ?File {
        return $this->fileObject;
    }

    public function getId (): ?int {
        return $this->id;
    }

    public function getName (): ?string {
        return $this->name;
    }

    public function setName (string $name): self {
        $this->name = $name;

        return $this;
    }

    public function getDescription (): ?string {
        return $this->description;
    }

    public function setDescription (?string $description): self {
        $this->description = $description;

        return $this;
    }

    public function getFileName (): ?string {
        return $this->fileName;
    }

    public function setFileName (?string $fileName = null): self {
        $this->fileName = $fileName;

        return $this;
    }

    public function getTimeUpdated (): ?\DateTimeInterface {
        return $this->timeUpdated;
    }

    public function setTimeUpdated (\DateTimeInterface $timeUpdated): self {
        $this->timeUpdated = $timeUpdated;

        return $this;
    }
}
