<aside id="left-panel" class="left-panel pt-3">
    <nav x-data="{ open: false }" class="navbar navbar-expand-sm navbar-default">
        <!-- Primary Navigation Menu -->
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <i class="menu-icon fa fa-laptop"></i>{{ __('Dashboard') }}
                </x-nav-link>
                <li class="menu-title">Master</li><!-- /.menu-title -->
                <x-nav-link :href="route('product')" :active="request()->routeIs('product')">
                    <i class="menu-icon fa fa-list"></i>{{ __('Product') }}
                </x-nav-link>
                <x-nav-link :href="route('category')" :active="request()->routeIs('category')">
                    <i class="menu-icon fa fa-list"></i>{{ __('Category') }}
                </x-nav-link>
                {{-- <li class="menu-title">Transaction</li><!-- /.menu-title -->
                <x-nav-link :href="route('product')" :active="request()->routeIs('product')">
                    <i class="menu-icon fa fa-list"></i>{{ __('Selling') }}
                </x-nav-link>
                <x-nav-link :href="route('product')" :active="request()->routeIs('product')">
                    <i class="menu-icon fa fa-list"></i>{{ __('Buying') }}
                </x-nav-link> --}}
            </ul>
        </div>
    </nav>

</aside>
