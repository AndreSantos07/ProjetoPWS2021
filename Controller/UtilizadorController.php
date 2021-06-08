<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\URL;
use Carbon\Carbon;
use ArmoredCore\WebObjects\Debug;
use Tracy\Dumper;

/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 09-05-2016
 * Time: 11:30
 */
class UtilizadorController extends BaseController implements ResourceControllerInterface
{

    public function index(){

        //$voos = Flight::all();

        //return view::make('voos.voo',['voos' => $voos]);

        //return View::make('home.index');
    }

    public function validar(){

        $user=Post::get("user");
        $pass=Post::get("pass");

        $passenc=md5($pass);


        $utilizador = User::first('all', array('conditions' => "username = '$user' AND pass = '$pass'"));
        //Dumper::dump($utilizador);

        if($utilizador!=''){

            $_SESSION['tipo'] = $utilizador->profiletype;
            $_SESSION['user_id']=$utilizador->user_id;

            switch($_SESSION['tipo']){
                case $_SESSION['tipo'] == "passageiro":
                    echo "É PASSAGEIRO";

                    Redirect::toRoute('passageiro/passageiro');
                    break;

                case $_SESSION['tipo'] == "administrador":
                    echo "É ADMINISTRADOR";
                    Redirect::toRoute('admistrador/admistrador');
                    break;

                case $_SESSION['tipo'] == "operador":
                    echo "É OPERADOR";
                    break;

                case $_SESSION['tipo'] == "gestor":
                    echo "É GESTOR";
                    break;
            }
        }

    }

    public function start(){

        //View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'Quick Start']);
        return View::make('home.start');
    }

    public function login(){
        return View::make('home.login');
    }


    public function worksheet(){

        View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'MVC Worksheet']);

        return View::make('home.worksheet');
    }

    public function setsession(){
        $dataObject = MetaArmCoreModel::getComponents();
        Session::set('object', $dataObject);

        Redirect::toRoute('home/worksheet');
    }

    public function showsession(){
        $res = Session::get('object');
        var_dump($res);
    }

    public function destroysession(){

        Session::destroy();
        Redirect::toRoute('home/worksheet');
    }


    /**
     * @return Returns
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * @return Returns
     */
    public function store()
    {
        // TODO: Implement store() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // TODO: Implement show() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
