    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="/dashboard" class="b-brand text-primary">
                    <!-- ========   Change your logo from here   ============ -->
                    <h3 class="fw-bold">HashMicro</h3>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">

                    @foreach ($sidebarLinks as $link)
                        @if (isset($link['is_caption']) && $link['is_caption'])
                            <li class="pc-item pc-caption">
                                <label>{{ $link['title'] }}</label>
                                <i class="pc-micon">
                                    <svg class="pc-icon">
                                        <use xlink:href="#{{ $link['icon'] }}"></use>
                                    </svg>
                                </i>
                            </li>
                        @elseif(isset($link['submenu']))
                            <li class="pc-item pc-hasmenu">
                                <a href="#!" class="pc-link">
                                    <i class="fa-solid  me-2 {{ $link['icon'] }}"></i>
                                    <span class="pc-mtext">{{ $link['title'] }}</span>
                                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                                </a>
                                <ul class="pc-submenu">
                                    @foreach ($link['submenu'] as $submenu)
                                        <li class="pc-item">
                                            <a class="pc-link" href="{{ route($submenu['route']) }}">
                                                {{ $submenu['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="pc-item">
                                <a href="{{ @$link['route'] ? route(@$link['route']) : '#' }}" class="pc-link">
                                    <i class="fa-solid me-2 {{ $link['icon'] }}"></i>
                                    <span class="pc-mtext">{{ $link['title'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>

            </div>
        </div>
    </nav>
