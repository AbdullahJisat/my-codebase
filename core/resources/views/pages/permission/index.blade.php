@extends('admin.layouts.app')
{{-- @section('cost_active', 'active pcoded-trigger')
@section('view_cost_active', 'active') --}}
@section('title', 'Permission')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <span class="pt-1 p-2">
                            <i class="kt-font-brand fa fa-align-left"></i>
                        </span>
                        <h3>
                            @yield('title')
                        </h3>
                    </div>
                    <div class="d-flex dataTableButton">
                        @include('partials.page_buttons')
                        <button type="button" class="btn btn-success waves-effect waves-light" id="showModal">
                            <i class="fas fa-plus"></i> Add New
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="permissionSearch" method="POST">
                    <div class="row">
                        @include('pages.permission.search')
                        @include('partials.search_button')
                    </div>
                </form>
                <table id="dataTablePermission" class="table table-striped dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>
                                <label class="form-check-label" for="formCheck1">
                                    <input onchange="select_all()" class="form-check-input selectall"
                                        style="background-color: lightgray;" type="checkbox" id="formCheck1">
                                </label>
                            </th>
                            <th>SR</th>
                            <th>Module</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Route Name</th>
                            <th>Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
@include('pages.permission.create')
@endsection
@push('script')
<script>
    var table;
        $(document).ready(function() {
            $(".select2").select2(),

            $("#bulk_action_delete").hide();
            /** BEGIN:: DATATABLE SERVER SIDE CODE **/
            var table = $('#dataTablePermission').DataTable({
                // "dom": 'Bfrtip',
                // "dom": `<'row'<'col-sm-12'tr>>
                // <'row'<'col-sm-12 col-md-5'i>
                // <'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
                "responsive": true, //make able resposive in mobile devices
                "bInfo": true, //to show the total number of data showing
                "bFilter": false, //for datatable default search box
                "lengthMenu": [
                    [5, 10, 15, 25, 50, 100, -1],
                    [5, 10, 15, 25, 50, 100, "All"]
                ],
                "pageLength": 10,
                "language": {
                    processing: "<img src='{{ asset('assets/dashboard') }}/images/table-loading.svg' />",
                    emptyTable: '<strong class="text-danger">No Data Found</strong>',
                    infoEmpty: '',
                    zeroRecords: '<strong class="text-danger">No Data Found</strong>',
                },

                "oLanguage": {
                    "sInfoFiltered": ""
                },

                // Load data for the table's content from an Ajax source//
                "ajax": {
                    "url": "{{ route('admin.permissions.list') }}",
                    "type": "POST",
                    "data": function(data) {
                        console.log(data);
                        data.search_query = $('#search_query').val();
                        data.search_module_id = $('#search_module_id').val();
                        data._token = "{{ csrf_token() }}";
                    }
                },
                "buttons": [
                    // {
                    // extend: 'print',
                    // title: "{{ ucwords('DEMOCHANGE') }}",
                    // orientation: 'portrait', //'landscape', //portrait
                    // pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    // exportOptions: {
                    // columns: [1, 2, 3, 4]
                    // },
                    // customize: function(win) {
                    // $(win.document.body).addClass('white-bg');
                    // $(win.document.body).find('table').addClass('display').css('font-size',
                    // '9px');
                    // $(win.document.body).find('h1').css('text-align', 'center');
                    // }
                    // },
                    {
                        extend: 'print',
                        title: "{{ ucwords('DemoTest') }}",
                        orientation: 'portrait', //'landscape', //portrait
                        pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                        exportOptions: {

                            columns: [1, 2]

                        },
                        customize: function(win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).find('table').addClass('display').css('font-size',
                                '9px');
                            $(win.document.body).find('h1').css('text-align', 'center');
                        }
                    },
                    'copyHtml5',
                    'colvis',
                    {
                        extend: 'excelHtml5',
                        title: "{{ ucwords('DEMOCHANGE') }}",
                        filename: 'house-report-eee',
                        exportOptions: {

                            columns: [1, 2]

                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: "{{ ucwords('DEMOCHANGE') }}",
                        filename: 'house-report',
                        exportOptions: {

                            columns: [1, 2]

                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: "{{ ucwords('DEMOCHANGE') }}",
                        filename: 'house-report',
                        orientation: 'portrait', //landscape
                        pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                        exportOptions: {

                            columns: [1, 2]

                        },
                        customize: function(doc) {
                            doc.content[1].table.widths = [
                                '10%',
                                '90%',
                            ];
                            //Remove the title created by datatTables
                            doc.content.splice(0, 1);
                            //Create a date string that we use in the footer. Format is dd-mm-yyyy
                            var now = new Date();
                            var jsDate = now.getDate() + '.' + (now.getMonth() + 1) + '.' + now
                                .getFullYear();
                            // Logo converted to base64
                            // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                            // The above call should work, but not when called from codepen.io
                            // So we use a online converter and paste the string in.
                            // Done on http://codebeautify.org/image-to-base64-converter
                            // It's a LONG string scroll down to see the rest of the code !!!
                            //var logo = '';
                            // A documentation reference can be found at
                            // https://github.com/bpampuch/pdfmake#getting-started
                            // Set page margins [left,top,right,bottom] or [horizontal,vertical]
                            // or one number for equal spread
                            // It's important to create enough space at the top for a header !!!
                            doc.pageMargins = [20, 60, 20, 30];
                            // Set the font size fot the entire document
                            doc.defaultStyle.fontSize = 7;
                            // Set the fontsize for the table header
                            doc.styles.tableHeader.fontSize = 7;
                            // Create a header object with 3 columns
                            // Left side: Logo
                            // Middle: brandname
                            // Right side: A document title
                            doc['header'] = (function() {
                                return {
                                    columns: [
                                        // {
                                        // image: logo,
                                        // width: 20,
                                        // },
                                        {
                                            alignment: 'right',
                                            // italics: true,
                                            text: 'warehouse Report',
                                            fontSize: 12,
                                            margin: [20, 0],
                                            width: 300,
                                        },
                                        {
                                            alignment: 'right',
                                            fontSize: 12,
                                            width: 200,
                                            text: ['Date: ', {
                                                text: jsDate.toString()
                                            }]
                                        }
                                    ],
                                    margin: 20
                                }
                            });
                            // Create a footer object with 2 columns
                            // Left side: report creation date
                            // Right side: current page and total pages
                            doc['footer'] = (function(page, pages) {
                                return {
                                    columns: [{
                                            alignment: 'left',
                                            text: ['Created on: ', {
                                                text: jsDate.toString()
                                            }]
                                        },
                                        {
                                            alignment: 'right',
                                            text: ['page ', {
                                                text: page.toString()
                                            }, ' of ', {
                                                text: pages.toString()
                                            }]
                                        }
                                    ],
                                    margin: 20,

                                }
                            });
                            // Change dataTable layout (Table styling)
                            // To use predefined layouts uncomment the line below and comment the custom lines below
                            // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                            var objLayout = {};
                            objLayout['hLineWidth'] = function(i) {
                                return .5;
                            };
                            objLayout['vLineWidth'] = function(i) {
                                return .5;
                            };
                            objLayout['hLineColor'] = function(i) {
                                return '#aaa';
                            };
                            objLayout['vLineColor'] = function(i) {
                                return '#aaa';
                            };
                            objLayout['paddingLeft'] = function(i) {
                                return 4;
                            };
                            objLayout['paddingRight'] = function(i) {
                                return 4;
                            };
                            doc.content[0].layout = objLayout;
                        },
                    },
                    {
                        extend: 'colvis',
                        name: 'colvis',
                        text: 'Column',
                        className: 'btn btn-sm btn-label-brand btn-bold',
                    },
                ],

                //Set column definition initialisation properties.
                "columnDefs": [{
                    "targets": [0, 3], //first column / numbering column

                    "orderable": false, //set not orderable
                    "className": "text-center",
                }],


            });

            /** END:: DATATABLE SERVER SIDE CODE **/

            $('.export').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                table.button(id).trigger();
            });

            /** BEGIN:: DATATABLE SEARCH FORM BUTTON TRIGGER CODE **/
            $('#btn-filter').click(function() {
                table.ajax.reload();
            });
            
            $('#btn-reset').click(function() {
                $('#permissionSearch')[0].reset();
                $('.select2').val('0').trigger("change");
                table.ajax.reload();
            });
            /** END:: DATATABLE SEARCH FORM BUTTON TRIGGER CODE **/

            document.querySelectorAll('.colVis').forEach((el) => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();

                    let columnIdx = e.target.getAttribute('data-column');
                    let column = table.column(columnIdx);

                    // Toggle the visibility
                    column.visible(!column.visible());
                });
            });

            /** BEGIN:: SAVE FORM TRIGGER CODE **/
            $('#dataForm').on('submit', function(event) {
                event.preventDefault();
                var data = new FormData(this);
                var id = $('#updateId').val();
                if (id) {
                    var method = 'update';
                    var url = "{{ route('admin.permissions.update', ':id') }}";
                    url = url.replace(':id', id);
                } else {
                    var method = 'store';
                    var url = "{{ route('admin.permissions.store') }}";
                }
                storeData(table, url, method, data);
            });

            /** BEGIN:: FETCH DATA TO UPDATE CODE */
            $(document).on("click", ".editBtn", function() {
                var id = $(this).data("id");
                var url = "{{ route('admin.permissions.edit', ':id') }}";
                url = url.replace(":id", id);
                // var _token = "{{ csrf_token() }}";
                $("#dataForm")[0].reset(); // reset form on show modals
                $(".error").each(function() {
                    $(this).empty(); //remove error text
                });
                $("#dataForm").find(".is-invalid").removeClass("is-invalid"); //remover red border color


                /** BEGIN:: FETCHING DATA AJAX CODE **/
                    $.ajax({
                        url: url,
                        type: "GET",
                        data: {
                            id: id,
                            // _token: _token
                        },
                        dataType: "JSON",
                        success: function(data) {
                            console.log(data.permission);
                            $("#dataForm #name").val(data.permission.name);
                            $("#dataForm #slug").val(data.permission.slug);
                            $("#dataForm #module_id").val(data.permission.module_id);
                            $("#dataForm #updateId").val(data.permission.id);
                            $("#dataModal").modal("show");
                            // $('.selectpicker').selectpicker('refresh');
                            $(".modal-title").html(
                                '<i class="fas fa-edit"></i> <span>Edit</span>');
                            $("#saveBtn").text("Update");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(
                                thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr
                                .responseText
                            );
                        },
                    });
                /** END: FETCHING DATA AJAX CODE **/
            });

            /** BEGIN:: DELETE FORM TRIGGER CODE **/
            $(document).on("click", ".deleteBtn", function() {
                var row = table.row($(this).parents("tr"));
                var id = $(this).data("id");
                var url = "{{ route('admin.permissions.destroy', ':id') }}";
                url = url.replace(":id", id);
                delete_data(table, row, id, url);
            });

            /** BEGIN:: BULK ACTION DELETE AJAX CODE */
            $(document).on("click", "#bulk_action_delete", function(e) {
                var id = [];
                var rows;
                $(".select_data:checked").each(function(i) {
                    id.push($(this).val());
                    rows = table.rows($(".select_data:checked").parents("tr"));
                });
                console.log(id);
                if (id.length === 0) {
                    //tell us if the array is empty
                    Swal.fire({
                        type: "error",
                        title: "Error",
                        text: "Please checked at least one row of table!",
                    });
                } else {
                    var url = "{{ route('admin.permissions.bulk_delete') }}";
                    bulk_action_delete(table, url, id, rows);
                    $("#bulk_action_delete").hide();
                }
            });
            /** END:: BULK ACTION DELETE AJAX CODE */
        });

        $('#name').on('keyup', function() {
            urlGenerator(this.value, output_id = 'slug');
        });
</script>
@endpush