<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Establishement::class, inversedBy: 'bookings')]
    private $establishement;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bookings')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Suite::class, inversedBy: 'bookings')]
    private $suite;

    #[ORM\Column(type: 'date')]
    #[Assert\Type("DateTimeInterface")]
    private $start;

    #[ORM\Column(type: 'date')]
    #[Assert\Type("DateTimeInterface")]
    #[Assert\GreaterThanOrEqual(propertyPath: 'start')]
    private $end;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstablishement(): ?Establishement
    {
        return $this->establishement;
    }

    public function setEstablishement(?Establishement $establishement): self
    {
        $this->establishement = $establishement;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSuite(): ?Suite
    {
        return $this->suite;
    }

    public function setSuite(?Suite $suite): self
    {
        $this->suite = $suite;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(?\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function __toString()
    {
        return $this->getSuite()->getName();
    }
}
