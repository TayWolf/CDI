<?php

class Facturas extends CI_Model

{
    function traerLista($condicion)
    {
        return $this->db->query("SELECT citas.folioCita, Facturacion.idFacturacion, citas.idCita, PreciosCita.*, Pacientes.nombrePaci, Facturacion.montoPago, Facturacion.fecha, Facturacion.formaPago, Facturacion.metodoPago, Facturacion.usoCFDI, Empresas.nombreEmpresa, Facturacion.rfc, Facturacion.domicilio, Facturacion.colonia, Facturacion.delegacion, Facturacion.estado FROM citas join Pacientes on Pacientes.idPaciente = citas.idPaciente join FacturacionCita on FacturacionCita.idCita = citas.idCita join Facturacion on Facturacion.idFacturacion = FacturacionCita.idFactura join Empresas on Empresas.idEmpresa = Facturacion.empresa JOIN (SELECT citas.folioCita,SUM(citas.precioEstudio) as precioEstudio FROM citas GROUP BY citas.folioCita) PreciosCita ON citas.folioCita=PreciosCita.folioCita $condicion GROUP by citas.folioCita;")->result_array();
    }

//     function traerLista($condicion)

//     {
//         return $this->db->query("SELECT Facturacion.idFacturacion,Facturacion.cliente as nombrePaci,Estudio.nombreEstudio,
//   SUM((SELECT CASE WHEN citas.tipoCitaa!=8 THEN (SELECT CASE WHEN clientes.precioEspecial=1

//         THEN (SELECT (CASE WHEN COUNT(precio)=0

//           THEN

//             (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)

//                       ELSE

//                         (SELECT precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente)

//                       END) as precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente)

//               ELSE

//                 (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)

//               END)

//           ELSE

//             (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)

//           END))

//     as precio,

//   Facturacion.montoPago,

//   Facturacion.fecha,

//   Facturacion.formaPago,

//   Facturacion.metodoPago ,

//   Facturacion.usoCFDI as usoCfdi,

//   E.nombreEmpresa,

//   Facturacion.domicilio, Facturacion.colonia, Facturacion.delegacion, Facturacion.estado, Facturacion.telefono, Facturacion.rfc

// FROM Facturacion

//   JOIN FacturacionCita ON Facturacion.idFacturacion=FacturacionCita.idFactura

//   JOIN citas ON citas.idCita=FacturacionCita.idCita

//   JOIN Estudio ON citas.idEstudio=Estudio.IdEstudio

//   JOIN Pacientes ON citas.idPaciente=Pacientes.idPaciente

//   JOIN clientes ON clientes.idCliente=Pacientes.cliente

//   JOIN Empresas E on Estudio.idEmpresa = E.idEmpresa

//   $condicion

//   GROUP BY Facturacion.idFacturacion

//     ORDER BY YEAR (fecha), MONTH (fecha), DAY (fecha), HOUR(fecha), MINUTE (fecha), SECOND (fecha);")->result_array();

//     }
    function traerListaCliente($condicion)

    {
        return $this->db->query("SELECT clientes.idCliente, CondicionesCliente.diasCredito,Empresas.nombreEmpresa,FacturacionClientes.idFacturacionClientes,FacturacionClientes.montoPago,clientes.nombreCliente,FacturacionClientes.fecha,FacturacionClientes.statusPago,FacturacionClientes.formaPago,FacturacionClientes.usoCFDI,FacturacionClientes.metodoPago, (FacturacionClientes.montoPago - (SELECT COALESCE(SUM(PagoFacturacionCliente.montoPagado), 0) FROM PagoFacturacionCliente WHERE PagoFacturacionCliente.idFacturacionClientes=FacturacionClientes.idFacturacionClientes)) as deuda from FacturacionClientes join clientes on clientes.idCliente=FacturacionClientes.cliente join Empresas on Empresas.idEmpresa=FacturacionClientes.empresa LEFT JOIN CondicionesCliente on clientes.idCliente = CondicionesCliente.cliente $condicion ORDER BY FacturacionClientes.idFacturacionClientes DESC")->result_array();

    }

    function getDiasCredito($idClie)

    {
        return $this->db->query("SELECT * FROM `CondicionesCliente` WHERE `cliente` =$idClie ")->result_array();

    }

