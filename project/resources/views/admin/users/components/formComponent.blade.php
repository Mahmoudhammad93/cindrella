
<!-- inputForm ($lable,$inputAttrArrayAsKeyAndValue,$errors) -->
<!-- selectform($lable,$inputAtrrs,$value,$databind,$errors) -->
<div class="box-body">
@php

$input = "name";
inputForm('Name ( الاسم )',['type' => 'text', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "email";
inputForm('Email ( البريد الالكتروني )',['type' => 'email', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "phone";
inputForm('Phone ( رقم الهاتف )',['type' => 'number', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );


$input = "address";
inputForm('Address ( العنوان )',['type' => 'text', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "desc";
inputForm('Description ( تفاصيل ) ',['type' => 'text', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "password";
inputForm('Password ( كلمة السر )',['type' => 'password', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "group_id";
selectform("Group ( المجموعة ) ",[ 'class' => 'form-control','name' => $input ],isset($row->$input) ? $row->$input : '',$databind['groups'], isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : []);

$input = "image";
$fileLabel = "<label for='product-".$input."' class='label-file'><span> <i class='fa fa-camera'></i>Select Photo </span> <img src='".asset('images/default-image.png')."' id='image-field'> </label>";
inputFile('Image ( الصورة ) ', $fileLabel,['type' => 'file', 'step' => 'any' , 'id'=> 'product-'.$input,'class' => 'form-control image', 'onchange'=>'previewImage(event)','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

@endphp

</div>
<!-- /.box-body -->
<div class="box-footer">
<input id="edit_id" type="submit" class="btn btn-success" value="Save ( حفظ )">
</div>
