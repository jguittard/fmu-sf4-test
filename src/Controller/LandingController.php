<?php
declare(strict_types=1);

namespace App\Controller;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class LandingController
 *
 * @package App
 */
class LandingController extends AbstractController
{
    public function categories()
    {
        $em = $this->getDoctrine()->getManager();

        /** @var NestedTreeRepository $repository */
        $repository = $em->getRepository('App\Entity\Category');
        $categories = $repository->findBy([], ['left' => 'ASC']);

        return $this->render('landing/categories.html.twig', compact('categories'));
    }
}
