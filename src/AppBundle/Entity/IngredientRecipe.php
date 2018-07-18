<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * IngredientRecipe
 *
 * @ORM\Table(name="ingredient_recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IngredientRecipeRepository")
 */
class IngredientRecipe
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
     * @ORM\Column(name="quantity", type="decimal", precision=4, scale=2)
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="serving", type="integer")
     */
    private $serving;

    /**
     * Many ingredients to one recipe
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Recipe", inversedBy="ingredients")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     */
    private $recipe;


    /**
     * Many recipes to one ingredient
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ingredient", inversedBy="ingredients")
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")
     */
    private $ingredient;

    /**
     * Many unity to one ingredient
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unity", inversedBy="ingredients")
     * @ORM\JoinColumn(name="unity_id", referencedColumnName="id")
     */
    private $unity;



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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return IngredientRecipe
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set serving
     *
     * @param integer $serving
     *
     * @return IngredientRecipe
     */
    public function setServing($serving)
    {
        $this->serving = $serving;

        return $this;
    }

    /**
     * Get serving
     *
     * @return int
     */
    public function getServing()
    {
        return $this->serving;
    }

    /**
     * @return mixed
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * @param mixed $recipe
     * @return IngredientRecipe
     */
    public function setRecipe($recipe)
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * @return int
     */
    public function getUnity()
    {
        return $this->unity;
    }

    /**
     * @param int $unity
     * @return IngredientRecipe
     */
    public function setUnity($unity)
    {
        $this->unity = $unity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * @param mixed $ingredient
     * @return IngredientRecipe
     */
    public function setIngredient($ingredient)
    {
        $this->ingredient = $ingredient;

        return $this;
    }

}

