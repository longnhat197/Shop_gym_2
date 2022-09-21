<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Product\ProductServiceInterface;
use App\Services\Blog\BlogServiceInterface;

class HomeController extends Controller
{
    private $productService;
    private $blogService;
    public function __construct(ProductServiceInterface $productService, BlogServiceInterface $blogService){
        $this->productService = $productService;
        $this->blogService = $blogService;
    }
    //
    public function index(){
        $featureProducts = $this->productService->getFeaturedProducts();
        $blogs = $this->blogService->getLatestBlog();

        return view('front.index',compact('featureProducts','blogs'));
    }
}
