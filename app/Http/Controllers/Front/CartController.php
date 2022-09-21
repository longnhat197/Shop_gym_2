<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\Product\ProductServiceInterface;

class CartController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $product = $this->productService->find($request->productId);

            $res['cart'] = Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->discount ?? $product->price,
                'qty' => 1,
                'weight' => $product->weight,
                'options' => [
                    'images' => $product->productImages,
                ],
            ]);
            $res['count'] = Cart::count();
            $res['total'] = Cart::total();

            return $res;
        }

        return back();
    }

    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.shop.cart', compact('carts', 'total', 'subtotal'));
    }

    public function delete(Request $request){
        if($request->ajax()){
            $res['cart'] = Cart::remove($request->rowId);
            $res['count'] = Cart::count();
            $res['total'] = Cart::total();
            $res['subtotal'] = Cart::subtotal();

            return $res;
        }
        return back();
    }

    public function destroy(){
        Cart::destroy();
        return redirect('/cart');
    }

    public function update(Request $request){
        if($request->ajax()){
            $res['cart'] = Cart::update($request->rowId,$request->qty);

            $res['count'] = Cart::count();
            $res['total'] = Cart::total();
            $res['subtotal'] = Cart::subtotal();

            return $res;
        }
    }
}
