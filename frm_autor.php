<?
if(1==2){
?>
<link href="estilo.css" rel="stylesheet" type="text/css" />
<?
}

$tipo_trn="Add";
if($pk){
  $qinfo=runsql("select * from autores where id = '$pk'");
  if(registros($qinfo)>0){
    $info=registro($qinfo);
    $tipo_trn="Update";
  }
}

?><form action="mnt_autor.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validar();" autocomplete="off">
  <table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="4%" background="../images/bg_titulo_frm.gif"><div align="left"><img src="../images/ic_frm.gif" width="35" height="32" /></div></td>
            <td width="96%" background="../images/bg_titulo_frm.gif" class="titulo_frm">Administraci&oacute;n de autores</td>
          </tr>
      </table></td>
    </tr>
    <?
    if($msg){
    ?>
    <tr>
      <td height="22" colspan="3" bgcolor="#FFFFCC" class="lbl">&nbsp;&nbsp;<img src="../images/ic_info.gif" width="14" height="13" /> <span class="lblroja"><?=$msg;?></span></td>
    </tr>
    <?
    }
    ?>
    <tr>
      <td width="160" class="lbl"><div align="left">Nombre:</div></td>
      <td width="699"><div align="left">
        <input name="txtnombre" type="text" class="textbox" id="txtnombre" value="<?=$info[nombre];?>" size="50" maxlength="100" />
      </div></td>
      <td width="131"><div align="center">
        <?if($tipo_trn=="Update"){?>
        <a href="index1.php?op=<?=$op;?>" class="link_texto">Agregar nuevo</a>
        <?}?>
      </div></td>
    </tr>
    <tr>
      <td class="lbl">Correo electr&oacute;nico:</td>
      <td colspan="2"><input name="txtemail" type="text" class="textbox" id="txtemail" value="<?=$info[email];?>" size="50" maxlength="100" /></td>
    </tr>
    <tr>
      <td class="lbl">Secci&oacute;n:</td>
      <td colspan="2">
      <select name="txtseccion" class="textbox" id="txtseccion">
      <option value="SV" selected>Seleccione una...</option>
      <?
      $qseccion=runsql("select * from secciones where activa = 1");
      while($iseccion=registro($qseccion)){
        $sel="";
        if($iseccion[id] == $info[seccion]){$sel="selected";}
        echo "<option value='{$iseccion[id]}' $sel>{$iseccion[seccion]}</option>";
      }
      ?>
      </select>      </td>
    </tr>
    <tr>
      <td class="lbl">Fotograf&iacute;a:</td>
      <td colspan="2"><input name="txtfoto" type="file" class="textbox" id="txtfoto" size="50" /></td>
    </tr>
    <tr>
      <td class="lbl"><div align="left">Activo:</div></td>
      <td colspan="2"><div align="left">
        <input name="txtactivo" type="checkbox" id="txtactivo" value="1" <?if($info[activo]==1){echo "checked";}?>/>
      </div></td>
    </tr>
    <tr>
      <td><input name="tipo_trn" type="hidden" id="tipo_trn" value="<?=$tipo_trn;?>" />
      <input name="op" type="hidden" id="op" value="<?=$op;?>" />
      <input name="pk" type="hidden" id="pk" value="<?=$pk;?>" /></td>
      <td colspan="2"><input name="button" type="submit" class="boton1" id="button" value="Guardar" /></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>
<br />
<table width="980" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#D1DDE7">
  <tr>
    <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="4%" background="../images/bg_titulo_frm.gif"><div align="left"><img src="../images/ic_recordatorio.png" width="35" height="32" /></div></td>
        <td width="96%" background="../images/bg_titulo_frm.gif" class="titulo_frm">Autores   existentes</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="385" class="lbl"><div align="center"><strong>Nombre del autor</strong></div></td>
    <td width="131" class="lbl"><div align="center">Foto</div></td>
    <td width="218" class="lbl"><div align="center">Correo electr&oacute;nico</div></td>
    <td width="250" class="lbl"><div align="center">Secci&oacute;n</div></td>
    <td width="76" class="lbl"><div align="center">Activo</div></td>
    <td width="109" class="lbl"><div align="center"><strong>Acciones</strong></div></td>
  </tr>
  <?
  $cnt_lista=0;
  $qlista=runsql("select autores.*, secciones.seccion as dseccion
                  from autores inner join secciones ON secciones.id = autores.seccion
                  order by nombre, seccion");
  while($ilista=registro($qlista)){
  $cnt_lista++;
  ?>
  <tr bgcolor="<?=color_fila($cnt_lista);?>">
    <td height="22" class="texto"><div align="center"><?=$ilista[nombre];?></div></td>
    <td class="texto"><div align="center">
    <?
    echo rd_imagen("../contenido/autores/",$ilista[foto],124,"border='1'");
    ?>
    </div></td>
    <td height="22" class="texto"><div align="center"><?=$ilista[email];?></div></td>
    <td class="texto"><div align="center"><?=$ilista[dseccion];?></div></td>
    <td height="22" class="texto"><div align="center"><img src="../images/ic_<?if($ilista[activo]==0){echo "no";}?>ok.gif" width="16" height="16" /></div></td>
    <td><div align="center"><a href="index1.php?<?="op=$op&pk={$ilista[id]}";?>"><img src="../images/ic_editar.gif" alt="Modificar" width="15" height="15" border="0" /></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../images/ic_delete.gif" alt="Eliminar" width="15" height="15" /></div></td>
  </tr>
  <?
  }
  ?>
</table>
<?
if($foco){
echo "<script language=\"javascript\">";
echo "$('{$foco}').focus();";
echo "</script>";
}
?>
