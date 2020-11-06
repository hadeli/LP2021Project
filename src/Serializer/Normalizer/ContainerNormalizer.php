<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContainerNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'id' => $object->getId(),
            'color' => $object->getColor(),
            'container_model_id' => $object->getContainerModelId(),
            'containership_id' => $object->getContainershipId()
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof App\Entity\Container;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
