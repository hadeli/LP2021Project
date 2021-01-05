<?php

namespace App\Normalizer;

use App\Entity\Container;
use ArrayObject;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof Container;
    }

    /**
     * @param Container $object
     * @param string|null $format
     * @param array $context
     * @return array|ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'color' => $object->getColor(),
            'containerModel' => $object->getContainerModel() ? $object->getContainerModel()->getId() : null,
            'containership' => $object->getContainership() ? $object->getContainership()->getId() : null
        ];
    }
}
