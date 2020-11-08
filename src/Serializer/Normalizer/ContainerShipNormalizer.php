<?php

namespace App\Serializer\Normalizer;

use App\Entity\ContainerShip;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContainerShipNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof ContainerShip;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }

    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'captain_name' => $object->getCaptainName(),
            'container_limit' => $object->getContainerLimit()
        ];
    }
}
