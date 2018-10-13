<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Category;
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
            new Category('Frais'),
            new Category('Produits Laitiers'),
            new Category('Beurres'),
            new Category('Beurre sans sel'),
        ];

        return $this->render('landing/categories.html.twig', compact('categories'));
    }
}
