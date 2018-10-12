<?php
/*  Developed by: Ibrahim Alexis Lopez Roman
    Año: 25/09/2018,
    Materia: Desarrollo de aplicaciones,
    Maestro: Noe Cazarez,
    Descripcion: Modulo de usuarios, alta de usuarios, catalogos, etc
*/

namespace App\Controller;
use App\Models\Usuario;
use App\Repositories\RolRepositories;
use App\Repositories\UsuarioRepositories;
use App\Repositories\PermisoRepositories;
use Core\Controller;
use Core\ServicesContainer;
use App\Helpers\UrlHelper;
use App\Helpers\ResponseHelper;
use App\Validations\UsuarioValidation;

class UsuariosController extends Controller
{
    private $config;
    public function __construct()
    {
        parent::__construct();
        $this->config = ServicesContainer::getConfig();
    }

    /*
        Autor: Ibrah,
        Descripcion: Vista principal del modulo,
        Fecha: 25/09/2018
    */
    public function getindex()
    {
        $obj = new UsuarioRepositories();
        return $this->
        render(
            'usuarios/index.twig',
            ['company_name' => $this->config['company_name'],
                'usuarios' => $obj->listar()
            ]
        );
    }

    //region Funciones para el registro de usuarios
    /*
        Autor: Ibrah,
        Descripcion: Vista de crear nuevo usuario,
        Fecha: 25/09/2018
    */
    public function getnusuario()
    {
        $obj = new RolRepositories();
        return $this->render(
            'usuarios/nusuario.twig',
            ['company_name' => $this->config['company_name'],
            'roles'=>$obj->listar()
        ]);
    }

    /*
        Autor: Ibrah,
        Descripcion: Funcion para el registro de usuario,
        Fecha: 26/09/2018
    */
    public function postguardarusuario()
    {    
        #TODO: validar los campos obligatorios
        UsuarioValidation::validate($_POST);
        $model = new Usuario();
        $model->nombre = $_POST['nombre'];
        $model->apaterno = $_POST['apaterno'];
        $model->amaterno = $_POST['amaterno'];
        $model->rol_id = $_POST['rol_id'];
        $model->correo = $_POST['correo'];
        $model->password = $_POST['password'];        

        $usuarioRepo = new UsuarioRepositories();
        $rh = $usuarioRepo->guardar($model);
        if ($rh->response)
            $rh->href = 'usuarios/';
        // UrlHelper::redirect('usuarios');
        print_r(json_encode($rh));
    }
    //endregion

    #region Funciones para actualizar
     /*
        Autor: Ibrah,
        Descripcion: vista para actualizar usuarios,
        Fecha: 2/10/2018
    */
    public function getactualizar_u($id)
    {        
        if($id == 0)
            UrlHelper::redirect('usuarios');
        $usuario = new UsuarioRepositories();
        $model = $usuario->obtener($id);           
        return $this->render('usuarios/actualizar_u.twig',['title'=> 'Actualizando...','model'=> $model,
        'roles'=> (new RolRepositories())->listar()]);
    }

    public function postactualizar_u()
    {
        UsuarioValidation::validate($_POST);
        $objRepo = new UsuarioRepositories();
        $model = $objRepo->obtener($_POST['id']);

        if (isset($_POST['nombre'])) $model->nombre=$_POST['nombre'];        
        if (isset($_POST['apaterno'])) $model->apaterno=$_POST['apaterno'];        
        if (isset($_POST['amaterno'])) $model->amaterno=$_POST['amaterno'];        
        if (isset($_POST['rol_id'])) $model->rol_id=$_POST['rol_id'];   
        $model->password = null;
        $rh = $objRepo->guardar($model);
        if ($rh->response) {
            $rh->href='/usuarios';
        }
        //UrlHelper::redirect('usuarios');
        print_r(json_encode($rh));

    }

    #endregion

    #region Funciones de eliminar
    /*
        Autor: Ibrah,
        Descripcion: Funcion para mostrar vista de eliminar a un usuario,
        Fecha: 2/10/2018
    */

    public function geteliminar_u($id)
    {
        if($id <= 0)
            UrlHelper::redirect('usuarios');
        return $this->render('usuarios/eliminar_u.twig',['title'=> 'Eliminar','model'=> (new UsuarioRepositories())->obtener($id)]);
    }

    /*
        Autor: Ibrah,
        Descripcion: Funcion para eliminar a un usuario,
        Fecha: 2/10/2018
    */ 

    public function posteliminar_u()
    {
        $objRepo = new UsuarioRepositories();
        $model = $objRepo->obtener($_POST['id']);
        $model->activo = false;
        $rh = $objRepo->guardar($model);
        if ($rh->response)
            $rh->href='usuarios';        
        UrlHelper::redirect('usuarios');
        // print_r(json_encode($rh));
    }
    #endregion
    
}