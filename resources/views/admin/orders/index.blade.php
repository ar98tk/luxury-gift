@extends('layout.admin')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" >
        <!--begin::Toolbar-->
        <div class="toolbar" >
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{$type}} Orders</h1>
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
                        <li class="breadcrumb-item text-dark">Orders</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Button-->
                <a href="{{route('orders.create')}}" class="btn btn-sm btn-primary">Create Order</a>
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
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Delivery Date</th>
                                    <th class="text-center">Delivered At</th>
                                    <th class="text-center">Operations</th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$order->user->name}}</td>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$order->user->email}}</td>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$order->user->phone}}</td>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$order->price}}</td>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$order->delivery_date !== null ? $order->delivery_date->format('Y-m-d') : 'No date yet'}}</td>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{@$order->delivered_at !== null ? $order->delivered_at->format('Y-m-d') : 'Not Delivered Yet'}}</td>
                                        <td class="text-dark text-center fw-bolder text-hover-primary fs-6"> <button class="btn btn-sm" style="background-color: {{$order->code}}"></button> {{$order->code}}</td>
                                        <td class="text-center" style="display: flex; justify-content: center; ">
                                            <a href="{{route('orders.edit',$order->id)}}"
                                               class="btn btn-icon btn-bg-primary btn-active-color-primary btn-sm"
                                               style="border-radius: 8px;margin-left: 5px; margin-right: 5px;">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <i class="fa fa-pen" style="color: #fff"></i>
                                            </a>
                                            <form method="POST" action="{{ route('orders.destroy', $order->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button href="{{route('orders.destroy',$order->id)}}"
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
