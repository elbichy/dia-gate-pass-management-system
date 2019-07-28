@extends('layout.print', ['title' => 'Guests clear at the gate today'])

@section('content')
    <div class="sectionTableWrap card">
        <div class="dataTables_wrapper">
            <table class="table centered table-bordered" id="users-table">
                <thead>
                    <tr>
                        <h5 style="margin-bottom:40px; padding:10px; border:2px solid #eee; text-align:center; width:100%;">List of guests cleared at the gate today</h5>
                    </tr>
                    <tr>
                        <th>SN</th>
                        <th>Personnel Name(s)</th>
                        <th>Block</th>
                        <th>Office</th>
                        <th>Guest Name(s)</th>
                        <th>Gender</th>
                        <th>Date/Time</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
    <script>
        $(function() {
            $('#users-table').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'csv', 'excel', 'pdf'
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                processing: true,
                serverSide: true,
                ajax:  `{!! route('admin.getGateGuestList') !!}`,
                columns: [
                    {
                        "data": "id",
                        "title": "SN",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }, "orderable": false, "searchable": false
                    },
                    { data: 'userFullname', name: 'userFullname' },
                    { data: 'user.block', name: 'user.block', title: 'Block' },
                    { data: 'user.office', name: 'user.office', title: 'Office' },
                    { data: 'fullname', name: 'fullname'},
                    { data: 'gender', name: 'gender'},
                    { data: 'created_at', name: 'created_at'},
                ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var input = document.createElement("input");
                        $(input).attr('placeholder', 'Search');
                        $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                    });
                },
            });
            $('.dataTables_length > label > select').addClass('browser-default');      
        });
    </script>
@endpush