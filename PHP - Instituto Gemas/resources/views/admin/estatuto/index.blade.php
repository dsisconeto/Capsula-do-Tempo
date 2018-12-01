@extends("admin.layout")

@push("css")

@endpush

@section("title")
    Estatuto do Instituto
@endsection
@section("content")
    <form method="POST" action="{{route("admin.estatuto.store")}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="row form-group">
            <div class="col-md-12">
                <label for="estatuto">Estatuto em PDF:</label>
                <input type="file" name="estatuto" id="estatuto" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right">
                    Enviar
                </button>
            </div>
        </div>
    </form>
    @if(isset($estatuto["pdf"])  && $estatuto["pdf"])
        <div class="row">
            <iframe class="col-md-12" src="{{asset("/storage/documentos/{$estatuto["pdf"]}")}}"
                    style="height: 600px;"></iframe>
        </div>
    @else
        Não existe o arquivo

    @endif


@endsection