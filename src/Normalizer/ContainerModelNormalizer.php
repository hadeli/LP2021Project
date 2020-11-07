<?php

namespace App\Normalizer;

use App\Entity\ContainerModel;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerModelNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof ContainerModel;
    }

    /**
     * @param ContainerModel $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'width' => $object->getWidth(),
            'length' => $object->getLength(),
            'height' => $object->getHeight(),
            'name' => $object->getName(),
        ];
    }
}
