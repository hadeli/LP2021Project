<?php

namespace App\Serializer\Normalizer;

use App\Entity\ContainerProduct;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerProductNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof ContainerProduct;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'container_id' => $object->getContainerId(),
            'product_id' => $object->getProductId(),
            'quantity' => $object->getQuantity()
        ];
    }
}
