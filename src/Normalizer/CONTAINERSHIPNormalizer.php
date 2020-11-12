<?php

namespace App\Normalizer;

use App\Entity\CONTAINERSHIP;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class CONTAINERSHIPNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CONTAINERSHIP;
    }

    /**
     * @param CONTAINERSHIP $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'ID' => $object->getId(),
            'CAPTAIN_NAME' => $object->getCAPTAINNAME(),
            'CONTAINER_LIMIT' => $object->getCONTAINERLIMIT()
        ];
    }
}