<?php

namespace App\Normalizer;

use App\Entity\CONTAINERMODEL;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class CONTAINERMODELNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CONTAINERMODEL;
    }

    /**
     * @param CONTAINERMODEL $object
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
