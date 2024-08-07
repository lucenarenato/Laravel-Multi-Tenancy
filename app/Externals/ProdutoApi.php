<?php


namespace App\Externals;


use App\Externals\Traits\FindTrait;

class ProdutoApi
{
    public const URL_FIND = 'produto/#id/?descricao_completa=1';

    use FindTrait;
}
