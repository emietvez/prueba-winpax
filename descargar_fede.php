<?php include("db_connect.php");
$sql = "SELECT * FROM prueba_winpax WHERE status = 1";

$resultado = $conn->query($sql);
$archivo = fopen("emails.txt", "w");

if ($resultado->num_rows > 0) {
    // echo "Registros encontrados";
    while ($fila = $resultado->fetch_assoc()) {
        foreach ($fila as $key => $value) {

            // primero validaría si key es json_1 para evitar una validacion que obviamente va a fallar
            // ya que se validaría un json contra FILTER_VALIDATE_EMAIL.
            // Además, haria un IF y un else, para evitar que se corran las dos validaciones.

            if ($key == 'json_1') {
                $result = $fila[$key];
                $json = json_decode($result);
                foreach ($json as $clave => $valor) {
                    if (filter_var($valor, FILTER_VALIDATE_EMAIL)) {
                        fwrite($archivo, $valor . "\r\n");
                    }
                }
            } else if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                fwrite($archivo, $value . "\r\n");
            }
        }
    }
    fclose($archivo);
    echo "Emails validos exportados correctamente";
} else {
    echo "No hay registros.";
}
