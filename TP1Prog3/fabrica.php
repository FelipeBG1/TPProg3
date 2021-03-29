<?php
    require_once "empleado.php";

    class Fabrica{

        private $_cantidadMaxima;
        private $_empleados;
        private $_razonSocial;

        public function __construct($razonSocial)
        {
            $this->_razonSocial = $razonSocial;
            $this->_empleados = array();
            $this->_cantidadMaxima = 5;
        }
        
        public function AgregarEmpleado($emp)
        {
            if($this->_cantidadMaxima > count($this->_empleados))
            {
                array_push($this->_empleados, $emp);
                $this->EliminarEmpleadoRepetido();
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function CalcularSueldos()
        {
            $totalSueldos = 0;

            foreach($this->_empleados as $item)
            {
                $totalSueldos += $item->GetSueldo();
            }

            return $totalSueldos;
        }

        public function EliminarEmpleado($emp)
        {
            $rta = false;

            foreach($this->_empleados as $key => $item)
            {
                if($item === $emp)
                {
                    unset($this->_empleados[$key]);
                    $rta = true;
                    break;
                    
                }
            }

            return $rta;
        }

        private function EliminarEmpleadoRepetido()
        {
            $this->_empleados = array_unique($this->_empleados, SORT_REGULAR);
        }

    
        public function ToString()
        {
            $cadena = "";

            foreach($this->_empleados as $item)
            {
                $cadena .= $item->ToString() . "<br>";
            }

            $cadena .= "<br>" . "Cantidad máxima de empleados: " . $this->_cantidadMaxima . " - " . "Razón social: " . $this->_razonSocial
            . " - " . "Total sueldos: " . $this->CalcularSueldos() . "<br>";

            return $cadena;
        }
    }   

?>