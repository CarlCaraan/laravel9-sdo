@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <!-- <a href="{{ route('dashboard') }} "><img src="{{ asset('admin/assets/images/logo/logo.svg') }}" alt="Logo" srcset=""></a> -->
                    <a href="{{ route('dashboard') }} "><img class="img-fluid h-100" src="{{ asset('auth/images/auth_brand.png') }}" alt="Logo"></a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                        <label class="form-check-labels"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
                    </svg>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <!-- Start Dashboard -->
                <li class="sidebar-item {{ ($route == 'dashboard') ? 'active' : ''}}">
                    <a href="{{ route('dashboard') }}" class="sidebar-link {{ ($route == 'dashboard') ? 'bg-success' : ''}}">
                        <i class="bi bi-grid-fill"></i>
                        <span class="{{ ($route == 'dashboard') ? 'text-white' : '' }}">Dashboard</span>
                    </a>
                </li>
                <!-- End Dashboard -->

                <!-- Start Site Info Management -->
                @if(auth::user()->user_type == "HR")
                @else
                <li class="sidebar-title">Site Info Management</li>
                <li class="sidebar-item  has-sub {{ ($prefix == '/siteinfo') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link {{ ($prefix == '/siteinfo') ? 'bg-success text-white' : '' }}">
                        <i class="fas fa-align-center {{ ($prefix == '/siteinfo') ? 'text-white' : '' }}"></i>
                        <span class="{{ ($prefix == '/siteinfo') ? 'text-white' : '' }}">Manage Site Info</span>
                    </a>
                    <ul class="submenu {{ ($prefix == '/siteinfo') ? 'active' : '' }}">
                        <li class="submenu-item {{ ($route == 'admin.siteinfo.edit') ? 'active' : '' }}">
                            <a class="{{ ($route == 'admin.siteinfo.edit') ? 'text-success' : '' }}" href="{{ route('admin.siteinfo.edit') }}">Admin Site Info</a>
                        </li>
                        <li class="submenu-item {{ ($route == 'user.siteinfo.edit') ? 'active' : '' }}">
                            <a class="{{ ($route == 'user.siteinfo.edit') ? 'text-success' : '' }}" href="{{ route('user.siteinfo.edit') }}">Landing Site Info</a>
                        </li>
                        <li class="submenu-item {{ ($route == 'user.herosection.view' || $route == 'user.herosection.add' || $route == 'user.herosection.edit') ? 'active' : '' }}">
                            <a class="{{ ($route == 'user.herosection.view' || $route == 'user.herosection.add' || $route == 'user.herosection.edit') ? 'text-success' : '' }}" href="{{ route('user.herosection.view') }}">Herosection</a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- End Site Info Management -->

                <!-- Start User Inquiry -->
                <li class="sidebar-item {{ ($route == 'user.inquiries.view') ? 'active' : ''}}">
                    <a href="{{ route('user.inquiries.view') }}" class="sidebar-link {{ ($route == 'user.inquiries.view') ? 'bg-success' : ''}}">
                        <i class="fas fa-envelope-open-text"></i>
                        <span class="{{ ($route == 'user.inquiries.view') ? 'text-white' : '' }}">User Inquiry</span>
                    </a>
                </li>
                <!-- End User Inquiry -->

                <!-- Start Account Management -->
                @if(auth::user()->user_type == "HR")
                @else
                <li class="sidebar-title">Account Management</li>
                <li class="sidebar-item  has-sub {{ ($prefix == '/accounts') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link {{ ($prefix == '/accounts') ? 'bg-success' : '' }}">
                        <i class="bi bi-people-fill {{ ($prefix == '/accounts') ? 'text-white' : '' }}"></i>
                        <span class="{{ ($prefix == '/accounts') ? 'text-white' : '' }}">Manage Account</span>
                    </a>
                    <ul class="submenu {{ ($prefix == '/accounts') ? 'active' : '' }}">
                        <li class="submenu-item {{ ($route == 'user.view') ? 'active' : '' }}">
                            <a class="{{ ($route == 'user.view') ? 'text-success' : '' }}" href="{{ route('user.view') }}">View Users</a>
                        </li>
                        <li class="submenu-item {{ ($route == 'user.add') ? 'active' : '' }}">
                            <a class="{{ ($route == 'user.add') ? 'text-success' : '' }}" href="{{ route('user.add') }}">Add User</a>
                        </li>
                        <li class="submenu-item {{ ($route == 'user.archive.view') ? 'active' : '' }}">
                            <a class="{{ ($route == 'user.archive.view') ? 'text-success' : '' }}" href="{{ route('user.archive.view') }}">Archived</a>
                        </li>
                    </ul>
                </li>
                @endif
                <!-- End Account Management -->

                <!-- Start PDS Management -->
                <li class="sidebar-title fw-bold">PDS MANAGEMENT</li>
                <li class="sidebar-item  has-sub {{ ($prefix == '/pds') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link {{ ($prefix == '/pds') ? 'bg-success' : '' }}">
                        <i class="fas fa-file-alt {{ ($prefix == '/pds') ? 'text-white' : '' }}"></i>
                        <span class="{{ ($prefix == '/pds') ? 'text-white' : '' }}">
                            Manage PDS
                            <!-- Start Badge -->
                            @php
                            $for_verification_count = DB::table('pds_form_lists')->where('pds_status', 'For Verification')->where('pds_archived', 'No')->count();
                            @endphp

                            @if ($for_verification_count > 0)
                            <span class="badge bg-warning">{{ $for_verification_count }}</span>
                            @else
                            @endif
                            <!-- End  Badge -->
                        </span>
                    </a>
                    <ul class="submenu {{ ($prefix == '/pds') ? 'active' : '' }}">
                        <li class="submenu-item {{ ($route == 'pds.pending.view') ? 'active' : '' }}">
                            <a class="{{ ($route == 'pds.pending.view') ? 'text-success' : '' }}" href="{{ route('pds.pending.view') }}">
                                For Verification
                                <!-- Start Badge -->
                                @if ($for_verification_count > 0)
                                <span class="text-muted">({{ $for_verification_count }})</span>
                                @else
                                @endif
                                <!-- End Badge -->
                            </a>
                        </li>
                        <li class="submenu-item {{ ($route == 'pds.verified.view') ? 'active' : '' }}">
                            <a class="{{ ($route == 'pds.verified.view') ? 'text-success' : '' }}" href="{{ route('pds.verified.view') }}">Verified</a>
                        </li>
                        <li class="submenu-item {{ ($route == 'pds.invalid.view') ? 'active' : '' }}">
                            <a class="{{ ($route == 'pds.invalid.view') ? 'text-success' : '' }}" href="{{ route('pds.invalid.view') }}">Invalid</a>
                        </li>
                        <li class="submenu-item {{ ($route == 'pds.archived.view') ? 'active' : '' }}">
                            <a class="{{ ($route == 'pds.archived.view') ? 'text-success' : '' }}" href="{{ route('pds.archived.view') }}">Archived</a>
                        </li>
                    </ul>
                </li>
                <!-- End PDS Management -->

                <!-- Start Service Record Management -->
                <li class="sidebar-title fw-bold">SERVICE RECORD</li>
                <li class="sidebar-item  has-sub {{ ($prefix == '/manage-sr') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link {{ ($prefix == '/manage-sr') ? 'bg-success' : '' }}">
                        <i class="fas fa-file-invoice {{ ($prefix == '/manage-sr') ? 'text-white' : '' }}"></i>
                        <span class="{{ ($prefix == '/manage-sr') ? 'text-white' : '' }}">
                            Manage SR
                            <!-- Start Badge -->
                            @php
                            $pending_count = DB::table('user_request_service_records')->where('service_record_status', 'Pending')->where('archived','No')->count();
                            @endphp

                            @if ($pending_count > 0)
                            <span class="badge bg-warning">{{ $pending_count }}</span>
                            @else
                            @endif
                            <!-- End Badge -->
                        </span>
                    </a>
                    <ul class="submenu {{ ($prefix == '/manage-sr') ? 'active' : '' }}">
                        <li class="submenu-item {{ ($route == 'all.request.view' || $route == 'edit.request.sr') ? 'active' : '' }}">
                            <a class="{{ ($route == 'all.request.view' || $route == 'edit.request.sr') ? 'text-success' : '' }}" href="{{ route('all.request.view') }}">
                                All Request
                                <!-- Start Badge -->
                                @if ($pending_count > 0)
                                <span class="text-muted">({{ $pending_count }})</span>
                                @else
                                @endif
                                <!-- End Badge -->
                            </a>
                        </li>
                        <li class="submenu-item {{ ($route == 'all.completed.view' || $route == 'viewdetails.completed.sr') ? 'active' : '' }}">
                            <a class="{{ ($route == 'all.completed.view' || $route == 'viewdetails.completed.sr') ? 'text-success' : '' }}" href="{{ route('all.completed.view') }}">Completed Request</a>
                        </li>
                        <li class="submenu-item {{ ($route == 'all.archived.view') ? 'active' : '' }}">
                            <a class="{{ ($route == 'all.archived.view') ? 'text-success' : '' }}" href="{{ route('all.archived.view') }}">Archived</a>
                        </li>
                    </ul>
                </li>
                <!-- End Service Record Management -->

                <!-- Start Report Management -->
                <li class="sidebar-item {{ ($route == 'generate.report.view') ? 'active' : ''}}">
                    <a href="{{ route('generate.report.view') }}" class="sidebar-link {{ ($route == 'generate.report.view') ? 'bg-success' : ''}}">
                        <i class="fas fa-folder"></i>
                        <span class="{{ ($route == 'generate.report.view') ? 'text-white' : '' }}">Manage Report</span>
                    </a>
                </li>
                <!-- End Report Management -->
            </ul>
        </div>
    </div>
</div>