<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class RootController
 *
 * @package App\Controller
 */
class RootController extends AbstractController
{
    public function root()
    {
        return $this->redirectToRoute('categories_list');
    }
}