<?php

namespace App\Normalizer;

use App\Entity\Container;
use App\Repository\ContainerProductRepository;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class ContainerNormalizer implements ContextAwareNormalizerInterface
{
    private $productNormalizer;
    private $containerProductRepository;

    public function __construct(ProductNormalizer $productNormalizer, ContainerProductRepository $containerProductRepository)
    {
        $this->productNormalizer = $productNormalizer;
        $this->containerProductRepository = $containerProductRepository;
    }

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
        ];
        $data['containership'] = $object->getContainership()->getId();
        $data['container_products'] = $this->fillWithProducts($object);
    }

    /**
     * @param Container $object
     * @return array
     */
    private function fillWithProducts(Container $object): array
    {
        $products = [];
        $containerProducts = $this->containerProductRepository->findBy(['container' => $object->getId()]);
        foreach ($containerProducts as $containerProduct) {
            $products[] = $this->productNormalizer->normalize($containerProduct->getProduct());
        }
        return $products;
    }
}