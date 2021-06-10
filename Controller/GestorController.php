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
class GestorController extends BaseController
{
    //Gestor
    public function gestor(){
        return View::make('gestor.GestorIndex');
    }

    //Parte dos aviões

    public function gestorAvioes(){
        $avioes = Plane::find('all');
        return View::make('gestor.GestorAvioes',['avioes' => $avioes]);
    }

    public function gestorAvioesInserir(){
        return View::make('gestor.GestorAvioesInserir');
    }

    public function InserirAviao(){
        $aviao = new Plane(Post::getAll());

        $aviao->save();
        Redirect::toRoute('gestor/gestorAvioes');
    }

    public function removerAviao($plane_id){
        $aviao = Plane::find([$plane_id]);
        $aviao->delete();
        Redirect::toRoute('gestor/gestorAvioes');
    }

    public function gestorAvioesAlterar($plane_id){
        $aviao = Plane::find([$plane_id]);

        if (is_null($aviao)) {
            //TODO redirect to standard error page
        } else {
            return View::make('gestor.GestorAvioesAlterar', ['aviao' => $aviao]);
        }
    }

    public function AlterarAviao($plane_id){
        $aviao = Plane::find([$plane_id]);
        $aviao->update_attributes(Post::getAll());

        $aviao->save();
        Redirect::toRoute('gestor/gestorAvioes');
    }

    //Parte das escalas

    public function gestorEscalas(){
        $escalas = Scale::find('all');
        return View::make('gestor.GestorEscalas',['escalas' => $escalas]);
    }

    public function gestorEscalasInserir(){
        $aeroportos = Airport::find('all');
        $avioes = Plane::find('all');
        return View::make('gestor.GestorEscalasInserir',['avioes' => $avioes, 'aeroportos' => $aeroportos]);
    }

    public function InserirEscala(){
        $escala = new Scale(Post::getAll());

        $escala->save();
        Redirect::toRoute('gestor/gestorEscalas');
    }

    public function removerEscala($scale_id){
        $escala = Scale::find([$scale_id]);
        $escala->delete();
        Redirect::toRoute('gestor/gestorEscalas');
    }

    public function gestorEscalasAlterar($scale_id){
        $escala = Scale::find([$scale_id]);

        $aeroportos = Airport::find('all');
        $avioes = Plane::find('all');

        if (is_null($escala)) {
            //TODO redirect to standard error page
        } else {
            return View::make('gestor.GestorEscalasAlterar', ['escala' => $escala, 'avioes' => $avioes, 'aeroportos' => $aeroportos]);
        }
    }

    public function AlterarEscala($scale_id){
        $escala = Scale::find([$scale_id]);
        $escala->update_attributes(Post::getAll());

        $escala->save();
        Redirect::toRoute('gestor/gestorEscalas');
    }

    //Parte do gestor de voo

    public function gestorVoos(){
        $voos = Flight::find('all');
        return View::make('gestor.GestorVoos',['voos' => $voos]);
    }

    public function gestorVoosInserir(){
        $aeroportos = Airport::find('all');
        return View::make('gestor.GestorVoosInserir',['aeroportos' => $aeroportos]);
    }

    public function InserirVoo(){
        $voo = new Flight(Post::getAll());

        $voo->save();
        Redirect::toRoute('gestor/gestorVoos');
    }

    public function removerVoo($flight_id){
        $voo = Flight::find([$flight_id]);
        $voo->delete();
        Redirect::toRoute('gestor/gestorVoos');
    }

    public function gestorVoosAlterar($flight_id){
        $voo = Flight::find([$flight_id]);

        $aeroportos = Airport::find('all');

        if (is_null($voo)) {
            //TODO redirect to standard error page
        } else {
            return View::make('gestor.GestorVoosAlterar', ['voo' => $voo, 'aeroportos' => $aeroportos]);
        }
    }

    public function AlterarVoo($flight_id){
        $voo = Flight::find([$flight_id]);
        $voo->update_attributes(Post::getAll());

        $voo->save();
        Redirect::toRoute('gestor/gestorVoos');
    }

    public function gestorGerirEscalas($flight_id){
        $escalas = Flights_scale::find('all', array('conditions' => "flight_id = '$flight_id'"));

        return View::make('gestor.GestorGerirEscalas',['escalas' => $escalas, 'idvoo' => $flight_id]);
    }

    public function gestorGerirEscalasInserir($flight_id){
        $escalas = Scale::find('all');
        return View::make('gestor.GestorGerirEscalasInserir',['escalasList' => $escalas, 'idvoo' => $flight_id]);
    }

    public function InserirEscalaVoo(){
        $escala_voo = new Flights_scale(Post::getAll());

        $escala_voo->save();
        Redirect::toRoute('gestor/gestorVoos');
    }

    public function removerEscalaVoo($id){
        $escala_voo = Flights_scale::find([$id]);
        $escala_voo->delete();
        Redirect::toRoute('gestor/gestorVoos');
    }

}