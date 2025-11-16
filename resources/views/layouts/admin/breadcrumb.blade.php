<!-- Breadcrumb -->
<div class="-mt-px">
    <div class="sticky top-0 inset-x-0 z-20 bg-white border-y border-gray-200 px-4 sm:px-6 lg:px-8 lg:hidden dark:bg-neutral-800 dark:border-neutral-700">
        <div class="flex items-center py-2">
            <!-- Breadcrumb -->
            <ol class="flex items-center whitespace-nowrap">
                @php
                    $segments = explode('.', Route::currentRouteName() ?? 'dashboard');
                    $breadcrumbs = [['label' => 'Dashboard', 'route' => 'dashboard']];

                    if (count($segments) > 0 && $segments[0] !== 'dashboard') {
                        foreach ($segments as $i => $segment) {
                            $label = ucfirst(str_replace(['-', '_'], ' ', $segment));
                            if ($segment !== 'index') {
                                $breadcrumbs[] = ['label' => $label, 'last' => $i === count($segments) - 1];
                            }
                        }
                    }
                @endphp

                @foreach ($breadcrumbs as $crumb)
                    <li class="flex items-center text-sm {{ isset($crumb['last']) && $crumb['last'] ? 'font-semibold' : '' }} text-gray-800 dark:text-neutral-400">
                        @if (!isset($crumb['last']))
                            <a href="{{ route($crumb['route'] ?? 'dashboard') }}" class="hover:text-blue-600">{{ $crumb['label'] }}</a>
                        @else
                            {{ $crumb['label'] }}
                        @endif

                        @if (!isset($crumb['last']) || !$crumb['last'])
                            <svg class="shrink-0 mx-3 overflow-visible size-2.5 text-gray-400 dark:text-neutral-500" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        @endif
                    </li>
                @endforeach
            </ol>
            <!-- End Breadcrumb -->
        </div>
    </div>
</div>
<!-- End Breadcrumb -->
