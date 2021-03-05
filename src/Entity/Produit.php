<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
* @ApiResource(
*    denormalizationContext={"groups"={"produit"}},
 *      itemOperations={
 *         "get",
 *         "put"={"security_post_denormalize"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)"},
 *         "delete"={"security_post_denormalize"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)"},
 *         "patch"={"security_post_denormalize"="is_granted('ROLE_ADMIN') or (object.owner == user and previous_object.owner == user)"},
 *     }
 * )
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */



class Produit
{
    /**
     * 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     * @Groups({"produit"})
     * @Groups({"Magasin"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"produit"})
     * @Groups({"Magasin"})
     * @ORM\Column(type="integer")
     */
    private $stock;


    /**
     * @Groups({"produit"})
     * @ORM\ManyToOne(targetEntity=Magasin::class, inversedBy="produits", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $magasin;

    /**
     * @ORM\ManyToMany(targetEntity=Commande::class, mappedBy="produit", cascade={"remove"})
     */
    private $commandes;



    public function __construct()
    {
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

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function __tostring(){
        return $this->name;
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
            $commande->addProduit($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeProduit($this);
        }

        return $this;
    }



}
