<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;

class UsuarioController extends Controllers
{
	public function cadastro()
	{
		$this->render('/usuario/cadastro');

		Sessao:limpaFormulario();
		Sessao:limpaMensagem();
	}

	public function salvar()
	{
		$Usuario = new Usuario();
		$Usuario->setNome($_POST['nome']);
		
	}
}