<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Utilities\VNPay;
use Illuminate\Support\Facades\Mail;
use App\Utilities\Constant;

class CheckOutController extends Controller
{
    private $orderService;
    private $orderDetailService;
    public function __construct(OrderServiceInterface $orderService,OrderDetailServiceInterface $orderDetailService)
    {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }
    public function index(){
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.checkout.index',compact('carts', 'total', 'subtotal'));
    }

    public function addOrder(Request $request){
        //01.Thêm đơn hàng
        $data = $request->all();
        $data['status'] =Constant::order_status_ReceiveOrder;
        $order = $this->orderService->create($data);

        //02.Thê chi tiết đơn hàng
        $carts = Cart::content();

        foreach($carts as $cart){
            $data = [
                'order_id'=>$order->id,
                'product_id'=>$cart->id,
                'qty'=>$cart->qty,
                'amount'=>$cart->price,
                'total'=>$cart->qty * $cart->price,
            ];

            $this->orderDetailService->create($data);
        }

        if($request->payment_type =='pay_later'){
            //Gửi mail:
            $carts = Cart::content();
            $total = Cart::total();
            $subtotal = Cart::subtotal();
            $this->sendEmail($order, $total, $subtotal,$carts); // Gọi hàm email gửi email đã định nghĩa

            //03.Xoá giỏ hàng
            Cart::destroy();

            //04.Trả về kết quả thông báo

            return redirect()->route('checkout.show')->with('success', 'Success! You will pay on delivery. Please check your email.');
        }

        if($request->payment_type =='online_payment'){
            //01. Lấy URL thanh toán VNpay
                $data_url = VNPay::vnpay_create_payment([
                    'vnp_TxnRef' => $order->id, //ID của đơn hàng
                    'vnp_OrderInfo' => 'Mô tả về đơn hàng',
                    'vnp_Amount' => Cart::total(0, '', '') * 23545, // Nhân tỉ giá để chuyển sang tiền việt
                ]);
            //02. Chuyển hướng tới url lấy được
            return redirect()->to($data_url);
        }

    }

    public function vnPayCheck(Request $request){
        //01.Lấy data từ url(do VNPay gửi về qua $vnp_Returnurl)
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //Mã phản hồi kết quả thanh toán
        $vnp_TxnRef = $request->get('vnp_TxnRef'); //tiket_id
        $vnp_Amount = $request->get('vnp_Amount'); //Số tiền thanh toán
        //02. Kiểm tra data, xem kết quả giao dịch trả về từ VnPay có hợp lệ không
        if($vnp_ResponseCode != null){
            //Nếu thành công
            if($vnp_ResponseCode == 00){
                //Cập nhật trạng thái
                $this->orderService->update([
                    'status' =>Constant::order_status_Paid,
                ],$vnp_TxnRef);

                // Gửi mail
                $order = $this->orderService->find($vnp_TxnRef); // $vnp_TxnRef chính là order -> id
                $total = Cart::total();
                $subtotal = Cart::subtotal();
                $carts = Cart::content();
                $this->sendEmail($order, $total, $subtotal,$carts); // Gọi hàm email gửi email đã định nghĩa
                //Xoá giỏ hàng
                Cart::destroy();

                //Thông báo kết quả
                return redirect()->route('checkout.show')->with('success', 'Success! Has paid online. Please check your email.');
            }else{ // Nếu không thành công
                //Xoá đơn hàng đã thêm vào database
                $this->orderService->delete($vnp_TxnRef);

                //Thông báo lỗi
                return redirect()->route('checkout.show')->with('error', 'Error: Payment failed or cancelled');
            }
        }
    }

    private function sendEmail($order,$total,$subtotal,$carts){
        $email_to = $order->email;

        Mail::send('front.checkout.email',compact('order','total','subtotal','carts'),
        function($message) use ($email_to){
            $message->from('longnhat515@gmail.com','TienBui');
            $message->to($email_to,$email_to);
            $message->subject('Order Notification');
        });
    }

}
