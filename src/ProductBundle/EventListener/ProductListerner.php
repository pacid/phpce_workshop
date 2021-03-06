<?php

namespace ProductBundle\EventListener;

use Elastica\Bulk;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use PhpOption\None;
use ProductBundle\Entity\Product;

class ProductListener implements EventSubscriberInterface
{

    /**
     * On post serialize handler
     *
     * @param ObjectEvent $event
     */
    public function onPostSerialize(ObjectEvent $event)
    {

    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {

    }
}