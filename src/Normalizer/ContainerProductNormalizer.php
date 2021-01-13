<?php

namespace App\Normalizer;

use App\Entity\ContainerProduct;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerProductNormalizer  implements ContextAwareNormalizerInterface
{
    /**
     * @var ProductNormalizer
     */
    private $productNormalizer;

    /**
     * @var ContainerNormalizer
     */
    private $containerNormalizer;

    /**
     * ContainerProductNormalizer constructor.
     * @param ContainerNormalizer $containerNormalizer
     * @param ProductNormalizer $productNormalizer
     */
    public function __construct(ContainerNormalizer $containerNormalizer, ProductNormalizer $productNormalizer)
    {
        $this->containerNormalizer = $containerNormalizer;
        $this->productNormalizer = $productNormalizer;
    }

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        return $data instanceof ContainerProduct;
    }

    /**
     * @param ContainerProduct $object
     *
     * @return array|\ArrayObject|bool|float|int|string|null
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'container' => $this->containerNormalizer->normalize($object->getContainer()),
            'product' => $this->productNormalizer->normalize($object->getProduct()),
            'quantity' => $object->getQuantity(),
        ];
    }
}

