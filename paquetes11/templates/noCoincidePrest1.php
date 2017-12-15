<sdm>
    <setModuleOptions moduleID="<?php echo $this->_moduleID;?>" autoRedraw="1" retainFocus="0" flushCache="3"/>

    <scene ID="selecServ" visible="1" pos="0 0">

      <subscribeToEvent ID="navigation">
          <keyEvent type="KEY_DOWN" relayToServer="0" actionList="{exit}" />
      </subscribeToEvent>

      <image ID="packs_bkg" visible="1" pos="35 70" ref="<?php echo $this->serverPath; ?>img/paquetes_bkg.png" cache="0" />

    </scene>
    <define>
        <exitModule ID="exit" targetID="<?php echo $this->_moduleID; ?>" />
        <updateModule ID="updateMod" targetID="<?php echo $this->_moduleID; ?>" refreshScreen="0" />
    </define>
</sdm>
