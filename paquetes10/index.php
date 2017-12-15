<?php
    /**
     * Widget para activar paquetes de productos premiun
     *
     * Version 2.0.3 - Diciembre 2017 (para Coop Caroya)
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
            $this->_arrPreciosPacks = array('fox' => "$ 150.-", 'futbol'  => "$ 300.-", 'adultos' => "$ 100.-");
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
        public function correrInicio()
        {
            $this->clientMAC = '0002025CE878';     // Alberto

            // Buscamos datos del cliente
            $this->_buscarDataClie($this->clientMAC);
            // Buscamos los servicios
            $this->_verServsClie($this->_nroPrest);
            // Grabamos el log de acceso
            $this->_grabarLogAccess();
            // Lanza codigo xml al STB
            include './templates/packInicio.php';
        }

        /**
         * Cuando el cliente ha seleccionado servicio...
         */
        public function correrSelec($selecciono)
        {
            $this->_tieneHD  = $_REQUEST['tieneHD'];
            $this->_nroPrest = $_REQUEST['nroPrest'];

            include './templates/selecServ.php';
        }

        /**
         * El cliente ha confirmado contratación de servicio...
         * 
         */
        public function correrConfirma($selecciono)
        {
            $this->_tieneHD  = $_REQUEST['tieneHD'];
            //$this->_tieneHD  = true;
            $this->_nroPrest = $_REQUEST['nroPrest'];

            // Cargar servicio en Minerva - Las variables son las privadas
            $salvarServMin = $this->_cargarServEnMinerva($selecciono);

            // Cargar servicio datos en Sistemas  Coop
            // $salvarEnSistem = $this->_cargarServicioEnSistCoop($selecciono);

// Falta comprobar si cargo bien en sistemas

            // if($salvarServMin && $salvarEnSistem)
            if ($salvarServMin) {
                // Si se cargó con exito el servicio...

                // Grabar en archivo log
                //$this->_grabarLogContratado($selecciono);

                include './templates/confServContrat.php';
                // Acá va a reiniciar el stb

            } else include './templates/errorCargaServ.php';
        }

        /**
         * Confirma lo de adultos -->> Luego pasa a correrConfirma()
         * 
         */
        public function correrConfirmaAdulto($selecciono)
        {
            $this->_tieneHD  = $_REQUEST['tieneHD'];
            //$this->_tieneHD  = true;
            $this->_nroPrest = $_REQUEST['nroPrest'];
            // Acá va a reiniciar el stb
            include './templates/confirmAdultos.php';
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
         *
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
            // include_once './func/verServsClie.php'

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

        /**
         * Carga el servicio solicitado en Minerva
         * 
         * @return boolean (true si cargó OK)
         */
        private function _cargarServEnMinerva($selec)
        {
            $custId = $this->_nroPrest;

            switch ($selec) {
                case 'fox':
                    $codServicios = ($this->_tieneHD) ? '576|782':'576';
                    break;
                case 'futbol':
                    $codServicios = ($this->_tieneHD) ? '1026|1007':'1026';
                    break;
                case 'adulto':
                    $codServicios = '566';
                    break;
            }

            $strConn = "http://alberto.coop5.com.ar/coopmine/customerServiceAdd.php?cid=$custId&serv=$codServicios";
            $jsonData = file_get_contents($strConn);
            $respAddServ = json_decode($jsonData, true);

            //    include './templates/verVar2.php';

            return ($respAddServ[0] == 'Ok') ? true : false;
        }

        /**
         * Pantalla final contrata adultos
         */
        function confirmAdultoFinal($nroPrest)
        {
            $this->_tieneHD  = $_REQUEST['tieneHD'];
            //$this->_tieneHD  = true;
            $this->_nroPrest = $nroPrest;
            $selecciono = 'adulto';
            // Cargar servicio en Minerva - Las variables son las privadas
            $salvarServMin = $this->_cargarServEnMinerva($selecciono);
            // Cargar servicio datos en Sistemas  Coop
            // $salvarEnSistem = $this->_cargarServicioEnSistCoop($selecciono);

            // if($salvarServMin && $salvarEnSistem) {
            if ($salvarServMin) {
                // Si se cargó con exito el servicio...
                include './templates/confServContrat.php';

            } else include './templates/errorCargaServ.php';
        }

        /**
         * Si no coincide el nro prestacion...
         *
         */
        function noCoincidePrest()
        {
            include './templates/noCoincidePrest.php';
        }

        /**
         * Salvar datos en sistema cooperativa
         * @param 
         */
        private function _cargarServicioEnSistCoop($selec)
        {
            //$this->_nroPrest;

            switch ($selec) {
                case 'fox':
                    $codSistema = '2';
                    break;
                case 'futbol':
                    $codSistema = '6';
                    break;
                case 'adulto':
                    $codSistema = '3';
                    break;
            }

            //$strConn = "http://alberto.coop5.com.ar/coopmine/customerServiceAdd.php?cid=$custId&serv=$codServicios";
            //$jsonData = file_get_contents($strConn);
            //$respAddServ = json_decode($jsonData, true);
            //    include './templates/verVar2.php';

            return ($respAddServ[0] == 'Ok') ? true : false;
        }

        /**
         * Resetea el STB
         *
         */
        function resetSTB($idMac)
        {
            // Buscar el id del stb con la mac
            $strConn = "http://alberto.coop5.com.ar/app/resetPorMac.php?mac=$idMac";
            $jsonData = file_get_contents($strConn);
            $respAddServ = json_decode($jsonData, true);

            include './templates/resetStb.php';
        }

        /**
         * Graba en archivo de log para registro de accesos
         * 
         * @return void
         */
        private function _grabarLogAccess()
        {
            $texto = date("d/m/y H:i") . " - WidgetName: paquetes";
            $texto = $texto." - AccountID: " . $this->accountID;
            $textUrl = urlencode($texto);
            $strConn = "http://alberto.coop5.com.ar/app/logWidgets.php?text=$textUrl";
            $jsonData = file_get_contents($strConn);
            // Tomo la devolucion para un futuro uso. Por ahora nada
            $data = json_decode($jsonData, true);
        }


        /**
         * Graba en archivo de log para registro de accesos
         * 
         * @return bool
         */
        private function _grabarLogContratado($selec)
        {
            $texto = date("d/m/y H:i") . " - Prestacion: ".$this->_nroPrest;
            $texto = $texto." - Contrato: ".$selec;
            $textUrl = urlencode($texto);
            $strConn = "http://alberto.coop5.com.ar/app/logContratados.php?text=$textUrl";
            $jsonData = file_get_contents($strConn);
            // Tomo la devolucion para un futuro uso. Por ahora nada
            $data = json_decode($jsonData, true);
            $result = $data[0];
            if ($result == 'OK') {
                return true;
            } else {
                return false;
            }
        }


    }   // Fin clase



    /**
     * Instancia de la clase
     */
    $paquetes = new Packs();
    $paquetes->serverPath = $serverPath;
    $paquetes->clientMAC  = $_REQUEST['clientMAC'];
    $paquetes->accountID  = $_REQUEST['accountID'];

    if (isset($_REQUEST['selec'])) {
        // Ha seleccionado un paquete

        if ( $_REQUEST['selec'] == 'adulto') {
            // Si es adulto pide datos para confirmar
            $paquetes->correrConfirmaAdulto($_REQUEST['selec']);

        } else {
            $paquetes->correrSelec($_REQUEST['selec']);
        }

    } elseif ( isset($_REQUEST['confirma']) ) {
        // Confirma o cancela paquete seleccionado. 
        // Si cancela comienza con correr() + session_destroy() para 

        if ( $_REQUEST['confirma'] == 'si' ) {
            // confirma paquete
            $paquetes->correrConfirma($_REQUEST['selecciono']);

        } else {
            // cancela confirmación
            session_destroy();
            $paquetes->correrInicio();
        }

    } elseif ( isset($_REQUEST['inputPrest']) ) {
            // Si confirma contrata adulto
            if ($_REQUEST['inputPrest'] == $_REQUEST['nroPrest']) {
                # Si coincide ingreso prestacion...
                $paquetes->confirmAdultoFinal($_REQUEST['nroPrest']);

            } else {
                // Si no coindice ingresado con prestacion
                $paquetes->noCoincidePrest();
            }

    } elseif ( isset($_REQUEST['resetStb']) ) {
            // Va a resetear STB
            $paquetes->resetSTB($_REQUEST['clientMAC']);
            //$paquetes->resetSTB('0002025C4A62');

    } else {
        // Inicio o si no ha seleccionado
        $paquetes->correrInicio();
    }

    unset($paquetes);

?>
