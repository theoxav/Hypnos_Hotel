<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SuiteRepository;
use App\Entity\Traits\Timestampable;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SuiteRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Suite
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: "please enter a name")]
    private $name;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: "please enter a description")]
    #[Assert\Length(min: 50)]
    private $description;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank(message: "please enter a price")]
    private $price;

    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    private $illustration;

    #[ORM\ManyToOne(targetEntity: Establishement::class, inversedBy: 'suites')]
    #[ORM\JoinColumn(nullable: false)]
    private $establishement;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'suites' )]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'suite', targetEntity: Booking::class)]
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
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

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setSuite($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getSuite() === $this) {
                $booking->setSuite(null);
            }
        }

        return $this;
    }
}
