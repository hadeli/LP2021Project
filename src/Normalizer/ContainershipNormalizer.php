<?php


namespace App\Normalizer;


use App\Entity\CONTAINERSHIP;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainershipNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CONTAINERSHIP;
    }

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