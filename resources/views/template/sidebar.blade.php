<!-- Left Sidebar Start -->
    <div class="app-sidebar-menu">
        <div class="h-100" data-simplebar>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <div class="logo-box">
                    <a class='logo logo-light' href='index.html'>
                        <span class="logo-sm">
                            {{-- <img src="{{asset('template/assets/images/logo/logo.png')}}" alt="" height="35"> <span style="font-sixe:100px">GOPRESENT</span> --}}
                            PERSEDIAAN OBAT
                        </span>
                        <span class="logo-lg">
                            {{-- <img src="{{asset('template/assets/images/logo/logo.png')}}" alt="" height="35"> <span style="font-sixe:100px">GOPRESENT</span> --}}
                            PERSEDIAAN OBAT
                        </span>
                    </a>
                    <a class='logo logo-dark' href='index.html'>
                        <span class="logo-sm">
                            {{-- <img src="{{asset('template/assets/images/logo/logo.png')}}" alt="" height="35"> <span style="font-sixe:100px">GOPRESENT</span> --}}
                            PERSEDIAAN OBAT
                        </span>
                        <span class="logo-lg">
                            {{-- <img src="{{asset('template/assets/images/logo/logo.png')}}" alt="" height="35"> <span style="font-sixe:100px">GOPRESENT</span> --}}
                            PERSEDIAAN OBAT
                        </span>
                    </a>
                </div>

                <ul id="side-menu">

                    <li class="menu-title">Menu</li>
                    <li>
                        <a class='tp-link' href='{{route('dashboard')}}'>
                            <i data-feather="columns"></i>
                            <span> Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#menu1" data-bs-toggle="collapse">
                            <i data-feather="home"></i>
                            <span> Master </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="menu1">
                            <ul class="nav-second-level">
                                <li>
                                    <a class='tp-link' href='{{route('master.distributor')}}'>
                                        Distributor
                                    </a>
                                </li>
                                <li>
                                    <a class='tp-link' href='{{route('master.sediaan-obat')}}'>
                                        Sediaan Obat
                                    </a>
                                </li>
                                <li>
                                    <a class='tp-link' href='{{route('master.kategori-obat')}}'>
                                        Kategori Obat
                                    </a>
                                </li>
                                <li>
                                    <a class='tp-link' href='{{route('master.jenis-obat')}}'>
                                        Jenis Obat
                                    </a>
                                </li>
                                <li>
                                    <a class='tp-link' href='{{route('master.obat')}}'>
                                        Obat
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a class='tp-link' href='{{route('pembelian')}}'>
                            <i data-feather="columns"></i>
                            <span> Pembelian</span>
                        </a>
                    </li>
                    <li>
                        <a class='tp-link' href='{{route('dashboard')}}'>
                            <i data-feather="columns"></i>
                            <span> Penjualan</span>
                        </a>
                    </li>
                    <li>
                        <a class='tp-link' href='{{route('dashboard')}}'>
                            <i data-feather="columns"></i>
                            <span> Stock Opname</span>
                        </a>
                    </li>
                    {{-- @php
                        $menu = filter_menu();
                        $subMenu = sub_menu();
                    @endphp
                    @foreach ($menu as $menuItem)
                        @if ($menuItem->isLabel)
                            <li class="menu-title">{{$menuItem->name}}</li>
                        @elseif($menuItem->link)
                            <li>
                                <a class='tp-link' href='{{route($menuItem->link)}}'>
                                    <i data-feather="columns"></i>
                                    <span> {{$menuItem->name}}</span>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="#{{$menuItem->id}}" data-bs-toggle="collapse">
                                    <i data-feather="home"></i>
                                    <span> {{$menuItem->name}} </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="{{$menuItem->id}}">
                                    <ul class="nav-second-level">
                                        @foreach ($subMenu as $subMenuItem)
                                            @if ($menuItem->id == $subMenuItem->parent)
                                            <li>
                                                <a class='tp-link' href='{{route($subMenuItem->link)}}'>
                                                    {{$subMenuItem->name}}
                                                </a>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif
                    @endforeach --}}
                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
    </div>
    <!-- Left Sidebar End -->
