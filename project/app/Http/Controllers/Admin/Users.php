<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BackEndController;
use App\models\User;
use App\models\Group;
use App\Http\Requests\BackEnd\User\Store as UserStore;
use App\Http\Requests\BackEnd\User\Update as UserUpdate;
class Users extends BackEndController
{
    public function __construct(User $model){
       return Parent::__construct($model);
    }

    public function store(UserStore $request)
    {
        // return public_path('images');
//        $row = $this->model;
        $user = new user();

        $user->name     =$request->input('name');
        $user->email    =$request->input('email');
        $user->phone    =$request->input('phone');
        $user->address  =$request->input('address');
        $user->desc     =$request->input('desc');
        $user->password =$request->input('password');
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('images'),$filename);
            $request->image = $filename;
            $user->image = $request->image;
        }else{
            $user->image = 'avatar.png';
        }
        $user->group_id = $request->input('group_id');
//        dd($user);
        if(isset($user->password) && $user->password != ""){
            $user->password = bcrypt($request['password']);
        }else{
            unset($request['password']);
        }
        $user->save();
        if($user->save()){
            swal()->button('Close Me')->message('تم','تم اضافة مستخدم بنجاح','info');
        }else{
            swal()->button('Close Me')->message('Sorry !!','Your Process Faild !!','info');
        }
        return redirect('backend/users');

    }

    public function show($id)
    {
        //
    }


    public function update(UserUpdate $request,$id)
    {
//        $row = $this->model->findOrFail($id);
        $user = user::find($id);

        $user->name     =$request->input('name');
        $user->email    =$request->input('email');
        $user->phone    =$request->input('phone');
        $user->address  =$request->input('address');
        $user->desc     =$request->input('desc');
        $user->password =$request->input('password');
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('images'),$filename);
            $request->image = $filename;
            $user->image = $request->image;
        }else{
            $user->image = 'avatar.png';
        }
        $user->group_id = $request->input('group_id');
        if(isset($user->password) && $user->password != ""){
            $user->password = bcrypt($request['password']);
        }else{
            unset($request['password']);
        }
//        dd($user);
        $user->save();
//
//
        if($user->save()){
            swal()->button('Close Me')->message('تم','تم تعديل البيانات بنجاح','info');
         }else{
            swal()->button('Close Me')->message('Sorry !!','Your Process Faild !!','info');
         }
        return redirect('backend/users/'.$id.'/profile');
    }

    public function profile($id)
    {
        $user = User::find($id);
        $PageTitle = trans('main.profile');
        $headerLevelProcessTitle1 = $PageTitle;
        $headerLevelProcessTitle2 = $user['name'];
        $buttonsRoutsname = $modelViewName = 'users';

        return View('Admin.users.profile',compact('user','PageTitle','buttonsRoutsname','headerLevelProcessTitle1','headerLevelProcessTitle2'));
    }

    function append(){
        $array = [
            'groups' => Group::all(),
        ];

        return $array;
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

