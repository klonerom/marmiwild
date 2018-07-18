<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DifficultyLevel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Difficultylevel controller.
 *
 * @Route("difficulty-level")
 */
class DifficultyLevelController extends Controller
{
    /**
     * Lists all difficultyLevel entities.
     *
     * @Route("/", name="difficultylevel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $difficultyLevels = $em->getRepository('AppBundle:DifficultyLevel')->findAll();

        return $this->render('difficultylevel/index.html.twig', array(
            'difficultyLevels' => $difficultyLevels,
        ));
    }

    /**
     * Creates a new difficultyLevel entity.
     *
     * @Route("/new", name="difficultylevel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $difficultyLevel = new Difficultylevel();
        $form = $this->createForm('AppBundle\Form\DifficultyLevelType', $difficultyLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($difficultyLevel);
            $em->flush();

            return $this->redirectToRoute('difficultylevel_show', array('id' => $difficultyLevel->getId()));
        }

        return $this->render('difficultylevel/new.html.twig', array(
            'difficultyLevel' => $difficultyLevel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a difficultyLevel entity.
     *
     * @Route("/{id}", name="difficultylevel_show")
     * @Method("GET")
     */
    public function showAction(DifficultyLevel $difficultyLevel)
    {
        $deleteForm = $this->createDeleteForm($difficultyLevel);

        return $this->render('difficultylevel/show.html.twig', array(
            'difficultyLevel' => $difficultyLevel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing difficultyLevel entity.
     *
     * @Route("/{id}/edit", name="difficultylevel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DifficultyLevel $difficultyLevel)
    {
        $deleteForm = $this->createDeleteForm($difficultyLevel);
        $editForm = $this->createForm('AppBundle\Form\DifficultyLevelType', $difficultyLevel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('difficultylevel_edit', array('id' => $difficultyLevel->getId()));
        }

        return $this->render('difficultylevel/edit.html.twig', array(
            'difficultyLevel' => $difficultyLevel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a difficultyLevel entity.
     *
     * @Route("/{id}", name="difficultylevel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DifficultyLevel $difficultyLevel)
    {
        $form = $this->createDeleteForm($difficultyLevel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($difficultyLevel);
            $em->flush();
        }

        return $this->redirectToRoute('difficultylevel_index');
    }

    /**
     * Creates a form to delete a difficultyLevel entity.
     *
     * @param DifficultyLevel $difficultyLevel The difficultyLevel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DifficultyLevel $difficultyLevel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('difficultylevel_delete', array('id' => $difficultyLevel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
