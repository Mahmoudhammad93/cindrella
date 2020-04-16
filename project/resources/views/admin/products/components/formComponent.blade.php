<!-- inputForm ($lable,$inputAttrArrayAsKeyAndValue,$errors) -->
<!-- selectform($lable,$inputAtrrs,$value,$databind,$errors) -->
<div class="box-body">
    <div class="box-footer">
        <button id="new" class="btn btn-success">
            New ( جديد )
        </button>
    </div>
@php

$input = "code";
inputForm(trans('main.'.$input.''),['type' => 'text', 'class' => 'form-control','name' => $input ,'placeholder' => trans('main.enter').' '.trans('main.'.$input.'') ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "name";
inputForm(trans('main.'.$input.''),['type' => 'text', 'class' => 'form-control','name' => $input ,'placeholder' => trans('main.enter').' '.trans('main.'.$input.'') ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "category_id";
selectform(trans('main.category'),[ 'class' => 'form-control','name' => $input ],isset($row->$input) ? $row->$input : '',$databind['categories'], isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : []);

$input = "unit_id";
selectform(trans('main.unit'),[ 'class' => 'form-control','name' => $input ],isset($row->$input) ? $row->$input : '',$databind['units'], isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : []);

$input = "desc";
inputForm(trans('main.'.$input.''),['type' => 'text' , 'class' => 'form-control','name' => $input ,'placeholder' => trans('main.enter').' '.trans('main.'.$input.'') ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "sell_price";
inputForm(trans('main.'.$input.''),['type' => 'number','step' => 'any' ,'class' => 'form-control','name' => $input ,'placeholder' => trans('main.enter').' '.trans('main.'.$input.'') ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "addition_value";
inputForm(trans('main.'.$input.''),['type' => 'number','step' => 'any' ,'class' => 'form-control','name' => $input ,'placeholder' => trans('main.enter').' '.trans('main.'.$input.'') ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "pay_price";
inputForm(trans('main.'.$input.''),['type' => 'number','step' => 'any' ,'class' => 'form-control','name' => $input ,'placeholder' => trans('main.enter').' '.trans('main.'.$input.'') ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "discount";
inputForm(trans('main.'.$input.''),['type' => 'number','step' => 'any' ,'class' => 'form-control','name' => $input ,'placeholder' => trans('main.enter').' '.trans('main.'.$input.'') ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "priceInDisc";
inputForm(trans('main.'.$input.''),['type' => 'number', 'step' => 'any' ,'class' => 'form-control','name' => $input ,'placeholder' => trans('main.enter').' '.trans('main.'.$input.'') ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "quantity";
inputForm(trans('main.'.$input.''),['type' => 'number', 'step' => 'any' ,'class' => 'form-control','name' => $input ,'placeholder' => trans('main.enter').' '.trans('main.'.$input.'') ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "alert_quantity";
inputForm(trans('main.'.$input.''),['type' => 'number', 'step' => 'any' ,'class' => 'form-control','name' => $input ,'placeholder' => trans('main.enter').' '.trans('main.'.$input.'') ,'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "expire_date";
$date = date('Y-m-d');
inputForm('',['type' => 'hidden', 'class' => 'form-control','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => $date] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );


$input = "image";
$issetRow = '';

if (isset($row->$input)){
    $issetRow = asset('images/'.$row->$input);
}else{
    $issetRow = asset('images/default-image.png');
}

$fileLabel = "<label for='product-".$input."' class='label-file'><span> <i class='fa fa-camera'></i>Select Photo </span> <img src='".$issetRow."' id='image-field'> </label>";
inputFile(trans('main.image'), $fileLabel,['type' => 'file', 'step' => 'any' , 'id'=> 'product-'.$input,'class' => 'form-control image', 'onchange'=>'previewImage(event)','name' => $input ,'placeholder' => 'Enter '.$input ,'value' => isset($row->$input)? $row->$input : $issetRow] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

@endphp

</div>
<!-- /.box-body -->
<div class="box-footer">
<input id="edit_id" type="submit" class="btn btn-success" value="Save ( حفظ )">
</div>
<script>
    $(document).on('click', '#new',function () {
        // Ajax To get last code and put new code
        $.ajax({
            url: "{{ route('productCode') }}",
            type: "GET",
            success:function (data) {
                console.log(data);
                if (data){
                    var code = parseInt(data) + 1;
                    $('input[name=code]').val(code);
                }else {
                    $('input[name=code]').val(1);
                }
                $('input[name=code]').attr('readonly','readonly')
            }
        });
        return false;
    });
    /*
    -For count Addition Value from price and show price in sell price
    in field price in sell price when change in sell price field
    or change in price field
    */
    var payPrice = $('input[name=pay_price]');
    $(document).on('keyup change','input[name=addition_value], input[name=sell_price]',function () {

        var sellPrice = parseInt($('input[name=sell_price]').val()),
            addValue = parseInt($('input[name=addition_value]').val());

        payPrice.val(sellPrice + ((sellPrice * addValue) / 100));
    });

    /*
    -For count discount from price and show price in discount
    in field price in discount when change in discount field
    or change in price field
    */
    var inputInDisc = $('input[name=priceInDisc]');
    $(document).on('keyup change','input[name=discount], input[name=sell_price]',function () {

        var inputPrice = $('input[name=pay_price]').val(),
            inputDisc = $('input[name=discount]').val();
        var price = parseInt(inputPrice) + 10;
        console.log((inputPrice * inputDisc) / 100);
        inputInDisc.val(inputPrice - ((inputPrice * inputDisc) / 100));
    });
</script>
