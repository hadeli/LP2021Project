<?php

namespace App\Normalizer;

use App\Entity\Product;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class ProductNormalizer implements ContextAwareNormalizerInterface
{

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Product;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        // TODO : Implement method normalize().
        return ['id' => $object->getId(),
            'name' => $object->getName(),
            'length' => $object->getLength(),
            'width' => $object->getWidth(),
            'height' => $object->getHeight(),];
    }
}