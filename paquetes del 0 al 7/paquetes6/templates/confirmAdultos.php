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
      <textRect ID="titulo1" visible="1" rect="130 90 400 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[Usted va a contratar ADULTOS]]></text>
      </textRect>
    </group>

    <group ID="imagCondPack" visible="1" pos="0 0">

        <image ID="pack_adult" visible="1" pos="320 170" ref="<?php echo $this->serverPath; ?>img/adultos_90x60.png" cache="1" />
        <textRect ID="titCondicAdult" visible="1" rect="130 260 300 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
            <text><![CDATA[Condiciones contratación:]]></text>
        </textRect>
        <textRect ID="condicAdult" visible="1" rect="130 290 600 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
            <text><![CDATA[* Permanencia mínima 3 meses - <?php echo $this->_arrPreciosPacks['adultos']; ?> mensuales.]]></text>
        </textRect>

    </group>

    <group ID="input" visible="1" pos="0 0">
        <textRect ID="titInputPrest" visible="1" rect="130 330 300 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
            <text><![CDATA[Ingrese ID prestación IPTV:]]></text>
        </textRect>

        <textEdit ID="inputPrest" visible="1" rect="270 360 100 35" text="" fontID="18" foreColor="0xFFFFFFFF" maxlen="10" password="0" border="5" focus="1" />
        <textEdit ID="confirmAdult" visible="0" rect="5 5 100 35" text="confirmAdult" fontID="18" foreColor="0xFFFFFFFF" maxlen="10" password="0" border="5" focus="0" />
        <textEdit ID="nroPrest" visible="0" rect="5 5 100 35" text="<?php echo $this->_nroPrest; ?>" fontID="18" foreColor="0xFFFFFFFF" maxlen="10" password="0" border="5" focus="0" />

    </group>

    <group ID="botones" visible="1" pos="0 0">

        <textButton ID="btnConfirma" visible="1" rect="420 360 110 35" text="Confirma" fontID="18" foreColor="0xFFFFFFFF">
					  <stateDef type="NORMAL" actionList="{tempAction}"/>
					  <stateDef type="FOCUSED" actionList="{tempAction}"/>
					  <stateDef type="SELECTED" actionList="{submit}" />
				</textButton>

			  <textButton ID="btnCancela" visible="1" rect="550 360 110 35" text="Cancela" fontID="18" foreColor="0xFFFFFFFF">
					  <stateDef type="NORMAL" actionList="{tempAction}"/>
					  <stateDef type="FOCUSED" actionList="{tempAction}"/>
					  <stateDef type="SELECTED" actionList="{exit}" />
				</textButton>

    </group>

  </scene>

  <define>
      <moduleSubmit ID="submit" />
      <exitModule ID="exit" targetID="<?php echo $this->_moduleID; ?>" />
      <updateModule ID="updateMod" targetID="<?php echo $this->_moduleID; ?>" refreshScreen="0"/>
<!--
      <moduleMsg ID="confirma" message="&amp;confirma=si&amp;selecciono=<?php echo $selecciono; ?>&amp;tieneHD=<?php echo $this->_tieneHD; ?>&amp;nroPrest=<?php echo $this->_nroPrest; ?>" />
-->
  </define>

</sdm>
