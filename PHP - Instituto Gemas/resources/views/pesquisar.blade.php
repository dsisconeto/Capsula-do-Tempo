@extends('layout.main')

@section('container')

    <div class="title">Pesquisar por "{{$q}}"</div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <script>
                    (function () {
                        var cx = '012568866682311218784:985bbxke3ce';
                        var gcse = document.createElement('script');
                        gcse.type = 'text/javascript';
                        gcse.async = true;
                        gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(gcse, s);
                    })();
                </script>
                <gcse:searchresults-only></gcse:searchresults-only>
            </div>
        </div>
    </div>

@endsection