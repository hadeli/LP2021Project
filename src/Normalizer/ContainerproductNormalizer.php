<?php


namespace App\Normalizer;


use App\Entity\CONTAINERPRODUCT;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerproductNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof CONTAINERPRODUCT;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'CONTAINER_ID' => $object->getCONTAINERID(),
            'PRODUCT_ID' => $object->getPRODUCTID(),
            'QUANTITY' => $object->getQUANTITY(),
        ];
    }
}