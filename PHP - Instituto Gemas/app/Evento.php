<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Cast\Object_;

class Evento extends Model
{
    use Notifiable;
    protected $table = "eventos";
    protected $dates = [
        "data"
    ];

    protected $fillable = ['nome', 'capa', 'descricao', 'endereco', 'data'];


    public function rules()
    {
        return [
            'nome' => 'required|max:150|min:5',
            'descricao' => 'required|min:5',
            'endereco' => 'required|min:2|max:250',
            'data' => 'required|date'
        ];
    }

    public function messenges()
    {

    }

    public function getGalleria()
    {
        if (!$this->galleria) {
            return [];
        }
        return (json_decode($this->galleria, true));
    }

    public function setGalleria($galleria)
    {
        $this->galleria = json_encode($galleria);

        return $this;
    }

    public function setData($data)
    {

        if (strlen($data) == 16) {
            $data = $data . ":00";
        }
        $this->data = str_replace("T", " ", $data);
    }


}
