<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table(name="recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeRepository")
 */
class Recipe
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="preparationTime", type="integer")
     */
    private $preparationTime;

    /**
     * @var int
     *
     * @ORM\Column(name="cookTime", type="integer")
     */
    private $cookTime;

    /**
     * @var int
     *
     * @ORM\Column(name="serving", type="integer")
     */
    private $serving;

    /**
     * Many recipes to one difficultyLevel
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DifficultyLevel", inversedBy="recipes")
     * @ORM\JoinColumn(name="difficultyLevel_id", referencedColumnName="id")
     */
    private $difficultyLevel;

    /**
     * Many recipes to one cost
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cost", inversedBy="recipes")
     * @ORM\JoinColumn(name="cost_id", referencedColumnName="id")
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\IngredientRecipe", mappedBy="recipe", cascade={"persist", "remove"})
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CategorieRecipe", mappedBy="recipe", cascade={"persist", "remove"})
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Upload", mappedBy="recipe", cascade={"persist", "remove"})
     */
    private $uploads;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bestSeller", type="boolean")
     */
    private $bestSeller;

    /**
     * Recipe constructor.
     */
    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->uploads = new ArrayCollection();
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Recipe
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set preparationTime
     *
     * @param integer $preparationTime
     *
     * @return Recipe
     */
    public function setPreparationTime($preparationTime)
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    /**
     * Get preparationTime
     *
     * @return int
     */
    public function getPreparationTime()
    {
        return $this->preparationTime;
    }

    /**
     * Set cookTime
     *
     * @param integer $cookTime
     *
     * @return Recipe
     */
    public function setCookTime($cookTime)
    {
        $this->cookTime = $cookTime;

        return $this;
    }

    /**
     * Get cookTime
     *
     * @return int
     */
    public function getCookTime()
    {
        return $this->cookTime;
    }

    /**
     * Set serving
     *
     * @param integer $serving
     *
     * @return Recipe
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
     * Set difficultyLevel
     *
     * @param integer $difficultyLevel
     *
     * @return Recipe
     */
    public function setDifficultyLevel($difficultyLevel)
    {
        $this->difficultyLevel = $difficultyLevel;

        return $this;
    }

    /**
     * Get difficultyLevel
     *
     * @return string
     */
    public function getDifficultyLevel()
    {
        return $this->difficultyLevel;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return Recipe
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
     * Set description
     *
     * @param string $description
     *
     * @return Recipe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * @return int
     */
    public function getIngredients()
    {
        return $this->ingredients->toArray();
    }

    /**
     * @param int $ingredients
     * @return Recipe
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories->toArray();
    }

    /**
     * @param mixed $categories
     * @return Recipe
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUploads()
    {
        return $this->uploads->toArray();
    }

    /**
     * @param mixed $uploads
     * @return Recipe
     */
    public function setUploads($uploads)
    {
        $this->uploads = $uploads;

        return $this;
    }

    /**
     * @return bool
     */
    public function isBestSeller()
    {
        return $this->bestSeller;
    }

    /**
     * @param bool $bestSeller
     * @return Recipe
     */
    public function setBestSeller($bestSeller)
    {
        $this->bestSeller = $bestSeller;

        return $this;
    }



}


