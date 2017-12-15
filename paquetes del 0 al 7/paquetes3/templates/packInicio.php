<sdm>
  <setModuleOptions moduleID="<?php echo $this->_moduleID;?>" autoRedraw="1" retainFocus="1" flushCache="2"/>

  <scene ID="verVariables" visible="1" pos="0 0">

    <subscribeToEvent ID="navigation">
      <keyEvent type="KEY_DOWN" relayToServer="0" actionList="{exit}" />
      <keyEvent type="KEY_LEFT" actionList="{temp}"/>
      <keyEvent type="KEY_RIGHT" actionList="{temp}"/>
    </subscribeToEvent>

    <image ID="packs_bkg" visible="1" pos="50 70" ref="<?php echo $this->serverPath; ?>img/paquetes_bkg.png" cache="1" />

    <group ID="titulos" visible="1" pos="0 0">

      <textRect ID="titulo1" visible="1" rect="200 110 400 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<< Gestión servicios adicionales >>]]></text>
      </textRect>
      <textRect ID="titulo2" visible="1" rect="110 170 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Paquetes que puede contratar:]]></text>
      </textRect>
      <textRect ID="titulo4" visible="1" rect="110 380 600 40" fontID="16" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Para dar de baja un servicio dirigirse al salón de ventas de la Cooperativa.]]></text>
      </textRect>
      <textRect ID="titulo3" visible="1" rect="110 360 600 40" fontID="16" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Los precios son mensuales.   -    Seleccione con las flechas del control remoto]]></text>
      </textRect>

    </group>

    <group ID="btnsContratar" visible="1" pos="0 0">

      <?php if($this->_foxContratado) {?>

        <image ID="fox_contratado" visible="1" pos="110 230" ref="<?php echo $this->serverPath; ?>img/fox_premium_contrat.png" cache="1" />

      <?php } else {?>
        <imageButton ID="btnFox" visible="1" pos="110 230">
            <stateDef type="NORMAL" ref="<?php echo $this->serverPath; ?>img/fox_premium.png" />
            <stateDef type="FOCUSED" ref="<?php echo $this->serverPath; ?>img/fox_premium_focused.png" />
            <stateDef type="SELECTED" actionList="{quiereFox}" ref="<?php echo $this->serverPath; ?>img/fox_premium.png" />
        </imageButton>
      <?php }?>

      <?php if($this->_futbolContratado) {?>

        <image ID="futbol_contratado" visible="1" pos="230 230" ref="<?php echo $this->serverPath; ?>img/futbol_fox_tnt_contrat.png" cache="1" />

     <?php } else {?>
        <imageButton ID="btnFutbol" visible="1" pos="230 230">
            <stateDef type="NORMAL" ref="<?php echo $this->serverPath; ?>img/futbol_fox_tnt.jpg" />
            <stateDef type="FOCUSED" ref="<?php echo $this->serverPath; ?>img/futbol_fox_tnt_focused.png" />
            <stateDef type="SELECTED" actionList="{quiereFut}" ref="<?php echo $this->serverPath; ?>img/futbol_fox_tnt.jpg" />
        </imageButton>
      <?php }?>

      <?php if($this->_adultosContratado) {?>

        <image ID="adulto_contratado" visible="1" pos="440 230" ref="<?php echo $this->serverPath; ?>img/adultos_contrat.png" cache="1" />

     <?php } else {?>
        <imageButton ID="btnAdulto" visible="1" pos="440 230">
            <stateDef type="NORMAL" ref="<?php echo $this->serverPath; ?>img/adultos_90x60.png" />
            <stateDef type="FOCUSED" ref="<?php echo $this->serverPath; ?>img/adultos_focused.png" />
            <stateDef type="SELECTED" actionList="{quiereAdu}" ref="<?php echo $this->serverPath; ?>img/adultos_90x60.png" />
        </imageButton>
      <?php }?>

    </group>

    <group ID="preciosYdisp" visible="1" pos="0 0">

      <?php if(!$this->_foxContratado) {?>
        <textRect ID="precioFox" visible="1" rect="110 290 200 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
          <text><![CDATA[<?php echo $this->_arrPreciosPacks['fox']; ?>]]></text>
        </textRect>
      <?php }?>

      <?php if(!$this->_futbolContratado) {?>
        <textRect ID="precioFutbol" visible="1" rect="230 290 200 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
          <text><![CDATA[<?php echo $this->_arrPreciosPacks['futbol']; ?>]]></text>
        </textRect>
      <?php }?>

      <?php if(!$this->_adultosContratado) {?>
        <textRect ID="precioAdultos" visible="1" rect="440 290 200 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
          <text><![CDATA[<?php echo $this->_arrPreciosPacks['adultos']; ?>]]></text>
        </textRect>
      <?php }?>

    </group>

<!-- Para probar variables... (borrar despues) -->

      <textRect ID="dato01" visible="1" rect="110 420 600 40" fontID="16" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Nro. prestación:]]></text>
      </textRect>
      <textRect ID="dato02" visible="1" rect="310 420 600 40" fontID="16" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo $this->_nroPrest; ?> - <?php echo $this->accountID; ?>]]></text>
      </textRect>


    <?php if(!$this->_foxContratado) {?>
      <relTimeTrigger ID="focoBotonfox" elapsedTime="0" actionList="focoBtnFox" />
    <?php }?>

    <?php if($this->_foxContratado && !$this->_futbolContratado) {?>
      <relTimeTrigger ID="focoBotonfut" elapsedTime="0" actionList="focoBtnFut" />
    <?php }?>

    <?php if($this->_foxContratado && $this->_futbolContratado) {?>
      <relTimeTrigger ID="focoBotonAdu" elapsedTime="0" actionList="focoBtnAdu" />
    <?php }?>


    <define>

      <exitModule ID="exit" targetID="<?php echo $this->_moduleID; ?>" />
      <updateModule ID="reload" targetID="<?php echo $this->_moduleID; ?>" refreshScreen="0"/>
      <buttonState ID="focoBtnFox" targetID="btnFox" state="FOCUSED" />
      <buttonState ID="focoBtnFut" targetID="btnFutbol" state="FOCUSED" />
      <buttonState ID="focoBtnAdu" targetID="btnAdulto" state="FOCUSED" />

      <moduleMsg ID="quiereFox" message="&amp;selec=fox&amp;tieneHD=<?php echo $this->_tieneHD; ?>" />
      <moduleMsg ID="quiereFut" message="&amp;selec=futbol&amp;tieneHD=<?php echo $this->_tieneHD; ?>" />
      <moduleMsg ID="quiereAdu" message="&amp;selec=adulto&amp;tieneHD=<?php echo $this->_tieneHD; ?>" />

    </define>
  </scene>

</sdm>
