<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Informacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Validator;

class SlideController extends Controller
{

    private $slide;
    private $pathImageMain = "image/slide/main";
    private $pathImageThumnail = "image/slide/thumbnail";

    public function __construct(Informacoes $slide)
    {
        $this->slide = $slide->find(2);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = $this->slide->getDados();

        return view("admin.slides.index")->with("slides", $slides);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "image" => "image|required|max:1000",
            "link" => "url|nullable"
        ]);

        $file = $request->file("image");
        $name = md5(uniqid(time())) . "." . $file->getClientOriginalExtension();

        // Upload da imagem
        $pathMain = $file->storeAs($this->pathImageMain, $name);
        $pathThumbnail = $file->storeAs($this->pathImageThumnail, $name);

        // salvando no banco de dados
        $slide = $this->slide->getDados();
        $slide[] = ["image" => $name, "link" => $request->get("link")];
        $this->slide->setDados($slide);
        $this->slide->save();
     // recriar a imagem do tamanho certo
        $image = Image::make(Storage::get($pathMain));
        $image->resize(1600, 800, function ($constraint) {
            $constraint->aspectRatio();
        });
        $canvas = Image::canvas(1600, 800, "#fff");
        $canvas->insert($image, 'center');
        $canvas->save(public_path('storage/'.$pathMain));

        // criando thumnail
        $image = Image::make(Storage::get($pathMain));
        $image->resize(320, 160);
        $image->save( public_path('storage/'.$pathThumbnail));


        return redirect()->route("admin.slides.index")->with("success", "Imagem carregada com sucesso :)");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $slide = $this->slide->getDados();
        if (!isset($slide[$id])) {
            return redirect()->back()->with("danger", "ID não encontrado");
        }

        Storage::delete($this->pathImageMain . $slide[$id]["image"]);
        Storage::delete($this->pathImageThumnail . $slide[$id]["image"]);
        unset($slide[$id]);
        $this->slide->setDados($slide)->save();
        return redirect()->back()->with("success", "Imagem deleta com sucesso");


    }
}
