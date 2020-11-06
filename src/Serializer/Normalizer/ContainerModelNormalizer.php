<?php

namespace App\Serializer\Normalizer;

use App\Entity\ContainerModel;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContainerModelNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    public function normalize($object,string $format = null, array $context = []): array
    {
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'length' => $object->getLength(),
            'width' => $object->getWith(),
            'height' => $object->getHeight(),
        ];

        return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof ContainerModel;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
