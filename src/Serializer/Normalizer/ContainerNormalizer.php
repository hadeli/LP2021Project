<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ContainerNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{

    public function normalize($object, string $format = null, array $context = []): array
    {
        $data = [
            'id' => $object->getId(),
            'color' => $object->getcolor(),
            'container_model_id' => $object->getContainerModelId(),
            'containership_id' => $object->getContainerShipId(),
        ];

       return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof \App\Entity\Container;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
