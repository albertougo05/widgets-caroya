<sdm>
  <setModuleOptions moduleID="<?php echo $this->_moduleID;?>" autoRedraw="1" retainFocus="1" flushCache="2"/>

  <scene ID="verVariables" visible="1" pos="0 0">

    <subscribeToEvent ID="navigation">
      <keyEvent type="KEY_DOWN" relayToServer="0" actionList="{exit}" />
      <keyEvent type="KEY_LEFT" actionList="{exit}"/>
      <keyEvent type="KEY_RIGHT" actionList="{exit}"/>
    </subscribeToEvent>

    <image ID="packs_bkg" visible="1" pos="10 10" ref="<?php echo $this->serverPath; ?>img/paquetes_bkg.png" cache="1" />

    <textRect ID="tituloVentana" visible="1" rect="90 50 500 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
      <text><![CDATA[Variables para cargar prestacion: ]]></text> 
    </textRect>

    <group ID="textoNoResult" visible="1" pos="0 0">

      <textRect ID="dato0" visible="1" rect="110 110 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Nro. prestación:]]></text>
      </textRect>
      <textRect ID="dato02" visible="1" rect="310 110 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo $this->_nroPrest; ?>]]></text>
      </textRect>

      <textRect ID="dato1" visible="1" rect="110 140 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Seleccionó:]]></text>
      </textRect>
      <textRect ID="dato12" visible="1" rect="310 140 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo $selec; ?>]]></text>
      </textRect>

      <textRect ID="dato2" visible="1" rect="110 170 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Códigos servicios:]]></text>
      </textRect>
      <textRect ID="dato22" visible="1" rect="310 170 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo $codServicios; ?>]]></text>
      </textRect>

      <textRect ID="dato92" visible="1" rect="50 200 650 40" fontID="16" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo $strConn; ?>]]></text>
      </textRect>

    </group>

    <define>

      <exitModule ID="exit" targetID="<?php echo $this->_moduleID; ?>" />

    </define>
  </scene>

</sdm>
