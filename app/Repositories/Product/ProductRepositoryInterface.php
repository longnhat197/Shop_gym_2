<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface{
    public function  getRelatedProducts($product,$limit = 4);
    public function getFeaturedProductByCategory(int $categoryId);
    public function getProductOnIndex($request);
    public function getProductsByCategory($categoryName, $request);
    public function getPriceMin();
    public function getPriceMax();


}

?>
