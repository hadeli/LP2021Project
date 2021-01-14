<?php

namespace App\Normalizer;

use App\Entity\Containership;
use ArrayObject;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainershipNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof Containership;
    }

    /**
     * @param $object
     * @param string|null $format
     * @param array $context
     * @return array|ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'captainName' => $object->getCaptainName(),
            'containership' => $object->getContainerLimit()
        ];
    }
}
