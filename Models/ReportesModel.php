<?php
class ReportesModel extends Query {
    public function __construct() 
    {
        parent::__construct();
    }

    public function verificarPermiso(int $id_user, string $nombre) 
    {
            $sql = "SELECT p.id, p.permiso, d.id, d.id_usuario, d.id_permiso FROM permisos p 
            INNER JOIN  detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.permiso = '$nombre'"; //cuando es un string hay que poner las comillas simples
            $data = $this->selectAll($sql);
            return $data;
    }

    public function getDatos(string $table)
    {
        $sql = "SELECT COUNT(*) AS total FROM $table";
        $data = $this->select($sql);
        return $data;
    }



        // Método para contar clientes activos e inactivos
        public function contarClientesPorEstado() {
            $sqlActivos = "SELECT COUNT(*) AS activos FROM clientes WHERE Estado = 1";
            $sqlInactivos = "SELECT COUNT(*) AS inactivos FROM clientes WHERE Estado = 0";
            
            $activos = $this->select($sqlActivos);    
            $inactivos = $this->select($sqlInactivos);
            
            return [
                'activos' => $activos['activos'] ?? 0,
                'inactivos' => $inactivos['inactivos'] ?? 0
            ];
        }


        public function getClientesConMasCompras() {
            $sql = "SELECT cliente, identificacion, COUNT(*) AS num_compras
                    FROM ventas
                    GROUP BY cliente, identificacion
                    ORDER BY num_compras DESC
                    LIMIT 10"; 
        
            return $this->selectAll($sql); 
        }


        public function getProveedoresConMasCompras() {
            $sql = "SELECT proveedor, COUNT(*) AS num_compras, SUM(cantidad) AS total_unidades, SUM(sub_total) AS total_gastado
                    FROM detalle_compra
                    GROUP BY proveedor
                    ORDER BY num_compras DESC
                    LIMIT 10"; 
        
            return $this->selectAll($sql); 
        }

        

        public function getProductosConMasCantidad() {
            $sql = "SELECT producto, cantidad 
                    FROM inventario 
                    ORDER BY cantidad DESC 
                    LIMIT 5"; 
    
            return $this->selectAll($sql);
        }
    
        public function getProductosConMenosCantidad() {
            $sql = "SELECT producto, cantidad 
                    FROM inventario 
                    WHERE cantidad > 0 
                    ORDER BY cantidad ASC 
                    LIMIT 5"; 
    
            return $this->selectAll($sql);
        }


        public function contarUsuariosPorEstado() {
            $sqlActivos = "SELECT COUNT(*) AS activos FROM _usuarios WHERE estado = 1"; 
            $sqlInactivos = "SELECT COUNT(*) AS inactivos FROM _usuarios WHERE estado = 0"; 
            
            $activos = $this->select($sqlActivos);    
            $inactivos = $this->select($sqlInactivos);
            
            return [
                'activos' => $activos['activos'] ?? 0,
                'inactivos' => $inactivos['inactivos'] ?? 0
            ];
        }
        
        
        public function getRolConMasUsuarios() {
            $sql = "SELECT roles.rol, COUNT(_usuarios.id) AS cantidad 
                    FROM _usuarios 
                    JOIN roles ON _usuarios.id_rol = roles.id
                    GROUP BY _usuarios.id_rol 
                    ORDER BY cantidad DESC 
                    LIMIT 5";
        
            return $this->selectAll($sql);
        }
        
        public function getProductosMasVendidos() {
            $sql = "SELECT tipo_productob, SUM(cantidad) AS cantidad_total
                    FROM detalle_venta
                    GROUP BY tipo_productob
                    ORDER BY cantidad_total DESC
                    LIMIT 5";  
        
            return $this->selectAll($sql);
        }
        
        
        

    }



?>