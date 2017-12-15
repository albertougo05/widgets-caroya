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

      <textRect ID="titulo1" visible="1" rect="200 110 400 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
        <text><![CDATA[<< Usted va a contratar: >>]]></text>
      </textRect>

      <?php if($selecciono == 'fox') {?>
          <image ID="pack_fox" visible="1" pos="300 170" ref="<?php echo $this->serverPath; ?>img/fox_premium.png" cache="1" />
      <?php }?>

      <?php if($selecciono == 'futbol') {?>
          <image ID="pack_fox" visible="1" pos="300 170" ref="<?php echo $this->serverPath; ?>img/futbol_fox_tnt.jpg" cache="1" />
      <?php }?>

      <?php if($selecciono == 'adulto') {?>
         <image ID="pack_fox" visible="1" pos="300 170" ref="<?php echo $this->serverPath; ?>img/adultos_90x60.png" cache="1" />
      <?php }?>

    </group>

    <define>

      <exitModule ID="exit" targetID="<?php echo $this->_moduleID; ?>" />

    </define>

  </scene>

</sdm>
