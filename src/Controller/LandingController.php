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
        $categories = [
            'Frais',
            'Produits Laitiers',
            'Beurres',
            'Beurre sans sel',
        ];

        return $this->render('landing/categories.html.twig', compact('categories'));
    }
}
