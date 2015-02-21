<?php 
    if($ajax===false){
        echo '<form id="finsertusuario" method="post" action="phpinsert.php">';
    }
?>
    <table>
        <tr>
            <td>login</td>
            <td>
                <input type="text" name="login" value="" />
            </td>
        </tr>
        <tr>
            <td>clave</td>
            <td>
                <input type="text" name="clave" value="" />
            </td>
        </tr>
        <tr>
            <td>nombre</td>
            <td>
                <input type="text" name="nombre" value="" />
            </td>
        </tr>
        <tr>
            <td>apellidos</td>
            <td>
                <input type="text" name="apellidos" value="" />
            </td>
        </tr>
        <tr>
            <td>email</td>
            <td>
                <input type="text" name="email" value="" />
            </td>
        </tr>
        <tr>
            <td>rol</td>
            <td>
                <?php echo Util::getRol("", "rol", "rol", false); ?>
            </td>
        </tr>
        <tr>
            <td>is root</td>
            <td>
                <?php echo Util::getSiNo("", "isroot", "isroot", false); ?>
            </td>
        </tr>
        <tr>
            <td>is activo</td>
            <td>
                <?php echo Util::getSiNo("", "isactivo", "isactivo", false); ?>
            </td>
        </tr>
        <tr>
            <td>fecha alta</td>
            <td>
                <input type="text" name="fechaalta" value="" disabled="" />
            </td>
        </tr>
        <tr>
            <td>fecha login</td>
            <td>
                <input type="text" name="fechalogin" value="" disabled=""/>
            </td>
        </tr>
        <?php 
            if($ajax===false){
        ?>
        <tr>
            <td colspan="2">
                <input id="btinsert" type="submit" value="inserción" class="btn btn-success" />
            </td>
        </tr>
        <?php 
            }
        ?>        
    </table>
<?php 
    if($ajax===false){
        echo '</form>';
    }
?>

