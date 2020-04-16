<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('project/public/images/'.Auth::user()->image) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
              <a href="{{ route('users.profile',Auth::user()->id) }}">{{ Auth::user()->name }}</a>
          </p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('main.online') }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"> {{ trans('main.menu_management') }} </li>
        <!-- Optionally, you can add icons to the links -->
        @if( is_permited('dashboard','view') == 1 )
        <li class="{{ is_active('dashboard') }}" ><a href="{{ route('dashboard.index') }}"><i class="fa fa-tachometer"></i> <span>{{ trans('main.dashboard') }} </span></a></li>
        @endif

        @if( (is_permited('groups','view') == 1) || ( is_permited('users','view') == 1 )  )
        <li class="treeview {{ is_active('groups') }} {{ is_active('users') }}">
          <a href="#"><i class="fa fa-users"></i> <span> {{ trans('main.users_manage') }} </span>
          </a>
          <ul class="treeview-menu">
            @if( is_permited('groups','view') == 1 )
            <li class="{{ is_active('groups') }}" ><a href="{{ route('groups.index') }}"> {{ trans('main.groups') }} </a></li>
            @endif

            @if( is_permited('users','view') == 1 )
            <li class="{{ is_active('users') }}" ><a href="{{ route('users.index') }}"> {{ trans('main.users') }} </a></li>
            @endif
          </ul>
        </li>
        @endif

        @if( (is_permited('suppliers','view') == 1) )
        <li class="treeview {{ is_active('suppliers') }}">
          <a href="#"><i class="fa fa-handshake-o"></i> <span> {{ trans('main.cust_comp_manage') }} </span>
          </a>
          <ul class="treeview-menu">
            @if( is_permited('suppliers','view') == 1 )
            <li class="{{ is_active('suppliers') }}" ><a href="{{ route('suppliers.index') }}"> {{ trans('main.cust_comp') }} </a></li>
            @endif
          </ul>
        </li>
        @endif

        @if( (is_permited('categories','view') == 1) || (is_permited('products','view') == 1) || ( (is_permited('units','view') == 1) ) )

        <li class="treeview {{ is_active('categories') }} {{ is_active('products') }} {{ is_active('units') }} ">
          <a href="#"><i class="fa fa-hdd-o"></i> <span> {{ trans('main.store') }} </span>
          </a>
          <ul class="treeview-menu">
            @if( is_permited('categories','view') == 1 )
            <li class="{{ is_active('categories') }}" ><a href="{{ route('categories.index') }}"> {{ trans('main.categories') }} </a></li>
            @endif

            @if( is_permited('units','view') == 1 )
            <li class="{{ is_active('units') }}" ><a href="{{ route('units.index') }}">{{ trans('main.units') }}</a></li>
            @endif

            @if( is_permited('products','view') == 1 )
            <li class="{{ is_active('products') }}" ><a href="{{ route('products.index') }}">{{ trans('main.products') }}</a></li>
            @endif
          </ul>
        </li>
       @endif

       @if( (is_permited('PurchaseInvoice','view') == 1) || (is_permited('sellInvoice','view') == 1) || ( (is_permited('totalgainindex','view') == 1) ) )
        <li class="treeview {{ is_active('PurchaseInvoice') }} {{ is_active('sellInvoice') }} {{ is_active('totalgainindex') }}">
          <a href="#"><i class="fa fa-list-alt"></i> <span> {{ trans('main.invoices_manage') }} </span>
          </a>
          <ul class="treeview-menu">
            @if( is_permited('PurchaseInvoice','view') == 1 )
            <li class="{{ is_active('PurchaseInvoice') }}" ><a href="{{ route('purchaseInvoice.index') }}"> {{ trans('main.pur_invoice') }} </a></li>
            @endif

            @if( is_permited('sellInvoice','view') == 1 )
            <li class="{{ is_active('sellInvoice') }}" ><a href="{{ route('sellInvoice.index') }}"> {{ trans('main.sell_invoice') }} </a></li>
            @endif

            @if( is_permited('totalgainindex','view') == 1 )
            <li class="{{ is_active('totalgainindex') }}" ><a href="{{ route('totalgainindex.index') }}"> {{ trans('main.total_gain') }} </a></li>
            @endif
          </ul>
        </li>

        @endif

        @if( is_permited('boxes','view') == 1 )
        <li class="{{ is_active('boxes') }}" ><a href="{{ route('boxes.index') }}"><i class="fa fa-archive"></i> <span> {{ trans('main.boxes') }} </span></a></li>
        @endif

        @if( is_permited('otherinvoices','view') == 1 )
        <li class="{{ is_active('otherinvoices') }}" ><a href="{{ route('otherinvoices.index') }}"><i class="fa fa-money"></i> <span> {{ trans('main.expenses') }} </span></a></li>
        @endif
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
