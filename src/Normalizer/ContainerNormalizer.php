<?php

namespace App\Normalizer;

use App\Entity\Container;
use App\Repository\ContainerProductRepository;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerNormalizer implements ContextAwareNormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof Container;
    }

    /**
     * @param Container $object
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'color' => $object->getColor(),
            'container_model' => $object->getContainerModel()->getId(),
            'volume_limit' => $this->getVolumeLimit($object),
            'current_volume' => $this->getUsedVolume($object),
            'product_inside' => count($object->getContainerProducts()),
            'product_list' => $this->getProducts($object),
        ];
    }

    // Get container products
    private function getProducts($object) {
        $products = [];
        foreach ($object->getContainerProducts() as $product) {
            $p = [];
            array_push($p,"Id: ". $product->getProduct()->getId());
            array_push($p,$product->getProduct()->getName());
            array_push($p,"Quantity: ". $product->getQuantity());
            array_push($products,$p);
        }
        return $products;
    }

    // Get container volume limit
    private function getVolumeLimit($object) {
        $volumeLimit =
            $object->getContainerModel()->getLength() *
            $object->getContainerModel()->getWidth() *
            $object->getContainerModel()->getHeight();
        return $volumeLimit;
    }

    // Get container used volume
    private function getUsedVolume($object) {
        $volumeUsed = 0;
        foreach ($object->getContainerProducts() as $product) {
            $volume =
                $product->getProduct()->getLength() *
                $product->getProduct()->getWidth() *
                $product->getProduct()->getHeight() *
                $product->getQuantity();
            $volumeUsed += $volume;
        }
        return $volumeUsed;
    }
}