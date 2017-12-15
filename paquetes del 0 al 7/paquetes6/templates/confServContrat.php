<sdm>
    <setModuleOptions moduleID="<?php echo $this->_moduleID;?>" autoRedraw="1" retainFocus="1" flushCache="3"/>

    <scene ID="selecServ" visible="1" pos="0 0">

        <image ID="packs_bkg" visible="1" pos="50 85" ref="<?php echo $this->serverPath; ?>img/paquetes_bkg.png" cache="1" />

        <group ID="titulos" visible="1" pos="0 0">
            <textRect ID="titulo1" visible="1" rect="240 100 400 40" fontID="18" foreColor="0xFFF7FE2E" horzJust="LEFT" vertJust="CENTER">
                <text><![CDATA[Contratación confirmada !!]]></text>
            </textRect>
        </group>

        <group ID="imagPack" visible="1" pos="0 0">

            <?php if($selecciono == 'fox') {?>
                <image ID="pack_fox" visible="1" pos="310 180" ref="<?php echo $this->serverPath; ?>img/fox_premium.png" cache="1" />

                <?php if($this->_tieneHD) {?>
                    <textRect ID="titCondicFox" visible="1" rect="130 290 500 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
                        <text><![CDATA[Su grilla agrega canales 530 al 535 y 1530 al 1535]]></text>
                    </textRect>

                <?php } else {?>
                    <textRect ID="titCondicFox" visible="1" rect="200 290 500 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
                        <text><![CDATA[Su grilla agrega canales 530 al 535]]></text>
                    </textRect>

                <?php }?>

            <?php }?>

            <?php if($selecciono == 'futbol') {?>
                <image ID="pack_fut" visible="1" pos="260 180" ref="<?php echo $this->serverPath; ?>img/futbol_fox_tnt.jpg" cache="1" />

                <?php if($this->_tieneHD) {?>
                    <textRect ID="titCondicFox" visible="1" rect="130 290 500 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
                        <text><![CDATA[Su grilla agrega canales 111, 112, 1111 y 1112]]></text>
                    </textRect>

                <?php } else {?>
                    <textRect ID="titCondicFox" visible="1" rect="200 290 500 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
                        <text><![CDATA[Su grilla agrega canales 111 y 112]]></text>
                    </textRect>

                <?php }?>

            <?php }?>

            <?php if($selecciono == 'adulto') {?>
                <image ID="pack_adulto" visible="1" pos="320 180" ref="<?php echo $this->serverPath; ?>img/adultos_90x60.png" cache="1" />

                <textRect ID="titCondicFox" visible="1" rect="150 290 500 40" fontID="18" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
                        <text><![CDATA[Su grilla agrega canales 111, y 1112]]></text>
                    </textRect>

            <?php }?>
 
        </group>

        <group ID="botones" visible="1" pos="0 0">

            <textRect ID="titCondicFox" visible="1" rect="260 400 300 40" fontID="16" foreColor="0xFFFFFFFF" horzJust="LEFT" vertJust="CENTER">
                <text><![CDATA[ATENCION: Su dispositivo se va a reiniciar. ]]></text>
            </textRect>

            <textButton ID="btnContinuar" visible="1" rect="310 360 110 35" text="Continuar" fontID="18" foreColor="0xFFFFFFFF">
                <stateDef type="NORMAL" actionList="{tempAction}"/>
                <stateDef type="FOCUSED" actionList="{tempAction}"/>
                <stateDef type="SELECTED" actionList="{exit}" />
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
<!--
        <moduleMsg ID="continua" message="&amp;continua=si" />
-->
    </define>

</sdm>
