<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: UserRepository::class)]
#[Table(name: "cq_user")]
class User
{
    #[Id, Column(type: Types::INTEGER), GeneratedValue(strategy: "AUTO")]
    private ?int $id = null;

    #[Column(name: "first_name", length: 255)]
    private ?string $firstName = null;

    #[Column(name: "last_name", length: 255)]
    private ?string $lastName = null;

    #[Column(name: "date_of_birth", type: Types::DATE_MUTABLE)]
    private ?DateTime $dateOfBirth = null;

    #[OneToOne(targetEntity: Country::class)]
    #[JoinColumn(name: "id_country", referencedColumnName: "id", nullable: false, onDelete: "SET NULL")]
    private Country $country;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getDateOfBirth(): ?DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?DateTime $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function setCountry(Country $country): self
    {
        $this->country = $country;
        return $this;
    }


}
