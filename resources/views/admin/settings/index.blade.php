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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Settings</h1>
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
                        <li class="breadcrumb-item text-dark">Settings</li>
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
                    <div class="card-body py-3">
                        <form class="form" id="kt_modal_create_app_form" method="post"
                              action="{{route('settings.update')}}">
                            @csrf
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <p class="text-center"
                               style="color: #0b0b0b; text-decoration: underline; font-size: 20px; font-weight: bold;">
                                Update Settings</p>
                            <!--begin::Step 1-->
                            <div class="current" data-kt-stepper-element="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Phone</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                   title="Phone"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--end::Label-->
                                            <input data-role="tagsinput" class="form-control form-control-solid" value="{{unserialize($settings->where('key','phone')->first()->value)}}" name="phone" />
                                            <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">WhatsApp</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                   title="WhatsApp"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--end::Label-->
                                            <input data-role="tagsinput" class="form-control form-control-solid" value="{{unserialize($settings->where('key','whatsapp')->first()->value)}}" name="whatsapp" />
                                            <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Emails</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                   title="Emails"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input data-role="tagsinput" class="form-control form-control-solid" value="{{unserialize($settings->where('key','email')->first()->value)}}" name="email" />
                                            <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Address AR</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                   title="Address AR"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input data-role="tagsinput" class="form-control form-control-solid" value="{{unserialize($settings->where('key','address_ar')->first()->value)}}" name="address_ar" />
                                            <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Address EN</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                   title="Address EN"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input data-role="tagsinput" class="form-control form-control-solid" value="{{unserialize($settings->where('key','address_en')->first()->value)}}" name="address_en" />
                                            <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Location</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                   title="Location"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input data-role="tagsinput" class="form-control form-control-solid" value="{{unserialize($settings->where('key','location')->first()->value)}}" name="location" />
                                            <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">About EN</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="About EN"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-lg form-control-solid"
                                              name="about_en" placeholder="About EN">{{$settings->where('key','about_en')->first()->value}}</textarea>
                                    <!--end::Input-->
                                </div>
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">About AR</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="About AR"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-lg form-control-solid"
                                              name="about_ar" placeholder="About AR">{{$settings->where('key','about_ar')->first()->value}}</textarea>
                                    <!--end::Input-->
                                </div>
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Footer EN</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Footer EN"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-lg form-control-solid"
                                              name="footer_en" placeholder="Footer EN">{{$settings->where('key','footer_en')->first()->value}}</textarea>
                                    <!--end::Input-->
                                </div>
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Footer AR</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Footer AR"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-lg form-control-solid"
                                              name="footer_ar" placeholder="Footer AR">{{$settings->where('key','footer_ar')->first()->value}}</textarea>
                                    <!--end::Input-->
                                </div>
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Terms EN</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Terms EN"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-lg form-control-solid"
                                              name="terms_en" placeholder="Terms EN">{{$settings->where('key','terms_en')->first()->value}}</textarea>
                                    <!--end::Input-->
                                </div>
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                        <span class="required">Terms AR</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                           title="Terms AR"></i>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea class="form-control form-control-lg form-control-solid"
                                              name="terms_ar" placeholder="Terms AR">{{$settings->where('key','terms_ar')->first()->value}}</textarea>
                                    <!--end::Input-->
                                </div>
                                <!--end::Step 1-->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        Submit
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    </button>
                                </div>
                                <!--end::Input group-->
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
    </div>
    <!--end::Content-->

@endsection
@push('js')
    <script>
        $('#edit_app').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var com_id = button.data('com_id')
            var com_name = button.data('com_name')
            var com_email = button.data('com_email')
            var modal = $(this)

            modal.find('.modal-body #com_id').val(com_id);
            modal.find('.modal-body #com_name').val(com_name);
            modal.find('.modal-body #com_email').val(com_email);

        })
    </script>
    <script src="{{asset('admin-assets/plugins/input-tags/js/tagsinput.js')}}"></script>
    <link href="{{asset('admin-assets/plugins/input-tags/css/tagsinput.css')}}" rel="stylesheet"/>
    <script src="{{asset('admin-assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin-assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    @include('partials.admin.tables')
@endpush
