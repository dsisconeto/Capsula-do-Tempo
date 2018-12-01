<?php

namespace App\Http\Controllers\Admin\Evento;

use Illuminate\Support\Facades\Storage;
use App\Evento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Image;

class CapaController extends Controller
{

    private $evento;
    private $pathImageMain = "image/evento/capa/main";
    private $pathImageThubnail = "image/evento/capa/thumbnail";


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

        if ($evento) {

            return view("admin.evento.capa", compact(["evento", $evento]));
        } else {
            return redirect()->route('admin.evento.todos')->with("danger", "Evento não encontrado");
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
        $file = $request->file("capa");

        $validate = Validator::make($request->all(), [
            "capa" => "image|required|max:1000",
        ]);

        $this->evento = $this->evento->find($id);
        // VALIDANDO O ID
        $validate->after(function ($validate) {


            if (!isset($this->evento->id)) {

                $validate->errors()->add('id', 'Evento não encontrado');
            }


        });


        if (!$validate->fails()) {
            // GERANDO NOME
            $name = md5(uniqid(time())) . "." . $file->getClientOriginalExtension();

            $pathMain = $file->storeAs($this->pathImageMain, $name);
            $pathThumbnail = $file->storeAs($this->pathImageThubnail, $name);

            $image = Image::make(Storage::get($pathMain));

            $image->resize(1050, 750, function ($constraint) {
                $constraint->aspectRatio();
            });
            $canvas = Image::canvas(1050, 750, "#fff");
            $canvas->insert($image, 'center');
            $canvas->save(public_path('storage/'.$pathMain));
            unset($canvas);

            Image::make(Storage::get($pathMain))
                ->resize(350, 250)
                ->save(public_path('storage/'.$pathThumbnail));

            if ($this->evento->capa) {
                Storage::delete("$this->pathImageMain{$this->evento->capa}");
                Storage::delete("$this->pathImageThubnail{$this->evento->capa}");
            }


            $this->evento->capa = $name;
            $this->evento->update();

            return redirect()
                ->back()
                ->with("success", "Upload de capa com sucesso");
        }

        return redirect()->back()->withErrors($validate);
    }

}
