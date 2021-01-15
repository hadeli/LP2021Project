<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use App\Entity\CONTAINERSHIP;

class CONTAINERSHIPNormalizer implements ContextAwareNormalizerInterface
{

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof \App\Entity\CONTAINERSHIP;
    }

    /**
     * @param CONTAINERSHIP $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'NAME' => $object->getNAME(),
            'CAPTAIN_NAME' => $object->getCAPTAINNAME(),
            'CONTAINER_LIMIT' => $object->getCONTAINERLIMIT(),
        ];
    }
}
