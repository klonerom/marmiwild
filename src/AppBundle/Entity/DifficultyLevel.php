<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * DifficultyLevel
 *
 * @ORM\Table(name="difficulty_level")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DifficultyLevelRepository")
 */
class DifficultyLevel
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
     * @ORM\Column(name="level", type="string", length=45)
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Recipe", mappedBy="difficultyLevel")
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
     * Set level
     *
     * @param string $level
     *
     * @return DifficultyLevel
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
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
     * @return DifficultyLevel
     */
    public function setRecipes($recipes)
    {
        $this->recipes = $recipes;

        return $this;
    }


}

