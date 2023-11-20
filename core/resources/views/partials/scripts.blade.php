<!-- JAVASCRIPT -->
<script src="{{ asset('assets/dashboard') }}/libs/jquery/jquery.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/metismenu/metisMenu.min.js"></script>
{{-- <script src="{{ asset('assets/dashboard') }}/libs/simplebar/simplebar.min.js"></script> --}}
<script src="{{ asset('assets/dashboard') }}/libs/node-waves/waves.min.js"></script>

<!-- Form validation -->
<script src="{{ asset('assets/dashboard') }}/libs/parsleyjs/parsley.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/js/pages/form-validation.init.js"></script>

<!-- apexcharts -->
{{-- <script src="{{ asset('assets/dashboard') }}/libs/apexcharts/apexcharts.min.js"></script> --}}

<!-- dashboard init -->
{{-- <script src="{{ asset('assets/dashboard') }}/js/pages/dashboard.init.js"></script> --}}

<!-- select2 -->
<script src="{{ asset('assets/dashboard') }}/libs/select2/js/select2.min.js"></script>


<!-- Required datatable js -->
<script src="{{ asset('assets/dashboard') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/dashboard') }}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/jszip/jszip.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- toastr plugin -->
<script src="{{ asset('assets/dashboard') }}/libs/toastr/build/toastr.min.js"></script>

<!-- Responsive examples -->
<script src="{{ asset('assets/dashboard') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets/dashboard') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
</script>

<!-- Datatable init js -->
<script src="{{ asset('assets/dashboard') }}/js/pages/datatables.init.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="{{ asset('assets/global/js/custom.js') }}"></script>
<script src="{{ asset('assets/global/js/create.js') }}"></script>
<script src="{{ asset('assets/global/js/edit.js') }}"></script>
<script src="{{ asset('assets/global/js/delete.js') }}"></script>
<script src="{{ asset('assets/global/js/bulk_delete.js') }}"></script>

@stack('script')

<!-- App js -->
<script src="{{ asset('assets/dashboard') }}/js/app.js"></script>
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/dashboard') }}/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="{{ asset('assets/dashboard') }}/js/pages/sweet-alerts.init.js"></script>