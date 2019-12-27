<?php


class CrudFacturas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("idUser")!= "") {
            }
            else
            {
                header("Location: http://localhost/CDI/Panel/");
            die();
            }
        $this->load->model("Facturas");

    }

    function index()
    {
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=28;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        $this->load->view("viewTodoFacturas");
    }
    //COMIENZO DE LA PARTE DEL PACIENTE
    function verFactura($idFactura)
    {
        $data['idFactura']=$idFactura;
        $data['datosGenerales']=$this->traeLista(0,0,0,$idFactura)[0];
        $data['detalles']=$this->Facturas->getDetallesFactura($idFactura);
        $this->load->view("viewDetalleFactura", $data);
    }
    function traeLista($fechaconsu, $fechaconsuFinal,$paciente, $idFactura=0)
    {
        $paciente=str_replace("%20", " ", $paciente);
        $contadorAND=-1;
        $condicionGeneral="";
        $condicionFecha="";
        $condicionPaciente="";
        $condicionFactura="";

        if($fechaconsu!="0" && $fechaconsuFinal!="0")
        {
            $condicionFecha.=" Facturacion.fecha BETWEEN '$fechaconsu' AND '$fechaconsuFinal' ";
            $contadorAND++;
        }
        else if($fechaconsu!="0")
        {
            $condicionFecha.=" Facturacion.fecha >= '$fechaconsu' ";
            $contadorAND++;
        }
        else if($fechaconsuFinal!="0")
        {
            $condicionFecha.=" Facturacion.fecha <= '$fechaconsuFinal' ";
            $contadorAND++;
        }
        if($paciente!="0")
        {
            if($contadorAND>=0)
            {
                $condicionPaciente.="AND";
                $contadorAND--;
            }
            $condicionPaciente.=" nombrePaci LIKE '%$paciente%' ";
            $contadorAND++;
        }
        if($idFactura)
        {
            if($contadorAND>=0)
            {
                $condicionFactura.="AND";
            }
            $condicionFactura.=" Facturacion.idFacturacion=$idFactura ";
            $contadorAND++;
        }
        if($contadorAND!=-1)
        {
            $condicionGeneral= "WHERE ".$condicionFecha.$condicionPaciente.$condicionFactura;
        }
        $prueba= $this->Facturas->traerLista($condicionGeneral);
        if($idFactura)
            return $prueba;
        echo json_encode($prueba);
    }
    //FIN PARTE DEL PACIENTE

    //COMIENZO PARTE DEL CLIENTE

    function Clientes()
    {
        //código de permisos
        $this->load->model("Permisos");
        $idTipoUsuario=$this->session->userdata('tipoUser');
        $idModulo=29;
        $acceso=$this->Permisos->getPermisosUsuarioModulo($idTipoUsuario, $idModulo);
        if(!$acceso['mostrar'])
        {
            redirect('menus');
            return;
        }
        //fin del código de permisos
        $this->load->view("viewTodoFacturasClientes");
    }
    function traerDiasC($idC)
    {
        $prueba = $this->Facturas->getDiasCredito($idC);
        echo json_encode ($prueba);
    }

    function traeListaClientes($fechaconsu, $fechaconsuFinal, $cliente, $adeudoMinimo, $adeudoMaximo, $idFactura=0)
    {
        $adeudoMinimo=rawurldecode($adeudoMinimo);
        $adeudoMaximo=rawurldecode($adeudoMaximo);
        $fechaHoy=date("Y-m-d");
        $cliente=rawurldecode($cliente);
        $condicionGeneral="WHERE (DATE_ADD(FacturacionClientes.fecha, INTERVAL CondicionesCliente.diasCredito DAY)) >= '$fechaHoy' ";
        $condicionFecha="";
        $condicionCliente="";
        $condicionFactura="";
        $condicionAdeudo="";

        if($fechaconsu!="0" && $fechaconsuFinal!="0")
        {
            $condicionFecha.=" AND FacturacionClientes.fecha >= '$fechaconsu' AND  FacturacionClientes.fecha <= '$fechaconsuFinal' ";
        }
        else if($fechaconsu!="0")
        {
            $condicionFecha.=" AND FacturacionClientes.fecha >= '$fechaconsu' ";
        }
        else if($fechaconsuFinal!="0")
        {
            $condicionFecha.=" AND FacturacionClientes.fecha <= '$fechaconsuFinal' ";
        }
        if($adeudoMinimo!="0"&&$adeudoMaximo!="0")
        {
            $condicionAdeudo=" AND (FacturacionClientes.montoPago - (SELECT COALESCE(SUM(PagoFacturacionCliente.montoPagado), 0)
                                    FROM PagoFacturacionCliente
                                    WHERE PagoFacturacionCliente.idFacturacionClientes =
                                          FacturacionClientes.idFacturacionClientes)) BETWEEN $adeudoMinimo AND $adeudoMaximo";
        }
        else if($adeudoMinimo!="0")
        {
            $condicionAdeudo=" AND (FacturacionClientes.montoPago - (SELECT COALESCE(SUM(PagoFacturacionCliente.montoPagado), 0)
                                    FROM PagoFacturacionCliente
                                    WHERE PagoFacturacionCliente.idFacturacionClientes =
                                          FacturacionClientes.idFacturacionClientes)) >= $adeudoMinimo";
        }
        else if($adeudoMaximo!="0")
        {
            $condicionAdeudo=" AND (FacturacionClientes.montoPago - (SELECT COALESCE(SUM(PagoFacturacionCliente.montoPagado), 0)
                                    FROM PagoFacturacionCliente
                                    WHERE PagoFacturacionCliente.idFacturacionClientes =
                                          FacturacionClientes.idFacturacionClientes)) <= $adeudoMaximo";
        }
        if($cliente!="0")
        {
            $condicionCliente.=" AND nombreCliente LIKE '%$cliente%' ";
        }
        if($idFactura)
        {
            $condicionFactura.=" AND FacturacionClientes.idFacturacionClientes=$idFactura ";
        }

        $condicionGeneral.= $condicionFecha.$condicionCliente.$condicionFactura.$condicionAdeudo;
        //echo "- $condicionGeneral ";
        $prueba= $this->Facturas->traerListaCliente($condicionGeneral);
        if($idFactura)
            return $prueba;
        echo json_encode($prueba);
    }
    function verDetallesFacturaCliente($idFacturacion)
    {
        $data['idFactura']=$idFacturacion;
        $data['datosCliente']=$this->Facturas->getDatosCliente($idFacturacion);
        $data['datosGenerales']=$this->traeListaClientes(0,0,0, 0, 0,$idFacturacion)[0];
        $data['detalles']=$this->Facturas->getDetallesFacturaCliente($idFacturacion);
        $this->load->view("viewDetallesFacturacliente", $data);
    }
    function verVentanaPagoCliente($idFacturacion)
    {
        $data['idFactura']=$idFacturacion;
        $data['datosGenerales']=$this->traeListaClientes(0,0,0, 0, 0,$idFacturacion)[0];
        $data['detalles']=$this->Facturas->getDetallesFacturaCliente($idFacturacion);
        $this->load->view("viewVentanaPagoCliente", $data);
    }
    function ejecutarPagoCliente($idFacturacionCliente)
    {
        $fechaPago=date("Y-m-d");
        $idUsuario=$this->session->userdata('idUser');
        echo json_encode($this->Facturas->ejecutarPagoCliente($idFacturacionCliente, $idUsuario, $fechaPago,$this->input->post('montoPagado')));
    }
    function verHistorialPagosCliente($idFacturacionCliente)
    {
        $data['idFactura']=$idFacturacionCliente;
        $data['historial']=$this->Facturas->verHistorialPagos($idFacturacionCliente);
        $this->load->view("viewHistorialPagosCliente", $data);
    }
}