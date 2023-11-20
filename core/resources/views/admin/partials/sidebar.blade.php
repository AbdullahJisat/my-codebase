<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                {{-- <li class="menu-title" key="t-menu">Menu</li> --}}
                @foreach (moduleListForSidebar()->get() as $module)
                @if ($module->status != 0 && $module->parent_id != 0)
                @if ($module->child->count() != 0)
                <li class="{{ request()->is($module->link) ? 'mm-active' : '' }}">
                    <a href="{{ $module->child->count() ? 'javascript: void(0);' : $module->link }}"
                        class="{{ $module->child->count() ? 'has-arrow waves-effect' : '' }}" aria-expanded="true">
                        <i class="{{ $module->icon }}"></i>
                        <span key="t-utility">{{ $module->name }}</span>
                    </a>
                    <ul class="sub-menu mm-collapse {{ request()->is($module->link) ? 'mm-show' : '' }}"
                        aria-expanded="false" style="">
                        @foreach ($module->child as $child)
                        <li>
                            <a href="{{ $child->link }}" class="{{ request()->is($child->link) ? 'active' : '' }}"><i
                                    class="{{ $child->icon }}"></i> {{
                                $child->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endif
                @else
                <li class="{{ request()->is($module->link) ? 'mm-active' : '' }}">
                    <a href="{{ $module->link }}" aria-expanded="true">
                        <i class="{{ $module->icon }}"></i>
                        <span key="t-utility">{{ $module->name }}</span>
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>