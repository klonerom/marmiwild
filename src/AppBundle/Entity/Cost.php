<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cost
 *
 * @ORM\Table(name="cost")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CostRepository")
 */
class Cost
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="string", length=45)
     */
    private $cost;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Recipe", mappedBy="cost")
     */
    private $recipes;

    /**
     * DifficultyLevel constructor.
     */
    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return Cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @return mixed
     */
    public function getRecipes()
    {
        return $this->recipes->toArray();
    }

    /**
     * @param mixed $recipes
     * @return Cost
     */
    public function setRecipes($recipes)
    {
        $this->recipes = $recipes;

        return $this;
    }


}

