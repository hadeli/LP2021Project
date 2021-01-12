<?php

namespace App\Normalizer;

use App\Entity\Container;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class ContainerNormalizer implements ContextAwareNormalizerInterface
{

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        // TODO: Implement supportsNormalization() method.
        return $data instanceof container;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        // TODO: Implement normalize() method.
        return ['id' => $object->getId(),
                'color' => $object->getColor(),
                'containerModel' => $object->getContainerModel(),
                'containerShip' => $object->getContainerShip(),];
    }
}