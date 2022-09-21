<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductComment\ProductCommentServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\Brand\BrandServiceInterface;

class ShopController extends Controller
{
    private $productService;
    private $productCommentService;
    private $productCategoryService;
    private $brandService;

    public function __construct(ProductServiceInterface $productService,
     ProductCommentServiceInterface $productCommentService,
     ProductCategoryServiceInterface $productCategoryService,
     BrandServiceInterface $brandService){

        $this->productCategoryService = $productCategoryService;
        $this->productService = $productService;
        $this->productCommentService = $productCommentService;
        $this->brandService = $brandService;
    }

    public function show($id){
        $product = $this->productService->find($id);
        $relatedProducts = $this->productService->getRelatedProducts($product);
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        $priceMax = $this->productService->getPriceMax();
        $priceMin = $this->productService->getPriceMin();

        return view('front.shop.show',compact('product','relatedProducts','categories','brands','priceMin','priceMax'));
    }

    public function postComment(Request $request){
        $this->productCommentService->create(($request->all()));

        return redirect()->back();
    }

    public function index(Request $request){
        $categories = $this->productCategoryService->all();
        $brands = $this->brandService->all();
        $products = $this->productService->getProductOnIndex($request);
        $priceMax = $this->productService->getPriceMax();
        $priceMin = $this->productService->getPriceMin();

        return view('front.shop.index',compact('products','categories','brands','priceMin','priceMax'));

    }

    public function category($categoryName,Request $request){
        $categories = $this->productCategoryService->all();
        $products = $this->productService->getProductsByCategory($categoryName, $request);
        $brands = $this->brandService->all();
        $priceMax = $this->productService->getPriceMax();
        $priceMin = $this->productService->getPriceMin();


        return view('front.shop.index',compact('products','categories','brands','priceMax','priceMin'));
    }

}

