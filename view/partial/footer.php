<div class="footer">
    <?php
    $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    echo $dias[date('w')] . ", " . date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y') . ' - ' . date('h:i:s A');
    ?>
</div>

