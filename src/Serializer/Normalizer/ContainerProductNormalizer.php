<?php

namespace App\Serializer\Normalizer;

use App\Entity\ContainerProduct;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ContainerProductNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
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
            'container_id' => $object->getContainerId(),
            'product_id' => $object->getProductId(),
            'quantity' => $object->getQuantity(),
        ];

        return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof ContainerProduct;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
