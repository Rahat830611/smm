<div class="row">
    <div class="col">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.index') ? 'active' : '' }}"
                    href="{{ route('admin.order.index') }}">@lang('all')
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.pending') ? 'active' : '' }}"
                    href="{{route('admin.order.pending')}}">@lang('Pending')
                    @if($pending)
                    <span class="badge rounded-pill bg--white text-muted">{{$pending}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.processing') ? 'active' : '' }}"
                    href="{{route('admin.order.processing')}}">@lang('Processing')
                    @if($processing)
                    <span class="badge rounded-pill bg--white text-muted">{{$processing}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.complete') ? 'active' : '' }}"
                    href="{{route('admin.order.complete')}}">@lang('Completed')
                    @if($complete)
                    <span class="badge rounded-pill bg--white text-muted">{{$complete}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.refund') ? 'active' : '' }}"
                    href="{{route('admin.order.refund')}}">@lang('Refunded')
                    @if($refund)
                    <span class="badge rounded-pill bg--white text-muted">{{$refund}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.order.cancel') ? 'active' : '' }}"
                    href="{{route('admin.order.cancel')}}">@lang('Cancelled')
                    @if($cancelled)
                    <span class="badge rounded-pill bg--white text-muted">{{$cancelled}}</span>
                    @endif
                </a>
            </li>
        </ul>
    </div>
</div>
