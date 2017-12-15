<sdm>
    <setModuleOptions moduleID="<?php echo $this->_moduleID;?>" autoRedraw="1" retainFocus="0" flushCache="3"/>

    <scene ID="selecServ" visible="1" pos="0 0">

      <image ID="packs_bkg" visible="1" pos="35 70" ref="<?php echo $this->serverPath; ?>img/paquetes_bkg.png" cache="0" />

      <subscribeToEvent ID="navigation">
          <keyEvent type="KEY_DOWN" relayToServer="0" actionList="{exit}" />
      </subscribeToEvent>

      <group ID="titulos" visible="1" pos="0 0">
        <textRect ID="titulo1" visible="1" rect="60 200 600 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="CENTER" vertJust="CENTER">
          <text><![CDATA[Reiniciando dispositivo !!]]></text>
        </textRect>
      </group>

    </scene>
    <define>
        <exitModule ID="exit" targetID="<?php echo $this->_moduleID; ?>" />
        <updateModule ID="updateMod" targetID="<?php echo $this->_moduleID; ?>" refreshScreen="0" />
    </define>
</sdm>
