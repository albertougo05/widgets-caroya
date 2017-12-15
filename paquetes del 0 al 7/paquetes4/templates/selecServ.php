<sdm>
  <setModuleOptions moduleID="<?php echo $this->_moduleID;?>" autoRedraw="1" retainFocus="1" flushCache="2"/>

  <scene ID="selecServ" visible="1" pos="0 0">

    <subscribeToEvent ID="navigation">
      <keyEvent type="KEY_DOWN" relayToServer="0" actionList="{exit}" />
      <keyEvent type="KEY_LEFT" actionList="{temp}"/>
      <keyEvent type="KEY_RIGHT" actionList="{temp}"/>
    </subscribeToEvent>

    <image ID="packs_bkg" visible="1" pos="40 50" ref="<?php echo $this->serverPath; ?>img/paquetes_bkg.png" cache="1" />

    <group ID="titulos" visible="1" pos="0 0">
      <textRect ID="titulo1" visible="1" rect="220 110 400 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<< Usted va a contratar: >>]]></text>
      </textRect>
    </group>

    <group ID="imagCondPack" visible="1" pos="0 0">

        <?php if($selecciono == 'fox') {?>
            <image ID="pack_fox" visible="1" pos="300 150" ref="<?php echo $this->serverPath; ?>img/fox_premium.png" cache="1" />
            <textRect ID="titCondicFox" visible="1" rect="200 250 300 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
                <text><![CDATA[Condiciones de contratación: ]]></text>
            </textRect>
            <textRect ID="condicFox" visible="1" rect="230 290 400 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
                <text><![CDATA[* Permanencia mínima 3 meses - <?php echo $this->_arrPreciosPacks['fox']; ?> mensuales.]]></text>
            </textRect>
        <?php }?>

        <?php if($selecciono == 'futbol') {?>
            <image ID="pack_fut" visible="1" pos="300 150" ref="<?php echo $this->serverPath; ?>img/futbol_fox_tnt.jpg" cache="1" />
            <textRect ID="titCondicFut" visible="1" rect="200 250 300 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
                <text><![CDATA[Condiciones de contratación: ]]></text>
            </textRect>
            <textRect ID="condicFut" visible="1" rect="230 290 400 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
                <text><![CDATA[* Permanencia mínima 1 año - <?php echo $this->_arrPreciosPacks['futbol']; ?> mensuales.]]></text>
            </textRect>
        <?php }?>

        <?php if($selecciono == 'adulto') {?>
          <image ID="pack_adult" visible="1" pos="300 150" ref="<?php echo $this->serverPath; ?>img/adultos_90x60.png" cache="1" />
          <textRect ID="titCondicAdult" visible="1" rect="200 250 300 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
                <text><![CDATA[Condiciones de contratación: ]]></text>
            </textRect>
            <textRect ID="condicAdult" visible="1" rect="230 290 400 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
                <text><![CDATA[* Permanencia mínima 3 meses - <?php echo $this->_arrPreciosPacks['adultos']; ?> mensuales.]]></text>
            </textRect>
        <?php }?>
 
    </group>

    <group ID="botones" visible="1" pos="0 0">

        <textButton ID="btnConfirma" visible="1" rect="250 340 80 30" text="Confirma" fontID="18" foreColor="0xFFFFFFFF">
					  <stateDef type="NORMAL" actionList="{tempAction}"/>
					  <stateDef type="FOCUSED" actionList="{tempAction}"/>
					  <stateDef type="SELECTED" actionList="{confirma}" />
				</textButton>

			  <textButton ID="btnCancela" visible="1" rect="450 340 80 30" text="Cancela" fontID="18" foreColor="0xFFFFFFFF">
					  <stateDef type="NORMAL" actionList="{tempAction}"/>
					  <stateDef type="FOCUSED" actionList="{tempAction}"/>
					  <stateDef type="SELECTED" actionList="{cancela}" />
				</textButton>

    </group>

  </scene>

  <define>

    <exitModule ID="exit" targetID="<?php echo $this->_moduleID; ?>" />
    <updateModule ID="updateMod" targetID="<?php echo $this->_moduleID; ?>" refreshScreen="0"/>

    <moduleMsg ID="confirma" message="&amp;confirma=si&amp;selecciono=<?php echo $selecciono; ?>&amp;tieneHD=<?php echo $this->_tieneHD; ?>&amp;nroPrest=<?php echo $this->_nroPrest; ?>" />
    <moduleMsg ID="cancela" message="&amp;confirma=no" />

  </define>

</sdm>
