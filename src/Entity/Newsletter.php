<?php

namespace App\Entity;

use App\Repository\NewsletterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
class Newsletter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255,unique:true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $submit_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubmitAt(): ?\DateTimeImmutable
    {
        return $this->submit_at;
    }

    public function setSubmitAt(\DateTimeImmutable $submit_at): self
    {
        $this->submit_at = $submit_at;

        return $this;
    }


}
