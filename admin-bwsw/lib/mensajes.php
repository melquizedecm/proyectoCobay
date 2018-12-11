<?php
/*
 * FUNCION IMPRIMIR MENSAJE:
 * 
 * recibe en GET:
 *     message =  "Mensaje a mostrar"
 *     tipo    = 
 *                 001 - Sucess -  Exito en la transaccion
 *                 002 - Info -    Información Adicional
 *                 003 - warning - Advertencia
 *                 004 - Danger  - Peligro o Error en la transaccion.
 */

function imprimirMensaje($message, $valor) {

    if (!empty($valor)) {
        $messageType = $message;
        $messageContent = "";
        //plantel
        ($valor == "1") ? $messageContent = "Error con el plantel del excel" : '';
        //periodo
        ($valor == "2") ? $messageContent = "Error con el periodo del excel" : '';
        //plan
        ($valor == "3") ? $messageContent = "Error con el plan del excel" : '';
        //semestre
        //($valor == "4") ? $messageContent = "Error con el grupo del excel" : '';
        //matricula profe
        ($valor == "5") ? $messageContent = "Error con la matricula maestro del excel" : '';
        //grupo
        ($valor == "6") ? $messageContent = "Error con el grupo del excel" : '';
        //matricula asignatura
        ($valor == "7") ? $messageContent = "Error con la clave de la asignatura del excel" : '';
        //nombre asignatura
        ($valor == "8") ? $messageContent = "Error con el nombre de la asignatura del excel" : '';
        //matricula alumno
        ($valor == "9") ? $messageContent = "Error con la matricula del alumno del excel" : '';
        //nombre alumno
        ($valor == "10") ? $messageContent = "Error con el nombre del alumno del excel" : '';
        //periodo activo o inactivo
        ($valor == "11") ? $messageContent = "Error el periodo no es activo" : '';

        if ($messageType == "001") {
            $messageClass = "alert alert-success";
        } elseif ($messageType == "002") {
            $messageClass = "alert alert-info";
        } elseif ($messageType == "003") {
            $messageClass = "alert alert-warning";
        } elseif ($messageType == "004") {
            $messageClass = "alert alert-danger";
        }
        //echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";
        ?>

                <div class="<?php echo $messageClass; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Nota:</strong> <?php echo $messageContent; ?>
                </div>

        <?php
    }
}

/////////////FINALIZA LA IMPRESIÓN DEL MENSAJE /////////////////
    

