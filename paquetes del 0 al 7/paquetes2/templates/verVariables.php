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
      <text><![CDATA[Compra de Paquetes: ]]></text> 
    </textRect>

    <group ID="textoNoResult" visible="1" pos="0 0">

      <textRect ID="dato0" visible="1" rect="110 110 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Nro. prestación:]]></text>
      </textRect>
      <textRect ID="dato02" visible="1" rect="310 110 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo $this->_nroPrest; ?>]]></text>
      </textRect>

      <textRect ID="dato1" visible="1" rect="110 140 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Nombre:]]></text>
      </textRect>
      <textRect ID="dato12" visible="1" rect="310 140 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo $this->_nombre; ?>]]></text>
      </textRect>

      <textRect ID="dato2" visible="1" rect="110 170 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Tiene FOX:]]></text>
      </textRect>
      <textRect ID="dato22" visible="1" rect="310 170 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo ($this->_foxContratado) ? "SI":"NO"; ?>]]></text>
      </textRect>

      <textRect ID="dato9" visible="1" rect="110 200 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Tiene Futbol:]]></text>
      </textRect>
      <textRect ID="dato92" visible="1" rect="310 200 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo ($this->_futbolContratado) ? "SI":"NO"; ?>]]></text>
      </textRect>

      <textRect ID="dato3" visible="1" rect="110 230 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Tiene Adultos:]]></text>
      </textRect>
      <textRect ID="dato32" visible="1" rect="310 230 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo ($this->_adultosContratado) ? "SI":"NO"; ?>]]></text>
      </textRect>

      <textRect ID="dato5" visible="1" rect="110 290 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[MAC del STB:]]></text>
      </textRect>

      <textRect ID="dato52" visible="1" rect="310 290 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo $this->clientMAC;?>]]></text>
      </textRect>

      <textRect ID="dato6" visible="1" rect="110 320 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Código Activación: ]]></text>
      </textRect>

      <textRect ID="dato62" visible="1" rect="310 320 600 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<?php echo $this->accountID;?>]]></text>
      </textRect>

    </group>

    <define>

      <exitModule ID="exit" targetID="<?php echo $this->_moduleID; ?>" />

    </define>
  </scene>

</sdm>
