<?php

function toRna(string $strand): string {
    return strtr($strand, 'GCTA', 'CGAU');
}