    function getDetallesFactura($idFactura)
    {

        return $this->db->query("SELECT Estudio.nombreEstudio, citas.idCita,

  ((SELECT CASE WHEN citas.tipoCitaa!=8

    THEN

      (SELECT CASE WHEN clientes.precioEspecial=1

        THEN (SELECT (CASE WHEN COUNT(precio)=0

          THEN

            (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)

                      ELSE

                        (SELECT precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente)

                      END) as precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente)

              ELSE

                (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)

              END)

           ELSE

             (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio)

           END))

    as precio

FROM citas

JOIN Estudio ON citas.idEstudio=Estudio.IdEstudio

JOIN Pacientes ON Pacientes.idPaciente=citas.idPaciente

JOIN clientes ON Pacientes.cliente=clientes.idCliente

JOIN FacturacionCita ON citas.idCita=FacturacionCita.idCita

JOIN Facturacion ON Facturacion.idFacturacion=FacturacionCita.idFactura

WHERE Facturacion.idFacturacion=$idFactura;")->result_array();

    }
    function getDetallesFacturaCliente($idFactura)
    {

        return $this->db->query("SELECT Estudio.nombreEstudio, citas.idCita, ((SELECT CASE WHEN citas.tipoCitaa!=8 THEN (SELECT CASE WHEN clientes.precioEspecial=1 THEN (SELECT (CASE WHEN COUNT(precio)=0 THEN (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio) ELSE (SELECT precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente) END) as precio FROM preciocliente WHERE preciocliente.IdprecioCliente=Estudio.IdEstudio AND preciocliente.Idcliente=clientes.idCliente) ELSE (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio) END) ELSE (SELECT Estudio.precioPublico FROM Estudio WHERE Estudio.IdEstudio=citas.idEstudio) END)) as precio FROM citas JOIN Estudio ON citas.idEstudio=Estudio.IdEstudio JOIN Pacientes ON Pacientes.idPaciente=citas.idPaciente JOIN clientes ON Pacientes.cliente=clientes.idCliente JOIN FacturacionClientesCita ON citas.idCita=FacturacionClientesCita.idCita JOIN FacturacionClientes ON FacturacionClientes.idFacturacionClientes=FacturacionClientesCita.idFacturaClientes WHERE FacturacionClientes.idFacturacionClientes=$idFactura;")->result_array();

    }
    function ejecutarPagoCliente($idFacturacionCliente, $idUsuario, $fechaPago, $montoPagado)
    {
        $data=array('idFacturacionClientes' => $idFacturacionCliente, 'idUsuario' => $idUsuario, 'fechaPago' => $fechaPago, 'montoPagado' => $montoPagado);
        //inserta el pago
        $this->db->insert("PagoFacturacionCliente", $data);
        //verifica si esta liquidada la deuda
        $arrayPago=$this->db->query("SELECT SUM(montoPagado) as totalPagado FROM PagoFacturacionCliente WHERE idFacturacionClientes=$idFacturacionCliente")->row_array();
        $totalPagado=$arrayPago['totalPagado'];
        $arrayFactura=$this->db->query("SELECT montoPago FROM FacturacionClientes WHERE idFacturacionClientes=$idFacturacionCliente")->row_array();
        $montoAPagar=$arrayFactura['montoPago'];
        //Si la deuda ha sido liquidada
        if($totalPagado>=$montoAPagar)
        {
            $this->db->where("idFacturacionClientes", $idFacturacionCliente);
            $this->db->update("FacturacionClientes", array('statusPago'=> 1));
            return "Pago registrado. La deuda ha sido saldada!";
        }
        return "Pago registrado.";
    }
    function verHistorialPagos($idFacturacionClientes)
    {
        return $this->db->query("SELECT PagoFacturacionCliente.*, u.nombreUser FROM PagoFacturacionCliente JOIN usuarios u on PagoFacturacionCliente.idUsuario = u.idUser WHERE PagoFacturacionCliente.idFacturacionClientes=$idFacturacionClientes")->result_array();
    }
    function getDatosCliente($idFacturacion)
    {
        return $this->db->query("SELECT clientes.*, municipios.nombreMunicipio FROM clientes JOIN FacturacionClientes FC on clientes.idCliente = FC.cliente JOIN municipios ON municipios.idMunicipio=clientes.municipio WHERE FC.idFacturacionClientes=$idFacturacion LIMIT 1;")->row_array();
    }
}