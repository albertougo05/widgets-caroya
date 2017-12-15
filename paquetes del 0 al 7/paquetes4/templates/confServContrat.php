<sdm>
    <setModuleOptions moduleID="<?php echo $this->_moduleID;?>" autoRedraw="1" retainFocus="1" flushCache="2"/>

    <scene ID="selecServ" visible="1" pos="0 0">

        <image ID="packs_bkg" visible="1" pos="40 50" ref="<?php echo $this->serverPath; ?>img/paquetes_bkg.png" cache="1" />

        <group ID="titulos" visible="1" pos="0 0">
            <textRect ID="titulo1" visible="1" rect="220 110 400 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
                <text><![CDATA[<< Contratación confirmada !! >>]]></text>
            </textRect>
        </group>

        <group ID="imagPack" visible="1" pos="0 0">

            <?php if($selecciono == 'fox') {?>
                <image ID="pack_fox" visible="1" pos="300 150" ref="<?php echo $this->serverPath; ?>img/fox_premium.png" cache="1" />
            <?php }?>

            <?php if($selecciono == 'futbol') {?>
                <image ID="pack_fut" visible="1" pos="300 150" ref="<?php echo $this->serverPath; ?>img/futbol_fox_tnt.jpg" cache="1" />
            <?php }?>

            <?php if($selecciono == 'adulto') {?>
                <image ID="pack_adulto" visible="1" pos="300 150" ref="<?php echo $this->serverPath; ?>img/adultos_90x60.png" cache="1" />
            <?php }?>
 
        </group>

        <group ID="botones" visible="1" pos="0 0">

            <textButton ID="btnContinuar" visible="1" rect="250 340 80 30" text="Continuar" fontID="18" foreColor="0xFFFFFFFF">
                    <stateDef type="NORMAL" actionList="{tempAction}"/>
                    <stateDef type="FOCUSED" actionList="{tempAction}"/>
                    <stateDef type="SELECTED" actionList="{continua}" />
            </textButton>

        </group>

        <subscribeToEvent ID="navigation">
        <keyEvent type="KEY_DOWN" relayToServer="0" actionList="{exit}" />
        <keyEvent type="KEY_LEFT" actionList="{temp}"/>
        <keyEvent type="KEY_RIGHT" actionList="{temp}"/>
        </subscribeToEvent>

    </scene>

    <define>
        <exitModule ID="exit" targetID="<?php echo $this->_moduleID; ?>" />
        <updateModule ID="updateMod" targetID="<?php echo $this->_moduleID; ?>" refreshScreen="0"/>

        <moduleMsg ID="continua" message="&amp;continua=si" />
    </define>

</sdm>
