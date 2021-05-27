<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use Carbon\Carbon;
use ArmoredCore\WebObjects\Debug;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;



/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 09-05-2016
 * Time: 11:30
 */
class AdmistradorController extends BaseController
{

    public function admistrador(){

        return View::make('admistrador.AdmistradorIndex');
    }

    public function admistradorGestaoOperadores(){

        $operadores = Utilizadores::find('all', array('conditions' => "tipoperfil = 'operador'"));
        return View::make('admistrador.AdmistradorOperadoresCheckin',['operadores' => $operadores]);
    }


    public function admistradorGestaoOperadoresInserir(){

        return View::make('admistrador.AdmistradorOperadoresInserir');
    }

    public function InserirOperador(){
        
        $utilizador = new Utilizadores(Post::getAll());

        $utilizador->save();
        Redirect::toRoute('admistrador/admistradorGestaoOperadores');
        
    }

}