<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Empresario;

class EmpresariosController extends Controller
{

		public function index (Empresario $empre) {

			return $empre->orderBy('id', 'DESC')->get();
		}

    public function cadastroEmpresarios (Request $req, Empresario $empre) {
    	$messages = [
        'nome.required' => 'O campo Nome Completo é de preenchimento obrigatório.',
        'estado.required' => 'O campo Estado é de preenchimento obrigatório.',
        'cidade.required' => 'O campo Cidade é de preenchimento obrigatório.',
        'telefone.required' => 'O campo Telefone é de preenchimento obrigatório.',
        'telefone.unique' => 'Já existe uma pessoa cadastrada com esse Celular.',
      ];

    	$validacao = Validator::make($req->all(), [
			    'nome' => 'required|string',
			    'estado' => 'required|string',
			    'cidade' => 'required|string',
			    'telefone' => 'required|unique:empresarios',
                'nome_pai' => 'nullable|string',
			    'pai_empresarial' => 'integer|nullable',
			], $messages);

	   if ($validacao->fails()) {
            $retorno[] = '0';
            $msg = [];
            $messages =  $validacao->messages()->get('*');
            foreach ($messages as $message) {
                $msg[] = $message;
            }
            $retorno[] = $msg;
   			return $retorno;
      }

    	$result = $empre->create($req->all());
        
        if($result){
            $retorno[] = '1';
            $retorno[] = $result;
            return $retorno;
        }

    }

    public function rede ($id_empr, Empresario $empre) {
    	//$children = $empre->children;
    	$children = Empresario::whereNull('pai_empresarial')
        ->with('parent')
        ->get();
    	return $children;
    }

    public function delete ($id_empr) {

    	$empresario = Empresario::where('id', $id_empr)->first();
    	$empresario = $empresario->delete();
        if($empresario){
        	return "ok";
        }
    }
}
