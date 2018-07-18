<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CategorieRecipe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Categorierecipe controller.
 *
 * @Route("categories-recipe")
 */
class CategorieRecipeController extends Controller
{
    /**
     * Lists all categorieRecipe entities.
     *
     * @Route("/", name="categories-recipe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categorieRecipes = $em->getRepository('AppBundle:CategorieRecipe')->findAll();

        return $this->render('categorierecipe/index.html.twig', array(
            'categorieRecipes' => $categorieRecipes,
        ));
    }

    /**
     * Creates a new categorieRecipe entity.
     *
     * @Route("/new", name="categories-recipe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categorieRecipe = new Categorierecipe();
        $form = $this->createForm('AppBundle\Form\CategorieRecipeType', $categorieRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieRecipe);
            $em->flush();

            return $this->redirectToRoute('categories-recipe_show', array('id' => $categorieRecipe->getId()));
        }

        return $this->render('categorierecipe/new.html.twig', array(
            'categorieRecipe' => $categorieRecipe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorieRecipe entity.
     *
     * @Route("/{id}", name="categories-recipe_show")
     * @Method("GET")
     */
    public function showAction(CategorieRecipe $categorieRecipe)
    {
        $deleteForm = $this->createDeleteForm($categorieRecipe);

        return $this->render('categorierecipe/show.html.twig', array(
            'categorieRecipe' => $categorieRecipe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorieRecipe entity.
     *
     * @Route("/{id}/edit", name="categories-recipe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CategorieRecipe $categorieRecipe)
    {
        $deleteForm = $this->createDeleteForm($categorieRecipe);
        $editForm = $this->createForm('AppBundle\Form\CategorieRecipeType', $categorieRecipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categories-recipe_edit', array('id' => $categorieRecipe->getId()));
        }

        return $this->render('categorierecipe/edit.html.twig', array(
            'categorieRecipe' => $categorieRecipe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorieRecipe entity.
     *
     * @Route("/{id}", name="categories-recipe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CategorieRecipe $categorieRecipe)
    {
        $form = $this->createDeleteForm($categorieRecipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorieRecipe);
            $em->flush();
        }

        return $this->redirectToRoute('categories-recipe_index');
    }

    /**
     * Creates a form to delete a categorieRecipe entity.
     *
     * @param CategorieRecipe $categorieRecipe The categorieRecipe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CategorieRecipe $categorieRecipe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categories-recipe_delete', array('id' => $categorieRecipe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
