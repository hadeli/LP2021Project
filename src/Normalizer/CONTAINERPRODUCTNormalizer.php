<?php

namespace App\Normalizer;

use App\Entity\CONTAINERPRODUCT;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class CONTAINERPRODUCTNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CONTAINERPRODUCT;
    }

    /**
     * @param CONTAINERPRODUCT $object
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