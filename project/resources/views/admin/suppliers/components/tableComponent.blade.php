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
            <tr class="row{{$td['id']}} sup-tool">
                @foreach($tdOnly as $only)
                <td class='text-center'>
                @if( $only == "functionGetType" )
                  {{ trans('main.'.$td->getType->name) }}
                @else
                {{ $td->$only }}
                @endif
                </td>
                @endforeach

                @if(isset($Otipnsinputs) && !empty($Otipnsinputs) )
                <td class='text-center'>
                @foreach($Otipnsinputs as $inputOption)
                  @if($inputOption != "")
                    @include($inputOption)
                  @endif
                @endforeach

                <a href="{{ route($buttonsRoutsname.'.profile',$td->id) }}" class="btn btn-sm btn-info btn-flat center btn-profile"><i class="fa fa-user"></i> {{ trans('main.profile') }} </a>
                    <div class="tooltip-profile">
                        <div class="profile-img">
                            <img src="{{ asset('project/public/images/'.$td->image) }}" alt="Profile Supplier">
                        </div>
                        <div class="profile-info">
                            <h5 class="name">
                                <a href="{{ route($buttonsRoutsname.'.profile',$td->id) }}">{{ $td->name }}</a>
                            </h5>
                            <p>{{ $td->address }}</p>
                            <p>عدد المعاملات النقدية ( {{ $td->getBalance->count() }} )</p>
                            <div class="opt">
                                <a href="{{ route($buttonsRoutsname.'.profile',$td->id) }}" class="btn btn-default">{{ trans('main.view') }} {{ trans('main.profile') }}</a>
                            </div>
                        </div>
                    </div>
                </td>
                @endif
            </tr>
          @endforeach
        </tbody>
