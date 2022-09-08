@extends('layout.admin')
@push('css')
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{asset('admin-assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
@endpush
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Messages</h1>
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
                        <li class="breadcrumb-item text-dark">Messages</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Button-->
                <a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app"
                   id="kt_toolbar_dark_button"><i class="fa fa-compass"></i>Send Message</a>
                <!--end::Button-->
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
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table id="example2"
                                   class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <!--begin::Table head-->
                                <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="text-center">Name</th>
                                    <th class="text-center">E-Mail</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Operations</th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                @forelse($messages as $message)
                                    <tr>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$message->name}}</td>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$message->email}}</td>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$message->phone}}</td>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$message->created_at->format('Y-m-d')}}</td>
                                        @if($message->status == 'Unread')
                                            <td class="text-center">
                                                <span class="badge badge-light-danger">Unread</span>
                                            </td>
                                        @elseif($message->status == 'Read')
                                            <td class="text-center">
                                                <span class="badge badge-light-success">Read</span>
                                            </td>
                                        @endif
                                        <td class="text-center" style="display: flex; justify-content: center; ">
                                            <a class="btn btn-icon btn-bg-warning btn-active-color-warning btn-sm"
                                               style="border-radius: 8px;margin-left: 5px; margin-right: 5px;" href="{{route('messages.show', $message->id)}}">
                                                <i class="fa fa-eye" style="color: #fff"></i>
                                            </a>
                                            <form method="POST" action="{{ route('messages.destroy', $message->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button href="{{route('messages.destroy',$message->id)}}"
                                                        class="btn btn-icon btn-bg-danger btn-active-color-primary show_confirm btn-sm"
                                                        style="border-radius: 8px;margin-left: 5px; margin-right: 5px;">
                                                    <i class="fa fa-trash" style="color: #fff"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <td valign="top" colspan="12" class="dataTables_empty text-center">No Matching Records Found
                                    </td>
                                @endforelse
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
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

    <!--begin::Modal - Create Admin-->
    <div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-600px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>Send Message</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="black"/>
									<rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="black"/>
								</svg>
							</span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-lg-10 px-lg-10">
                    <!--begin::Stepper-->
                    <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
                         id="kt_modal_create_app_stepper">
                        <!--begin::Content-->
                        <div class="flex-row-fluid py-lg-5 px-lg-15">
                            <!--begin::Form-->
                            <form class="form" id="kt_modal_create_app_form" method="post"
                                  action="{{route('messages.store')}}">
                                @csrf
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <!--begin::Step 1-->
                                <div class="current" data-kt-stepper-element="content">
                                    <div class="w-100">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Emails</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify email addresses"></i>
                                            </label>
                                            <!--end::Label-->
                                            <input data-role="tagsinput" class="form-control form-control-solid" value="" name="emails" />
                                            <small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small>
                                        </div>
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Subject</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                   title="Subject"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                   name="subject" placeholder="Subject" required/>
                                            <!--end::Input-->
                                        </div>
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Message</span>
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                                   title="Message"></i>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-lg form-control-solid"
                                                      name="message" placeholder="Message" required
                                                      minlength="10"></textarea>
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
                                </div>

                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Stepper-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Create Admin-->

@endsection
@push('js')
    <script src="{{asset('admin-assets/plugins/input-tags/js/tagsinput.js')}}"></script>
    <link href="{{asset('admin-assets/plugins/input-tags/css/tagsinput.css')}}" rel="stylesheet"/>
    <script src="{{asset('admin-assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    @include('partials.admin.tables')
@endpush