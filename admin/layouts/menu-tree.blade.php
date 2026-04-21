@php
    $id_ref = strtolower(preg_replace('/\s+/', '_', $menu['name'].'_'.$menu['id']));

    // flatten dengan depth tracking
    $flatten = function ($items, $depth = 1) use (&$flatten) {
        $result = collect();

        foreach ($items as $item) {
            $item['_depth'] = $depth;
            $result->push($item);

            if (!empty($item['children'])) {
                $result = $result->merge(
                    $flatten($item['children'], $depth + 1)
                );
            }
        }

        return $result;
    };

    $allChildren = !empty($menu['children'])
        ? $flatten($menu['children'])
        : collect();

    $hasAccess = in_array($menu['id'], $my_menu)
        || $allChildren->pluck('id')->intersect($my_menu)->isNotEmpty();

    if (!$hasAccess) return;
@endphp

@php
    $isRoot = is_null($menu['parent']);
    $noChildren = empty($menu['children']);
    $isHash = $menu['url'] === '#';

    $isDisabledRoot = $isRoot && $isHash && $noChildren;
@endphp

@if ($noChildren)

    @if ($isDisabledRoot)

        {{-- ROOT, url=#, no children → disabled --}}
        <span class="nav-link disabled text-muted"
              role="button"
              tabindex="-1"
              aria-disabled="true">
            {{ $menu['name'] }}
        </span>

    @else

        {{-- Normal clickable link --}}
        <a class="nav-link"
           href="{{ url($menu['url']) }}"
           role="button">
            {{ $menu['name'] }}
        </a>

    @endif
@else

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"
           href="#"
           role="button"
           data-bs-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false"
           id="{{ $id_ref }}">
            {{ $menu['name'] }}
        </a>

        <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0"
             aria-labelledby="{{ $id_ref }}">

            <div class="bg-white dark__bg-1000 rounded-3 py-2">

                @foreach ($allChildren as $child)

                    @if (in_array($child['id'], $my_menu))

                        @php
                            $depth = $child['_depth'];

                            $prefix = '';
                            if ($depth > 1) {
                                $prefix = '└' . str_repeat('─', $depth - 1) . ' ';
                            }

                            $isGroupHeader = ($child['url'] === '#' && !empty($child['children']));
                        @endphp

                        @if ($isGroupHeader)

                            <p class="dropdown-item text-700 mb-0 fw-bold">
                                <span class="text-muted me-1">{{ $prefix }}</span>
                                {{ $child['name'] }}
                            </p>

                        @else

                            <a class="dropdown-item link-600 fw-medium"
                            href="{{ url($child['url']) }}">
                                <span class="text-muted me-1">{{ $prefix }}</span>
                                {{ $child['name'] }}
                            </a>

                        @endif

                    @endif

                @endforeach

            </div>
        </div>
    </li>

@endif