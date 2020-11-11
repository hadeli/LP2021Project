<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ContainershipNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'captain_name' => $object->getCaptainName(),
            'containter_limit' => $object->getContainerLimit(),
        ];


       return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof \App\Entity\Containership;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
