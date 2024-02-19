<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class Select_items{
/* Funcion que permite armar un campo tipo select (combo) dinamicamente llamandola desde cualquier vista

PARAMETROS
- opciones: listado de opciones con las que se quiere armar el select (Ej: categoria1, categoria2, etc)
- opcionSeleccionada: En caso de que se este editando una vista, esta variable trae el valor guardado en
base de datos
- nombreSelect: nombre que se quiere poner al campo que se esta creando
- tipoOperacion: bandera que indica si es un campo de un formulario vacio (alta) o es un formulario que
tiene datos y se esta editando su contenido.
- requerido trae un string de la siguiente forma = required="required" que indica que es un select requerido

Las opciones que se envien, previamente deben ser definidas con un alias:
para la clave primaria el alias debe ser "id"
para el campo que contiene las opciones el alias debe ser "nombre"

Ejemplo de llamada a la Funcion desde una vista con un form vacio:

<?=SelectDinamico($categorias,'','selectCategoria','');?>

Ejemplo de llamada a la Funcion desde una vista con un form con datos:

<?=SelectDinamico($categorias,$datosUsuario->idCategoria,'selectCategoria','EdicionDatos');?> */
function sin_buscador($opciones, $opcionSeleccionada, $nombreSelect, $tipoOperacion, $camposAuxiliares = ''){?>
<select name="<?= $nombreSelect; ?>" id="<?= $nombreSelect; ?>" class="form-control" <?if ($camposAuxiliares != '') echo $camposAuxiliares;?> ><!--input multiselect filtro-select-->
    <?if ($tipoOperacion==''):?>
        <option value="">Seleccione una opción</option>
        <?foreach ($opciones as $row):?>
            <option value="<?= strval($row->ID); ?>">
                <?= $row->NOMBRE ?>
            </option>
        <?endforeach;?>
    <?else:?>
        <option value=""></option>
        <?
        $x=999;

        foreach ($opciones as $row):?>
        <option value="<?= strval($row->ID) ?>" <?if (strval($opcionSeleccionada) == strval($row->ID)) echo "selected"; ?> >
            <?= $row->NOMBRE;
              ?>

        </option>
        <?endforeach;

        ?>


    <?endif;?>
</select>
<?}

function sin_buscador_priv($opciones, $opcionSeleccionada, $nombreSelect, $tipoOperacion, $camposAuxiliares = ''){?>
    <select name="<?= $nombreSelect; ?>" id="<?= $nombreSelect; ?>" class="form-control" <?if ($camposAuxiliares != '') echo $camposAuxiliares;?> ><!--input multiselect filtro-select-->
        <?if ($tipoOperacion==''):?>
            <option value="">Seleccione una opción</option>
            
            <?
            foreach ($opciones as $row):?>
                <option value="<?= strval($row->idRol); ?>">
                    <?= $row->nombre_tipo ?>
                </option>
            <?endforeach;?>
        <?else:?>
            <option value=""></option>
            <?
            $x=999;
            foreach ($opciones as $row):?>
            <option value="<?= strval($row->idRol) ?>" <?if (strval($opcionSeleccionada) == strval($row->idRol)) echo "selected"; ?> >
                <?= $row->nombre_tipo;
                  ?>
    
            </option>
            <?endforeach;
    
            ?>
    
    
        <?endif;?>
    </select>
    <?}

function sin_buscadormultiple($opciones, $opcionSeleccionada, $nombreSelect, $tipoOperacion, $camposAuxiliares = ''){?>
<select name="<?= $nombreSelect; ?>" id="<?= $nombreSelect; ?>" class="js-example-basic-multiple"  <?if ($camposAuxiliares != '') echo $camposAuxiliares;?> name="states[]" multiple="multiple" style="width: 75%"><!--input multiselect filtro-select-->
    <?if ($tipoOperacion==''):?>
        <option value="">Seleccione una opción</option>
        <?foreach ($opciones as $row):?>
            <option value="<?= strval($row->ID); ?>">
                <?= $row->NOMBRE ?>
            </option>
        <?endforeach;?>
    <?else:?>
        <option value=""></option>
        <?
        $x=999;

        foreach ($opciones as $row):?>
        <option value="<?= strval($row->ID) ?>" <?if (strval($opcionSeleccionada) == strval($row->ID)) echo "selected"; ?> >
            <?= $row->NOMBRE;
              ?>

        </option>
        <?endforeach;

        ?>


    <?endif;?>
</select>
<?}

function sin_buscador2($opciones, $opcionSeleccionada, $nombreSelect, $tipoOperacion, $camposAuxiliares = ''){?>
<select name="<?= $nombreSelect; ?>" id="<?= $nombreSelect; ?>" class="form-control" <?if ($camposAuxiliares != '') echo $camposAuxiliares;?> ><!--input multiselect filtro-select-->
    <?if ($tipoOperacion==''):?>
        <option value="">Seleccione una opción</option>
        <?foreach ($opciones as $row):?>
            <option value="<?= strval($row->IdCliente); ?>">
                <?= $row->NOMBRE ?>
            </option>
        <?endforeach;?>
    <?else:?>
        <option value=""></option>
        <?
        foreach ($opciones as $row): ?>
        <option value="<?= strval($row->IdCliente) ?>" <?if (strval($opcionSeleccionada) == strval($row->IdCliente)) echo "selected"; ?> >
            <?= $row->NOMBRE; ?>
        </option>
        <?endforeach;?>
    <?endif;?>
</select>
<?}

function sin_buscador5($opciones, $opcionSeleccionada, $nombreSelect, $tipoOperacion, $camposAuxiliares = ''){?>
    <select name="<?= $nombreSelect; ?>" id="<?= $nombreSelect; ?>" class="form-control" <?if ($camposAuxiliares != '') echo $camposAuxiliares;?> ><!--input multiselect filtro-select-->
        <?if ($tipoOperacion==''):?>
            <option value="">Seleccione una opción</option>
            <?foreach ($opciones as $row):?>
                <option value="<?= strval($row->IdCliente); ?>">
                    <?= $row->NOMBRE ?>
                </option>
            <?endforeach;?>
        <?else:?>
            <option value=""></option>
            <?
            foreach ($opciones as $row): ?>
            <option value="<?= strval($row->IdCliente) ?>" <?if (strval($opcionSeleccionada) == strval($row->IdCliente)) echo "selected"; ?> >
                <?= $row->NOMBRE; ?>
            </option>
            <?endforeach;?>
        <?endif;?>
    </select>
    <?}

function sin_buscador_roles($opciones, $opcionSeleccionada, $nombreSelect, $tipoOperacion, $camposAuxiliares = ''){?>
    <select name="<?= $nombreSelect; ?>" id="<?= $nombreSelect; ?>" class="form-control" <?if ($camposAuxiliares != '') echo $camposAuxiliares;?> ><!--input multiselect filtro-select-->
        <?if ($tipoOperacion==''):?>
            <option value="">Seleccione una opción</option>
            <?foreach ($opciones as $row):?>
                <option value="<?= strval($row->ID); ?>">
                    <?= $row->NOMBRE ?>
                </option>
            <?endforeach;?>
        <?else:?>
            <option value=""></option>
            <?
            foreach ($opciones as $row): ?>
            <option value="<?= strval($row->ID) ?>" <?if (strval($opcionSeleccionada) == strval($row->ID)) echo "selected"; ?> >
                <?= $row->NOMBRE; ?>
            </option>
            <?endforeach;?>
        <?endif;?>
    </select>
    <?}

function sin_buscador3($opciones, $opcionSeleccionada, $nombreSelect, $tipoOperacion, $camposAuxiliares = ''){?>
    <select name="<?= $nombreSelect; ?>" id="<?= $nombreSelect; ?>" class="form-control" <?if ($camposAuxiliares != '') echo $camposAuxiliares;?> ><!--input multiselect filtro-select-->
        <?if ($tipoOperacion==''):?>
            <option value="">Seleccione una opción</option>
            <?foreach ($opciones as $row):?>
                <option value="<?= strval($row->ID_GRUPOS); ?>">
                    <?= $row->NOMBRE ?>
                </option>
            <?endforeach;?>
        <?else:?>
            <option value=""></option>
            <?
            foreach ($opciones as $row):?>
            <option value="<?= strval($row->ID_GRUPOS) ?>" <?if (strval($opcionSeleccionada) == strval($row->ID_GRUPOS)) echo "selected"; ?> >
                <?= $row->NOMBRE; ?>

            </option>
            <?endforeach;?>
        <?endif;?>
    </select>
    <?}

function sin_buscador4($opciones, $opcionSeleccionada, $nombreSelect, $tipoOperacion, $camposAuxiliares = ''){?>
    <select name="<?= $nombreSelect; ?>" id="<?= $nombreSelect; ?>" class="form-control" <?if ($camposAuxiliares != '') echo $camposAuxiliares;?> ><!--input multiselect filtro-select-->
        <?if ($tipoOperacion==''):?>
            <option value="">Seleccione una opción</option>
            <?foreach ($opciones as $row):?>
                <option value="<?= strval($row->ID); ?>">
                    <?= $row->NOMBRE ?>
                </option>
            <?endforeach;?>
        <?else:?>
            <option value=""></option>
            <?
            $x=999;
            foreach ($opciones as $row):?>
            <option value="<?= strval($row->ID) ?>" <?if (strval($opcionSeleccionada) == strval($row->ID)) echo "selected"; ?> >
                <?= $row->NOMBRE;
                  ?>

            </option>
            <?endforeach;

            ?>
            <option value="<?= strval($x) ?>" <?if (strval($opcionSeleccionada) == strval($x)) echo "selected"; ?> >
                TODOS
            </option>

        <?endif;?>
    </select>
    <?}


function con_buscador_multiselect($opciones, $opcionSeleccionada, $nombreSelect, $tipoOperacion, $camposAuxiliares = ''){?>
<select name="<?= $nombreSelect; ?>[]" id="<?= $nombreSelect; ?>" class="form-control" <?if ($camposAuxiliares != '') echo $camposAuxiliares;?> multiple="multiple" style="white-space: nowrap;">
    <?if ($tipoOperacion==''):?>
        <?foreach ($opciones as $row):?>
            <option value="<?= $row->id ?>" data-toggle="tooltip" title "asd">
                <?= $row->nombre ?>
            </option>
        <?endforeach;?>
    <?else:?>
        <option value=""></option>
        <?foreach ($opciones as $row):?>
        <option value="<?= $row->id ?>" <?if ($opcionSeleccionada == $row->id) echo "selected"; ?> >
            <?= $row->nombre ?>
        </option>
        <?endforeach;?>
    <?endif;?>
</select>
<?}

function con_buscador($opciones, $opcionSeleccionada, $nombreSelect, $tipoOperacion, $camposAuxiliares = ''){?>
<select name="<?= $nombreSelect; ?>" id="<?= $nombreSelect; ?>" class="form-control form-group select_buscador" <?if ($camposAuxiliares != '') echo $camposAuxiliares;?>  style="white-space: nowrap;">
    <?if ($tipoOperacion==''):?>
        <option value="" selected>Seleccione una Opción</option>
        <?foreach ($opciones as $row):?>
            <option value="<?= $row->id ?>" data-toggle="tooltip" title "<?= $row->nombre ?>">
                <?= $row->nombre ?>
            </option>
        <?endforeach;?>
    <?else:?>
        <option value=""></option>
        <?foreach ($opciones as $row):?>
        <option value="<?= $row->id ?>" <?if ($opcionSeleccionada == $row->id) echo "selected"; ?> >
            <?= $row->nombre ?>
        </option>
        <?endforeach;?>
    <?endif;?>
</select>
<?}


}
?>
