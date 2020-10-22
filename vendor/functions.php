<?php

//  функция которая возвращает расширение
function getExtension( $filename ) {
    return end( explode( '.', $filename ) );
    }
