<script>
    $(document).ready(function () {
        var table = $('#example2').DataTable({
            lengthChange: false,
            ordering: true,
            buttons: [
                {
                    extend:    'copyHtml5',
                    @if(Session::get('mode') == 'Dark')
                    text:      '<button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" style="border-radius: 8px;margin-left: 5px; margin-right: 5px;"> <i class="fa fa-copy" style="color: #fff"></i></button>',
                    @else
                    text:      '<button class="btn btn-icon btn-bg-dark btn-active-color-primary btn-sm" style="border-radius: 8px;margin-left: 5px; margin-right: 5px;"> <i class="fa fa-copy" style="color: #fff"></i></button>',
                    @endif
                    titleAttr: 'Copy'
                },
                {
                    extend:    'excelHtml5',
                    text:      '<button class="btn btn-icon btn-bg-success btn-active-color-success btn-sm" style="border-radius: 8px;margin-left: 5px; margin-right: 5px;"> <i class="fa fa-file-excel" style="color: #fff"></i></button>',
                    titleAttr: 'Excel'
                },
                {
                    extend:    'csvHtml5',
                    text:      '<button class="btn btn-icon btn-bg-primary btn-active-color-primary btn-sm" style="border-radius: 8px;margin-left: 5px; margin-right: 5px;"> <i class="fa fa-file-csv" style="color: #fff"></i></button>',
                    titleAttr: 'CSV'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<button class="btn btn-icon btn-bg-danger btn-active-color-primary btn-sm" style="border-radius: 8px;margin-left: 5px; margin-right: 5px;"> <i class="fa fa-file-pdf" style="color: #fff"></i></button>',
                    titleAttr: 'PDF'
                }
            ]
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">

    $('.show_confirm').click(function (event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });

</script>
