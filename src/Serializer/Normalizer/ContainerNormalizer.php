<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use App\Entity\Container;
use App\Entity\ContainerModel;

class ContainerNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Container;
    }

    /**
     * @param Container $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'color' => $object->getColor(),
            'container_model' => $object->getContainerModel() ? $object->getContainerModel()->getId() : null,
            'container_ship' => $object->getContainership() ? $object->getContainership()->getId() : null,
        ];
    }
}
