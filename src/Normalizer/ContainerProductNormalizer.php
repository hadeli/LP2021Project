<?php

namespace App\Normalizer;

use App\Entity\ContainerProduct;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerProductNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof ContainerProduct;
    }

    /**
     * @param ContainerProduct $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'container' => [
                'id' => $object->getContainer()->getId(),
                'color' => $object->getContainer()->getColor(),
                'containerModel' => [
                    'id' => $object->getContainer()->getContainerModel()->getId(),
                    'name' => $object->getContainer()->getContainerModel()->getName(),
                    'length' => $object->getContainer()->getContainerModel()->getLength(),
                    'width' => $object->getContainer()->getContainerModel()->getHeight(),
                    'height' => $object->getContainer()->getContainerModel()->getWidth(),
                    ],
                ],
                'containership' => [
                    'id' => $object->getContainer()->getContainership()->getId(),
                    'name' => $object->getContainer()->getContainership()->getName(),
                    'captainName' => $object->getContainer()->getContainership()->getCaptainName(),
                    'containerLimit' => $object->getContainer()->getContainership()->getContainerLimit(),
            ],
            'product' => [
                'id' => $object->getProduct()->getId(),
                'name' => $object->getProduct()->getName(),
                'length' => $object->getProduct()->getLength(),
                'width' => $object->getProduct()->getWidth(),
                'height' => $object->getProduct()->getHeight(),
            ],
        ];
    }
}