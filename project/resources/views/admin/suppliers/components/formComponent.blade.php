
<!-- inputForm ($lable,$inputAttrArrayAsKeyAndValue,$errors) -->
<!-- selectform($lable,$inputAtrrs,$value,$databind,$errors) -->
<div class="box-body">
@php

$input = "name";
inputForm('Name ( الاسم )',['type' => 'text', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "type";
selectform("Type ( النوع )",[ 'class' => 'form-control','name' => $input ],isset($row->$input) ? $row->$input : '',$databind['types'], isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : []);

$input = "address";
inputForm('Address ( العنوان )',['type' => 'text', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "phone";
inputForm('Phone ( رقم الهاتف )',['type' => 'number', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "notes";
inputForm('Notes ( ملاحظات )',['type' => 'text', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "image";
$fileLabel = "<label for='product-".$input."' class='label-file'><span> <i class='fa fa-camera'></i>Select Photo </span> <img src='".asset('images/default-image.png')."' id='image-field'> </label>";
inputFile('Image ( الصورة ) ', $fileLabel,['type' => 'file', 'step' => 'any' , 'id'=> 'product-'.$input,'class' => 'form-control image', 'onchange'=>'previewImage(event)','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

@endphp

</div>
<!-- /.box-body -->
<div class="box-footer">
<input id="edit_id" type="submit" class="btn btn-success" value="Save ( حفظ )">
</div>
