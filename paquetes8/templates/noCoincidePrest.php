<sdm>
  <setModuleOptions moduleID="<?php echo $this->_moduleID;?>" autoRedraw="1" retainFocus="1" flushCache="3"/>

  <scene ID="selecServ" visible="1" pos="0 0">

    <subscribeToEvent ID="navigation">
      <keyEvent type="KEY_DOWN" relayToServer="0" actionList="{exit}" />
      <keyEvent type="KEY_LEFT" actionList="{temp}"/>
      <keyEvent type="KEY_RIGHT" actionList="{temp}"/>
    </subscribeToEvent>

    <image ID="packs_bkg" visible="1" pos="50 70" ref="<?php echo $this->serverPath; ?>img/paquetes_bkg.png" cache="1" />

    <group ID="titulos" visible="1" pos="0 0">
      <textRect ID="titulo1" visible="1" rect="60 120 600 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="CENTER" vertJust="CENTER">
        <text><![CDATA[NO coincide número de prestacion ingresado !!]]></text>
      </textRect>
    </group>

    <group ID="boton" visible="1" pos="0 0">

      <textButton ID="btnContinuar" visible="1" rect="310 360 110 35" text="Continuar" fontID="18" foreColor="0xFFFFFFFF">
          <stateDef type="NORMAL" actionList="{tempAction}"/>
          <stateDef type="FOCUSED" actionList="{tempAction}"/>
          <stateDef type="SELECTED" actionList="{exit}" />
      </textButton>

    </group>

  </scene>

  <define>

    <exitModule ID="exit" targetID="<?php echo $this->_moduleID; ?>" />
    <updateModule ID="updateMod" targetID="<?php echo $this->_moduleID; ?>" refreshScreen="0" />

  </define>

</sdm>
