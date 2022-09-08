@extends('layout.admin')

@section('content')

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Tables Widget 13-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body">
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
                                <th class="text-center">Date</th>
                                <th class="text-center">Operations</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            <tr>
                                <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$message->name}}</td>
                                <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$message->email}}</td>
                                <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$message->phone}}</td>
                                <td class="text-dark text-center fw-bolder text-hover-primary fs-6">{{$message->created_at->format('Y-m-d')}}</td>
                                <td class="text-center" style="display: flex; justify-content: center; ">
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
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <hr>
                <br>
                <p style="font-weight: bold;font-size: 25px; text-align: center;">Message Subject <br> {{$message->subject}}</p>
                <hr>
                <p style="font-weight: bold;font-size: 20px; text-decoration: underline; text-align: center;">Message Content</p>
                <br>
                <div style="margin-left: 20px; margin-right: 20px;">
                    <p style="font-weight: bold;font-size: 18px; color: #6a1a21; "
                       class="form-control">{{$message->message}}</p>
                </div>
                <br>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 13-->
        </div>
        <!--end::Container-->
    </div>
@endsection
