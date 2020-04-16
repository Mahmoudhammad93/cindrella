
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
inputForm(trans('main.'.$input),['type' => 'number', 'step'=>'any' ,'class' => 'form-control','name' => $input ,'readonly' =>'readonly' , 'id' => 'totale_price' , 'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

@endphp

<input type="hidden" name="invoice_type" value="0" />

<h4 class="text-center" style="color: red;"> {{trans('main.invoice_product')}} </h4>

<div id="AllProducts">
@php
$itrator = 0;
@endphp
@foreach($row->getInvoiceProducts as $item)
<div id="product{{ $itrator }}" style="margin-top: 10px;border: 1px solid #BFBFBF; background-color: white;">

<div class="row">
    <div class='form-group col-md-12'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.code') }} </label>
        <div class='col-sm-12'>
            <input type="text" onchange='productInfoByCode({{ $itrator }})' id="code{{ $itrator }}" class="form-control" name="code{{ $itrator }}" value="{{$item->getProduct->code}}" placeholder="{{ trans('main.code') }}" />
        </div>
    </div>


    <div class='form-group col-md-2'>
        @if($itrator == 0 ) <label style="margin-left: 15px;color:red;"> {{ trans('main.category') }} </label> @endif
        <div class='col-sm-12'>
            <select class='form-control' id="category{{ $itrator }}" name = "category_id{{ $itrator }}" onchange="categoryProducts({{ $itrator }},this.value)" >
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

                    <option  {{ $selected }} value="{{ $cat->id }}"> {{ $cat->name }} </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class='form-group col-md-2'>
        @if($itrator == 0)  <label style="margin-left: 15px;color:red;"> {{ trans('main.product') }} </label> @endif
        <div class='col-sm-12'>
            <select class='form-control'name = "product_id{{ $itrator }}" id='product_id{{ $itrator }}'>

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

    <div class='form-group col-md-2'>
        @if($itrator == 0) <label style="margin-left: 15px;color:red;"> {{ trans('main.quantity') }} </label> @endif
        <div class='col-sm-12'>
            <input onchange="countTotalPrice({{ $itrator }})" value="{{ $item->quantity }}" id="quantity{{ $itrator }}" type="number" step=any class="form-control" name="quantity{{ $itrator }}" placeholder=" {{ trans('main.quantity') }} " />
        </div>
    </div>

    <div class='form-group col-md-2'>
        @if($itrator == 0 ) <label style="margin-left: 15px;color:red;"> {{ trans('main.unit') }} </label> @endif
        <div class='col-sm-12'>
            <input id='unitdetails0' readonly='readonly' type='text' class='form-control' placeholder=" {{ trans('main.unit') }} " value='{{ $item->getProduct->getUnit->name }}' />
        </div>
    </div>

    <div class='form-group col-md-2'>
        @if($itrator == 0) <label style="margin-left: 15px;color:red;"> {{ trans('main.pay_price') }} </label> @endif
        <div class='col-sm-12'>
            <input type="number" step=any class="form-control" value="{{ $item->pay_price }}" onchange="countTotalPrice({{ $itrator }})" id="payprice{{ $itrator }}" name="payprice{{ $itrator }}" placeholder=" {{ trans('main.pay_price') }} " />
        </div>
    </div>

    <div class='form-group col-md-2'>
        @if($itrator == 0) <label style="margin-left: 15px;color:red;"> {{ trans('main.total_price') }} </label> @endif
        <div class='col-sm-12'>
            <input type="number" step=any id="totalePrice{{ $itrator }}" readonly="readonly" class="form-control" name="total_price{{ $itrator }}" placeholder=" {{ trans('main.total_price') }} " value="{{ $item->total_price }}" />
        </div>
    </div>
</div>

    <div class="row">
        <div class='form-group col-md-6'>
            <div class='col-sm-12'>
                @if($itrator == 0)
                    <button type="button" disabled="disable" onclick='removeitemrow({{ $itrator }})' class="form-control btn btn-sm btn-danger col-sm-3"> <i class="fa fa-trash"></i> </button>
                @else
                    <button type="button" onclick='removeitemrow({{ $itrator }})' class="form-control btn btn-sm btn-danger col-sm-3"> <i class="fa fa-trash"></i> </button>
                @endif
            </div>
        </div>

        <div class='form-group col-md-6'>
            <div class='col-sm-12'>
                <button type="button" onclick="addnewitem()" class="form-control btn btn-sm btn-info col-sm-3">  <i class="fa fa-plus"></i> </button>
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

      var quantity  = $('#quantity'+itrator).val();
      var payprice  = $('#payprice'+itrator).val();
      var total     = quantity * payprice;
      $('#totalePrice'+itrator).val(total);

      invoiceTotalPrice = $('#totale_price').val();
      invoiceTotalPrice = +invoiceTotalPrice + total;
      $('#totale_price').val(invoiceTotalPrice);

  }

  function addnewitem(){
      var itrator   = $('#itrator').val();
      itrator = +itrator + 1 ;
      var htmlOp = " <div id='product"+itrator+"' style=' margin-top: 10px;border: 1px solid #BFBFBF; background-color: white;' ><div class='row'> <div class='form-group col-md-12'> <div class='col-sm-12'> <input type='text' onchange='productInfoByCode("+itrator+")' id='code"+itrator+"' class='form-control' name='code"+itrator+"' placeholder='{{trans('main.code')}}' /> </div> </div> <div class='form-group col-md-2'><div class='col-sm-12'> <select class='form-control' id='category"+itrator+"' name = 'category_id"+itrator+"' onchange='categoryProducts("+itrator+",this.value)' > <option value=''>-- {{trans('main.select')}} {{trans('main.category')}} --</option> @foreach($databind['categories'] as $cat) <option  value='{{ $cat->id }}'> {{ $cat->name }} </option>  @endforeach </select>  </div> </div> <div class='form-group col-md-2'><div class='col-sm-12'><select class='form-control' id='product_id"+itrator+"' onchange='productsInfo("+itrator+",this.value)' id='product_id"+itrator+"' name = 'product_id"+itrator+"'> @foreach($databind['products'] as $product) <option  value='{{ $product->id }}'> {{ $product->name }} </option> @endforeach </select></div></div><div class='form-group col-md-2'><div class='col-sm-12'><input onchange='countTotalPrice("+itrator+")' id='quantity"+itrator+"' type='number' step=any class='form-control' name='quantity"+itrator+"' placeholder=' {{trans('main.quantity')}} ' /></div></div> <div class='form-group col-md-2'> <div class='col-sm-12'> <input id='unitdetails"+itrator+"' readonly='readonly' type='text' class='form-control' placeholder=' {{trans('main.unit')}} ' /> </div> </div> <div class='form-group col-md-2'><div class='col-sm-12'><input type='number' step=any class='form-control' onchange='countTotalPrice("+itrator+")' id='payprice"+itrator+"' name='payprice"+itrator+"' placeholder=' {{trans('main.sell_price')}} ' /></div></div><div class='form-group col-md-2'><div class='col-sm-12'><input type='number' step=any id='totalePrice"+itrator+"' readonly='readonly' class='form-control' name='total_price"+itrator+"' placeholder=' {{trans('main.total_price')}} ' /></div></div></div><div class='row'><div class='form-group col-md-6'><div class='col-sm-12'><button type='button' onclick='removeitemrow("+itrator+")' class='form-control btn btn-sm btn-danger col-sm-3'><i class='fa fa-trash'></i></button></div></div><div class='form-group col-md-6'><div class='col-sm-12'><button type='button' onclick='addnewitem()' class='form-control btn btn-sm btn-info col-sm-3'><i class='fa fa-plus'></i></button></div></div></div></div>";
      $('#AllProducts').append(htmlOp);
      var itrator   = $('#itrator').val(itrator);
  }

  function removeitemrow(itrator){

    var rowTotal = $('#totalePrice'+itrator).val();
      $('#product'+itrator).remove();
      var invoiceTotalPrice = $('#totale_price').val();
      invoiceTotalPrice = +invoiceTotalPrice - rowTotal;
      $('#totale_price').val(invoiceTotalPrice);
  }

  function categoryProducts(formProNum , catId){
    $('#product_id'+formProNum).html("<option value=''>-- {{trans('main.select')}} {{trans('main.product')}} --</option>");
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
                $('#payprice'+formProNum).val(data.sell_price);
                $('#category'+formProNum).val(data.category_id);
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
            var unitVal = data.get_unit.name;
            $('#unitdetails'+formProNum).val(unitVal);
            $('#payprice'+formProNum).val(data.sell_price);
         }
        }
     });
  }

</script>
