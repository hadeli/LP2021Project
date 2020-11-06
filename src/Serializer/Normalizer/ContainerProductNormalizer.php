<?php

namespace App\Serializer\Normalizer;

use App\Entity\ContainerProduct;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContainerProductNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    public function normalize($object,string $format = null, array $context = []): array
    {
        $data = [
            'id' => $object->getId(),
            'containerId' => $object->getContainerId(),
            'productId' => $object->getProductId(),
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
