<?php


namespace App\Normalizer;


use App\Entity\CONTAINERMODEL;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainermodelNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CONTAINERMODEL;
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