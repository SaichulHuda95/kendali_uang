<?php
function format_tgl($datetime)
{
    // Konversi string ke objek DateTime
    $dt = new DateTime($datetime);
    // Format jadi dd/mm/yyyy HH:ii
    return $dt->format('d/m/Y H:i');
}
