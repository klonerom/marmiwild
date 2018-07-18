<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{

    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bestRecipes = $em->getRepository('AppBundle:Recipe')->findBy(
            ['bestSeller' => 1]
        );

        //Shuffle object
        $bestRecipes = (array)$bestRecipes;
        shuffle($bestRecipes);

        return $this->render('Home/index.html.twig', array(
            'bestRecipes' => $bestRecipes,
        ));
    }
}