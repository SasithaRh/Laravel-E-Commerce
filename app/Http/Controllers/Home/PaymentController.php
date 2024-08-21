<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use App\Models\Prodct_Size;


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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
