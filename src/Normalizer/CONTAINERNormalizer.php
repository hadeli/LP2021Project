<?php

namespace App\Normalizer;

use App\Entity\CONTAINER;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class CONTAINERNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CONTAINER;
    }

    /**
     * @param CONTAINER $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'ID' => $object->getId(),
            'CONTAINER_MODEL_ID' => $object->getCONTAINERMODELID(),
            'CONTAINERSHIP_ID' => $object->getCONTAINERSHIPID()
        ];
    }
}