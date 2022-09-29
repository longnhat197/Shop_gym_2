<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\BaseService;

class ProductService extends BaseService implements ProductServiceInterface
{
    public $repository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function find($id)
    {
        $product =  $this->repository->find($id);
        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(), 'rating'));
        $countRating = count($product->productComments);
        if ($countRating != 0) {
            $avgRating = $sumRating / $countRating;
        }

        $product->avgRating = round($avgRating);

        return $product;
    }

    public function getRelatedProducts($product,$limit = 4){
        return $this->repository->getRelatedProducts($product,$limit);
    }

    public function getFeaturedProducts(){
        return [
            "men"=> $this->repository->getFeaturedProductByCategory(1),
            "women"=> $this->repository->getFeaturedProductByCategory(2),
        ];
    }

    public function getProductOnIndex($request){
        return $this->repository->getProductOnIndex($request);
    }

    public function getProductsByCategory($categoryName, $request){
        return $this->repository->getProductsByCategory($categoryName,$request);
    }

    public function getPriceMax(){
        return $this->repository->getPriceMax();
    }

    public function getPriceMin(){
        return $this->repository->getPriceMin();
    }


}
