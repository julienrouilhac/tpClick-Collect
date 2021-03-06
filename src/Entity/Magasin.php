<?php

namespace App\Entity;

use App\Repository\MagasinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * @ApiResource(
 *     denormalizationContext={"groups"={"Magasin"}},
 *      itemOperations={
 *         "get",
 *         "put"={"security_post_denormalize"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)"},
 *         "delete"={"security_post_denormalize"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)"},
 *         "patch"={"security_post_denormalize"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)"},
 *     }
 * )
 * @ORM\Entity(repositoryClass=MagasinRepository::class)
 */



class Magasin
{
    /**
     * @Groups("Magasin")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups("Magasin")
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups("Magasin")
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * 
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="magasin", cascade={"remove"})
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="magasin")
     */
    private $commandes;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function __tostring(){
        return $this->name;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setMagasin($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getMagasin() === $this) {
                $produit->setMagasin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setMagasin($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getMagasin() === $this) {
                $commande->setMagasin(null);
            }
        }

        return $this;
    }
}
