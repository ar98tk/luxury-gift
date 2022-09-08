@extends('layout.admin')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div class="toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit ({{$user->name}})</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('home')}}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Edit ({{$user->name}})</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        @if($errors->any())
            <div style="display: flex; justify-content: center">
                <!--begin::Alert-->
                <div class="alert alert-danger d-flex align-items-center p-5 mb-10 col-md-6">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
															<path opacity="0.3"
                                                                  d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                                                  fill="black"/>
															<path
                                                                d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
                                                                fill="black"/>
														</svg>
													</span>
                    <!--end::Svg Icon-->
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-danger">Validation Errors</h4>
                        @foreach($errors->all() as $error)
                            <!--begin::Content-->
                            <span>- {{$error}}</span>
                            <!--end::Content-->
                        @endforeach
                    </div>
                </div>
                <!--end::Alert-->
            </div>
        @endif
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Tables Widget 13-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <form class="form" method="post" action="{{route('users.update',$user->id)}}">
                            {{csrf_field()}}
                            @method('put')
                            <input type="hidden" id="com_id" name="id" value="{{$user->id}}">
                            <p class="text-center"
                               style="color: #0b0b0b; text-decoration: underline; font-size: 20px; font-weight: bold;">
                                Update User Info</p>
                            <!--begin::Step 1-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Name</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                               title="Name"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--end::Label-->
                                        <input class="form-control form-control-solid" required type="text"
                                               value="{{$user->name}}" name="name"/>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Email</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                               title="Email"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--end::Label-->
                                        <input class="form-control form-control-solid" type="email"
                                               value="{{$user->email}}" required name="email"/>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span>Phone</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                               title="Phone"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--end::Label-->
                                        <input class="form-control form-control-solid" type="number"
                                               value="{{$user->phone}}" name="phone"/>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span>Password</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                               title="Password"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--end::Label-->
                                        <input class="form-control form-control-solid" type="number"
                                               placeholder="Password" name="password"/>

                                    </div>
                                </div>
                            </div>
                            <!--end::Step 1-->
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    Update
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                </button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="card-body">
                        <p class="text-center"
                           style="color: #0b0b0b; text-decoration: underline; font-size: 20px; font-weight: bold;">
                            User Addresses</p>
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <!--begin::Table head-->
                                <thead>
                                <tr class="fw-bolder text-muted">

                                    <th class="text-center">Address</th>
                                    <th class="text-center">City</th>
                                    <th class="text-center">Operations</th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                @forelse($user->addresses as $address)
                                    <tr>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$address->address}}</td>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$user->city == null ? 'No City' : $user->city->name-en}}</td>
                                        <td class="text-center" style="display: flex; justify-content: center; ">
                                            <form method="POST" action="{{ route('address.destroy', $address->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button href="{{route('address.destroy',$address->id)}}"
                                                        class="btn btn-icon btn-bg-danger btn-active-color-primary show_confirm btn-sm"
                                                        style="border-radius: 8px;margin-left: 5px; margin-right: 5px;">
                                                    <i class="fa fa-trash" style="color: #fff"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <td valign="top" colspan="12" class="dataTables_empty text-center">
                                        No Matching Records Found
                                    </td>
                                @endforelse
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <hr>
                    <div class="card-body">
                        <p class="text-center"
                           style="color: #0b0b0b; text-decoration: underline; font-size: 20px; font-weight: bold;">
                            Add New Address</p>
                        <form class="form" method="post" action="{{route('address.store')}}">
                            @csrf
                            <input type="hidden" id="com_id" name="id" value="{{$user->id}}">
                            <!--begin::Step 1-->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">Address</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                               title="Address"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--end::Label-->
                                        <input class="form-control form-control-solid" required type="text" name="address"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                            <span class="required">City</span>
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                               title="City"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--end::Label-->
                                        <select class="form-control form-control-solid" required type="text" name="city">
                                            <option class="text-center" value="">--- Select City ---</option>
                                            @foreach($cities as $city)
                                                <option class="text-center" value="{{$city->id}}">{{$city->name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--end::Step 1-->
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-success">
                                    Add Address
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 13-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection
@push('js')
    <script src="{{asset('admin-assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin-assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    @include('partials.admin.tables')
@endpush
