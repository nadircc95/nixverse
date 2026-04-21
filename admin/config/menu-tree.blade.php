@foreach ($menus as $menu)
    <tr>
        <td>
            <label style="padding-left: {{ $level * 20 }}px">
                {{ $menu['name'] }}
            </label>
        </td>

        {{-- CHECK ALL --}}
        <td class="text-center">
            <input type="checkbox"
                   data-id="{{ $menu['id'] }}"
                   data-parent="{{ $menu['parent'] }}"
                   id="{{ $menu['id'] }}"
                   class="check-all {{ $menu['url'] == '#' ? 'd-none' : '' }}">
        </td>

        {{-- PERMISSIONS --}}
        @foreach (['c','r','u','d'] as $perm)
            <td class="text-center">
                <input type="checkbox"
                       data-id="{{ $menu['id'] }}"
                       data-parent="{{ $menu['parent'] }}"
                       name="menu[{{ $menu['id'] }}][{{ $perm }}]"
                       id="{{ $perm }}-{{ $menu['id'] }}"
                       class="sub-check {{ $menu['url'] == '#' ? 'd-none' : '' }}">
            </td>
        @endforeach
    </tr>

    {{-- CHILDREN (recursive) --}}
    @if (!empty($menu['children']))
        @include('admin.config.menu-tree', [
            'menus' => $menu['children'],
            'level' => $level + 1
        ])
    @endif
@endforeach