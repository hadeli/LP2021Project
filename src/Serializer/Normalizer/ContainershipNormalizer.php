<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use App\Entity\Containership;

class ContainershipNormalizer implements ContextAwareNormalizerInterface
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
            'name' => $object->getName(),
            'captain_name' => $object->getCaptainName(),
            'container_limit' => $object->getContainerLimit(),
        ];
    }
}
