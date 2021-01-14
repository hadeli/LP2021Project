<?php

namespace App\Normalizer;

use App\Entity\Containership;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

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
            'containers_on_board' => count($object->getContainers()),
            'containers' => $this->getContainers($object),
        ];
    }

    // Get containers
    private function getContainers($object) {
        $containers = [];
        foreach ($object->getContainers() as $container) {
            $c = [];
            array_push($c,"Id: ". $container->getId());
            array_push($containers,$c);
        }
        return $containers;
    }
}