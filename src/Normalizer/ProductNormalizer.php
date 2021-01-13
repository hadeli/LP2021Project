<?php


namespace App\Normalizer;


use App\Entity\PRODUCT;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ProductNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof PRODUCT;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'NAME' => $object->getNAME(),
            'LENGHT' => $object->getLENGHT(),
            'WIDTH' => $object->getWIDTH(),
            'HEIGHT' => $object->getHEIGHT(),
        ];
    }
}