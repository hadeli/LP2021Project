<?php


namespace App\Normalizer;


use App\Entity\CONTAINER;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CONTAINER;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'COLOR' => $object->getCOLOR(),
            'CONTAINER_MODEL_ID' => $object->getCONTAINERMODELID(),
            'CONTAINERSHIP_ID' => $object->getCONTAINERSHIPID(),
        ];
    }
}