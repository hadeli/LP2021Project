<?php

namespace App\Serializer\Normalizer;

use App\Entity\Containership;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContainershipNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    public function normalize($object,string $format = null, array $context = []): array
    {
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'captainName' => $object->getCaptainName(),
            'containerLimit' => $object->getContainerLimit(),
        ];

        return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Containership;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
