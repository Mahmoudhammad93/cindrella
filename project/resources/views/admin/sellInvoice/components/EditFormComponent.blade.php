
<!-- inputForm ($lable,$inputAttrArrayAsKeyAndValue,$errors) -->
<!-- selectform($lable,$inputAtrrs,$value,$databind,$errors) -->
<div class="box-body">
@php

$input = "code";
inputForm(trans('main.'.$input),['type' => 'text', 'class' => 'form-control','name' => $input ,'placeholder' => 'Code ( كود الفاتورة )','value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "date";
inputForm(trans('main.'.$input),['type' => 'date', 'class' => 'form-control','name' => $input ,'placeholder' => 'Date ( التفاصيل ) ','value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "supplier_id";
selectform(trans('main.supplier'),[ 'class' => 'form-control','name' => $input ],isset($row->$input) ? $row->$input : '',$databind['suppliers'], isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : []);

$input = "total_value";
inputForm(trans('main.'.$input),['type' => 'number', 'step' => 'any' ,'class' => 'form-control','name' => $input ,'readonly' =>'readonly' , 'id' => 'totale_price' , 'value' => $row->$input] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "total_gain";
inputForm(trans('main.'.$input),['type' => 'number', 'step' => 'any','class' => 'form-control','name' => $input ,'readonly' =>'readonly' , 'id' => 'totale_gain' , 'value' => $row->$input] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

@endphp

<input type="hidden" name="invoice_type" value="0" />

<h4 class="text-center" style="color: red;"> {{ trans('main.invoice_product') }} </h4>

<div id="AllProducts">
@php
$itrator = 0;
@endphp
@foreach($row->getInvoiceProducts as $item)
<div id="product{{ $itrator }}" style=" margin-top: 10px;border: 1px solid #BFBFBF; background-color: white;">

<div class="row">
    <div class='form-group col-md-12'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.code') }} </label>
        <div class='col-sm-12'>
            <input type="text" onchange='productInfoByCode({{ $itrator }})' id="code{{ $itrator }}" class="form-control" name="code{{ $itrator }}" value="{{$item->getProduct->code}}" placeholder="Code ( الكود )" />
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.category') }} </label>
        <div class='col-sm-12'>
            <select class='form-control' id="category{{ $itrator }}" name = "category_id0" onchange="categoryProducts(0,this.value)" >
                <option value="">-- {{ trans('main.select') }} {{ trans('main.category') }} --</option>
                @foreach($databind['categories'] as $cat)
                    @php
                        $selected = "";
                    @endphp

                    @if($cat->id == $item->getProduct->category_id)
                        @php
                            $selected = "selected";
                        @endphp
                    @endif
                    <option {{ $selected }} value="{{ $cat->id }}"> {{ $cat->name }} </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.product') }} </label>
        <div class='col-sm-12'>
            <select class='form-control' name = "product_id{{ $itrator }}" onchange="productsInfo({{ $itrator }},this.value)" id = "product_id{{ $itrator }}">
                <option value="">-- {{ trans('main.select') }} {{ trans('main.product') }} --</option>
                @foreach($databind['products'] as $product)
                    @php
                        $selected = "";
                    @endphp

                    @if($product->id == $item->product_id)
                        @php
                            $selected = "selected";
                        @endphp
                    @endif
                    <option {{ $selected }} value="{{ $product->id }}"> {{ $product->name }} </option>

                @endforeach
            </select>
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;" > {{ trans('main.quantity_avai') }} </label>
        <div class='col-sm-12'>
            <input readonly="readonly" id="avelablequantity{{ $itrator }}" type="number" step=any class="form-control" value="{{ $item->getProduct->quantity }}" placeholder=" {{ trans('main.quantity_avai') }} " />
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.quantity') }} </label>
        <div class='col-sm-12'>
            <input onchange="countTotalPrice({{ $itrator }})" value="{{ $item->quantity }}" id="quantity{{ $itrator }}" type="number" step=any class="form-control" name="quantity{{ $itrator }}" placeholder=" {{ trans('main.quantity') }} " />
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.unit') }} </label>
        <div class='col-sm-12'>
            <input id='unitdetails0' readonly='readonly' value="{{ $item->getProduct->getUnit->name }}" type='text' class='form-control' placeholder=" {{ trans('main.unit') }} " />
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;" > {{ trans('main.sell_price') }} </label>
        <div class='col-sm-12'>
            <input readonly="readonly" id="payprice{{ $itrator }}" value="{{ $item->pay_price }}" name="payprice{{ $itrator }}" type="number" step=any class="form-control" placeholder=" {{ trans('main.sell_price') }} " />
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.pay_price') }} </label>
        <div class='col-sm-12'>
            <input type="number" step=any value="{{ $item->sell_price }}" class="form-control" onchange="countTotalPrice({{ $itrator }})" id="sellprice{{ $itrator }}" name="sellprice{{ $itrator }}" placeholder=" {{ trans('main.pay_price') }} " />
        </div>
    </div>

    <input type='hidden' id='totaleGain{{ $itrator }}' name='total_gain{{ $itrator }}' value="{{ $item->total_gain }}" />

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.total_price') }} </label>
        <div class='col-sm-12'>
            <input type="number" step=any value="{{ $item->total_price }}" id="totalePrice{{ $itrator }}" readonly="readonly" class="form-control" name="total_price{{ $itrator }}" placeholder=" {{ trans('main.total_price') }} " />
        </div>
    </div>
</div>

<div class="row">
    <div class='form-group col-md-6'>
        <div class='col-sm-12'>
            @if($itrator == 0)
                <button type="button" disabled="disable" onclick='removeitemrow({{ $itrator }})' class="form-control btn btn-sm btn-danger col-sm-3">
                    <i class="fa fa-trash"></i>
                </button>
            @else
                <button type="button" onclick='removeitemrow({{ $itrator }})' class="form-control btn btn-sm btn-danger col-sm-3">
                    <i class="fa fa-trash"></i>
                </button>
            @endif
        </div>
    </div>

    <div class='form-group col-md-6'>

        <div class='col-sm-12'>
            <button type="button" onclick="addnewitem()" class="form-control btn btn-sm btn-info col-sm-3">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</div>

</div>
@php
 $itrator = $itrator + 1;
@endphp
@endforeach
<input type="hidden" id="itrator" value="{{ $itrator }}" name="itrator"/>
</div>

</div>
<!-- /.box-body -->
<div class="box-footer">
<div class='form-group col-md-3'>
    <div class='col-sm-12'>
      <select class="form-control" name="due">
         @if($row->due == 0)
          @php
          $select0 = "selected";
          $select1 = "";
          @endphp
         @else
          @php
          $select0 = "";
          $select1 = "selected";
          @endphp
         @endif
         <option {{ $select0 }} value="0"> تسديد الفاتورة </option>
         <option {{ $select1 }} value="1">  حفظ بدون تسديد </option>
      </select>
    </div>
</div>
<input id="edit_id" type="submit" class="btn btn-success" value="{{trans('main.save')}}">
</div>

<script>
  function countTotalPrice(itrator) {

      var rowTotal = $('#totalePrice'+itrator).val();
      var invoiceTotalPrice = $('#totale_price').val();
      invoiceTotalPrice = +invoiceTotalPrice - rowTotal;
      $('#totale_price').val(invoiceTotalPrice);

      var rowTotalGain = $('#totaleGain'+itrator).val();
      var invoiceTotalGain = $('#totale_gain').val();
      invoiceTotalGain = +invoiceTotalGain - rowTotalGain;
      $('#totale_gain').val(invoiceTotalGain);

      var quantity  = $('#quantity'+itrator).val();
      var sellprice  = $('#sellprice'+itrator).val();
      var payprice  = $('#payprice'+itrator).val();

      var total     = quantity * sellprice;
      var totalGain = quantity * (sellprice - payprice);
      $('#totalePrice'+itrator).val(total);
      $('#totaleGain'+itrator).val(totalGain);

      invoiceTotalPrice = $('#totale_price').val();
      invoiceTotalPrice = +invoiceTotalPrice + total;
      $('#totale_price').val(invoiceTotalPrice);

      invoiceTotalGain = $('#totale_gain').val();
      invoiceTotalGain = +invoiceTotalGain + totalGain;
      $('#totale_gain').val(invoiceTotalGain);

  }

  function addnewitem(){
      var itrator   = $('#itrator').val();
      itrator = +itrator + 1 ;
      var htmlOp = "<div id='product"+itrator+"' style=' margin-top: 10px;border: 1px solid #BFBFBF; background-color: white;'> <div class='row'><div class='form-group col-md-12'> <label style='margin-left: 15px;color:red;'> {{ trans('main.code') }} </label> <div class='col-sm-12'> <input type='text' onchange='productInfoByCode("+itrator+")' id='code"+itrator+"' class='form-control' name='code"+itrator+"' placeholder='{{ trans('main.code') }}' /> </div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;'> {{ trans('main.category') }} </label> <div class='col-sm-12'> <select class='form-control' id='category"+itrator+"' name = 'category_id"+itrator+"' onchange='categoryProducts("+itrator+",this.value)' > <option value=''>-- {{ trans('main.select') }} {{ trans('main.category') }} --</option> @foreach($databind['categories'] as $cat) <option  value='{{ $cat->id }}'> {{ $cat->name }} </option> @endforeach </select></div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;'> {{ trans('main.product') }} </label> <div class='col-sm-12'> <select class='form-control' onchange='productsInfo("+itrator+",this.value)'  name = 'product_id"+itrator+"' id='product_id"+itrator+"'><option value=''>-- {{ trans('main.select') }} {{ trans('main.category') }} {{ trans('main.first') }}  --</option></select> </div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;' > ِ{{ trans('main.quantity_avai') }} </label> <div class='col-sm-12'> <input readonly='readonly' id='avelablequantity"+itrator+"' type='number' step=any class='form-control' placeholder=' {{ trans('main.quantity_avai') }} ' /> </div> </div><div class='form-group col-md-3'><label style='margin-left: 15px;color:red;'> {{ trans('main.quantity') }} </label> <div class='col-sm-12'> <input onchange='countTotalPrice("+itrator+")' id='quantity"+itrator+"' type='number' step=any class='form-control' name='quantity"+itrator+"' placeholder=' {{ trans('main.quantity') }} ' /> </div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;'> {{ trans('main.unit') }} </label> <div class='col-sm-12'> <input id='unitdetails"+itrator+"' readonly='readonly' type='text' class='form-control' placeholder=' {{ trans('main.unit') }} ' /> </div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;' > {{ trans('main.sell_price') }} </label> <div class='col-sm-12'> <input readonly='readonly' id='payprice"+itrator+"' name='payprice"+itrator+"' type='number' step=any class='form-control' placeholder=' {{ trans('main.sell_price') }} ' /> </div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;'> {{ trans('main.pay_price') }} </label> <div class='col-sm-12'><input type='number' step=any class='form-control' onchange='countTotalPrice("+itrator+")' id='sellprice"+itrator+"' name='sellprice"+itrator+"' placeholder=' {{ trans('main.pay_price') }} ' /> </div> </div> <input type='hidden' id='totaleGain"+itrator+"' name='total_gain"+itrator+"' /> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;'> {{ trans('main.total_price') }} </label> <div class='col-sm-12'> <input type='number' step=any id='totalePrice"+itrator+"' readonly='readonly' class='form-control' name='total_price"+itrator+"' placeholder=' {{ trans('main.total_price') }} ' /> </div> </div> </div><div class='row'><div class='form-group col-md-6'> <div class='col-sm-12'> <button onclick='removeitemrow("+itrator+")' type='button' class='form-control btn btn-sm btn-danger col-sm-3'><i class='fa fa-trash'></i></button> </div> </div> <div class='form-group col-md-6'><div class='col-sm-12'> <button type='button' onclick='addnewitem()' class='form-control btn btn-sm btn-info col-sm-3'><i class='fa fa-plus'></i></button> </div> </div> </div></div>";
      $('#AllProducts').append(htmlOp);
      var itrator   = $('#itrator').val(itrator);
  }

  function removeitemrow(itrator){

    var rowTotal = $('#totalePrice'+itrator).val();
    var rowTotalGain = $('#totaleGain'+itrator).val();

      $('#product'+itrator).remove();

      var invoiceTotalPrice = $('#totale_price').val();
      invoiceTotalPrice = +invoiceTotalPrice - rowTotal;
      $('#totale_price').val(invoiceTotalPrice);

      var invoiceTotalGain = $('#totale_gain').val();
      invoiceTotalGain = +invoiceTotalGain - rowTotalGain;
      $('#totale_gain').val(invoiceTotalGain);
  }

  function productsInfo(formProNum , ProId){
    var itrator = $('#itrator').val();
    var i ;
    for( i = 0 ; i < itrator ; i++ ){
      var latproduct = $('#product_id'+i).val();
      if(ProId == latproduct){
          alert('هذا الصنف مضاف مسبقا') ; return ;
      }
     }
     var csrfToken = '{{csrf_token()}}';
     $.ajax({
         url      : "{{route('getProductInfo')}}",
         type     : 'POST',
         dataType : 'JSON',
         data     :  {_token: csrfToken, ProId: ProId},
         success: function (data) {
        if (data) {
            $('#payprice'+formProNum).val(data.sell_price);
            $('#avelablequantity'+formProNum).val(data.quantity);
            $('#unitdetails'+formProNum).val(data.get_unit.name);
            $('#sellprice'+formProNum).val(data.pay_price);

         }
        }
     });
  }

  function categoryProducts(formProNum , catId){
    $('#product_id'+formProNum).html("<option value=''>-- Select Product ( الصنف ) --</option>");
     var csrfToken = '{{csrf_token()}}';
     $.ajax({
         url      : "{{route('getCategoryProducts')}}",
         type     : 'POST',
         dataType : 'JSON',
         data     :  {_token: csrfToken, catId: catId},
         success: function (data) {
        if (data) {
            data.forEach(productsDisplayFunction.bind(null, formProNum)) ;
         }
        }
     });
  }

  function productInfoByCode(formProNum){
      var code = $('#code'+formProNum).val();

      $('#unitdetails'+formProNum).val("");
      $('#payprice'+formProNum).val("");
      $('#category'+formProNum).val("");
      $('#product_id'+formProNum).val("");
      $('#avelablequantity'+formProNum).val("");
      $('#sellprice'+formProNum).val("");

      var itrator = $('#itrator').val();
      var i ;
      for( i = 0 ; i < itrator ; i++ ){
        var latcode = $('#code'+i).val();
        if(code == latcode){
          alert('هذا الصنف مضاف مسبقا') ; return ;
       }
     }

     var csrfToken = '{{csrf_token()}}';
     $.ajax({
         url      : "{{route('getProductInfoByCode')}}",
         type     : 'POST',
         dataType : 'JSON',
         data     :  {_token: csrfToken, code: code},
         success: function (data) {
            if (data.id) {
                var unitVal = data.get_unit.name;
                $('#unitdetails'+formProNum).val(unitVal);
                $('#payprice'+formProNum).val(data.sell_price);
                $('#category'+formProNum).val(data.category_id);
                $('#avelablequantity'+formProNum).val(data.quantity);
                $('#sellprice'+formProNum).val(data.pay_price);

                data.catProducts.forEach(productsDisplayFunction.bind(null, formProNum)) ;
                $('#product_id'+formProNum).val(data.id);

            }else{
                alert("هذا المنتج غير موجود ");
            }
        }
     });
  }


  function productsDisplayFunction(formProNum,item){
    options = " <option value='"+item.id+"'> "+item.name+" </option> ";
    $('#product_id'+formProNum).append(options);
  }

</script>
