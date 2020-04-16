<div class="row">
    <div class="col-md-12">
    <form action="{{ route($buttonsRoutsname.'.index') }}" method="GET">
        @php

        $input ="name";
        isset($filterData[$input]) ? $inputValue = $filterData[$input] : $inputValue = '';
        filterInputForm(['type' => 'text', 'class' => 'form-control','name' => $input ,'placeholder' => trans('main.name'), 'value' => $inputValue ] , 3 );


        $input = "type";
        isset($filterData[$input]) ? $inputValue = $filterData[$input] : $inputValue = '';
        filterSelectForm(['class' => 'form-control','name' => $input ] ,2,$databind['types'],$inputValue);


        $input ="phone";
        isset($filterData[$input]) ? $inputValue = $filterData[$input] : $inputValue = '';
        filterInputForm(['type' => 'number', 'class' => 'form-control','name' => $input ,'placeholder' => trans('main.phone') , 'value' => $inputValue ] , 3 );

        @endphp

        <button class="btn btn-sm btn-info btn-flat center"><i class="fa fa-search"></i> {{ trans('main.search') }} </button>

    </form>
    </div>
</div>
