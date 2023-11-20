@extends('layouts.app')
{{-- @section('cost_active', 'active pcoded-trigger')
@section('view_cost_active', 'active') --}}
@push('style')
<style>
    .bg-danger {
        background-color: #fd397a !important;
    }
</style>
@endpush
@section('title', 'Role')
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
                        <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#roleModal">
                            <i class="la la-plus"></i> Add New
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('pages.role.search')
                <table id="dataTableRole" class="table table-striped dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>
                                <label class="form-check-label" for="formCheck1">
                                    <input onchange="select_all()" class="form-check-input selectall"
                                        style="background-color: lightgray;" type="checkbox" id="formCheck1">
                                </label>
                            </th>
                            <th>SR</th>
                            <th>Name</th>
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
@include('pages.role.create')
@endsection
@push('script')
<script>
    /***********************************************************
         ******* Start :: On Checked Select All Rows Of Table *******
         ************************************************************/
        function select_all() {
            if ($('.selectall:checked').length == 1) {
                $("#bulk_action_delete").show();
                $('.select_data').prop('checked', $(this).prop('checked', true));
                if ($('.select_data').is(':checked')) {
                    $('.select_data').closest('tr').addClass('bg-danger');
                    $('.select_data').closest('tr').children('td').addClass('text-white');
                } else {
                    $('.select_data').closest('tr').removeClass('bg-danger');
                    $('.select_data').closest('tr').children('td').removeClass('text-white');
                }
            } else {
                $("#bulk_action_delete").hide();
                $('.select_data').prop('checked', false);
                if ($('.select_data').is(':checked')) {
                    $('.select_data').closest('tr').addClass('bg-danger');
                    $('.select_data').closest('tr').children('td').addClass('text-white');
                } else {
                    $('.select_data').closest('tr').removeClass('bg-danger');
                    $('.select_data').closest('tr').children('td').removeClass('text-white');
                }
            }
        }
        /***********************************************************
         ******* End :: On Checked Select All Rows Of Table *******
         ************************************************************/
        var table;
        // $(document).ready(function() {
        //     $("#bulk_action_delete").hide();
        //     /** BEGIN:: DATATABLE SERVER SIDE CODE **/
        //     var table = $('#datatableRole').DataTable({
        //         // "dom": 'Bfrtip',
        //         "dom": `<'row'<'col-sm-12'tr>>
    //     <'row'<'col-sm-12 col-md-5'i>
    //         <'col-sm-12 col-md-7 dataTables_pager'lp>>`,
        //         "processing": true, //Feature control the processing indicator.
        //         "serverSide": true, //Feature control DataTables' server-side processing mode.
        //         "order": [], //Initial no order.
        //         "responsive": true, //make able resposive in mobile devices
        //         "bInfo": true, //to show the total number of data showing
        //         "bFilter": false, //for datatable default search box
        //         "lengthMenu": [
        //             [5, 10, 15, 25, 50, 100, -1],
        //             [5, 10, 15, 25, 50, 100, "All"]
        //         ],
        //         "pageLength": 25,
        //         "language": {
        //             processing: "<img src='{{ asset('assets/dashboard') }}/images/table-loading.svg' />",
        //             emptyTable: '<strong class="text-danger">No Data Found</strong>',
        //             infoEmpty: '',
        //             zeroRecords: '<strong class="text-danger">No Data Found</strong>',
        //         },

        //         // Load data for the table's content from an Ajax source//
        //         "ajax": {
        //             "url": "{{ route('admin.roles.list') }}",
        //             "type": "POST",
        //             "data": function(data) {
        //                 console.log(data);
        //                 // data.warehouse_id = $('#warehouse').val();
        //                 // data.customer_name = $('#customer_name').val();
        //                 // data.customer_phone = $('#customer_phone').val();
        //                 // data.customer_code = $('#customer_code').val();
        //                 // data.customer_email = $('#customer_email').val();
        //                 data._token = "{{ csrf_token() }}";
        //             }
        //         },
        //         "buttons": [
        //             {
        //                 extend: 'print',
        //                 title: "{{ ucwords('DemoText') }}",
        //                 orientation: 'portrait', //'landscape', //portrait
        //                 pageSize: 'A4', //A3 , A5 , A6 , legal , letter
        //                 exportOptions: {
        //                     columns: [1, 2, 3, 4]
        //                 },
        //                 customize: function(win) {
        //                     $(win.document.body).addClass('white-bg');
        //                     $(win.document.body).find('table').addClass('display').css('font-size',
        //                         '9px');
        //                     $(win.document.body).find('h1').css('text-align', 'center');
        //                 }
        //             },
        //             'copy',
        //             {
        //                 extend: 'excel',
        //                 title: "{{ ucwords('DemoText') }}",
        //                 filename: 'user-customer-report-eee',
        //                 exportOptions: {
        //                     columns: [0, 1, 2, 3]
        //                 }
        //             },
        //             {
        //                 extend: 'csv',
        //                 title: "{{ ucwords('DemoText') }}",
        //                 filename: 'user-customer-report',
        //                 exportOptions: {
        //                    columns: [0, 1, 3, 4]
        //                 }
        //             },
        //             {
        //                 extend: 'pdf',
        //                 title: "{{ ucwords('DemoText') }}",
        //                 filename: 'user-customer-report',
        //                 orientation: 'portrait', //landscape
        //                 pageSize: 'A4', //A3 , A5 , A6 , legal , letter
        //                 exportOptions: {
        //                     columns: [0, 1, 3, 4]
        //                 },
        //                 customize: function(doc) {
        //                     doc.content[1].table.widths = [
        //                         '10%',
        //                         '90%',
        //                     ];
        //                     //Remove the title created by datatTables
        //                     doc.content.splice(0, 1);
        //                     //Create a date string that we use in the footer. Format is dd-mm-yyyy
        //                     var now = new Date();
        //                     var jsDate = now.getDate() + '.' + (now.getMonth() + 1) + '.' + now
        //                         .getFullYear();
        //                     // Logo converted to base64
        //                     // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
        //                     // The above call should work, but not when called from codepen.io
        //                     // So we use a online converter and paste the string in.
        //                     // Done on http://codebeautify.org/image-to-base64-converter
        //                     // It's a LONG string scroll down to see the rest of the code !!!
        //                     //var logo = '';
        //                     // A documentation reference can be found at
        //                     // https://github.com/bpampuch/pdfmake#getting-started
        //                     // Set page margins [left,top,right,bottom] or [horizontal,vertical]
        //                     // or one number for equal spread
        //                     // It's important to create enough space at the top for a header !!!
        //                     doc.pageMargins = [20, 60, 20, 30];
        //                     // Set the font size fot the entire document
        //                     doc.defaultStyle.fontSize = 7;
        //                     // Set the fontsize for the table header
        //                     doc.styles.tableHeader.fontSize = 7;
        //                     // Create a header object with 3 columns
        //                     // Left side: Logo
        //                     // Middle: brandname
        //                     // Right side: A document title
        //                     doc['header'] = (function() {
        //                         return {
        //                             columns: [
        //                                 // {
        //                                 // image: logo,
        //                                 // width: 20,
        //                                 // },
        //                                 {
        //                                     alignment: 'right',
        //                                     // italics: true,
        //                                     text: 'warehouse Report',
        //                                     fontSize: 12,
        //                                     margin: [20, 0],
        //                                     width: 300,
        //                                 },
        //                                 {
        //                                     alignment: 'right',
        //                                     fontSize: 12,
        //                                     width: 200,
        //                                     text: ['Date: ', {
        //                                         text: jsDate.toString()
        //                                     }]
        //                                 }
        //                             ],
        //                             margin: 20
        //                         }
        //                     });
        //                     // Create a footer object with 2 columns
        //                     // Left side: report creation date
        //                     // Right side: current page and total pages
        //                     doc['footer'] = (function(page, pages) {
        //                         return {
        //                             columns: [{
        //                                     alignment: 'left',
        //                                     text: ['Created on: ', {
        //                                         text: jsDate.toString()
        //                                     }]
        //                                 },
        //                                 {
        //                                     alignment: 'right',
        //                                     text: ['page ', {
        //                                         text: page.toString()
        //                                     }, ' of ', {
        //                                         text: pages.toString()
        //                                     }]
        //                                 }
        //                             ],
        //                             margin: 20,

        //                         }
        //                     });
        //                     // Change dataTable layout (Table styling)
        //                     // To use predefined layouts uncomment the line below and comment the custom lines below
        //                     // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
        //                     var objLayout = {};
        //                     objLayout['hLineWidth'] = function(i) {
        //                         return .5;
        //                     };
        //                     objLayout['vLineWidth'] = function(i) {
        //                         return .5;
        //                     };
        //                     objLayout['hLineColor'] = function(i) {
        //                         return '#aaa';
        //                     };
        //                     objLayout['vLineColor'] = function(i) {
        //                         return '#aaa';
        //                     };
        //                     objLayout['paddingLeft'] = function(i) {
        //                         return 4;
        //                     };
        //                     objLayout['paddingRight'] = function(i) {
        //                         return 4;
        //                     };
        //                     doc.content[0].layout = objLayout;
        //                 },
        //             },
        //         ],

        //         //Set column definition initialisation properties.
        //         "columnDefs": [{
        //             "targets": [2],
        //             "orderable": false, //set not orderable
        //             "className": "text-center",
        //         }],


        //     });


        //     /** END:: DATATABLE SERVER SIDE CODE **/

        //     $('.export').on('click', function(e) {
        //         e.preventDefault();
        //         var id = $(this).data('id');
        //         table.button(id).trigger();
        //     });

        //     /** BEGIN:: DATATABLE SEARCH FORM BUTTON TRIGGER CODE **/
        //     $('#btn-filter').click(function() {
        //         table.ajax.reload();
        //     });

        //     $('#btn-reset').click(function() {
        //         $('#form-filter')[0].reset();
        //         table.ajax.reload();
        //     });
        //     /** END:: DATATABLE SEARCH FORM BUTTON TRIGGER CODE **/

        // });
        $(document).ready(function() {
            // final
            // $("#bulk_action_delete").hide();
            // /** BEGIN:: DATATABLE SERVER SIDE CODE **/
            // var table = $('#datatableRole').DataTable({
            //     "processing": true, //Feature control the processing indicator.
            //     "serverSide": true, //Feature control DataTables' server-side processing mode.
            //     "order": [], //Initial no order.
            //     "responsive": true, //make able resposive in mobile devices
            //     "bInfo": true, //to show the total number of data showing
            //     "bFilter": false, //for datatable default search box
            //     "lengthMenu": [
            //         [5, 10, 15, 25, 50, 100, -1],
            //         [5, 10, 15, 25, 50, 100, "All"]
            //     ],
            //     "pageLength": 10,
            //     "language": {
            //         processing: "<img src='{{ asset('assets/dashboard') }}/images/table-loading.svg' />",
            //         emptyTable: '<strong class="text-danger">No Data Found</strong>',
            //         infoEmpty: '',
            //         zeroRecords: '<strong class="text-danger">No Data Found</strong>',
            //     },
            //     "oLanguage": {
            //         "sInfoFiltered": ""
            //     },
            //     // Load data for the table's content from an Ajax source//
            //     "ajax": {
            //         "url": "{{ route('admin.roles.list') }}",
            //         "type": "POST",
            //         "data": function(data) {
            //             console.log(data);
            //             data._token = "{{ csrf_token() }}";
            //         }
            //     },

            //     "buttons": [{
            //             extend: 'print',
            //             title: "{{ ucwords('DemoTest') }}",
            //             orientation: 'portrait', //'landscape', //portrait
            //             pageSize: 'A4', //A3 , A5 , A6 , legal , letter
            //             exportOptions: {

            //                 columns: [0, 1, 2, 3]

            //             },
            //             customize: function(win) {
            //                 $(win.document.body).addClass('white-bg');
            //                 $(win.document.body).find('table').addClass('display').css('font-size',
            //                     '9px');
            //                 $(win.document.body).find('h1').css('text-align', 'center');
            //             }
            //         },
            //         'copyHtml5',
            //         {
            //             extend: 'excelHtml5',
            //             title: "{{ ucwords('DemoTest') }}",
            //             filename: 'user-customer-report-eee',
            //             exportOptions: {

            //                 columns: [0, 1, 2, 3]

            //             }
            //         },
            //         {
            //             extend: 'csvHtml5',
            //             title: "{{ ucwords('DemoTest') }}",
            //             filename: 'user-customer-report',
            //             exportOptions: {

            //                 columns: [0, 1, 3, 4]
            //             }
            //         },
            //         {
            //             extend: 'pdfHtml5',
            //             title: "{{ ucwords('DemoTest') }}",
            //             filename: 'user-customer-report',
            //             orientation: 'portrait', //landscape
            //             pageSize: 'A4', //A3 , A5 , A6 , legal , letter
            //             exportOptions: {

            //                 columns: [0, 1, 3, 4]
            //             },
            //             customize: function(doc) {
            //                 doc.content[1].table.widths = [
            //                     '10%',
            //                     '90%',
            //                 ];
            //                 //Remove the title created by datatTables
            //                 doc.content.splice(0, 1);
            //                 //Create a date string that we use in the footer. Format is dd-mm-yyyy
            //                 var now = new Date();
            //                 var jsDate = now.getDate() + '.' + (now.getMonth() + 1) + '.' + now
            //                     .getFullYear();
            //                 // Logo converted to base64
            //                 // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
            //                 // The above call should work, but not when called from codepen.io
            //                 // So we use a online converter and paste the string in.
            //                 // Done on http://codebeautify.org/image-to-base64-converter
            //                 // It's a LONG string scroll down to see the rest of the code !!!
            //                 //var logo = '';
            //                 // A documentation reference can be found at
            //                 // https://github.com/bpampuch/pdfmake#getting-started
            //                 // Set page margins [left,top,right,bottom] or [horizontal,vertical]
            //                 // or one number for equal spread
            //                 // It's important to create enough space at the top for a header !!!
            //                 doc.pageMargins = [20, 60, 20, 30];
            //                 // Set the font size fot the entire document
            //                 doc.defaultStyle.fontSize = 7;
            //                 // Set the fontsize for the table header
            //                 doc.styles.tableHeader.fontSize = 7;
            //                 // Create a header object with 3 columns
            //                 // Left side: Logo
            //                 // Middle: brandname
            //                 // Right side: A document title
            //                 doc['header'] = (function() {
            //                     return {
            //                         columns: [
            //                             // {
            //                             // image: logo,
            //                             // width: 20,
            //                             // },
            //                             {
            //                                 alignment: 'right',
            //                                 // italics: true,
            //                                 text: 'warehouse Report',
            //                                 fontSize: 12,
            //                                 margin: [20, 0],
            //                                 width: 300,
            //                             },
            //                             {
            //                                 alignment: 'right',
            //                                 fontSize: 12,
            //                                 width: 200,
            //                                 text: ['Date: ', {
            //                                     text: jsDate.toString()
            //                                 }]
            //                             }
            //                         ],
            //                         margin: 20
            //                     }
            //                 });
            //                 // Create a footer object with 2 columns
            //                 // Left side: report creation date
            //                 // Right side: current page and total pages
            //                 doc['footer'] = (function(page, pages) {
            //                     return {
            //                         columns: [{
            //                                 alignment: 'left',
            //                                 text: ['Created on: ', {
            //                                     text: jsDate.toString()
            //                                 }]
            //                             },
            //                             {
            //                                 alignment: 'right',
            //                                 text: ['page ', {
            //                                     text: page.toString()
            //                                 }, ' of ', {
            //                                     text: pages.toString()
            //                                 }]
            //                             }
            //                         ],
            //                         margin: 20,

            //                     }
            //                 });
            //                 // Change dataTable layout (Table styling)
            //                 // To use predefined layouts uncomment the line below and comment the custom lines below
            //                 // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
            //                 var objLayout = {};
            //                 objLayout['hLineWidth'] = function(i) {
            //                     return .5;
            //                 };
            //                 objLayout['vLineWidth'] = function(i) {
            //                     return .5;
            //                 };
            //                 objLayout['hLineColor'] = function(i) {
            //                     return '#aaa';
            //                 };
            //                 objLayout['vLineColor'] = function(i) {
            //                     return '#aaa';
            //                 };
            //                 objLayout['paddingLeft'] = function(i) {
            //                     return 4;
            //                 };
            //                 objLayout['paddingRight'] = function(i) {
            //                     return 4;
            //                 };
            //                 doc.content[0].layout = objLayout;
            //             },
            //         },
            //     ],

            //     //Set column definition initialisation properties.
            //     "columnDefs": [{

            //         "targets": [2],
            //         "orderable": false, //set not orderable
            //         "className": "text-center",
            //     }],

            //     //Set column definition initialisation properties.
            //     // "columnDefs": [{
            //     //         // "targets": [0,10], //first column / numbering column
            //     //         "orderable": false, //set not orderable
            //     //     },
            //     //     {
            //     //         // "targets": [0,10],
            //     //         "className": "text-center",
            //     //     }
            //     // ],
            // });
            // /** END:: DATATABLE SERVER SIDE CODE **/

            // $('.export').on('click', function(e) {
            //     e.preventDefault();
            //     var id = $(this).data('id');
            //     table.button(id).trigger();
            // });

            // final

            // /** BEGIN:: DATATABLE SEARCH FORM BUTTON TRIGGER CODE **/
            // $('#btn-filter').click(function() {
            //     table.ajax.reload();
            // });

            // $('#btn-reset').click(function() {
            //     $('#form-filter')[0].reset();
            //     $('#form-filter .selectpicker').selectpicker('refresh');
            //     table.ajax.reload();
            // });
            // /** END:: DATATABLE SEARCH FORM BUTTON TRIGGER CODE **/

            // /** END:: DATATABLE BUTTONS **/
            // new $.fn.dataTable.Buttons(table, {
            //     name: "export",
            //     buttons: [
            //         {
            //             extend: 'print',
            //             title: "Sale List",
            //             orientation: 'portrait', //'landscape', //portrait
            //             pageSize: 'A4', //A3 , A5 , A6 , legal , letter
            //             exportOptions: {


            //                     columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]


            //             },
            //             customize: function(win) {
            //                 $(win.document.body).addClass('white-bg');
            //                 $(win.document.body).find('table').addClass('display').css('font-size',
            //                     '9px');
            //                 $(win.document.body).find('h1').css('text-align', 'center');
            //             }
            //         },
            //         {
            //             extend: 'copy'
            //         },
            //         {
            //             extend: 'excel',
            //             title: "Sale List",
            //             filename: 'sale-report',
            //             exportOptions: {

            //                     columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]


            //             }
            //         },
            //         {
            //             extend: 'csv',
            //             title: "Sale List",
            //             filename: 'sale-report',
            //             exportOptions: {

            //                     columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]


            //             }
            //         },
            //         {
            //             extend: 'pdf',
            //             title: "Sale List",
            //             filename: 'sale-report',
            //             orientation: 'portrait', //landscape
            //             pageSize: 'A4', //A3 , A5 , A6 , legal , letter
            //             exportOptions: {

            //                     columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]


            //             },

            //         },

            //     ]
            // }).container().appendTo($('#btn_group'));

            // new $.fn.dataTable.Buttons(table, {
            //     name: 'visiable',
            //     buttons: [{
            //         extend: 'colvis',
            //         name: 'colvis',
            //         text: 'Column',
            //         className: 'btn btn-sm btn-label-brand btn-bold'
            //     }, ],

            // });

            // table.buttons('visiable', null).containers().appendTo($('.dataTableButton #colvis-btn'));
            /** END:: DATATABLE BUTTONS **/


            // finalize tobe

            /** BEGIN:: DATATABLE SERVER SIDE CODE **/

            $("#bulk_action_delete").hide();
            /** BEGIN:: DATATABLE SERVER SIDE CODE **/
            var table = $('#dataTableRole').DataTable({
                // "dom": 'Bfrtip',
                "dom": `<'row'<'col-sm-12'tr>>
                <'row'<'col-sm-12 col-md-5'i>
                    <'col-sm-12 col-md-7 dataTables_pager'lp>>`,
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
                    "url": "{{ route('admin.roles.list') }}",
                    "type": "POST",
                    "data": function(data) {
                        console.log(data);
                        data.search_name = $('#search_name').val();
                        data._token = "{{ csrf_token() }}";
                    }
                },
                "buttons": [
                    // {
                    //     extend: 'print',
                    //     title: "{{ ucwords('DEMOCHANGE') }}",
                    //     orientation: 'portrait', //'landscape', //portrait
                    //     pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    //     exportOptions: {
                    //         columns: [1, 2, 3, 4]
                    //     },
                    //     customize: function(win) {
                    //         $(win.document.body).addClass('white-bg');
                    //         $(win.document.body).find('table').addClass('display').css('font-size',
                    //             '9px');
                    //         $(win.document.body).find('h1').css('text-align', 'center');
                    //     }
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
                alert('da')
                table.ajax.reload();
            });

            $('#btn-reset').click(function() {
                $('#roleSearch')[0].reset();
                table.ajax.reload();
            });
            /** END:: DATATABLE SEARCH FORM BUTTON TRIGGER CODE **/
            // finalize tobe end


            $('#roleForm').on('submit', function(event) {
                event.preventDefault();
                var data = new FormData(this);
                var id = $('#updateId').val();
                if (id) {
                    var method = 'update';
                    var url = "{{ route('admin.roles.update', ':id') }}";
                    url = url.replace(':id', id);
                } else {
                    var method = 'store';
                    var url = "{{ route('admin.roles.store') }}";
                }
                storeData(table, url, method, data);
            });

            // $('#roleForm').on('submit', function(event) {
            function storeData(table, url, method, data) {
                // event.preventDefault();
                // CKEDITOR.instances.description.updateElement();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('#saveBtn').addClass('kt-spinner kt-spinner--md kt-spinner--light');
                    },
                    complete: function() {
                        $('#saveBtn').removeClass(
                            'kt-spinner kt-spinner--md kt-spinner--light');
                    },
                    success: function(data) {
                        console.log(data.errors);
                        $("#roleForm").find('.is-invalid').removeClass('is-invalid');
                        $("#roleForm").find('.error').remove();
                        $("#roleForm table tbody").find('.is-invalid').removeClass(
                            'is-invalid');
                        $("#roleForm table tbody").find('.error').remove();
                        if (data.status) {
                            // toastMessage(data.status, data.message);
                            $("#roleForm")[0].reset();
                            // $("#roleForm .selectpicker").selectpicker('refresh');
                            if (data.status == 'success') {
                                if (method == 'update') {
                                    table.ajax.reload(null, false);
                                } else {
                                    table.ajax.reload();
                                }

                                $('#roleModal').modal('hide');
                            }
                        } else {
                            console.log(data.errors);
                            $.each(data.errors, function(key, value) {
                                var key = key.split('.').join("_");
                                $("#roleForm input[name='" + key + "']").addClass(
                                    'is-invalid');
                                $("#roleForm select#" + key + ".selectpicker")
                                    .parent().addClass('is-invalid');
                                $("#roleForm textarea[name='" + key + "']")
                                    .addClass('is-invalid');
                                $("#roleForm input[name='" + key + "']").after(
                                    '<div id="' + key +
                                    '" class="error invalid-feedback">' + value +
                                    '</div>');
                                $("#roleForm select#" + key + ".selectpicker")
                                    .parent().after('<div id="' + key +
                                        '" class="error invalid-feedback">' + value +
                                        '</div>');
                                $("#roleForm textarea[name='" + key + "']").after(
                                    '<div id="' + key +
                                    '" class="error invalid-feedback">' + value +
                                    '</div>');
                                if (key == 'primary_image') {
                                    $('#choose-picture-box').css({
                                        'border': '1px dashed red'
                                    });
                                }

                                $("#roleForm table tbody").find("#" + key).addClass(
                                    'is-invalid');
                                $("#roleForm table tbody").find("#" + key).after(
                                    '<div id="' + key +
                                    '" class="error invalid-feedback">' + value +
                                    '</div>');
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr
                            .responseText);
                    }
                });
            }
            // });

            $(document).on('click', '.deleteBtn', function() {
                var row = table.row($(this).parents('tr'));
                var id = $(this).data('id');
                var url = "{{ route('admin.roles.destroy', ':id') }}";
                url = url.replace(':id', id);
                delete_data(table, row, id, url);
            });

            function delete_data(table, row, id, url) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6610f2',
                    cancelButtonColor: '#fd397a',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    id: id
                                },
                                dataType: 'json'
                            })
                            .done(function(response) {
                                if (response.status == 'success') {
                                    Swal.fire("Deleted!", response.message, "success").then(function() {
                                        // table.ajax.reload();
                                        table.row(row).remove().draw(false);
                                    });
                                } else if (response.status == 'error') {
                                    Swal.fire('Error deleting!', response.message, 'error');
                                }
                            })
                            .fail(function() {
                                swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                            });
                    }
                })
            }

            //BEGIN: FETCHING DATA AJAX CODE
            $(document).on('click', '.editBtn', function() {
                var id = $(this).data('id');
                var url = "{{ route('admin.roles.edit', ':id') }}";
                url = url.replace(':id', id);
                // var _token = "{{ csrf_token() }}";
                $('#roleForm')[0].reset(); // reset form on show modals
                $(".error").each(function() {
                    $(this).empty(); //remove error text
                });
                $("#roleForm").find('.is-invalid').removeClass('is-invalid'); //remover red border color

                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        id: id,
                        // _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data.role);
                        $('#roleForm #name').val(data.role.name);
                        $('#roleForm #updateId').val(data.role.id);
                        $('#roleModal').modal('show');
                        // $('.selectpicker').selectpicker('refresh');
                        $('.modal-title').html(
                            '<i class="fas fa-edit"></i> <span>Edit</span>');
                        $('#saveBtn').text('Update');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr
                            .responseText);
                    }
                });
            });
            //END: FETCHING DATA AJAX CODE

            //BEGIN: SELECT ALL CHECKBOX CHECKED IF ANY ROW SELECTED CODE
            $(document).on('change', '.select_data', function() {
                var total = $('.select_data').length;
                var number = $('.select_data:checked').length;
                if ($(this).is(':checked')) {
                    $(this).closest('tr').addClass('bg-danger');
                    $(this).closest('tr').children('td').addClass('text-white');
                } else {
                    $(this).closest('tr').removeClass('bg-danger');
                    $(this).closest('tr').children('td').removeClass('text-white');
                }
                if (total == number) {
                    $('.selectall').prop('checked', true);
                } else {
                    $('.selectall').prop('checked', false);
                }
                if (number > 0) {
                    $("#bulk_action_delete").show();
                } else {
                    $("#bulk_action_delete").hide();
                }
            });
            //END: SELECT ALL CHECKBOX CHECKED IF ANY ROW SELECTED CODE

            //START: BULK ACTION DELETE AJAX CODE
            $(document).on("click", '#bulk_action_delete', function(e) {
                var id = [];
                var rows;
                $('.select_data:checked').each(function(i) {
                    id.push($(this).val());
                    rows = table.rows($('.select_data:checked').parents('tr'));
                });
                console.log(id);
                if (id.length === 0) //tell us if the array is empty
                {
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'Please checked at least one row of table!',
                    })
                } else {
                    var url = "{{ route('admin.roles.bulk_delete') }}";
                    bulk_action_delete(table, url, id, rows);
                    $("#bulk_action_delete").hide();
                }
            });
            //END: BULK ACTION DELETE AJAX CODE
            /********************************************************
             ******* Start :: Bulk Action Delete Data Functions *******
             *********************************************************/

            function bulk_action_delete(table, url, id, rows) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6610f2',
                    cancelButtonColor: '#fd397a',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.value) {
                        // $.ajaxSetup({
                        //     headers: {
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //     }
                        // });
                        $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    id: id
                                },
                                dataType: 'json'
                            })
                            .done(function(response) {
                                if (response.status == 'success') {
                                    Swal.fire("Deleted!", response.message, "success").then(function() {
                                        // table.ajax.reload();
                                        $('.selectall').prop('checked', false);
                                        table.rows(rows).remove().draw(false);
                                        // table.ajax.reload();
                                    });
                                } else if (response.status == 'error') {
                                    Swal.fire('Error deleting!', response.message, 'error');
                                }
                            })
                            .fail(function() {
                                swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                            });
                    }
                })
            }
            /********************************************************
             ******* End :: Bulk Action Delete Data Functions *******
             *********************************************************/
        });
</script>
@endpush