<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Livro
 * @package App
 * @property string $nome
 * @property string $descricao
 * @property string $capa
 * @property string $link_pdf
 * @property string $link_epub
 * @property string $link_azw
 *
 */
class Livro extends Model
{
    protected $table = 'livros';
    public $timestamps = false;

}
