@extends('admin.layouts.app')
{{-- @section('cost_active', 'active pcoded-trigger')
@section('view_cost_active', 'active') --}}
@section('title', 'Language')
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
            {{-- @include('partials.page_buttons') --}}
            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
              data-bs-target="#dataModal">
              <i class="la la-plus"></i> Add New
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        {{-- @include('pages.language.details.search') --}}
        <table id="datatable" class="table table-bordered dt-responsive w-100">
          <thead>
            <tr>
              <th>
                <label class="form-check-label" for="formCheck1">
                  <input onchange="select_all()" class="form-check-input selectall" style="background-color: lightgray;"
                    type="checkbox" id="formCheck1">
                </label>
              </th>
              <th>Key</th>
              <th>Code</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="keyList">
            @forelse ($json as $key => $value)
            <tr id="lang{{ $key }}">
              <td><input type='checkbox' name='did[]' value='{{ $key }}' class='form-check-input select_data'></td>
              <td>{{ $key }}</td>
              <td>{{ $value }}</td>
              <td>
                <div class='d-flex gap-3'><a href='javascript:void(0);' class='text-success editBtn'
                    data-bs-target="#dataModal" data-bs-toggle="modal" data-title="{{ $key }}" data-key="{{ $key }}"
                    data-value="{{ $value }}" data-id='{{ $key }}'><i class='mdi mdi-pencil font-size-18'></i></a><a
                    href='javascript:void(0);' class='text-danger deleteBtn' data-id='{{ $lang->id }}'
                    data-key="{{ $key }}" data-value="{{ $value }}"><i class='mdi mdi-delete font-size-18'></i></a>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="100%" class="text-center">No data found</td>
            </tr>
            @endforelse
            </>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
@section('modal')
@include('pages.language.details.create')
@endsection
@push('script')
<script>
  $(document).ready(function() {

            /** BEGIN:: SAVE FORM TRIGGER CODE **/
            $('#dataForm').on('submit', function(event) {
                event.preventDefault();
                var data = new FormData(this);
                var state = $('#saveBtn').val();
                if (state == "update") {
                    var id = {{ $lang->id }};
                    var key = $("#dataForm #key").val();
                    var url = "{{ route('admin.languages_details.update', [':id', ':key']) }}";
                    url = url.replace(":id", id);
                    url = url.replace(":key", key);
                } else {
                    var url = "{{ route('admin.languages_details.store') }}";
                }
                alert(url);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                      console.log(data);
                        var tr = `<tr id="lang${data.key}">
                          <td><input type='checkbox' name='did[]' value='${data,key}' class='form-check-input select_data'></td>
                          <td>${data.key}</td>
                          <td>${data.value}</td>
                          <td>
                            <div class='d-flex gap-3'><a href='javascript:void(0);' class='text-success editBtn' data-bs-target="#dataModal"
                                data-bs-toggle="modal" data-title="${data.key}" data-key="${data.key}" data-value="${data.value}"
                                data-id='${data.key}'><i class='mdi mdi-pencil font-size-18'></i></a><a href='javascript:void(0);'
                                class='text-danger deleteBtn' data-id='${data.key}' data-key="${data.key}" data-value="${data.value}"><i
                                  class='mdi mdi-delete font-size-18'></i></a>
                            </div>
                          </td>
                        </tr>`;
                        if (state == "add") {
                            $('#keyList').append(tr);
                        } else {
                            $(`#lang${data.key}`).replaceWith(tr);
                        }
                        $('#dataForm').trigger("reset");
                        $('#dataModal').modal('hide')
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

            /** BEGIN:: FETCH DATA TO UPDATE CODE */
            $(document).on("click", ".editBtn", function() {
                $("#dataForm")[0].reset(); // reset form on show modals
                $(".error").each(function() {
                    $(this).empty(); //remove error text
                });
                $("#dataForm").find(".is-invalid").removeClass("is-invalid"); //remover red border color
                $("#dataForm #value").val($(this).data('value'));
                $("#dataForm #key").val($(this).data('key'));
                $("#dataForm #key").attr('readonly', 'readonly');
                $("#dataModal").modal("show");
                // $('.selectpicker').selectpicker('refresh');
                $(".modal-title").html(
                    '<i class="fas fa-edit"></i> <span>Edit</span>');
                $("#saveBtn").text("Update");
                $("#saveBtn").val("update");
            });

            /** BEGIN:: DELETE FORM TRIGGER CODE **/
            $(document).on("click", ".deleteBtn", function() {
                var id = $(this).data("id");
                var key = $(this).data("key");
                var value = $(this).data("value");
                var url = "{{ route('admin.languages_details.destroy', [':id', ':key']) }}";
                url = url.replace(":id", id);
                url = url.replace(":key", key);
                // delete_data(table, row, id, url);
                $.ajax({
                    type: "POST",
                    url: url,
                    success: function(data) {
                        console.log(data);
                        $(`#lang${key}`).remove();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
</script>
@endpush