<?php 
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
?>
