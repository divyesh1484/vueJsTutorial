<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $BirthDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $technology = null;

    #[ORM\Column(length: 255)]
    private ?string $gender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profile_link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profile_pic = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(\DateTimeInterface $BirthDate): static
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }

    public function getTechnology(): ?string
    {
        return $this->technology;
    }

    public function setTechnology(?string $technology): static
    {
        $this->technology = $technology;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getEmailId(): ?string
    {
        return $this->email_id;
    }

    public function setEmailId(?string $email_id): static
    {
        $this->email_id = $email_id;

        return $this;
    }

    public function getProfileLink(): ?string
    {
        return $this->profile_link;
    }

    public function setProfileLink(?string $profile_link): static
    {
        $this->profile_link = $profile_link;

        return $this;
    }

    public function getProfilePic(): ?string
    {
        return $this->profile_pic;
    }

    public function setProfilePic(?string $profile_pic): self
    {
        $this->profile_pic = $profile_pic;

        return $this;
    }
}
