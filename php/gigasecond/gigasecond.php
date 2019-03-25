<?php

function from(\DateTime $dob): \DateTime {
    return (clone $dob)->modify('+' . 1e9 . ' seconds');
}
