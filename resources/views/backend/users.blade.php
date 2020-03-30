@extends('layouts.exskel')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{ $dataTable->table([], true) }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}

    <script>
        $('document').ready(function(){
            $('#user-table_wrapper').addClass('table-responsive');
            $('#user-table').addClass('table-striped table-dark w-100');
        })
    </script>
@endpush
