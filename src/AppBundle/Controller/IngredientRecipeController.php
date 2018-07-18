<?php

namespace AppBundle\Controller;

use AppBundle\Entity\IngredientRecipe;
use AppBundle\Entity\Recipe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ingredientrecipe controller.
 *
 * @Route("ingredients-recipe")
 */
class IngredientRecipeController extends Controller
{
    /**
     * Lists all ingredientRecipe entities.
     *
     * @Route("/recipe/{recipe_id}", name="ingredients-recipe_index", requirements={"recipe_id"="\d+"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"}))
     * @Method("GET")
     */
    public function indexAction(Recipe $recipe)
    {
        $em = $this->getDoctrine()->getManager();

        $ingredientRecipes = $em->getRepository('AppBundle:IngredientRecipe')->findBy(
            ['recipe' => $recipe]
        );

        return $this->render('ingredientrecipe/index.html.twig', array(
            'ingredientRecipes' => $ingredientRecipes,
            'recipe' => $recipe,
        ));
    }

    /**
     * Creates a new ingredientRecipe entity.
     *
     * @Route("/recipe/{recipe_id}/new", name="ingredients-recipe_new", requirements={"recipe_id"="\d+"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"})
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Recipe $recipe)
    {
        $ingredientRecipe = new IngredientRecipe();
        $form = $this->createForm('AppBundle\Form\IngredientRecipeType', $ingredientRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ingredientRecipe->setRecipe($recipe);

            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredientRecipe);
            $em->flush();

            $this->addFlash('success', 'Ingrédient ajouté');

            return $this->redirectToRoute('ingredients-recipe_index', [
                'recipe_id' => $recipe->getId()
            ]);
        }

        return $this->render('ingredientrecipe/new.html.twig', array(
            'ingredientRecipe' => $ingredientRecipe,
            'recipe' => $recipe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ingredientRecipe entity.
     *
     * @Route("/recipe/{recipe_id}/show/{id}", name="ingredients-recipe_show", requirements={"recipe_id"="\d+"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"}))
     * @Method("GET")
     */
    public function showAction(IngredientRecipe $ingredientRecipe, Recipe $recipe)
    {

        return $this->render('ingredientrecipe/show.html.twig', array(
            'ingredientRecipe' => $ingredientRecipe,
            'recipe' => $recipe,
        ));
    }

    /**
     * Displays a form to edit an existing ingredientRecipe entity.
     *
     * @Route("/recipe/{recipe_id}/edit/{id}", name="ingredients-recipe_edit", requirements={"recipe_id"="\d+"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, IngredientRecipe $ingredientRecipe, Recipe $recipe)
    {
        $editForm = $this->createForm('AppBundle\Form\IngredientRecipeType', $ingredientRecipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Ingrédient modifié');
            return $this->redirectToRoute('ingredients-recipe_index', array(
                'id' => $ingredientRecipe->getId(),
                'recipe_id' => $recipe->getId(),
                ));
        }

        return $this->render('ingredientrecipe/edit.html.twig', array(
            'ingredientRecipe' => $ingredientRecipe,
            'edit_form' => $editForm->createView(),
            'recipe' => $recipe,
        ));
    }

    /**
     * Deletes a ingredientRecipe entity.
     *
     * @Route("/recipe/{recipe_id}/delete/{id}", name="ingredients-recipe_delete", requirements={"recipe_id"="\d+"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"})
     * @Method("GET")
     */
    public function deleteAction(Request $request, IngredientRecipe $ingredientRecipe, Recipe $recipe)
    {
        if ($recipe) {

            $em = $this->getDoctrine()->getManager();

            $delete = $em->getRepository('AppBundle:IngredientRecipe')->find($ingredientRecipe);
            $em->remove($ingredientRecipe);
            $em->flush();

            $this->addFlash('success', 'Ingrédient supprimé de la recette');
        }

        return $this->redirectToRoute('ingredients-recipe_index', [
            'recipe_id' => $recipe->getId()
        ]);
    }

}
