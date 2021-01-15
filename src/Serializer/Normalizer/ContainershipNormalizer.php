<?php

namespace App\Serializer\Normalizer;

use App\Entity\Containership;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ContainershipNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function normalize($object, string $format = null, array $context = []): array
    {
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'captain_name' => $object->getCaptainName(),
            'container_limit' => $object->getContainerLimit(),
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
