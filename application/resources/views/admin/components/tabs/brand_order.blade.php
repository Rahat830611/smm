<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.brand.package.index') ? 'active' : '' }}"
                    href="{{ route('admin.order.brand.package.index') }}">@lang('all')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.brand.package.pending') ? 'active' : '' }}"
                    href="{{route('admin.order.brand.package.pending')}}">@lang('Pending')
                    @if($pending)
                    <span class="badge rounded-pill bg--white text-muted">{{$pending}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.brand.package.processing') ? 'active' : '' }}"
                    href="{{route('admin.order.brand.package.processing')}}">@lang('Processing')
                    @if($processing)
                    <span class="badge rounded-pill bg--white text-muted">{{$processing}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.brand.package.complete') ? 'active' : '' }}"
                    href="{{route('admin.order.brand.package.complete')}}">@lang('Completed')
                    @if($complete)
                    <span class="badge rounded-pill bg--white text-muted">{{$complete}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.brand.package.refund') ? 'active' : '' }}"
                    href="{{route('admin.order.brand.package.refund')}}">@lang('Refunded')
                    @if($refund)
                    <span class="badge rounded-pill bg--white text-muted">{{$refund}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.brand.package.cancel') ? 'active' : '' }}"
                    href="{{route('admin.order.brand.package.cancel')}}">@lang('Cancelled')
                    @if($cancelled)
                    <span class="badge rounded-pill bg--white text-muted">{{$cancelled}}</span>
                    @endif
                </a>
            </li>
        </ul>
    </div>
</div>
