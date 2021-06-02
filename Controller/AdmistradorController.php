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

    //Parte de Operador de checkin

    public function admistradorGestaoOperadores(){
        $operadores = User::find('all', array('conditions' => "tipoperfil = 'operador'"));
        return View::make('admistrador.AdmistradorOperadoresCheckin',['operadores' => $operadores]);
    }


    public function admistradorGestaoOperadoresInserir(){
        return View::make('admistrador.AdmistradorOperadoresInserir');
    }

    public function InserirOperador(){       
        $utilizador = new User(Post::getAll());

        $utilizador->save();
        Redirect::toRoute('admistrador/admistradorGestaoOperadores');
    }

    public function removerOperador($idutilizador){
        $utilizador = User::find([$idutilizador]);
        $utilizador->delete();
        Redirect::toRoute('admistrador/admistradorGestaoOperadores');
    }

    public function admistradorGestaoOperadoresAlterar($idutilizador){
        $utilizador = User::find([$idutilizador]);

        if (is_null($utilizador)) {
            //TODO redirect to standard error page
        } else {
            return View::make('admistrador.AdmistradorOperadoresAlterar', ['utilizador' => $utilizador]);
        }
    }

    public function AlterarOperador($idutilizador){
        $utilizador = User::find([$idutilizador]);
        $utilizador->update_attributes(Post::getAll());

        $utilizador->save();
        Redirect::toRoute('admistrador/admistradorGestaoOperadores');
    }

    //Parte de Gestor de Voo

    public function admistradorGestaoGestores(){
        $gestores = User::find('all', array('conditions' => "tipoperfil = 'gestor'"));
        return View::make('admistrador.AdmistradorGestorVoo',['gestores' => $gestores]);
    }

    public function admistradorGestoresInserir(){
        return View::make('admistrador.AdmistradorGestoresInserir');
    }

    public function InserirGestor(){
        $utilizador = new User(Post::getAll());

        $utilizador->save();
        Redirect::toRoute('admistrador/admistradorGestaoGestores');
    }

    public function removerGestor($idutilizador){
        $utilizador = User::find([$idutilizador]);
        $utilizador->delete();
        Redirect::toRoute('admistrador/admistradorGestaoGestores');
    }

    public function admistradorGestoresAlterar($idutilizador){
        $utilizador = User::find([$idutilizador]);

        if (is_null($utilizador)) {
            //TODO redirect to standard error page
        } else {
            return View::make('admistrador.AdmistradorGestoresAlterar', ['utilizador' => $utilizador]);
        }
    }

    public function AlterarGestor($idutilizador){        
        $utilizador = User::find([$idutilizador]);
        $utilizador->update_attributes(Post::getAll());

        $utilizador->save();
        Redirect::toRoute('admistrador/admistradorGestaoGestores');
    }

    //Parte aeroportos

    public function admistradorAeroportos(){
        $aeroportos = Airport::find('all');
        return View::make('admistrador.AdmistradorAeroportos',['aeroportos' => $aeroportos]);
    }

    public function admistradorAeroportosInserir(){
        return View::make('admistrador.AdmistradorAeroportosInserir');
    }

    public function InserirAeroporto(){
        $aeroporto = new Airport(Post::getAll());

        $aeroporto->save();
        Redirect::toRoute('admistrador/admistradorAeroportos');
    }

    public function removerAeroporto($idaeroporto){
        $aeroporto = Airport::find([$idaeroporto]);
        $aeroporto->delete();
        Redirect::toRoute('admistrador/admistradorAeroportos');
    }

    public function admistradorAeroportosAlterar($idaeroporto){
        $aeroporto = Airport::find([$idaeroporto]);

        if (is_null($aeroporto)) {
            //TODO redirect to standard error page
        } else {
            return View::make('admistrador.AdmistradorAeroportosAlterar', ['aeroporto' => $aeroporto]);
        }
    }

    public function AlterarAeroporto($idaeroporto){
        $aeroporto = Airport::find([$idaeroporto]);
        $aeroporto->update_attributes(Post::getAll());

        $aeroporto->save();
        Redirect::toRoute('admistrador/admistradorAeroportos');
    }

}