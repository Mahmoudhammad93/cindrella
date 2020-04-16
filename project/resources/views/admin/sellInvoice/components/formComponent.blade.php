
<!-- inputForm ($lable,$inputAttrArrayAsKeyAndValue,$errors) -->
<!-- selectform($lable,$inputAtrrs,$value,$databind,$errors) -->
<div class="box-body">
@php

$input = "code";
inputForm(trans('main.'.$input),['type' => 'text', 'class' => 'form-control','name' => $input , 'readonly'=>'readonly','placeholder' => trans('main.code'),'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "date";
inputForm(trans('main.'.$input),['type' => 'date', 'class' => 'form-control','name' => $input ,'placeholder' => trans('main.date'),'value' => isset($row->$input) ? $row->$input : ''] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "supplier_id";
selectform(trans('main.company_name'),[ 'class' => 'form-control','name' => $input ],isset($row->$input) ? $row->$input : '',$databind['suppliers'], isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : []);

$input = "total_value";
inputForm(trans('main.'.$input),['type' => 'number', 'step' => 'any' ,'class' => 'form-control','name' => $input ,'readonly' =>'readonly' , 'id' => 'totale_price'] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "total_gain";
inputForm(trans('main.'.$input),['type' => 'number', 'step' => 'any','class' => 'form-control','name' => $input ,'readonly' =>'readonly' , 'id' => 'totale_gain'] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

$input = "add_discount";
inputFormWithBtn(trans('main.'.$input),['type' => 'number', 'step' => 'any','class' => 'form-control add-disc','name' => $input , 'id' => 'add_discount'] , isset($errors->toArray()[$input]) ? $errors->toArray()[$input] : [] );

@endphp
    <div class="form-group">
        <label for="" class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <a href="" class="show-disc-inputs">{{trans('main.add_discount')}} +</a>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <a href="" class="hide-disc-inputs">{{trans('main.hide')}} -</a>
        </div>
    </div>
<input type="hidden" name="invoice_type" value="0" />

<h4 class="text-center" style="color: red;"> {{ trans('main.invoice_product') }} </h4>
<input type="hidden" id="itrator" value="0" name="itrator"/>

<div id="AllProducts">
<div id="product0" style=" margin-top: 10px;height: 300px;border: 1px solid #BFBFBF; background-color: white; ">

<div class="row">
    <div class='form-group col-md-12'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.code') }} </label>
        <div class='col-sm-12'>
            <input type="text" onchange='productInfoByCode(0)' id="code0" class="form-control" name="code0" placeholder="{{ trans('main.code') }}" />
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.category') }} </label>
        <div class='col-sm-12'>
            <select class='form-control' id="category0" name = "category_id0" onchange="categoryProducts(0,this.value)" >
            <option value="">-- {{ trans('main.select') }} {{ trans('main.category') }} --</option>
            @foreach($databind['categories'] as $cat)
                <option  value="{{ $cat->id }}"> {{ $cat->name }} </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.product') }} </label>
        <div class='col-sm-12'>
            <select class='form-control' onchange="productsInfo(0,this.value)"  name = "product_id0" id="product_id0">
                <option value="">-- {{ trans('main.select') }} {{ trans('main.category') }} {{ trans('main.first') }}  --</option>
            </select>
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;" > {{ trans('main.quantity_avai') }} </label>
        <div class='col-sm-12'>
            <input readonly="readonly" id="avelablequantity0" type="number" step=any class="form-control" placeholder=" {{ trans('main.quantity_avai') }} " />
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.quantity') }} </label>
        <div class='col-sm-12'>
            <input onchange="countTotalPrice(0)" id="quantity0" type="number" step=any class="form-control" name="quantity0" placeholder="{{ trans('main.quantity') }}" />
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.unit') }} </label>
        <div class='col-sm-12'>
            <input id='unitdetails0' readonly='readonly' type='text' class='form-control' placeholder=" {{ trans('main.unit') }} " />
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;" > {{ trans('main.sell_price') }} </label>
        <div class='col-sm-12'>
            <input readonly="readonly" id="payprice0" name="payprice0" type="number" step=any class="form-control" placeholder=" {{ trans('main.sell_price') }} " />
        </div>
    </div>

    <div class='form-group col-md-3'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.pay_price') }} </label>
        <div class='col-sm-12'>
            <input type="number" step=any class="form-control" onchange="countTotalPrice(0)" id="sellprice0" name="sellprice0" placeholder=" {{ trans('main.pay_price') }} " />
        </div>
    </div>

    <div class='form-group col-md-2' style="display: none">
        <label style="margin-left: 15px;color:red;"> {{ trans('main.discount') }} </label>
        <div class='col-sm-12'>
            <input type="number" step=any class="form-control" readonly id="discount0" name="discount0" placeholder=" {{ trans('main.discount') }} " />
        </div>
    </div>

    <input type='hidden' id='totaleGain0' name='total_gain0' />

    <div class='form-group col-md-2'>
        <label style="margin-left: 15px;color:red;"> {{ trans('main.total') }} </label>
        <div class='col-sm-12'>
            <input type="number" step=any id="totalePrice0" readonly="readonly" class="form-control" name="total_price0" placeholder=" {{ trans('main.total') }} " />
        </div>
    </div>
</div>

<div class="row">
    <div class='form-group col-md-6'>
        <div class="col-sm-12">
            <button type="button" disabled="disable" class="form-control btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>

    <div class='form-group col-md-6'>
        <div class="col-sm-12">
            <button type="button" onclick="addnewitem()" class="form-control btn btn-sm btn-info">
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</div>

</div>


</div>

</div>
<!-- /.box-body -->
<div class="box-footer">
<div class='form-group col-md-3'>
    <div class='col-sm-12'>
      <select class="form-control" name="due">
         <option  value="0"> تسديد الفاتورة </option>
         <option  value="1">  حفظ بدون تسديد </option>
      </select>
    </div>
</div>
<input id="edit_id" type="submit" class="btn btn-success" value="{{trans('main.save')}}">
</div>

<script>
  function countTotalPrice(itrator) {

      var rowTotal = $('#totalePrice'+itrator).val();
      var invoiceTotalPrice = $('#totale_price').val();
      test = +invoiceTotalPrice - rowTotal;
      $('#totale_price').val(test);

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
      var htmlOp = "<div id='product"+itrator+"' style=' margin-top: 10px;height: 300px;border: 1px solid #BFBFBF; background-color: white; '><div class='row'> <div class='form-group col-md-12'> <label style='margin-left: 15px;color:red;'> {{trans('main.code')}} </label> <div class='col-sm-12'> <input type='text' onchange='productInfoByCode("+itrator+")' id='code"+itrator+"' class='form-control' name='code"+itrator+"' placeholder='{{trans('main.code')}}' /> </div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;'> {{trans('main.category')}} </label> <div class='col-sm-12'> <select class='form-control' id='category"+itrator+"' name = 'category_id"+itrator+"' onchange='categoryProducts("+itrator+",this.value)' > <option value=''>-- {{ trans('main.select') }} {{ trans('main.category') }} --</option> @foreach($databind['categories'] as $cat) <option  value='{{ $cat->id }}'> {{ $cat->name }} </option> @endforeach </select></div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;'> {{trans('main.product')}} </label> <div class='col-sm-12'> <select class='form-control' onchange='productsInfo("+itrator+",this.value)'  name = 'product_id"+itrator+"' id='product_id"+itrator+"'><option value=''>-- {{ trans('main.select') }} {{ trans('main.category') }} {{ trans('main.first') }}  --</option></select> </div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;' > {{ trans('main.quantity_avai') }} </label> <div class='col-sm-12'> <input readonly='readonly' id='avelablequantity"+itrator+"' type='number' step=any class='form-control' placeholder=' {{ trans('main.quantity_avai') }} ' /> </div> </div><div class='form-group col-md-3'><label style='margin-left: 15px;color:red;'> {{ trans('main.quantity') }} </label> <div class='col-sm-12'> <input onchange='countTotalPrice("+itrator+")' id='quantity"+itrator+"' type='number' step=any class='form-control' name='quantity"+itrator+"' placeholder=' {{ trans('main.quantity') }} ' /> </div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;'> {{ trans('main.unit') }} </label> <div class='col-sm-12'> <input id='unitdetails"+itrator+"' readonly='readonly' type='text' class='form-control' placeholder=' {{ trans('main.unit') }} ' /> </div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;' > {{ trans('main.sell_price') }} </label> <div class='col-sm-12'> <input readonly='readonly' id='payprice"+itrator+"' name='payprice"+itrator+"' type='number' step=any class='form-control' placeholder=' {{ trans('main.sell_price') }} ' /> </div> </div> <div class='form-group col-md-3'> <label style='margin-left: 15px;color:red;'> {{ trans('main.pay_price') }} </label> <div class='col-sm-12'><input type='number' step=any class='form-control' onchange='countTotalPrice("+itrator+")' id='sellprice"+itrator+"' name='sellprice"+itrator+"' placeholder=' {{ trans('main.pay_price') }} ' /> </div> </div> <input type='hidden' id='totaleGain"+itrator+"' name='total_gain"+itrator+"' /><div class='form-group col-md-2' style='display: none'> <label style='margin-left: 15px;color:red;'> {{trans('main.discount')}} </label> <div class='col-sm-12'><input type='number' step=any class='form-control' id='discount"+itrator+"' readonly name='discount"+itrator+"' placeholder=' {{trans('main.discount')}} ' /> </div> </div> <input type='hidden' id='totaleGain"+itrator+"' name='total_gain"+itrator+"' /> <div class='form-group col-md-2'> <label style='margin-left: 15px;color:red;'> {{trans('main.total_price')}} </label> <div class='col-sm-12'> <input type='number' step=any id='totalePrice"+itrator+"' readonly='readonly' class='form-control' name='total_price"+itrator+"' placeholder=' {{trans('main.total_price')}} ' /> </div> </div></div> <div class='row'><div class='form-group col-md-6'> <div class='col-md-12'><button onclick='removeitemrow("+itrator+")' type='button' class='form-control btn btn-sm btn-danger col-sm-3'><i class='fa fa-trash'></i></button> </div></div> <div class='form-group col-md-6'><div class='col-md-12'><button type='button' onclick='addnewitem()' class='form-control btn btn-sm btn-info col-sm-3'><i class='fa fa-plus'></i></button> </div> </div> </div></div>";
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
      $('#discount'+formProNum).val("");

      // $(document).on('keyup change', '#discount'+formProNum+' ,#quantity'+formProNum+' ,#sellprice'+formProNum, function(){
      //     console.log('test')
      //       var quantity = $('#quantity'+formProNum).val(),
      //           sellPrice = $('#sellprice'+formProNum).val(),
      //           discount = $('#discount'+formProNum).val(),
      //           totalPrice = $('#totalePrice'+formProNum);
      //
      //       var price = sellPrice - (sellPrice * discount) / 100;
      //
      //       totalPrice.val(price * quantity)
      // })

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
                $('#sellprice'+formProNum).val(data.priceInDisc);
                if(data.discount > 0){
                    $('#discount'+formProNum).val(data.discount).parents('.form-group').css({'display': 'block'});
                }

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

  $(document).ready(function(){
      $.ajax({
        type: 'GET',
        url: "{{ route('invoiceCode') }}",
        success:function(response){
            console.log(response)
            if (response){
                var code = parseInt(response) + 1;
                $('input[name=code]').val(code);
            }else {
                $('input[name=code]').val(1);
            }
        }
      })
  })

  // To get Date Today
  Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
  });

  // To set input date make it value equal date todat
  $(document).ready(function(){
    var date = $('input[type=date]').val(new Date().toDateInputValue());

    // To hide inputs for add discount if not add discount
      $('.add-disc').parents('.form-group').css({'display': 'none'});
      $('a.hide-disc-inputs').parents('.form-group').css({'display': 'none'});
  });

  // To Show inputs for add discount if add discount
  $(document).on('click', 'a.show-disc-inputs', function () {
      $(this).parents('.form-group').css({'display': 'none'})
      $('.add-disc').parents('.form-group').css({'display': 'block'});
      $('a.hide-disc-inputs').parents('.form-group').css({'display': 'block'});
      return false;
  })

  // To Hide inputs for add discount if not add discount
  $(document).on('click', 'a.hide-disc-inputs', function () {
      $(this).parents('.form-group').css({'display': 'none'})
      $('.add-disc').parents('.form-group').css({'display': 'none'});
      $('a.show-disc-inputs').parents('.form-group').css({'display': 'block'});
      return false;
  })

  // To add another discount
  $(document).on('change', 'input[name=add_discount]',function(){
      var totalPrice = $('input[name=total_value]').val(),
          anotherDisc = $('input[name=add_discount]').val(),
          totalGain = $('input[name=total_gain]').val();

      // To Count Total Price In Add Discount
      totalPrice =+ totalPrice - anotherDisc;
      $('input[name=total_value]').val(totalPrice);

      // To Count Total Gain In Add Discount
      totalGain =+ totalGain - anotherDisc;
      $('input[name=total_gain]').val(totalGain)
  });

  $(document).on('click', '.input-btn', function(){
      return false;
  });

</script>
