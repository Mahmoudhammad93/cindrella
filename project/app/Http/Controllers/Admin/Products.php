<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BackEndController;
use App\models\Product;
use App\models\Category;
use App\models\Unit;
use App\Http\Requests\BackEnd\Product\Store as ProductStore;
class Products extends BackEndController
{
    public function __construct(Product $model){
       return Parent::__construct($model);
    }

    public function store(ProductStore $request)
    {
//        $row = $this->model;
        $product = new Product();

        $product->code              = $request['code'];
        $product->name              = $request['name'];
        $product->category_id       = $request['category_id'];
        $product->unit_id           = $request['unit_id'];
        $product->desc              = $request['desc'];
        $product->sell_price        = $request['sell_price'];
        $product->pay_price         = $request['pay_price'];
        $product->discount          = $request['discount'];
        $product->quantity          = $request['quantity'];
        $product->alert_quantity    = $request['alert_quantity'];
        $product->expire_date       = $request['expire_date'];
        $product->priceInDisc       = $request['priceInDisc'];
        $flag = Product::where('code', '=',$product->code)->first();
        if($flag){
            swal()->button('Close Me')->message(trans('main.error').' !!',trans('main.this_code_isset').' !!','info');
            return redirect('backend/products');
        }else{
            if($request->hasfile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = $file->getClientOriginalName();
    //            $filename = time() . '.' . $extension;
                $file->move(public_path('images'),$filename);
                $request->image = $filename;
                $product->image = $request->image;
            }else{
                $product->image = 'avatar.png';
            }
    //        dd($row);
            if($request['code'] == ""){
                $request['code'] = rand();
            }

            $product->save();
            if($product->save()){
                swal()->button('Close Me')->message('تم','تم اضافة المنتج بنجاح','info');
            }else{
                swal()->button('Close Me')->message('Sorry !!','Your Process Faild !!','info');
            }
            return redirect('backend/products');
        }
    }

    public function show($id)
    {
        //
    }

    function append(){
        $array = [
            'categories' => Category::all(),
            'units' => Unit::all(),
        ];

        return $array;
    }


    public function update(ProductStore $request,$id)
    {
//        $row = $this->model->findOrFail($id);
        $product = Product::findOrFail($id);

        $product->code              = $request['code'];
        $product->name              = $request['name'];
        $product->category_id       = $request['category_id'];
        $product->unit_id           = $request['unit_id'];
        $product->desc              = $request['desc'];
        $product->sell_price        = $request['sell_price'];
        $product->pay_price         = $request['pay_price'];
        $product->discount          = $request['discount'];
        $product->quantity          = $request['quantity'];
        $product->alert_quantity    = $request['alert_quantity'];
        $product->expire_date       = $request['expire_date'];
        $product->priceInDisc       = $request['priceInDisc'];
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
//            $filename = time() . '.' . $extension;
            $file->move(public_path('images'),$filename);
            $request->image = $filename;
            $product->image = $request->image;
        }else{
            $product->image = 'avatar.png';
        }
        if($request['code'] == ""){
            $request['code'] = rand();

        }
        $product->update();
        if($product->update()){
            swal()->button('Close Me')->message('تم','تم تعديل المنتج بنجاح','info');
         }else{
            swal()->button('Close Me')->message('Sorry !!','Your Process Faild !!','info');
         }
        return redirect('backend/products');
    }

    protected function filter($rows,$filterData){
        foreach($filterData as $key => $value){
          if($value !=""){
            $rows = $rows->where($key,'like','%'.$value.'%');
          }
        }
        return $rows;
    }

    public function productCode()
    {
        $productCode = Product::all()->last();
        if ($productCode){
            return $productCode->code;
        }
    }

}
