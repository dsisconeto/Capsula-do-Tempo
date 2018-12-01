@extends("layout.main")

@push("css")
    <style>
        iframe {
            width: 100%;
            height: 600px;
            margin-bottom: 50px;
        }
    </style>
@endpush

@section("container")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">Estatuto Social<br>
                    <small>Instituto Gestão Meio Ambiente e Sociedade - GEMAS</small>
                </h1>
                <iframe src="{{asset("/storage/documentos/{$estatuto["pdf"]}")}}" class=""
                        style=""></iframe>
            </div>
        </div>
    </div>
@endsection