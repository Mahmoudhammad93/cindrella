<?php

Route::get('/lang/{lang}', function ($lang){
//    dd("jdfdf");
    if (in_array($lang, ['ar','en'])){
        if (auth()->user()){
//            dd($lang);
            $user = auth()->user();
            $user->lang = $lang;
            $user->save();
        }else{
            if (session()->has('lang')){
                session()->forget();
            }
            session()->put('lang',$lang);
        }
    }else{
        if (auth()->user()){
            $user = auth()->user();
            $user->lang = 'en';
            $user->save();
        }else{
            if (session()->has('lang')){
                session()->forget();
            }
        }
        session()->put('lang','en');
    }
    return back();
});

Auth::routes();
Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/home',function () {
    return redirect()->route('dashboard.index');
})->name('home');

// Web Site Routes
Route::get('/site/home', 'Admin\SiteController@index');
Route::prefix('site')->middleware('auth')->group(function (){

    // To Get Element Page Route
    Route::get('element', 'Admin\SiteController@getElements');

    // To Get Generic Page Route
    Route::get('generic', 'Admin\SiteController@getGeneric');

    // To Get Products Page Route
    Route::get('products', 'Admin\SiteController@products');

    // To Get Product Details Route
    Route::get('product/{id}/details', 'Admin\SiteController@productDetails');

    // To Get Categories Page Route
    Route::get('categories', 'Admin\SiteController@categories');

    // To Get One Product From Categories Route
    Route::get('products/{id}', 'Admin\SiteController@getProductsFromCate');

    // To Get Products By Categories Route
    Route::get('getProduct', 'Admin\SiteController@getProducts')->name('getProduct');

    // To Get Gallery Page Route
    Route::get('gallery', 'Admin\SiteController@gallery');

    // To Get Product Image Route
    Route::get('product/images/{id}', 'Admin\SiteController@productImages');

    // To Add Product In Cart Route
    Route::post('addProductToCart', 'Admin\SiteController@addProductToCart')->name('addProductToCart');

    // To Get Cart Page Route
    Route::get('cart', 'Admin\SiteController@cart');

    // To Get Count And Update Route
    Route::post('countUpdatePlus', 'Admin\SiteController@countUpdatePlus')->name('countUpdatePlus');

    // To Get Count And Update Route
    Route::post('countUpdateMinus', 'Admin\SiteController@countUpdateMinus')->name('countUpdateMinus');

    // To Delete Product From Cart
    Route::delete('site/product/{id}/destroy', 'Admin\SiteController@destroy');

    // To put a feedback or rating
    Route::post('rating', 'Admin\SiteController@rating')->name('rating');

    // To Get Complete Order Page
    Route::get('cart/payment', 'Admin\SiteController@payment')->name('cart.payment');

    // Search Route
    Route::get('search', 'Admin\SiteController@search')->name('search');

    // To make vote
    Route::post('vote', 'Admin\SiteController@vote')->name('vote');

    // To view Vote
    Route::get('viewVote', 'Admin\SiteController@viewVote')->name('viewVote');

    // To View Product in Cart
    Route::get('viewProductInCart', 'Admin\SiteController@viewProductInCart')->name('viewProductInCart');

    // To Submit Search
    Route::get('result/search', 'Admin\SiteController@viewSearchResult')->name('result/search');

    // To View About Us Page
    Route::get('about_us', 'Admin\SiteController@about_us');

    // To View Contact Us Page
    Route::get('contact_us', 'Admin\SiteController@contact_us');

    // To View Services Page
    Route::get('services', 'Admin\SiteController@services');
});

