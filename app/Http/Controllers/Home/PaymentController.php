<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Prodct_Size;
use App\Models\Color;
use App\Models\DiscountCode;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function cart(Request $request)  {
        //dd(Cart::getContent());
        return view('home.payment.cart');

     }
     public function checkout(Request $request)  {
        //dd(Cart::getContent());
        return view('home.payment.checkout');

     }
     public function cart_delete($id) {
       // dd($id);
        Cart::remove($id);
        return redirect()->back();
     }
     public function cart_update(Request $request) {
      // dd($request->all());
        foreach($request->cart as $key => $cart){
            Cart::update($cart['id'],array(
                'quantity'=>array(
                  'relative' =>false,
                  'value' => $cart['qty']
                ),
            )

            );


        }

         return redirect()->back();
      }
    public function addtocart(Request $request)
    {
       // dd( $request->all());
        $getProduct = Product::findOrFail($request->product_id);
        $total = $getProduct->price;
        if (!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = Prodct_Size::findOrFail($size_id);
            $total = $total + $getSize->price;
            //dd( $getSize->price);
        }else{
            $size_id  = 0;
        }

        $color_id = !empty($request->color_id)?$request->color_id:0;
        Cart::add(array(
            'id' => $getProduct->id, // inique row ID
            'name' => 'Product',
            'price' => $total,
            'quantity' => $request->qty,
            'attributes' => array(
                'size_id' => $size_id,
                'color_id' => $color_id
            )
        ));
        // dd( $request->all());
        return redirect()->back();
    }

    public function apply_discount(Request $request) {

       $DiscountCode= DiscountCode::checkDiscount($request->discount_code);
       dd($DiscountCode["type"]);
       if(!empty($DiscountCode)){
        $total= Cart::getTotal();
       // dd($total);
        if($DiscountCode->type == "amount"){
            $getDiscountCode = $DiscountCode->percent_amount;
            $paybal_total = $total-$getDiscountCode;
        }else{
            $getDiscountCode =($total *$DiscountCode->percent_amount)/100;
            $paybal_total = $total-$getDiscountCode;
            dd($paybal_total);
        }
        dd( $paybal_total);
        $json['status'] =true;
        $json['discount_amount'] =$getDiscountCode;
        $json['paybal_total'] =$paybal_total;
        $json['message'] ="success";
       }else{
        $json['status'] =false;
        $json['message'] ="Invalid Discount Code";
       }
       echo json_encode($json);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkout_place_order(Request $request)
    {
       // dd( $request->all());
if(!empty($request->first_name)){
        $save = new Order;
        $save->first_name = $request->first_name;
        $save->last_name = $request->last_name;
        $save->company = $request->company;
        $save->country = $request->country;
        $save->address1 = $request->address1;
        $save->address2 = $request->address2;
        $save->city = $request->city;
        $save->state = $request->state;
        $save->pastcode = $request->pastcode;
        $save->phone = $request->phone;
        $save->email = $request->email;
        $save->amount = $request->amount;
        $save->note = $request->note;
        $save->payment_method = $request->payment_method;
        $save->save();

        foreach (Cart::getContent() as $key => $item ){
           // dd($item);
            // if(!empty($item->attributes->size_id)){
                $getSize = Prodct_Size::getSingle($item->attributes->size_id);
                $getColor =Color::getSingle($item->attributes->color_id);

            // }
           // dd($getColor->name);
            $order_item = new Order_item;
            $order_item->order_id = $save->id;
            $order_item->product_id = $item->id;
            $order_item->quantity = $item->quantity;
            $order_item->price = $item->price;
            $order_item->color_name = $getColor->name;
            $order_item->size_name = !empty($getSize->name)?$getSize->name:"";
            $order_item->size_amount = !empty($getSize->price)?$getSize->price:"";
            $order_item->total_amount = $save->amount;
            $order_item->save();
           // Cart::remove($item->id);
        }
        $json['status'] =true;
        $json['message'] ="success";
        $order_id = base64_encode($save->id);

// Use Laravel's redirect helper
return redirect()->to('checkout/payment?order_id=' . $order_id);

    }
echo json_encode($json);
//  return redirect()->back();


    }

    /**
     * Store a newly created resource in storage.
     */
    public function checkout_payment(Request $request)
    {
       // dd( Cart::getTotal());
        if(!empty(Cart::getTotal()) && !empty($request->order_id)){
            //dd( $request->order_id);
            $order_id = base64_decode($request->order_id);

            $getOrder = Order::findOrFail($order_id);
           // dd($getOrder);
            if(!empty($getOrder)){
                if($getOrder->payment_method == 'cod'){
                    $getOrder->is_payment =1;
                    $getOrder->save();
                    Cart::clear();
                 return redirect('cart')->with('success',"Order successfully placed");
                }elseif($getOrder->payment_method == 'paypal'){

                }else{

                }
            }
        }else{
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
