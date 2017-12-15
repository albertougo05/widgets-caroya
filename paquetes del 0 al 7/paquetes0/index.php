<?php
    /**
     * Widget para activar paquetes de productos premiun
     *
     * Version 1.0.1 - Noviembre 2017 (para Coop Caroya)
     * Copyright: Alberto Ugolino
     **/

    # Para Coop Caroya
    include('./templates/serverInfo.php');


    /**
     * Clase Packs
     */
    class Packs
    {
      // Variables pasadas por el servidor
        public $serverPath;
        public $clientIP;
        public $clientMAC;
        public $accountID;

        private $_moduleID;
        private $_widget_name;
        private $_datosCliente;
        private $_nroPrest;
        private $_nombre;
        private $_telefono;
        private $_direccion;
        private $_localidad;
        private $_planIptv;


      function __construct()
      {
          session_start();
          $this->_cargaVarConfig();
      }

      private function _cargaVarConfig()
      {
          # Carga variables de configuration.xml
            $config_variables = simplexml_load_file('configuration.xml');
            foreach ($config_variables as $key => $value) {
                switch ($key) {
                    case "sdmModule_id":
                        $this->_moduleID = $value; break;
                    case "widget_name":
                        $this->_widget_name = $value; break;
                }
            }          
        }

        public function correr()
        {
            # Buscar data cliente

            // Cargo una mac para prueba. En producción lo toma del stb.
            //$this->clientMAC = '0002025C4BBF';     // Seba
            //$this->clientMAC = '0002025C36C1';    // Marquez
            $this->clientMAC = '0002025CE878';     // Alberto


            $this->_buscarDataClie($this->clientMAC);
            //$this->_preciosServs();

            // Buscar en base de datos de Lucas, los datos del cliente, con el nro. de prestacion.
            //$this->_dataDeCoop($this->_nroPrest);


            # Lanza codigo xml al STB
            //include './templates/verVariables.php';
            include './templates/packInicio.php';
        }

        private function _buscarDataClie()
        {
            # Busco datos cliente en Minerva
            $strConn = "http://alberto.coop5.com.ar/app/classBuscarXmac.php?mac=$this->clientMAC";
            $jsonData = file_get_contents($strConn);
            $this->_datosCliente = json_decode($jsonData, true);
            $resultBusq = $this->_datosCliente['STATUS'];

            if ($resultBusq == "OK") {
                 // 
                $this->_nroPrest = $this->_datosCliente['CUSTOMER_ID'][0];
                $this->accountID = $this->_datosCliente['ACCOUNT_ID'][0];

          $this->_nombre    = "Alberto Ugolino";
          $this->_direccion = "Av. 28 de Julio 1300";
          $this->_localidad = "Jesus Maria";
          $this->_telefono  = "3525-608912";
          $this->_planIptv  = "N/D";

            }
        }

        private function _dataDeCoop($value)
        {
          # Buscar data de cliente en base de datos de la Coop
          # $value es el número de prestacion en Coop

          $strConn = "https://isp.coop5.com.ar/buscarPrest.php?id=27&toquen=76a850bcefcceb388f751271da3c6150&prest=".$value;

          $dataJson = file_get_contents($strConn);
          $dataArr = json_decode($dataJson, true);

          $this->_nombre    = $dataArr['nombre'];
          $this->_direccion = $dataArr['calle_nro'];
          $this->_localidad = $dataArr['localidad'];
          $this->_telefono  = $dataArr['telefono'];
          $this->_planIptv  = $dataArr['planIptv'];
        }

        private function _preciosServs()
        {
          # Array con precios de servicios
          $fox = "$ 150.-";  $futbol = "$ 300.-";  $adultos = "$ 80.-";

          // hacer un case para si tiene contratado el servicio le pongo 'contratado'

          # Permanencia minima 3 meses para fox y adultos | 1 año para futbol

        }

    }   // Fin clase



    /**
     * Instancia de la clase
     */
    $paquetes = new Packs();
    $paquetes->serverPath = $serverPath;

    $paquetes->clientIP    = $_REQUEST['clientIP'];
    $paquetes->clientMAC   = $_REQUEST['clientMAC'];
    $paquetes->accountID   = $_REQUEST['accountID'];

    $paquetes->correr();

    unset($paquetes);

?>
