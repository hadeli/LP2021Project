<?php

namespace App\Normalizer;

use App\Entity\CONTAINER_MODEL;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class CONTAINER_MODELNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CONTAINER_MODEL;
    }

    /**
     * @param CONTAINER_MODEL $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'ID' => $object->getId(),
            'NAME' => $object->getNAME(),
            'LENGTH' => $object->getLENGTH(),
            'WIDTH' => $object->getWIDTH(),
            'HEIGHT' => $object->getHEIGHT(),
        ];
    }
}