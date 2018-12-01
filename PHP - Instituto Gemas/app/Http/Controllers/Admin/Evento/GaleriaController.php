<?php

namespace App\Http\Controllers\Admin\Evento;

use App\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{

    private $evento;
    private $pathImageMain = "image/evento/galeria/main";
    private $pathImageThumnail = "image/evento/galeria/thumbnail";

    public function __construct(Evento $evento)
    {
        $this->evento = $evento;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evento = $this->evento->find($id);

        if ($evento->exists) {

            return view("admin.evento.galeria")
                ->with("evento", $evento)
                ->with("galerias", $evento->getGalleria());

        } else {
            return redirect()->route("admin.evento.todos");
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "imagens.*" => "required|image|max:2000",
            "id" => "exists:eventos,id"
        ]);

        $this->evento = $this->evento->find($id);
        $galeria = $this->evento->getGalleria();
        $files = $request->file("imagens");
        foreach ($files as $key => $image) {

            $name = md5(uniqid(time())) . "." . $image->getClientOriginalExtension();
            $imageMain = $image->storeAs($this->pathImageMain, $name);
            $imageThumbnail = $image->storeAs($this->pathImageThumnail, $name);
            $galeria[] = $name;

            // recriar a imagem do tamanho certo
            $image = Image::make(Storage::get($imageMain));
            $image->resize(1200, 675, function ($constraint) {
                $constraint->aspectRatio();
            });
            $canvas = Image::canvas(1200, 675, "#fff");
            $canvas->insert($image, 'center');
            $canvas->save(public_path('storage/'.$imageMain) );
            unset($canvas);
            // criando thumnail
            $image = Image::make(Storage::get($imageMain));
            $image->resize(480, 270)->save(public_path('storage/'.$imageThumbnail));
        }
        $this->evento->setGalleria($galeria);
        $this->evento->save();

        return redirect()->back()->with("success", "Imagens Enviadas com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $evento = $this->evento->find($request->get("evento_id"));
        $galleria = $evento->getGalleria();

        if (!isset($galleria[$id])) {
            return redirect()->back()->with("danger", "Id não encontrado");
        }

        Storage::delete($this->pathImageThumnail . $galleria[$id]);
        Storage::delete($this->pathImageMain . $galleria[$id]);
        unset($galleria[$id]);
        $evento->setGalleria($galleria);
        $evento->save();

        return redirect()->back()->with("success", "Imagem deletada com sucesso");
    }
}
