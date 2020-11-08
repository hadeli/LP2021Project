<?php

namespace App\Serializer\Normalizer;

use App\Entity\Container;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContainerNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Container;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'id' => $object->getId(),
            'color' => $object->getColor(),
            'container_model_id' => $object->getContainerModelId(),
            'containership_id' => $object->getContainershipId()
        ];
    }
}
