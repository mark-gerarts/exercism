<?php

class RnaTranscriber
{
    private const COMPLEMENT_MAPPING = [
        'G' => 'C',
        'C' => 'G',
        'T' => 'A',
        'A' => 'U'
    ];

    public function transcribe(string $strand): string
    {
        $nucleotides = str_split($strand);
        $transcribed = array_map([$this, 'getComplement'], $nucleotides);

        return implode('', $transcribed);
    }

    private function getComplement(string $nucleotide): string
    {
        if (!isset(self::COMPLEMENT_MAPPING[$nucleotide])) {
            throw new \InvalidArgumentException(sprintf(
                'Encountered invalid nucleotide: %s',
                $nucleotide
            ));
        }

        return self::COMPLEMENT_MAPPING[$nucleotide];
    }
}

function toRna(string $strand): string {
    $transcriber = new \RnaTranscriber();
    return $transcriber->transcribe($strand);
}
