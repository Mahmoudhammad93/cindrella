    <!-- // build table data -->
        <thead>
            <tr>
            @foreach ($ths as $th)
                <th class='text-center'> {{ $th }}</th>
            @endforeach
            </tr>
        </thead>
        <tbody>
          @foreach($tds as $td )
            <tr class="row{{$td['id']}} text-center">
                @foreach($tdOnly as $only)

                    @if( $only == "type" )
                        @if($td->type == 0)
                        <td><span class="label label-danger">{{trans('main.depit')}} </span></td>
                        @else
                        <td><span class="label label-info">{{trans('main.credit')}} </span></td>
                        @endif

                    @else

                    @if($only == "invoiceType")
                       @if($td->invoiceType == NULL)
                         <td><span class="label label-danger"> {{ trans('main.direct_dealing') }} </span></td>
                        @endif

                        @if($td->invoiceType == 1)
                         <td><span class="label label-info"> {{ trans('main.invoice') }} </span></td>
                        @endif

                        @if($td->invoiceType == 2)
                         <td><span class="label label-warning"> {{trans('main.bill_expense')}} </span></td>
                        @endif
                    @else
                    <td class='text-center'>{{ ( $only == 'value' ) || ( $only == 'totl_value' ) ? round($td->$only,3) : $td->$only }}</td>
                   @endif
                   @endif

                @endforeach

                @if(isset($Otipnsinputs) && !empty($Otipnsinputs) )
                <td class='text-center'>
                @foreach($Otipnsinputs as $inputOption)
                    @include($inputOption)
                @endforeach
                </td>
                @endif
            </tr>
          @endforeach
        </tbody>
