<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use App\Entity\CONTAINER;
use App\Entity\CONTAINERMODEL;

class CONTAINERNormalizer implements ContextAwareNormalizerInterface
{

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof CONTAINER;
    }
    /**
     * @param CONTAINER $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = []): array
    {

        return [
            'id' => $object->getId(),
            'color' => $object->getColor(),
            'container_Model' => $object->getCONTAINERMODEL()->getId(),
            'containership' => $object->getCONTAINERSHIP()->getId()
        ];
    }


}
