<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Cart;
use App\Models\Animal;
use App\Models\Employee;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    public function getCart()
    {
        if (!Session::has("cart")) {
            return view("transaction.shopping-cart");
        }
        $oldService = Session::get("cart");
        $cart = new Cart($oldService);
        return view("transaction.shopping-cart", [
            "services" => $cart->services,
            "animals" => $cart->animals,
            "totalPrice" => $cart->totalPrice,
        ]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $services = Service::find($id);
        $oldService = Session::has("cart")
            ? $request->session()->get("cart")
            : null;
        $cart = new Cart($oldService);
        $cart->add($services, $services->id);
        $request->session()->put("cart", $cart);
        Session::put("cart", $cart);
        $request->session()->save();
        return redirect()->back();
        // dd(Session::all());
    }

    public function getAnimal(Request $request, $id)
    {
        $animals = Animal::find($id);
        $oldService = Session::has("cart")
            ? $request->session()->get("cart")
            : null;
        $cart = new Cart($oldService);
        $cart->addAnimal($animals, $animals->id);
        $request->session()->put("cart", $cart);
        Session::put("cart", $cart);
        $request->session()->save();
        return redirect()->back();
        // dd(Session::all());
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has("cart") ? Session::get("cart") : null;
        $cart = new Cart($oldCart);
        $cart->removeService($id);
        if (count($cart->services) > 0) {
            Session::put("cart", $cart);
        } else {
            Session::forget("cart");
        }
        return redirect()->route("transaction.shoppingCart");
    }

    public function removeService($id)
    {
        $this->totalPrice -= $this->services[$id]["price"];
        unset($this->services[$id]);
        unset($this->animals[$id]);
    }

        public function getSession(){
     Session::flush();
    }
    public function postCheckout(Request $request){
        if (!Session::has('cart')) {
            return redirect()->route('transaction.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        try {
            DB::beginTransaction();
            $order = new Order();
            $customer =  Customer::where('user_id',Auth::id())->first();
            $order->customer_id = $customer->id;
            $order->schedule = now();
            $order->save();
         foreach($cart->services as $services){
            foreach ($cart->animals as $animals) {
         $id = $services['services']['id'];
        //  $animal_id = $animals["animals"]["id"];
         $order->items()->attach($id,['animal_id'=>$animals["animals"]["id"]]);
        //  $order->tests()->attach($animal_id);
        // DB::table("service_orderinfo")->insert([
        //                 "service_orderinfo_id" => DB::getPdo()->lastInsertId(),
        //                 "service_id" => $id,
        //                 "animal_id" => $animal_id,
        //             ]);
                }
            }
        }
        catch (\Exception $e) {
            dd($e);
         DB::rollback();
            return redirect()->route('transaction.shoppingCart')->with('error', $e->getMessage());
        }
        DB::commit();
        Session::forget('cart');
        return redirect()->route('transaction.index')->with('success','Successfully Purchased Your Products!!!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::with('animals')->where('user_id', Auth::id())->get();
        $services = Service::all();
        return view("transaction.index", [
            "services" => $services,
            "customers" => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
