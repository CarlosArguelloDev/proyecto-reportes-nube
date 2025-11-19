<?php

return [
    // Clases base de Bootstrap para botones
    'button_base' => 'btn d-inline-flex align-items-center gap-1',
    'button_colors' => [
        'primary'   => 'btn-primary',
        'secondary' => 'btn-secondary',
        'success'   => 'btn-success',
        'danger'    => 'btn-danger',
        'warning'   => 'btn-warning',
        'info'      => 'btn-info',
        'light'     => 'btn-light',
        'dark'      => 'btn-dark',
        'link'      => 'btn-link',
    ],

    // Catálogo de ESTADOS
    'estados' => [
        1 => ['label' => 'Estado: Sin Atender',       'color' => 'info',    'icon' => 'ti ti-clock'],
        2 => ['label' => 'Estado: En revisión', 'color' => 'warning', 'icon' => 'ti ti-eye'],
        3 => ['label' => 'Estado: Resuelto',    'color' => 'success', 'icon' => 'ti ti-circle-check'],
    ],

    // Catálogo de PRIORIDADES
    'prioridades' => [
        1 => ['label' => 'Prioridad: Baja',    'color' => 'secondary', 'icon' => 'ti ti-arrow-down'],
        2 => ['label' => 'Prioridad: Media',   'color' => 'primary',      'icon' => 'ti ti-arrows-down-up'],
        3 => ['label' => 'Prioridad: Alta',    'color' => 'danger',    'icon' => 'ti ti-arrow-up'],
        4 => ['label' => 'Prioridad: Crítica', 'color' => 'danger',    'icon' => 'ti ti-alert-triangle'],
    ],
];
