@extends("admin.layout")
@section("title")
    Slide Principal
@endsection

@push("css")
    <style>
        .slides-content > ul {
            display: block;
            width: 100%;
            list-style: none;
        }

        .slides-content > ul > li {
            width: 320px;
            height: 180px;
            display: block;
            float: left;
            margin: 0 10px 20px 0;
        }

        .slides-content > ul > li button {
            width: 100%;
            border-radius: 0;
        }

    </style>
@endpush

@section("content")

    <form action="{{route("admin.slides.store")}}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group row">
            <div class="col-md-6">
                <label for="image">
                    Imagem: tamanho Recomendado 1600x800
                </label>
                <input type="file" name="image" id="image" class="form-control" required="required">
            </div>

            <div class="col-md-6">
                <label for="link">
                    Link:
                </label>
                <input type="url" name="link" id="link" class="form-control">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <button class="btn btn-primary pull-right" type="submit">Enviar</button>
            </div>
        </div>
    </form>

    <h1>Imagens do Slide</h1>
    <hr>

    <div class="slides-content">
        <ul class="row">
            @forelse($slides as $key => $slide)
                <li class="col-md-4">
                    @if($slide["link"] != null)
                        <a href="{{$slide["link"]}}">
                            @endif
                            <img src="{{asset("/storage/image/slide/thumbnail/{$slide["image"]}")}}"
                                 class="img-responsive">
                            @if($slide["link"] != null)
                        </a>
                    @endif
                    <form action="{{route("admin.slides.destroy", $key)}}" method="POST">
                        {!! csrf_field() !!}
                        {!! method_field("DELETE") !!}
                        <button class="btn btn-danger">
                            Deletar
                        </button>
                    </form>
                </li>
            @empty
                Não existe slide no banco de dados
            @endforelse

        </ul>

    </div>

@endsection



