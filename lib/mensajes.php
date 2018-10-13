<?php

function imprimirMensaje($message) {
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

    if (!empty($message)) {
        $messageType = $message[0];
        $messageContent = $message[1];
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
    
