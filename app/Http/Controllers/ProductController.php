<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use File;
use Image;
  
class ProductController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $products = Product::all();
        return view('admin/index', compact('products'));
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('cart');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "product_id"=>$product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect('cart')->with('success', 'Product added to cart successfully!');
    }

  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }


    public function checkout()
    {
        $cart = session()->get('cart');

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }
        $order = new Order();
        $order->user_id = Auth::id();
        $order->amount = $totalAmount;
        $order->save();
        foreach ($cart as $item) {

            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->amount = $item['price'];
            $orderItem->save();
        }
        session()->put('cart', []);
        return redirect()->back()->with('success', 'Checkout successfully!');
    }
    /**
     * CRUD PRODUCT
    */
    /**
     * ADD PRODUCT
    */
    
    public function addproduct(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
			'desc' => 'required|max:1000|min:10',
			'price' => 'required|max:20|min:3',
			'img' => 'mimes:jpg,jpeg,png,gif',
		]);
        
        // dd($validator->fails());
        // if ($validator->fails()) {
        //     dd(1);
        //     return ($validator);
        // }
        
        // Create The Product
        $image = $request->file('img');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        
        $upload = 'assets/img/products/';
        // dd($upload);
        $filename = time().$image->getClientOriginalName();
        $path = move_uploaded_file($image->getPathName(), $upload. $filename);
        // dd($path);
    
        $product = new Product;
        // $post->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->desc;
        $product->image = $filename;
        // dd($product->image);
        $product->price = $request->price;
        $product->save();
        // dd($product->name);
        Session::flash('product_create','New product is created');
        return redirect('/admin');
    }


    public function remove_pro($id)
    {
        $product = Product::find($id)->delete();
        return redirect('/admin');
    }

    /**
     * update product
    */
    public function update_pro(Request $request, $id){
    // dd(1);
    $id = $request->input("id");
    $product = Product::find($id);
    $image = $request->file('img');
    $filename = time() . '.' . $image->getClientOriginalExtension();
    
    $upload = 'assets/img/products/';
    // dd($upload);
    $filename = time().$image->getClientOriginalName();
    $path = move_uploaded_file($image->getPathName(), $upload. $filename);
    $product->image = $filename;
    $product->name = $request->get('name');
    $product->description = $request->get('desc');
    $product->price = $request->get('price');
    $product->save();
    // dd($product);
    $request->session()->flash('alert-info', 'Product Status Updated!'); 
    // return Redirect::to('admin/product/detail');
    // Session::flash('product_update','');
    return redirect('/admin');
    }


    /**
     * Delete User
    */
    public function remove_user($id)
    {
       $user = User::find($id)->delete();
       return redirect('/admin');
    }

  
}
