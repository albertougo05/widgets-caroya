<?php
    /**
     * Widget para activar paquetes de productos premiun
     *
     * Version 1.0.2 - Noviembre 2017 (para Coop Caroya)
     * Copyright: Alberto Ugolino
     **/

    // Para Coop Caroya
    include './templates/serverInfo.php';


    /**
     * Clase Packs
     */
    class Packs
    {
      // Variables pasadas por el servidor
      public $serverPath;
      public $clientMAC;
      public $accountID;

      private $_moduleID;
      private $_widget_name;
      private $_datosCliente;
      private $_nroPrest;
      private $_nombre;

      private $_servs_a_contratar;
      private $_arrPreciosPacks;
      private $_foxContratado;
      private $_futbolContratado;
      private $_adultosContratado;
      private $_tieneHD;


      function __construct()
      {
          session_start();
          $this->_cargaVarConfig();
          # Cargo los precios de los servicios (Packs)
          $this->_arrPreciosPacks = array('fox' => "$ 150.-", 'futbol'  => "$ 300.-", 'adultos' => "$ 80.-");
          # Cargo los servicios a contratar
          $this->_servs_a_contratar = array('foxMasHD' => 782, 'foxMas' => 576, 'futbolHD' => 1007, 'futbolSD' => 1026, 'adultos' => 566);

      }

      /**
       * Carga variables de configuration.xml
       * @return nada
       */
      private function _cargaVarConfig()
      {
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

        /**
         * Funcion que corre el script
         * @return nada (void)
         */
        public function correr()
        {
            // Cargo una mac para prueba. En producción lo toma del stb.
            //$this->clientMAC = '0002025C4BBF';     // Seba
            //$this->clientMAC = '0002025C36C1';    // Marquez
            //$this->clientMAC = '0002025CE878';     // Alberto
            $this->clientMAC = '0002024FD95B';     // Luque Nicolas - 159228 - Servicios Basicos

            # Verificar si es el inicio y cargar datos del cliente y servicios

            # Buscamos datos del cliente
            $this->_buscarDataClie($this->clientMAC);
            $this->_verServsClie($this->_nroPrest);

            # Permanencia minima 3 meses para fox y adultos | 1 año para futbol

            # Lanza codigo xml al STB
            //include './templates/verVariables.php';
            include './templates/packInicio.php';
        }

        /**
         * Cuando el cliente ha seleccionado servicio...
         */
        public function correrSelec($selecciono)
        {

          include './templates/selecServ.php';

        }

        /**
         * Busco datos cliente en Minerva
         * @return nada
         */
        private function _buscarDataClie()
        {
            $strConn = "http://alberto.coop5.com.ar/app/classBuscarXmac.php?mac=$this->clientMAC";
            $jsonData = file_get_contents($strConn);
            $this->_datosCliente = json_decode($jsonData, true);
            $resultBusq = $this->_datosCliente['STATUS'];

            if ($resultBusq == "OK") {

                $this->_nroPrest = $this->_datosCliente['CUSTOMER_ID'][0];
                $this->accountID = $this->_datosCliente['ACCOUNT_ID'][0];
                // Buscar en base de datos de Lucas, los datos del cliente, con el nro. de prestacion.
                $this->_dataDeCoop($this->_nroPrest);
            }
        }

        /**
         * Buscar data de cliente en base de datos de la Coop
         * @param  int $value número de prestacion en Coop
         * @return los datos cargados en variables privadas
         */
        private function _dataDeCoop($value)
        {
          $strConn = "https://isp.coop5.com.ar/buscarPrest.php?id=27&toquen=76a850bcefcceb388f751271da3c6150&prest=".$value;
          $dataJson = file_get_contents($strConn);
          $dataArr = json_decode($dataJson, true);

          $this->_nombre    = $dataArr['nombre'];
        }

        /**
         * Busca los servicios que tiene cargado el cliente
         * @param  int $custId
         * @return array con Paquetes adquiridos
         */
        private function _verServsClie($custId)
        {
            $strConn = "http://alberto.coop5.com.ar/app/verServsCli.php?cid=$custId";
            $jsonData = file_get_contents($strConn);
            $arrServicios = json_decode($jsonData, true);

            # En falso todos los servicios
            $this->_foxContratado = $this->_futbolContratado = $this->_adultosContratado = $this->_tieneHD = false;

            if ($arrServicios[0] != "Vacio") {
                // Recorro array con servicios para ver si están los 3 a 

                foreach ($arrServicios as $value) {
                    switch ((int) $value) {
                      case (int) $this->_servs_a_contratar['foxMas']:
                        $this->_foxContratado = true;
                        break;
                      case (int) $this->_servs_a_contratar['foxMasHD']:
                        $this->_foxContratado = true;
                        break;
                      case (int) $this->_servs_a_contratar['futbolSD']:
                        $this->_futbolContratado = true;
                        break;
                      case (int) $this->_servs_a_contratar['futbolDD']:
                        $this->_futbolContratado = true;
                        break;
                      case (int) $this->_servs_a_contratar['adultos']:
                        $this->_adultosContratado = true;
                        break;
                      case 565:    // Servicio de HD
                        $this->_tieneHD = true;
                        break;
                    }
                }

            }
        }

    }   // Fin clase



    /**
     * Instancia de la clase
     */
    $paquetes = new Packs();
    $paquetes->serverPath = $serverPath;

    $paquetes->clientMAC   = $_REQUEST['clientMAC'];
    $paquetes->accountID   = $_REQUEST['accountID'];

    if (!isset($_REQUEST['selec'])) {
        # Si no ha seleccionado...
        $paquetes->correr();

    } else {

        $paquetes->correrSelec($_REQUEST['selec']);

    }

    unset($paquetes);

?>
