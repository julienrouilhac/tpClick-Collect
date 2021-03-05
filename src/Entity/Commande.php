<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource(
 *     denormalizationContext={"groups"={"commande"}},
 *      itemOperations={
 *         "get"={"security_post_denormalize"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)"},
 *         "put"={"security_post_denormalize"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)"},
 *         "delete"={"security_post_denormalize"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)"},
 *         "patch"={"security_post_denormalize"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)"},
 *     }
 * )
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @Groups({"commande"})
     * @ORM\ManyToOne(targetEntity=Magasin::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $magasin;

    /**
     * @Groups({"commande"})
     * @ORM\ManyToMany(targetEntity=Produit::class, inversedBy="commandes")
     */
    private $produit;

    /**
     * @Groups({"commande"})
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commande", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Groups({"commande"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reservation;


    public function __construct()
    {
        $this->produit = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        
        $this->magasin = $magasin;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        $this->produit->removeElement($produit);

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

    public function getReservation(): ?string
    {
        return $this->reservation;
    }

    public function setReservation(?string $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

}
