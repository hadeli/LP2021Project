<?php

namespace App\Normalizer;

use App\Entity\Container;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerNormalizer implements ContextAwareNormalizerInterface
{
    /**
     * @var ContainerModelNormalizer
     */
    private $containerModelNormalizer;

    /**
     * @var ContainerShipNormalizer
     */
    private $containerShipNormalizer;

    /**
     * ContainerNormalizer constructor.
     * @param ContainerModelNormalizer $containerModelNormalizer
     * @param ContainerShipNormalizer $containerShipNormalizer
     */
    public function __construct(ContainerModelNormalizer $containerModelNormalizer, ContainerShipNormalizer $containerShipNormalizer)
    {
        $this->containerModelNormalizer = $containerModelNormalizer;
        $this->containerShipNormalizer = $containerShipNormalizer;
    }


    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Container;
    }

    /**
     * @param Container $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'color' => $object->getColor(),
            'model' => $this->containerModelNormalizer->normalize($object->getContainerModel()),
            'ship' => $this->containerShipNormalizer->normalize($object->getContainership()),
        ];
    }
}
