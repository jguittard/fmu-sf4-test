<?php
declare(strict_types=1);

namespace App\Listener;

use Doctrine\Common\EventArgs;
use Gedmo\Mapping\Event\AdapterInterface as GedmoAdapterInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Gedmo\Tree\TreeListener;

/**
 * Class TreePathListener
 *
 * @package App\Listener
 */
class TreePathListener extends TreeListener
{
    /**
     * @inheritDoc
     */
    public function postPersist(EventArgs $args)
    {
        parent::postPersist($args);
        $this->updatePath($this->getEventAdapter($args));
    }

    /**
     * @inheritDoc
     */
    public function postUpdate(EventArgs $args)
    {
        parent::postUpdate($args);
        $this->updatePath($this->getEventAdapter($args));
    }

    protected function updatePath(GedmoAdapterInterface $adapter)
    {
        $objectManager = $adapter->getObjectManager();
        $object = $adapter->getObject();

        $metadata = $objectManager->getClassMetadata(get_class($object));
        $repository = $objectManager->getRepository($metadata->getName());

        if ($repository instanceof NestedTreeRepository) {
            $nodes = $repository->getChildren($object, false, null, 'ASC', true);
            $property = $metadata->getReflectionProperty('path');

            foreach ($nodes as $node) {
                $parents = $repository->getPath($object);
                $property->setValue($node, implode(' \\ ', $parents));
                $objectManager->persist($node);
            }

            $objectManager->flush();
        }
    }
}
