<?php
require_once 'models/computers.model.php';
require_once 'models/marks.model.php';
require_once 'models/login.model.php';
require_once 'views/public.view.php';
require_once 'views/admin.view.php';
require_once 'helpers/auth.helper.php';

class AdminController
{
    //variables globales
    private $modelComputers;
    private $modelMarks;
    private $modelLogin;
    private $viewAdmin;
    private $viewPublic;

    public function __construct()
    {
        authHelper::checkLogged();
        $this->modelComputers = new ComputersModel();
        $this->modelMarks = new MarksModel();
        $this->modelLogin = new LoginModel();
        $this->viewAdmin = new AdminView();
        $this->viewPublic = new PublicView();
    }

    //muestra una form para poder cargar una computadora nueva
    public function formComputer()
    {
        $marcas = $this->modelMarks->getAll();
        $this->viewAdmin->formComputerAdd($marcas);
    }

    public function addComputer()
    {
        if (empty($_POST['nombre']) || empty($_POST['sistOperativo']) || empty($_POST['marca'])) {
           // $marcas = $this->modelMarks->getAll();
            $this->viewAdmin->showError("No ingreso todos los datos obligatorios");
        } else {
                $this->modelComputers->insert($_POST['nombre'], $_POST['sistOperativo'], $_POST['marca']);
                //$marcas = $this->modelMarks->getAll();
                //$this->viewAdmin->formComputerAdd("La computadora fue guardada correctamente");
                header('Location: ' . BASE_URL . 'agregarComp');
            
        }
    }

    //muestra un formulario vacio para agregar una marca
    public function formMark()
    {
        $this->viewAdmin->formMarkAdd();
    }

    //guarda una nueva marca
    public function addMark()
    {
        if (empty($_POST['nombre'])) {
            $this->viewAdmin->showError("No completo los datos obligatorios");
        } else {
            $marca = $this->modelMarks->getName($_POST['nombre']);
            if (!empty($marca)) {
                $this->viewAdmin->showError("La marca ya existe");
            } else {
                $this->modelMarks->insert($_POST['nombre']);
                //$this->viewAdmin->formMarkAdd("La marca fue guardada correctamente");
                header('Location: ' . BASE_URL . 'agregarMarca');
            }
        }
    }

    //muestra un formulario para editar la comp
    public function editComputer($id_computadora)
    {
        $computadora = $this->modelComputers->get($id_computadora);
        $marca = $this->modelMarks->getAll();
        $this->viewAdmin->showFormEditComputer($computadora, $marca);
    }

    //modificacion de computadora
    public function modifyComputer()
    {
        if (empty($_POST['nombre']) || empty($_POST['sistOperativo']) || empty($_POST['marca'])) {
            $computadora = $this->modelComputers->get($_POST['nombre']);
            $marca = $this->modelMarks->getAll();
            $this->viewAdmin->showFormEditComputer($computadora, $marca, "completar todos los campos");
        }
        else{
            $this->modelComputers->update($_POST['nombre'], $_POST['sistOperativo'], $_POST['marca']);
            $computadora = $this->modelComputers->get($_POST['nombre']);
            $marca = $this->modelMarks->getAll();
            $this->viewAdmin->showFormEditComputer($computadora, $marca, "los cambios se guardaron exitosamente");
        }
    }

    public function deleteComputer($id_computadora)
    {
        $this->modelComputers->delete($id_computadora);
        header('Location: ' . BASE_URL . 'listaComp');
    }

    //muestra formulario para editar
    public function editMark($id_marca)
    {
        $marca = $this->modelMarks->get($id_marca);
        $this->viewAdmin->showFormEditMark($marca);
    }

    public function modifyMark()
    {
        if (empty($_POST['nombre'])) {
            $marca = $this->modelMarks->get($_POST['nombre']);
            $this->viewAdmin->showFormEditMark($marca);
        }
        $this->modelMarks->update($_POST['nombre']);
    }

    public function deleteMark($id_marca)
    {
        $this->modelMarks->delete($id_marca);
        header('Location: ' . BASE_URL . 'listaMarca');
    }

    public function showError($msg)
    {
        $this->view->error($msg);
    }
}
