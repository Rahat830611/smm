@php
$user = auth()->user();
@endphp
<div class="col-xl-3 col-lg-4 pe-xl-4">
    <div class="dashboard_profile">
        <div class="dashboard_profile__details">
            <div class="sidebar-menu">
                    <span class="sidebar-menu__close"><i class="las la-times"></i></span>
                    <ul class="sidebar-menu-list">
                        <div class="dashboard_profile_wrap">
                            <div class="profile_photo">
                                <img src="{{ getImage(getFilePath('userProfile').'/'.$user->image,getFileSize('userProfile')) }}" alt="agent">
                                <div class="photo_upload">
                                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <label for="image"><i class="fas fa-image"></i></label>
                                        <input id="image" type="file" name="image" class="upload_file"  onchange="this.form.submit()">
                                  </form>
                                </div>
                            </div>
                            <h3 class="text-center">{{__($user->fullname)}}</h3>
                        </div>
                        <li class="sidebar-menu-list__item {{ Route::is('user.home') ? 'active' : '' }}">
                            <a href="{{ route('user.home') }}" class="sidebar-menu-list__link">
                            <span class="icon"><i class="fa fa-tachometer-alt"></i></span>
                            @lang('Dashboard')</span>
                            </a>
                        </li>

                        <li class="sidebar-menu-list__item has-dropdown">
                            <a href="javascript:void(0)" class="sidebar-menu-list__link">
                            <span class="icon"><i class="fas fa-plus"></i></span>
                            <span class="text">@lang('Create Orders')</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul class="sidebar-submenu-list">
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.order.create') ? 'active' : '' }}">
                                        <a href="{{route('user.order.create')}}" class="sidebar-submenu-list__link">@lang('New Order')</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="sidebar-menu-list__item has-dropdown">
                            <a href="javascript:void(0)" class="sidebar-menu-list__link">
                            <span class="icon"><i class="fas fa-cart-plus"></i></span>
                            <span class="text">@lang('Orders')</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul class="sidebar-submenu-list">
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.brnad.package.index') ? 'active' : '' }}">
                                        <a href="{{route('user.brnad.package.index')}}" class="sidebar-submenu-list__link">@lang('Brand Package Orders')</a>
                                    </li>
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.order.index') ? 'active' : '' }}">
                                        <a href="{{route('user.order.index')}}" class="sidebar-submenu-list__link">@lang('All Orders')</a>
                                    </li>
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.order.pending') ? 'active' : '' }}">
                                        <a href="{{route('user.order.pending')}}" class="sidebar-submenu-list__link">@lang('Pending')</a>
                                    </li>
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.order.processing') ? 'active' : '' }}">
                                        <a href="{{route('user.order.processing')}}" class="sidebar-submenu-list__link">@lang('Processing')</a>
                                    </li>
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.order.complete') ? 'active' : '' }}">
                                        <a href="{{route('user.order.complete')}}" class="sidebar-submenu-list__link">@lang('Complete')</a>
                                    </li>
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.order.refund') ? 'active' : '' }}">
                                        <a href="{{route('user.order.refund')}}" class="sidebar-submenu-list__link">@lang('Refunded')</a>
                                    </li>
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.order.cancelle') ? 'active' : '' }}">
                                        <a href="{{route('user.order.cancelle')}}" class="sidebar-submenu-list__link">@lang('Cancelled')</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-menu-list__item has-dropdown">
                            <a href="javascript:void(0)" class="sidebar-menu-list__link">
                            <span class="icon"><i class="fas fa-file-invoice-dollar"></i></span>
                            <span class="text">@lang('Deposit')</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul class="sidebar-submenu-list">
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.order.index') ? 'active' : '' }}">
                                        <a href="{{route('user.deposit')}}" class="sidebar-submenu-list__link">@lang('Deposit Now')</a>
                                    </li>
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.deposit.history') ? 'active' : '' }}">
                                        <a href="{{route('user.deposit.history')}}" class="sidebar-submenu-list__link">@lang('Deposit Log') </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-menu-list__item has-dropdown">
                            <a href="javascript:void(0)" class="sidebar-menu-list__link">
                            <span class="icon"><i class="fas fa-headset"></i></span>
                            <span class="text">@lang('Support Tickets')</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul class="sidebar-submenu-list">
                                    <li class="sidebar-submenu-list__item {{ Route::is('ticket') ? 'active' : '' }}">
                                        <a href="{{ route('ticket') }}" class="sidebar-submenu-list__link">@lang('My Tickets')</a>
                                    </li>
                                    <li class="sidebar-submenu-list__item {{ Route::is('ticket.open') ? 'active' : '' }}">
                                        <a href="{{ route('ticket.open') }}" class="sidebar-submenu-list__link">@lang('New Ticket') </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-menu-list__item {{ Route::is('user.transactions') ? 'active' : '' }}">
                            <a href="{{route('user.transactions')}}" class="sidebar-menu-list__link">
                            <span class="icon"><i class="fas fa-funnel-dollar"></i></span>
                            @lang('Transactions')</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-list__item has-dropdown">
                            <a href="javascript:void(0)" class="sidebar-menu-list__link">
                            <span class="icon"><i class="fas fa-cog"></i></span>
                            <span class="text">@lang('Settings')</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul class="sidebar-submenu-list">
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.profile.setting') ? 'active' : '' }}">
                                        <a href="{{ route('user.profile.setting') }}" class="sidebar-submenu-list__link"> @lang('Profile Setting')</a>
                                    </li>
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.change.password') ? 'active' : '' }}">
                                        <a href="{{ route('user.change.password') }}" class="sidebar-submenu-list__link">@lang('Change Password')</a>
                                    </li>
                                    <li class="sidebar-submenu-list__item {{ Route::is('user.twofactor') ? 'active' : '' }}">
                                        <a href="{{ route('user.twofactor') }}" class="sidebar-submenu-list__link">   @lang('Google Authentication')</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-menu-list__item">
                            <a href="{{route('user.logout')}}" class="sidebar-menu-list__link text--danger">
                            <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                            @lang('Logout')</span>
                            </a>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</div>
