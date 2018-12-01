@extends("layout.main")

@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                  {{session('mensagem')}}
                </div>
            </div>
        </div>
    </div>
@endsection