<!-- Sidebar Overlay -->
<div id="sidebar-overlay" class="hidden fixed inset-0 bg-black/50 z-[60] lg:hidden"></div>

<!-- Sidebar -->
<div id="hs-application-sidebar"
    class="-translate-x-full transition-all duration-300 fixed top-0 start-0 bottom-0 z-[70] w-64   bg-neutral-800 border-neutral-900  overflow-y-auto lg:block lg:translate-x-0"
    role="dialog" tabindex="-1" aria-label="Sidebar">
    <div class="relative flex flex-col h-full max-h-full">
        <div class="px-6 pt-4">
            <!-- Logo -->
            <a class="flex-none font-semibold text-xl text-white focus:outline-hidden focus:opacity-80 cursor-pointer"
                href="#" aria-label="Brand" href="/">
                <span class="inline-flex items-center gap-x-2 text-2xl font-extraboldbold">
                    <img class="w-10 h-auto" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                    J-Voyage
                </span>
            </a>
        </div>

        <!-- Content -->
        <div
            class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-blue-700 [&::-webkit-scrollbar-thumb]:bg-blue-900">
            <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                <ul class="flex flex-col space-y-1">
                    @php
                        $currentRoute = Route::currentRouteName();

                        $role = auth()->user()->roles->pluck('name')->first();
                        $menus = [];

                        if ($role === 'admin') {
                            $menus = [
                                [
                                    'label' => 'Dashboard',
                                    'route' => 'admin.dashboard',
                                    'icon' => 'layout-dashboard',
                                    'active' => 'admin.dashboard',
                                ],
                                [
                                    'label' => 'Users',
                                    'route' => 'admin.users.index',
                                    'icon' => 'users',
                                    'active' => 'admin.users.*',
                                ],
                                [
                                    'label' => 'Pengelola',
                                    'route' => 'admin.pengelola.index',
                                    'icon' => 'user-check',
                                    'active' => 'admin.pengelola.*',
                                ],
                            ];
                        } elseif ($role === 'pengelola') {
                            $menus = [
                                [
                                    'label' => 'Dashboard',
                                    'route' => 'pengelola.dashboard',
                                    'icon' => 'layout-dashboard',
                                    'active' => 'pengelola.dashboard',
                                ],
                                // [
                                //     'label' => 'Profile',
                                //     'route' => 'profile.show',
                                //     'icon' => 'user',
                                //     'active' => 'profile.*',
                                // ],
                                [
                                    'label' => 'Profile Usaha',
                                    'route' => 'pengelola.profile.index',
                                    'icon' => 'store',
                                    'active' => 'pengelola.profile.*',
                                ],
                                [
                                    'label' => 'Highlights',
                                    'route' => 'pengelola.highlight.index',
                                    'icon' => 'star',
                                    'active' => 'pengelola.highlight.*',
                                ],
                                [
                                    'label' => 'Fasilitas',
                                    'route' => 'pengelola.fasilitas.index',
                                    'icon' => 'list',
                                    'active' => 'pengelola.fasilitas.*',
                                ],
                                [
                                    'label' => 'Transaksi',
                                    'route' => 'pengelola.transaksi.index',
                                    'icon' => 'credit-card',
                                    'active' => 'pengelola.transaksi.*',
                                ],
                                [
                                    'label' => 'Reviews',
                                    'route' => 'pengelola.review.index',
                                    'icon' => 'star',
                                    'active' => 'pengelola.review.*',
                                ],
                            ];
                        }
                    @endphp

                    @foreach ($menus as $menu)
                        @if (isset($menu['permission']) && !auth()->user()?->can($menu['permission']))
                            @continue
                        @endif

                        @if (isset($menu['children']))
                            {{-- Menu with children --}}
                            @php
                                $isParentActive = false;
                                if (isset($menu['active'])) {
                                    $patterns = explode('|', $menu['active']);
                                    foreach ($patterns as $pattern) {
                                        if (Str::is($pattern, $currentRoute)) {
                                            $isParentActive = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp
                            <li class="hs-accordion {{ $isParentActive ? 'active' : '' }}"
                                id="{{ Str::slug($menu['label']) }}-accordion">
                                <button type="button"
                                    class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg focus:outline-hidden {{ $isParentActive ? 'bg-blue-800 text-white' : 'text-white hover:bg-blue-700' }}">
                                    <i data-lucide="{{ $menu['icon'] }}" class="shrink-0 size-4"></i>
                                    {{ $menu['label'] }}
                                    <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m18 15-6-6-6 6" />
                                    </svg>

                                    <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </button>

                                <div
                                    class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 {{ $isParentActive ? '' : 'hidden' }}">
                                    <ul class="ps-8 pt-1 space-y-1">
                                        @foreach ($menu['children'] as $child)
                                            @if (isset($child['permission']) && !auth()->user()?->can($child['permission']))
                                                @continue
                                            @endif
                                            @php
                                                $isChildActive = false;
                                                if (isset($child['active'])) {
                                                    $patterns = explode('|', $child['active']);
                                                    foreach ($patterns as $pattern) {
                                                        if (Str::is($pattern, $currentRoute)) {
                                                            $isChildActive = true;
                                                            break;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <li>
                                                <a href="{{ route($child['route'] ?? 'dashboard') }}"
                                                    class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg focus:outline-hidden {{ $isChildActive ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                                                    {{ $child['label'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @else
                            {{-- Simple link --}}
                            @php
                                $isActive = false;
                                if (isset($menu['active'])) {
                                    $patterns = explode('|', $menu['active']);
                                    foreach ($patterns as $pattern) {
                                        if (Str::is($pattern, $currentRoute)) {
                                            $isActive = true;
                                            break;
                                        }
                                    }
                                }
                            @endphp
                            <li>
                                <a href="{{ route($menu['route'] ?? 'dashboard') }}"
                                    class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg focus:outline-hidden {{ $isActive ? 'bg-blue-800 text-white' : 'text-white hover:bg-blue-700' }}">
                                    <i data-lucide="{{ $menu['icon'] }}" class="shrink-0 size-4"></i>
                                    {{ $menu['label'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- End Sidebar -->
