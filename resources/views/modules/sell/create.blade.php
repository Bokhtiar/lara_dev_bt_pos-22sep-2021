    @extends('layouts.admin.app')

    @section('title', 'Sell Create')
    @section('css')
    <link rel="stylesheet" href="{{ asset('admin') }}/plugins/select2/select2.min.css">
    @endsection

    @section('admin_content')
    
    @endsection

    @section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/plugins/select2/select2.full.min.js"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //end of ajax heaer setup

        $(function () {
            $('.select2').select2()
        })
        //end of select2
    </script>
    @endsection
