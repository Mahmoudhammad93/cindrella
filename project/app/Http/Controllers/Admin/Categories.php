<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BackEndController;
use App\models\Category;
use App\Http\Requests\BackEnd\Category\Store as CategoryStore;
class Categories extends BackEndController
{
    public function __construct(Category $model){
       return Parent::__construct($model);
    }

    public function store(CategoryStore $request)
    {
//        $row = $this->model;
        $category = new Category();
        $category->name = $request['name'];
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('images'),$filename);
            $request->image = $filename;
            $category->image = $request->image;
        }else{
            return $request;
            $category->image = 'avatar.png';
        }

        $category->save();

        if($category->save()){
            swal()->button('Close Me')->message('تم','تمت عملية الاضافة بنجاح','info');
         }else{
            swal()->button('Close Me')->message('Sorry !!','Your Process Faild !!','info');
         }
        return redirect('backend/categories');

    }

    public function show($id)
    {
        //
    }


    public function update(CategoryStore $request,$id)
    {
//        $row = $this->model->findOrFail($id);
        $category = Category::find($id);
        $category->name = $request['name'];
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('images'),$filename);
            $request->image = $filename;
            $category->image = $request->image;
        }else{
            return $request;
            $category->image = 'avatar.png';
        }

        $category->update();

        if($category->update()){
            swal()->button('Close Me')->message('تم','تمت عملية التعديل بنجاح','info');
         }else{
            swal()->button('Close Me')->message('Sorry !!','Your Process Faild !!','info');
         }
        return redirect('backend/categories');
    }

    protected function filter($rows,$filterData){
        foreach($filterData as $key => $value){
          if($value !=""){
            $rows = $rows->where($key,'=',$value);
          }
        }
        return $rows;
    }

}

