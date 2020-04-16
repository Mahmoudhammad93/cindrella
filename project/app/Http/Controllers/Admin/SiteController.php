<?php

namespace App\Http\Controllers\Admin;

use App\models\Cart;
use App\models\Category;
use App\models\Product;
use App\models\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $productsCount = Cart::all();
        $pageTitle = trans('main.site.home');
        $buttonsRoutsname = $modelViewName = 'home';
        $headerStat = 1;

        return view('site.home', compact('pageTitle','headerStat','products','productsCount','buttonsRoutsname'));
    }

    public function products()
    {
        $products = Product::all();
        $categories = Category::all();
        $productsCount = Cart::all();
        $pageTitle = trans('main.site.products');
        $buttonsRoutsname = $modelViewName = 'products';

        $headerStat = 0;
        return view('site.products', compact('products','pageTitle','headerStat','categories','buttonsRoutsname','productsCount','buttonsRoutsname'));
    }

    public function getProducts()
    {
        $prodID = $_GET['prodID'];

        if ($prodID == 'all'){
            return $products = Product::all();
        }else{
            return $products = DB::table('categories')
                ->join('products','products.category_id','=','categories.id')
                ->where('categories.id', '=',$prodID)
                ->get();
        }

    }

    public function getProductsFromCate($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        $productsCount = Cart::all();
        $Id = $id;
        $products = Product::where('category_id','=',$id)->get();
        $pageTitle = trans('main.site.categories')." | ".$category->name;
        $headerStat = 0;
        $buttonsRoutsname = $modelViewName = 'product'.$category->id;
        return view('site.products', compact('products','pageTitle','headerStat','buttonsRoutsname','categories','Id','productsCount'));
    }

    public function categories()
    {
        $categories = Category::all();
        $products = Product::all();
        $productsCount = Cart::all();
        $pageTitle = trans('main.site.categories');
        $buttonsRoutsname = $modelViewName = 'categories';
        $headerStat = 0;
        return view('site.categories', compact('categories','pageTitle','headerStat','products','buttonsRoutsname','productsCount'));
    }

    public function getElements()
    {
        $productsCount = Cart::all();
        $pageTitle = "Home Page ( الصفحه الرئيسيه )";
        $headerStat = 0;
        return view('site.elements', compact('pageTitle','headerStat','productsCount'));
    }

    public function getGeneric()
    {
        $productsCount = Cart::all();
        $pageTitle = "Home Page ( الصفحه الرئيسيه )";
        $headerStat = 0;
        return view('site.generic', compact('pageTitle','headerStat','productsCount'));
    }

    public function productDetails($id)
    {
        $product = Product::find($id);
        $vote = Vote::where('product_id','=',$id);
        $productsCount = Cart::all();
        $headerStat = 0;
        $pageTitle = trans('main.site.product_details');
        $buttonsRoutsname = $modelViewName = 'products';

        return view('site.productDetails', compact('product', 'pageTitle','headerStat', 'productsCount','buttonsRoutsname','vote'));
    }

    public function gallery()
    {
        $categories = Category::all();
        $productsCount = Cart::all();
        $headerStat = 0;
        $pageTitle = trans('main.site.gallery');
        $buttonsRoutsname = $modelViewName = 'gallery';

        return view('site.categories', compact('categories', 'pageTitle','headerStat','buttonsRoutsname','productsCount'));
    }

    public function productImages($id)
    {
        $categories = Category::find($id);
        $products = Product::where('category_id','=',$id)->get();
        $pageTitle = trans('main.site.products')." | ".$categories->name;
        $headerStat = 0;
        $buttonsRoutsname = $modelViewName = 'productImages';
        return view('site.products', compact('products','pageTitle','headerStat','buttonsRoutsname'));
    }

    public function addProductToCart(Request $request)
    {
        $product = new Cart();
        $product->product_id    = $request['product_id'];
        $product->count         = $request['count'];
        $product->userId        = $request['userId'];
        $product->productName   = $request['productName'];
        $product->price         = $request['price'];
        $product->desc          = $request['desc'];
        $product->image         = $request['image'];
        $product->discount      = $request['discount'];
        $product->priceInDisc   = $request['priceInDisc'];
        $product->totalPrice    = $product->priceInDisc * $product->count;

        $found = 0;
        $productsCount = count(Cart::where('product_id', '=',$product->product_id)
            ->where('userId', '=', Auth::user()->id)
            ->get());
        $flag = Cart::where('product_id', '=',$product->product_id)
            ->where('userId', '=', Auth::user()->id)
            ->first();
        if ($productsCount > 0){
            $found = 1;
            if ($flag){
                $flag->count ++;
                $flag->save();
            }else{
                $product->save();
            }
        }else{
            $found =  0;
            $check = Cart::where('product_id', '=',$product->product_id)
                ->where('userId', '=', Auth::user()->id)
                ->first();

            if ($check){
                $flag->count ++;
                $flag->save();
            }else{
                $product->save();
            }
        }

        return $found;



//        $product->save();
//        if ($product->save()){
//            swal()->button('Close Me')->message('تم','تم اضافة المنتج بنجاح','info');
//        }else{
//            swal()->button('Close Me')->message('Sorry !!','Your Process Faild !!','info');
//        }
    }

    public function cart()
    {
        $pageTitle = trans('main.site.cart');
        $headerStat = 0;
        $productsCount = Cart::all();
        $allProductsPrice = DB::table("cart")->get()->sum("totalPrice");
        $countAllOrder = Cart::all()->sum("price");
        $buttonsRoutsname = $modelViewName = 'cart';
        Cart::$productsCount;

        $cartProducts = DB::table('cart')
            ->join('users', 'users.id', '=', 'cart.userId')
            ->join('products','products.id','=','cart.product_id')
            ->select('*')
            ->where('cart.userId','=',Auth::user()->id)
            ->get();

        return view('site.cart',compact('cartProducts','pageTitle','headerStat','productsCount','countAllOrder','allProductsPrice','buttonsRoutsname'));
    }

    public function countUpdatePlus(Request $request)
    {
        $product = new Cart();
        $product->count = $request['count'];
        $inputValue = $_POST['inputValue'];
        $count_id = $_POST['count_id'];

        $flag = Cart::where('product_id', '=',$count_id)
            ->where('userId', '=', Auth::user()->id)
            ->first();

        if ($flag){
//            return 'test';
            $flag->count = $inputValue;
            $flag->totalPrice = $flag->priceInDisc * $flag->count;
            $flag->save();
        }else{
            $product->save();
        }
        return $inputValue ;
    }

    public function countUpdateMinus(Request $request)
    {
        $product = new Cart();
        $product->count = $request['count'];
        $inputValue = $_POST['inputValue'];
        $count_id = $_POST['count_id'];

        $flag = Cart::where('product_id', '=',$count_id)
            ->where('userId', '=', Auth::user()->id)
            ->first();

        if ($flag){
            $flag->count = $inputValue;
            $flag->totalPrice = $flag->priceInDisc * $flag->count;
            $flag->save();
        }else{
            $product->save();
        }
    }

    public function destroy($id)
    {
       Cart::where("product_id", '=',$id)->first()->delete();
    }

    public function rating(Request $request)
    {
        $product = new Product();
        $product->rate = $request['rate'];

        $cart = new Cart();
        $cart->rate = $request['rate'];

        $value = $_POST['value'];
        $dataId = $_POST['dataId'];

        $ratingProduct = Product::where('id', '=',$dataId)
            ->first();

        $ratingCart = Cart::where('product_id', '=',$dataId)
            ->first();

        if ($ratingProduct || $ratingCart){
            $ratingProduct->rate = $value;
            $ratingProduct->save();

            if ($ratingCart){
                $ratingCart->rate = $value;
                $ratingCart->save();
            }
        }else{
            $product->save();
            $cart->save();
        }
        return $value;
    }

    public function payment()
    {
        $pageTitle = trans('main.site.payment');
        $headerStat = 0;
        $buttonsRoutsname = $modelViewName = 'payment';
        return view('site.payment',compact('pageTitle','headerStat','buttonsRoutsname'));
    }

    function search(Request $request)
    {
//        return 'test';
        if($request->ajax())
        {
            $query = $request->get('query');
            if($query != '')
            {
                $data = DB::table('products')
                    ->where('name', 'like', '%'.$query.'%')
                    ->orWhere('desc', 'like', '%'.$query.'%')
                    ->orderBy('code', 'desc')
                    ->get();

            }
            else
            {
                $data = DB::table('products')
                    ->orderBy('code', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if($total_row > 0) {
                return $data;
            }else{
                return 'no data';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }

    function vote(Request $request)
    {
        $value = $_POST['value'];
        $dataId = $_POST['dataId'];

        $vote = new Vote();
        $productVote = Vote::where('product_id', '=', $dataId)
//            ->where('user_voting', '=', Auth::user()->id)
            ->first();

        if ($productVote){
            $productVote->vote = $value;
            if ($value == 1){
                $productVote->one ++;
                if ($productVote->two > 0 && $productVote->three > 0 && $productVote->four > 0 && $productVote->five > 0){
                    $productVote->two --;
                    $productVote->three --;
                    $productVote->four --;
                    $productVote->five --;
                }
            }elseif ($value == 2){
                $productVote->two++;
                if ($productVote->one > 0 && $productVote->three > 0 && $productVote->four > 0 && $productVote->five > 0) {
                    $productVote->one--;
                    $productVote->three--;
                    $productVote->four--;
                    $productVote->five--;
                }
            }elseif ($value == 3){
                $productVote->three++;
                if ($productVote->two > 0 && $productVote->one > 0 && $productVote->four > 0 && $productVote->five > 0) {
                    $productVote->two--;
                    $productVote->one--;
                    $productVote->four--;
                    $productVote->five--;
                }
            }elseif ($value == 4){
                $productVote->four++;
                if ($productVote->two > 0 && $productVote->three > 0 && $productVote->one > 0 && $productVote->five > 0) {
                    $productVote->two--;
                    $productVote->one--;
                    $productVote->three--;
                    $productVote->five--;
                }
            }else{
                $productVote->five++;
                if ($productVote->two > 0 && $productVote->three > 0 && $productVote->four > 0 && $productVote->five > 0) {
                    $productVote->two--;
                    $productVote->one--;
                    $productVote->three--;
                    $productVote->four--;
                }
            }
            $productVote->save();
        }else{
            $vote->product_id = $request['dataId'];
            $vote->user_voting = Auth::user()->id;
            $vote->vote = $request['value'];
            if ($value == 1){
                $vote->one ++;
            }elseif ($value == 2){
                $vote->two ++;
            }elseif ($value == 3){
                $vote->three ++;
            }elseif ($value == 4){
                $vote->four ++;
            }else{
                $vote->five ++;
            }
            $vote->save();
        }
    }

    public function viewVote(Request $request)
    {
        $product_id = $request['dataId'];
        $voteProduct = Vote::where('product_id', '=',$product_id)->first();
        return $voteProduct;
    }

    public function viewProductInCart(Request $request)
    {
        $id = $request['dataId'];
        $flag = Cart::where('product_id', '=',$id)->get();
        return $flag;
    }

    public function viewSearchResult(Request $request)
    {
//        return 'test';
        if ($request != ""){
            $product = DB::table('products')
                ->where('name', 'like', '%'.$request.'%')
                ->orWhere('desc', 'like', '%'.$request.'%')
                ->orderBy('code', 'desc')
                ->get();

        }
        else
        {
            $product = DB::table('products')
                ->orderBy('code', 'desc')
                ->get();
        }


        $headerStat = 0;
        $pageTitle = trans('main.site.search_result');
        $buttonsRoutsname = $modelViewName = 'search';
        return view('site.search.index',compact('product','headerStat','pageTitle','buttonsRoutsname'));
    }

    public function about_us()
    {
        $headerStat = 0;
        $pageTitle = trans('main.site.about_us');
        $buttonsRoutsname = $modelViewName = 'about_us';
        return view('site.about_us.index',compact('pageTitle','headerStat','buttonsRoutsname'));
    }

    public function contact_us()
    {
        $headerStat = 0;
        $pageTitle = trans('main.site.contact_us');
        $buttonsRoutsname = $modelViewName = 'contact_us';
        return view('site.contact_us.index',compact('pageTitle','headerStat','buttonsRoutsname'));
    }

    public function services()
    {
        $headerStat = 0;
        $pageTitle = trans('main.site.services');
        $buttonsRoutsname = $modelViewName = 'services';
        return view('site.services.index',compact('pageTitle','headerStat','buttonsRoutsname'));
    }
}
