<?php

namespace AppBundle\Controller;

use AppBundle\Entity\IngredientRecipe;
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
     * @Route("/", name="ingredients-recipe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ingredientRecipes = $em->getRepository('AppBundle:IngredientRecipe')->findAll();

        return $this->render('ingredientrecipe/index.html.twig', array(
            'ingredientRecipes' => $ingredientRecipes,
        ));
    }

    /**
     * Creates a new ingredientRecipe entity.
     *
     * @Route("/new", name="ingredients-recipe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ingredientRecipe = new Ingredientrecipe();
        $form = $this->createForm('AppBundle\Form\IngredientRecipeType', $ingredientRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredientRecipe);
            $em->flush();

            return $this->redirectToRoute('ingredients-recipe_show', array('id' => $ingredientRecipe->getId()));
        }

        return $this->render('ingredientrecipe/new.html.twig', array(
            'ingredientRecipe' => $ingredientRecipe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ingredientRecipe entity.
     *
     * @Route("/{id}", name="ingredients-recipe_show")
     * @Method("GET")
     */
    public function showAction(IngredientRecipe $ingredientRecipe)
    {
        $deleteForm = $this->createDeleteForm($ingredientRecipe);

        return $this->render('ingredientrecipe/show.html.twig', array(
            'ingredientRecipe' => $ingredientRecipe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ingredientRecipe entity.
     *
     * @Route("/{id}/edit", name="ingredients-recipe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, IngredientRecipe $ingredientRecipe)
    {
        $deleteForm = $this->createDeleteForm($ingredientRecipe);
        $editForm = $this->createForm('AppBundle\Form\IngredientRecipeType', $ingredientRecipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ingredients-recipe_edit', array('id' => $ingredientRecipe->getId()));
        }

        return $this->render('ingredientrecipe/edit.html.twig', array(
            'ingredientRecipe' => $ingredientRecipe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ingredientRecipe entity.
     *
     * @Route("/{id}", name="ingredients-recipe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, IngredientRecipe $ingredientRecipe)
    {
        $form = $this->createDeleteForm($ingredientRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ingredientRecipe);
            $em->flush();
        }

        return $this->redirectToRoute('ingredients-recipe_index');
    }

    /**
     * Creates a form to delete a ingredientRecipe entity.
     *
     * @param IngredientRecipe $ingredientRecipe The ingredientRecipe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(IngredientRecipe $ingredientRecipe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ingredients-recipe_delete', array('id' => $ingredientRecipe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
