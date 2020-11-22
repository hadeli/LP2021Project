<?php

namespace App\Normalizer;

use App\Entity\PRODUCT;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class PRODUCTNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof PRODUCT;
    }

    /**
     * @param PRODUCT $object
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
