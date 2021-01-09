<?php

namespace App\Normalizer;

use App\Entity\CONTAINER_PRODUCT;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class CONTAINER_PRODUCTNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CONTAINER_PRODUCT;
    }

    /**
     * @param CONTAINER_PRODUCT $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'ID' => $object->getId(),
            'CONTAINER_ID' => $object->getCONTAINERID(),
            'PRODUCT_ID' => $object->getPRODUCTID()
        ];
    }
}