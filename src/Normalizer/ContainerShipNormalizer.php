<?php

namespace App\Normalizer;

use App\Entity\Containership;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerShipNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Containership;
    }

    /**
     * @param Containership $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'shipName' => $object->getName(),
            'captain' => $object->getCaptainName(),
            'limit' => $object->getContainerLimit(),
        ];
    }
}
