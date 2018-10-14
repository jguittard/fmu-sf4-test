<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class LandingController
 *
 * @package App
 */
class LandingController extends AbstractController
{
    /**
     * @Route("/landing")
     */
    public function categories()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('App\Entity\Category');
        $categories = $repository->findBy([], ['left' => 'ASC']);

        return $this->render('landing/categories.html.twig', compact('categories'));
    }
}
