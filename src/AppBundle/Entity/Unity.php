<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Unity
 *
 * @ORM\Table(name="unity")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UnityRepository")
 */
class Unity
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
     * @ORM\Column(name="unity", type="string", length=45)
     */
    private $unity;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\IngredientRecipe", mappedBy="unity")
     */
    private $ingredients;

    /**
     * Unity constructor.
     * @param $ingredients
     */
    public function __construct($ingredients)
    {
        $this->ingredients = new ArrayCollection();
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
     * Set unity
     *
     * @param string $unity
     *
     * @return Unity
     */
    public function setUnity($unity)
    {
        $this->unity = $unity;

        return $this;
    }

    /**
     * Get unity
     *
     * @return string
     */
    public function getUnity()
    {
        return $this->unity;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients->toArray();
    }

    /**
     * @param mixed $ingredients
     * @return Unity
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

}

