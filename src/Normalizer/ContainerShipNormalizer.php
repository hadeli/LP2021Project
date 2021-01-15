<?php

namespace App\Normalizer;

use App\Entity\Containership;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;


class ContainerShipNormalizer implements ContextAwareNormalizerInterface
{

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        // TODO: Implement supportsNormalization() method.
        return $data instanceof Containership;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        // TODO: Implement normalize() method.
        return ['id' => $object->getId(),
            'name' => $object->getName(),
            'captainName' => $object->getCaptainName(),
            'containerLimit' => $object->getContainerLimit(),];
    }
}