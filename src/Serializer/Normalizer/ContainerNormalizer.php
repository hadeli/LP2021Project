<?php

namespace App\Serializer\Normalizer;

use App\Entity\Container;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Container;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'color' => $object->getColor(),
            'container_model_id' =>  $object->getContainerModelId(),
            'containership_id' =>  $object->getContainerShipId()
        ];
    }
}
