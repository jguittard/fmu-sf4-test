<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

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

    public function update(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->find(Category::class, $id);

        $form = $this->createFormBuilder($category)
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Category name:',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('categories_list');
        }

        return $this->render('categories/update.html.twig', ['form' => $form->createView()]);
    }
}
