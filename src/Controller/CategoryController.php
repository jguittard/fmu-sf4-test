<?php
declare(strict_types=1);

namespace App\Controller;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class CategoryController
 *
 * @package App\Controller
 */
class CategoryController extends AbstractController
{
    public function fetch()
    {
        $em = $this->getDoctrine()->getManager();

        /** @var NestedTreeRepository $repository */
        $repository = $em->getRepository('App\Entity\Category');

        $options = [
            'decorate' => true,
            'rootOpen' => '<ol>',
            'rootClose' => '</ol>',
            'childOpen' => '<li>',
            'childClose' => '</li>',
            'nodeDecorator' => function($node) {
                return '<a href="/categories/'.$node['id'].'">'.sprintf('%s <em>(%s)</em>', $node['name'], $node['path']).'</a>';
            }
        ];

        $categories = $repository->childrenHierarchy(
            null,
            false,
            $options
        );

        return $this->render('categories/fetch.html.twig', compact('categories'));
    }

    public function add()
    {

    }

    public function update()
    {

    }
}
