<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudCotizaciones extends CI_Controller {
	function __construct(){
		parent::__construct();
    if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
		$this->load->model("cotizaciones"); //cargamos el modelo de User
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=20;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
	}

	public function index($index = 1)
	{
		$data['page'] = $this->cotizaciones->data_pagination("/Crudcitas/index/", 
    $this->cotizaciones->getTotalRowAllData(), 3);
    //$data['medico'] = $this->citas->getDatos();
    //$data['Estudios'] = $this->citas->getEstudios();
    $data['cliente'] = $this->cotizaciones->getClientes();
    $data['medicoRem'] = $this->cotizaciones->getDatosRemitente();
		$this->load->view('gridtodocotizaciones', $data);		
	}

    function AutocompletaEstudio()

    {
        $Estudio=$_REQUEST["q"];
        if(isset($Estudio)){
            $result=$this->cotizaciones->obtenerDatosEstudio($Estudio);
            if(count($result)>0)
                foreach($result as $pr)

                    $arrResult[]=array("value"=>$pr->nombreEstudio,
                        "IdEstudio"=>$pr->IdEstudio
                        );
                echo json_encode($arrResult);
       }
    }

    function traesInfo()

     {

        $Estudio=$_POST["est"];
        $prueba=$this->cotizaciones->traerNombres($Estudio);
        echo json_encode($prueba);

     }


    function buscarNombreMedico()

    {  

        $Medico=$_REQUEST["q"];
        if(isset($Medico)){
            $result=$this->cotizaciones->obtenerDatosMedico($Medico);
            if(count($result)>0)
                foreach($result as $pr)

                    $arrResult[]=array("value"=>$pr->nombreDoc,
                        "idDoctor"=>$pr->idDoctor
                        );
                echo json_encode($arrResult);
       }
    }

    function traeSalas()
    {
        $prueba= $this->cotizaciones->getSalas();
        echo json_encode ($prueba);
    }

    function traetodoClientes()
    {
        $prueba= $this->cotizaciones->getClientes();
        echo json_encode ($prueba);
    }

    function traeClientesXidPaciente($idpac)
    {
        $prueba= $this->cotizaciones->getClienteXidPaciente($idpac);
        echo json_encode ($prueba);
    }


    function traeestudiosRelacionados($estudio)
    {
        $newvalue = str_replace('%20', ' ', $estudio);
        $prueba= $this->cotizaciones->getEstudios($newvalue);
        echo json_encode ($prueba);
    }

    function traetodosestudios()
    {
        $prueba= $this->cotizaciones->gettodosEstudios();
        echo json_encode ($prueba);
    }

    function traetodosestudiosXcliente($cliente)
    {
        $prueba= $this->cotizaciones->getEstudiosXcliente($cliente);
        echo json_encode ($prueba);
    }

    function traetodasCot()
    {
        $prueba= $this->cotizaciones->gettodasCotizaciones();
        echo json_encode ($prueba);
    }
    function getId()
    {
        $prueba= $this->cotizaciones->getIdCoti();
        echo json_encode ($prueba);
    }

    function traenoDispo($idE,$idS,$fecha)
    {
        $prueba= $this->cotizaciones->getnoDispo($idE,$idS,$fecha);
        echo json_encode ($prueba);
    }

    function agregacita()
    {
        
        $data = array(  
            'idSala' => $this->input->post('Salas'),
            
            'idEstudio' => $this->input->post('Estud'),
            'fechaCita' => $this->input->post('fecha'),
            'horarioCita' => $this->input->post('horainicio'),
            'idPaciente' => $this->input->post('idPaciente'),
            'horaTerminada' => $this->input->post('HoraTerminada'),
            'idUser' => $this->input->post('idUser'),
            'urgencia'=> $this->input->post('emergencia'),
            'orden_medica'=> $this->input->post('orden')
            );
        $this->cotizaciones->insertaDatos($data);
    
    }


    function EditaCita($idcita,$horaini,$horafin){
        $data = array(
            'horarioCita' => $horaini,
            'horaTerminada' => $horafin 
        );
        $this->cotizaciones->updatecitas($data,$idcita);
        //echo "1";

    }

function altamacivo()
{   
    $idUser = $this->input->post('idUser'); 
    $totaltotal = $this->input->post('totaltotal'); 
    $controlOrden = $this->input->post('controlOrden'); 
    $fechacoti = date('Y-m-d'); 

    $datad =array(
        'iduser' => $idUser,
        'total' => $totaltotal,
        'fechacoti' => $fechacoti,
        'controCotizacion' => $controlOrden
        );
    $this->cotizaciones->insertaDatosR($datad);

    $prueba=$this->cotizaciones->idComunicado(); 
    foreach ($prueba as $key) {
        $idcotizacion= $key['idcotizacion'];
    }   
    $prueba = $this->input->post('arreglo');
    $pruebaDos= json_encode($prueba);   
    foreach ($prueba as $key => $value) {
        foreach ($value as $key => $value) {
            $dataPue =array(
                'idEstudio' => $value['idestudio'], 
                'descuento' => $value['descuento'],
                'precioNormal' => $value['precio'],
                'cantidad' => $value['cantidad'],
                'precioDescuento' => $value['total'],
                'idcotizacion' => $idcotizacion,
                );
            $this->cotizaciones->insertaDatosPuent($dataPue);
            
        }
        echo $idcotizacion;
    }
        //redirect('http://cointic.com.mx/IntraNet/Admin/index.php/Crudcomunicados');
}


public function sendMail()
    {   
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $fechaSoli=date("Y-m-d"); 
        $fecha4=strftime("%d-%B-%Y",strtotime($fechaSoli));
        $correoDestino = $this->input->post('correoPac');
        $nombrePac = $this->input->post('nombrePac');
        $cliente = $this->input->post('cliente');
        $total = $this->input->post('total');
        $idcot = $this->input->post('idcot');
        $nombreCliente="";
        $Ncliente=$this->cotizaciones->getNombreCliente($cliente);
        foreach ($Ncliente as $reg) {
            $nombreCliente= $reg['nombreCliente'];
        } 

        // $arreglo = $this->input->post('arreglo');<font color='#2d3920'>Estudios cotizados:</font> $arreglo <br/>
        $prueba=$this->cotizaciones->getCotizaciones($idcot); 
        $row = "";
        foreach ($prueba as $key) {
            $estudio= $key['nombreEstudio'];
            $descuento= $key['descuento'];
            $preciouni= $key['precioNormal'];
            $importe= $key['precioDescuento'];
            $cantidad= $key['cantidad'];
            $row .= "
              <tr align='center'>
                  <td style='border-bottom: 1px solid;'>$estudio</td>
                  <td style='border-bottom: 1px solid;'>$cantidad</td>
                  <td style='border-bottom: 1px solid;'>$ $preciouni</td>
                  <td style='border-bottom: 1px solid;'>$descuento%</td>
                  <td style='border-bottom: 1px solid;'>$ $importe</td>
              </tr>
            ";
        }

        $contenido = "<font color='#2d3920'>Paciente:  <b>$nombrePac</b></font><br/>
                      <font color='#2d3920'>Correo:  <b>$correoDestino</b></font><br/>
                      <font color='#2d3920'>Cliente:  <b>$nombreCliente</b></font><br/>
                      <font color='#2d3920'>Fecha de Envio:  <b>$fecha4</b></font><br/>
                      <font color='#2d3920'>Total:  <b>$ $total MXN</b></font><br/>
                    ";

        $mensaje = "
         <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
              <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
              <title>Cotizaciones - LABORATORIOS CDI</title>
              <style type='text/css'>
              body {
               padding-top: 0 !important;
               padding-bottom: 0 !important;
               padding-top: 0 !important;
               padding-bottom: 0 !important;
               margin:0 !important;
               width: 100% !important;
               -webkit-text-size-adjust: 100% !important;
               -ms-text-size-adjust: 100% !important;
               -webkit-font-smoothing: antialiased !important;
             }
             .tableContent img {
               border: 0 !important;
               display: block !important;
               outline: none !important;
             }
             a{
              color:#382F2E;
            }
            p, h1{
              color:#382F2E;
              margin:0;
            }
         p{
              text-align:left;
              color:#999999;
              font-size:14px;
              font-weight:normal;
              line-height:19px;
            }
            a.link1{
              color:#382F2E;
            }
            a.link2{
              font-size:16px;
              text-decoration:none;
              color:#ffffff;
            }
            h2{
              text-align:left;
               color:#222222; 
               font-size:19px;
              font-weight:normal;
            }
            div,p,ul,h1{
              margin:0;
            }
            .bgBody{
              background: #ffffff;
            }
            .bgItem{
              background: #ffffff;
            }
            </style>
        <script type='colorScheme' class='swatch active'>
        {
            'name':'Default',
            'bgBody':'ffffff',
            'link':'382F2E',
            'color':'999999',
            'bgItem':'ffffff',
            'title':'222222'
        }
        </script>
          </head>
          <body paddingwidth='0' paddingheight='0'   style='padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset='0' toppadding='0' leftpadding='0'>
            <table width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent bgBody' align='center'  style='font-family:Helvetica, Arial,serif;'>
              <tr><td height='35'></td></tr>
              <tr>
                <td>
                  <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='bgItem'>
                    <tr>
                      <td width='40'></td>
                      <td width='520'>
                        <table width='720' border='0' cellspacing='0' cellpadding='0' align='center'>
        <!-- =============================== Header ====================================== -->           
                          <tr><td height='75'></td></tr>
        <!-- =============================== Body ====================================== -->
                          <tr>
                            <td class='movableContentContainer' valign='top'>
                              <div lass='movableContent'>
                                <table width='720' border='0' cellspacing='0' cellpadding='0' align='center'>
                                  <tr>
                                    <td valign='top' align='center'>
                                      <div class='contentEditableContainer contentTextEditable'>
                                        <div class='contentEditable'>
                                          <p style='text-align:center;margin:0;font-family:Futura-Condensed-regular;font-size:26px;color:#770526;line-height: 25px;padding-bottom: 10px;'>Cotización de estudios <span style='color:#000;'>| Laboratorios CDI</span></p>
                                          <img class='logo' src='http://localhost/CDI/Panel/content/images/logo_cdi.jpg' alt='logo' width='300' height='90'/>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                              <div lass='movableContent'>
                                <table width='720' border='0' cellspacing='0' cellpadding='0' align='center'>
                                  <tr>
                                    <td valign='top' align='center'>
                                      <div class='contentEditableContainer contentImageEditable'>
                                        <div class='contentEditable'>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                              <div class='movableContent'>
                                <table width='720' border='0' cellspacing='0' cellpadding='0' align='center'>
                                  <tr><td height='15'></td></tr>
                                  <tr>
                                    <td align='left'>
                                      <div class='contentEditableContainer contentTextEditable'>
                                        <div class='contentEditable' align='center'>
                                          <h2>Confirmación de cotización</h2>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                  <div class='contentEditableContainer contentTextEditable'>
                                    <div class='contentEditable' align='center'>
                                        <p>
                                         $contenido
                                         <table class='table table-hover' style='width: 100%; margin-top: 20px;'>
                                            <thead style='background: #ccc;'>
                                                <tr>
                                                    <th>ESTUDIO</th>
                                                    <th>CANTIDAD</th>
                                                    <th>P. UNITARIO</th>
                                                    <th>DESCUENTO</th>
                                                    <th>IMPORTE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              $row
                                            </tbody>
                                          </table>
                                        </p>
                                   <div>
                                  </div>
                                  </tr>
                                  
                                   
                                  </tr>
                                  <tr><td height='15'></td></tr>
                                  <tr>
                                    <td align='center'>
                                      <table>
                                        <tr>
                                          <td align='center' bgcolor='#2d3920' style='background:#770526; padding:15px 18px;-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;'>
                                            <div class='contentEditableContainer contentTextEditable'>
                                              <div class='contentEditable' align='center' style='color:white;'>
                                                <a href='#' style='color:white;'> Gracias por confiar en nosotros | Laboratorios CDI </a>
                                              </div>
                                            </div>
                                          </td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr><td height='20'></td></tr>
                                </table>
                              </div>
                              <div lass='movableContent'>
                                <table width='520' border='0' cellspacing='0' cellpadding='0' align='center'>
                                  <tr><td height='65'></td></tr>
                                  <tr><td  style='border-bottom:1px solid #DDDDDD;'></td></tr>
                                  <tr><td height='25'></td></tr>
                                  <tr>
                                    <td>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                            </td>
                          </tr>
        <!-- =============================== footer ====================================== -->
                        </table>
                      </td>
                      <td width='40'></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr><td height='88'></td></tr>
            </table>
              </body>
              </html>

        ";
        $this->load->library("email");
        $this->email->from("contacto@cdimorelos.com","Laboratorios CDI");
        $this->email->to($correoDestino);
        $this->email->subject('Cotización de Estudios');
        $this->email->message($mensaje);
        $this->email->set_mailtype('html');
        if ($this->email->send()) {
            echo "1";
         } 
         else
         {
            echo "2";
         }

  }








}


?>