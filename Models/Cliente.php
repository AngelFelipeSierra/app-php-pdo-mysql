<?php 
    namespace Models;
    class Cliente {
        protected static $conn;
        protected static $columnsTbl=["idCliente", "primerNombre", "segundoNombre", "primerApellido", "segundoApellido", "emailCliente"];
        private $idCliente;
        private $primerNombre;
        private $segundoNombre;
        private $primerApellido;
        private $segundoApellido;
        private $emailCliente;
        public function __construct($args = []){
            $this->idCliente = $args['idCliente'] ?? '';
            $this->primerNombre = $args['primerNombre'] ?? '';
            $this->segundoNombre = $args['segundoNombre'] ?? '';
            $this->primerApellido = $args['primerApellido'] ?? '';
            $this->segundoApellido = $args['segundoApellido'] ?? '';
            $this->emailCliente = $args['emailCliente'] ?? ''; 
        }
        /* Metodo de insercion de data */
        public function saveData($data){
            $dekimiter = ":";
            $dataBd = $this->sanitizarAttributos();
            $valCols = $delimiter . join(',:',array_keys($data));
            $cols = join(',', array_keys($data));
            $sql = "INSERT INTO cliente ($cols) VALUES ($valCols)";
            $stmt = self::$conn->prepare($sql);
            try {
                $stml->execute($data);
                $response=[[
                    'idCliente' => $data['idCliente'],
                    'primerNombre' => $data['primerNombre'],
                    'segundoNombre' => $data['segundoNombre'],
                    'primerApellido' => $data['primerApellido'],
                    'segundoApellido' => $data['segundoApellido'],
                    'emailCliente' => $data['emailCliente']
                    
                ]];
            } catch (\PDOException $e) {
                echo $sql . $e->getMessage();
            }
            return $response;
        }

        /* Sanatizacio: Previene caracteres especiales en el momento de la  inyeccion de sql */
        public static function setConn ($connBd){
            self::$conn = $connBd;
        }
        public static function atributos (){
            $atributos = [];
            foreach(self::$columnsTbl as $columna){
                if($columna === 'idCliente') continue;
                $atributos [$columna]=$this->$columna;
            }
            return $atributos;
        }
        public function sanitizarAttributos (){
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach ($atributos as $key => $value) {
                $sanitizado[$key] = self::$conn->quote($value);
            }
            return $sanitizado;
        }
    }
?>