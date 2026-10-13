@extends('layouts.main')
@section('title', __('form.commission'))
@section('content')

    <div class="main-content">
        <h5>@lang('form.commission')</h5>
        <hr>
        @if(check_perm(['payments_view', 'invoices_view', 'invoices_view_own']))
        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="data">
            <thead>
            <tr>
               <th>Date</th>
                <th>Invoice #</th>
                <th>Commission %</th>
                <th>Commission Amount</th>
                              
            </tr>
            
            @foreach($rec as $row)
            <tr><td>{{$row['date']}} </td><td>{{$row['number']}} </td><td>{{$row['percent']}} </td><td>{{$row['amount']}} </td></tr>
            @endforeach
            </thead>
        </table>
        @endif
    </div>
@endsection
@section('onPageJs')
    <script>
/*
        $(function() {

            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: [

                    {
                        init: function(api, node, config) {
                            $(node).removeClass('btn-secondary')
                        },
                        className: "btn-light btn-sm",
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                            'copy',
                            'excel',
                            'csv',
                            'pdf',
                            'print'
                        ]
                    }
                ],

                "language": {
                    "lengthMenu": '_MENU_ ',
                    "search": '',
                    "searchPlaceholder": "{{ __('form.search') }}"
                    // "paginate": {
                    //     "previous": '<i class="fa fa-angle-left"></i>',
                    //     "next": '<i class="fa fa-angle-right"></i>'
                    // }
                }

                ,
                responsive: true,
                processing: true,
                serverSide: true,
                //iDisplayLength: 5
                pageLength: {{ data_table_page_length() }},
                ordering: false,
                "columnDefs": [
                    { className: "text-right", "targets": [5] }
                    // { className: "text-center", "targets": [5] }


                ],
                "ajax": {
                    "url": '{!! route("datatables_payment") !!}',
                    "type": "POST",
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            }).
            on('mouseover', 'tr', function() {
                jQuery(this).find('div.row-options').show();
            }).
            on('mouseout', 'tr', function() {
                jQuery(this).find('div.row-options').hide();
            });

        });

*/
    </script>
@endsection