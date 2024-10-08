<?php

require_once "conexion.php";

class DashboardModelo
{

    static public function mdlGetDatosDashboard()
    {

        $stmt = Conexion::conectar()->prepare('call prc_ObtenerDatosDashboard()');

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    static public function mdlGetVentasMesActual()
    {

        $stmt = Conexion::conectar()->prepare('call prc_ObtenerVentasMesActual');

        $stmt->execute();
        //pdo:fetch_obj devuelve un onjeto, com propiedades coincidan con las columnas
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static public function mdlProductosMasVendidos()
    {
        //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
        $stmt = Conexion::conectar()->prepare('call prc_ListarProductosMasVendidos()');

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlProductosPocoStock()
    {
        //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
        $stmt = Conexion::conectar()->prepare('call prc_ListarProductosPocoStock');

        $stmt->execute();

        return $stmt->fetchAll();
    }


    static public function mdlGetUltimasVentas()
    {
        //con call realizamos el llamdo de los procedimientos creados en sql de phpMyadmin:
        $stmt = Conexion::conectar()->prepare('call prc_UltimasVentas');

        $stmt->execute();

        return $stmt->fetchAll();
    }


    static public function mdlFiltrarGraficoBarras($fechaDesde, $fechaHasta)
    {
        try {
            $stmt = Conexion::conectar()->prepare('SELECT DATE_FORMAT(vc.fecha_venta, "%m-%d") AS fecha_venta,
            SUM(ROUND(vc.total_venta, 2)) AS total_venta
            FROM ventas vc
            WHERE DATE(vc.fecha_venta) >= DATE(:fecha_desde)
            AND DATE(vc.fecha_venta) <= DATE(:fecha_hasta)
            GROUP BY DATE_FORMAT(vc.fecha_venta, "%m-%d")');

            $stmt->bindParam(":fecha_desde", $fechaDesde, PDO::PARAM_STR);  // Corregido aquí
            $stmt->bindParam(":fecha_hasta", $fechaHasta, PDO::PARAM_STR);  // Corregido aquí

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return 'Excepción capturada: ' . $e->getMessage() . "\n";
        }
    }



    static public function mdlCantidadVentas($mes, $anio)
    {
        try {
            $mesFormateado = sprintf("%02d", $mes);
            $anioFormateado = sprintf("%04d", $anio);

            $stmt = Conexion::conectar()->prepare("SELECT DATE_FORMAT(fecha_venta, '%m-%d') AS dia, COUNT(DISTINCT fecha_venta) AS ventas_dia
                FROM ventas
                WHERE DATE_FORMAT(fecha_venta, '%Y-%m') = '$anioFormateado-$mesFormateado'
                GROUP BY dia
                ORDER BY dia;");

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return 'Excepción capturada: ' . $e->getMessage() . "\n";
        }
    }

    static public function mdlTopProductoPeriodo()
    {

        $stmt = Conexion::conectar()->prepare('call prc_productos_mas_vendidos_periodo');

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlGetBarraDeProgreso()
    {

        $stmt = Conexion::conectar()->prepare('call prc_Metas');

        $stmt->execute();

        return $stmt->fetchAll();
    }


    static public function mdlgetMetas()
    {

        $stmt = Conexion::conectar()->prepare('call prc_Metas');

        $stmt->execute();

        return $stmt->fetchAll();
    }


    static public function mdlObtenerGanancia_d_s_m()
    {

        $stmt = Conexion::conectar()->prepare('call prc_ganancia_d_s_m');

        $stmt->execute();

        return $stmt->fetchAll();
    }



    static public function mdlRecursosMeta()
    {

        $stmt = Conexion::conectar()->prepare('SELECT id, dato FROM recursos limit 3 ');

        $stmt->execute();

        return $stmt->fetchAll();
    }



    static public function mdlEditarMetas($id, $valorMeta)
    {

        $stmt = Conexion::conectar()->prepare('UPDATE recursos SET dato = :metas WHERE id = :id');


        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->bindParam(":metas", $valorMeta, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }





    static public function mdlSiNoEsUltimoDiaMes($dato)
    {
        try {
            $conn = Conexion::conectar();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->beginTransaction();

            $stmt = $conn->prepare('UPDATE recursos SET dato = :siNoMes WHERE id = "ULTIMO_D_M"');
            $stmt->bindParam(":siNoMes", $dato, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $conn->commit();
                $resultado = "ok";
                self::verificarSiNoUltimoDiaMes($conn);
            } else {
                $conn->rollBack();
                $resultado = "error";
            }
        } catch (Exception $e) {

            if ($conn->inTransaction()) {
                $conn->rollBack();
            }
            $resultado = 'Excepción capturada: ' . $e->getMessage();
        } finally {

            $stmt = null;
            $conn = null;
        }

        return $resultado;
    }

    static public function verificarSiNoUltimoDiaMes($conn)
    {


        try {
            $stmtVerificarDia = $conn->prepare('SELECT dato FROM recursos WHERE id = "ULTIMO_D_M"');
            $stmtVerificarDia->execute();

            $resultadoDia = $stmtVerificarDia->fetch(PDO::FETCH_ASSOC);



            if ($resultadoDia) {


                if ($resultadoDia['dato'] == 1) {
                    include_once '../vistas/generar_reportes.php';
                } else {

                    return "No se encontró el dato.";
                }
            } else {
                echo json_encode("entro verificarsi no asdasdasdasdasddia");
                return "No se encontró el dato.";
            }
        } catch (PDOException $e) {
            return "Error al verificar el día: " . $e->getMessage();
        } finally {
            // Cerrar la conexión y liberar recursos
            $stmtVerificarDia = null;
        }
    }




    static public function mdlObtenerComparativaVentas()
    {
        try {
            $stmt = Conexion::conectar()->prepare('call comparativa_ventas_productos');
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
}