// Admin Panel Routes
Route::namespace('Admin')->prefix('backend')->middleware('auth')->group(function(){

    Route::get('dashboard','Dashboard@index')->name('dashboard.index');

    // Groups Routes
    Route::resource('groups','Groups');
    Route::post('groups/print','Groups@print')->name('groups.print');

    // Users Routes
    Route::resource('users','Users');
    Route::post('users/print','Users@print')->name('users.print');
    Route::get('users/{id}/profile','Users@profile')->name('users.profile');

    // suppliers Routes
    Route::resource('suppliers','Suppliers');
    Route::post('suppliers/print','Suppliers@print')->name('suppliers.print');
    Route::get('suppliers/{id}/profile','Suppliers@profile')->name('suppliers.profile');
    Route::post('suppliers/savebalance','Suppliers@saveBalance')->name('suppliers.saveBalance');

    // Box Routes
    Route::resource('boxes','Boxs');
    Route::post('boxes/print','Boxs@print')->name('boxes.print');

    // Categories Routes
    Route::resource('categories','Categories');
    Route::post('categories/print','Categories@print')->name('categories.print');

    // UNITS Routes
    Route::resource('units','Units');
    Route::post('units/print','Units@print')->name('units.print');

    // products Routes
    Route::resource('products','Products');
    Route::post('products/print','Products@print')->name('products.print');
    Route::get('productCode', 'Products@productCode')->name('productCode');

    // OtherInvoices Routes
    Route::resource('otherinvoices','OtherInvoices');
    Route::post('otherinvoices/print','OtherInvoices@print')->name('otherinvoices.print');


    // purchaseInvoice Routes
    Route::get('PurchaseInvoice/List','PurchaseInvoice@index')->name('purchaseInvoice.index');
    Route::get('PurchaseInvoice/Create','PurchaseInvoice@create')->name('purchaseInvoice.create');
    Route::get('PurchaseInvoice/{id}/Edit','PurchaseInvoice@edit')->name('purchaseInvoice.edit');
    Route::post('PurchaseInvoice/Add','PurchaseInvoice@store')->name('purchaseInvoice.store');
    Route::put('PurchaseInvoice/{id}/Update','PurchaseInvoice@update')->name('purchaseInvoice.update');
    Route::delete('PurchaseInvoice/{id}/Delet','PurchaseInvoice@destroy')->name('purchaseInvoice.delete');
    Route::post('PurchaseInvoice/print','PurchaseInvoice@print')->name('PurchaseInvoice.print');
    Route::get('PurchaseInvoice/{id}/singleInvoice','PurchaseInvoice@show')->name('purchaseInvoice.show');
    Route::get('PurchaseInvoice/{id}/printSingleInvoice','PurchaseInvoice@printSingleInvoice')->name('purchaseInvoice.printSingleInvoice');
    Route::post('getCategoryProducts','PurchaseInvoice@getCategoryProducts')->name('getCategoryProducts');
    Route::get('purchaseCode','PurchaseInvoice@purchaseCode')->name('purchaseCode');

    // sellInvoice Routes
    Route::get('sellInvoice/List','SellInvoice@index')->name('sellInvoice.index');
    Route::get('sellInvoice/Create','SellInvoice@create')->name('sellInvoice.create');
    Route::get('sellInvoice/{id}/Edit','SellInvoice@edit')->name('sellInvoice.edit');
    Route::post('sellInvoice/Add','SellInvoice@store')->name('sellInvoice.store');
    Route::put('sellInvoice/{id}/Update','SellInvoice@update')->name('sellInvoice.update');
    Route::delete('sellInvoice/{id}/Delet','SellInvoice@destroy')->name('sellInvoice.delete');
    Route::post('sellInvoice/print','SellInvoice@print')->name('sellInvoice.print');
    Route::get('sellInvoice/{id}/singleInvoice','SellInvoice@show')->name('sellInvoice.show');
    Route::get('sellInvoice/{id}/printSingleInvoice','SellInvoice@printSingleInvoice')->name('sellInvoice.printSingleInvoice');
    Route::post('ajaxgetProductInfo','SellInvoice@getProductInfo')->name('getProductInfo');
    Route::post('ajaxgetProductInfoByCode','SellInvoice@getProductInfoByCode')->name('getProductInfoByCode');
    Route::get('totalgainindex','SellInvoice@totalgainindex')->name('totalgainindex.index');
    Route::get('invoiceCode','SellInvoice@invoiceCode')->name('invoiceCode');

    // Students Routs
    Route::resource('students','StudentController');
    Route::post('students/print','StudentController@print')->name('students.print');

    // Offers Routes
    Route::resource('offers','Offers');
    Route::post('offers/print','Offers@print')->name('offers.print');

});

// Pages Payment
Route::get('/payment', 'Admin\\PaymentController@index')->name('home.payment');
Route::post('/payment/store', 'Admin\\PaymentController@store')->name('payment.store');
Route::post('/payment/{payment}/update', 'Admin\\PaymentController@update')->name('payment.update');
