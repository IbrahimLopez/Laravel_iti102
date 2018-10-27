<?php
/*BY: RUBIO OLIVARRIA LUIS ARMANDO
    Año: 24/Oct/2018,
    Materia: Desarrollo de Aplicaciones Web,
    Maestro: CAZAREZ CAMARGO NOE,
    Descripcion: Controlador para las acciones de la tienda.
*/

namespace App\Controller;

use App\Helpers\CartHelper;
use App\Helpers\ResponseHelper;
use App\Repositories\UsuarioRepositories;
use Core\Controller;

class TiendaController extends Controller{

    private $carrito;
    /* Autor: LARO
       Descripcion:
       Fecha: 24/Oct/2018
    */
    public function __construct(){
        parent::__construct();
        $this->carrito = new CartHelper([
            'cartMaxItem' => 0, //SIN LIMITE DE ARTICULOS
            'itemMaxQuantity' => 5, //MAXIMO 5 ARTICULOS POR SESSION
            'useCookies' => false   //NO UTILIZAR LA COOKIES
        ]);
    }

    /* Autor: LARO
       Descripcion:
       Fecha: 24/Oct/2018
    */
    public function getindex(){
        return $this->render('tienda/index.twig', [
            'datos' => (new UsuarioRepositories())->listar()
        ]);
    }

    /* Autor: LARO
       Descripcion: Funcion para mandar un item para agregarlo al carrito
       Fecha: 24/Oct/2018
    */
    public function postaddcar(){
        $rh = new ResponseHelper();

        $this->carrito->add($_POST['id'], 1, ['codigo'=>$_POST['id']]);

//        $this->carrito->add($_POST['id'], 1);

        $rh->setResponse(true);
        $rh->result = $this->carrito->getItems();
        //echo $this->carrito->getItems();
        print_r(json_encode($rh));
    }

    /* Autor: LARO
       Descripcion: Funcion para ver el carrito con sus items.
       Fecha: 24/Oct/2018
    */
    public function getvercarrito(){
        //print_r($this->carrito->getItems());
        return $this->render('tienda/vercarrito.twig', [
            'carr' => $this->carrito->getItems()
        ]);
    }


    /* Autor: LARO
       Descripcion: Eliminar variable de carrito
       Fecha: 25/Oct/2018
    */
    public function getdeletecarrito(){
        $this->carrito->clear();

    }
}