<?php

namespace App\Services;

class TextComparisonService
{
    /**
     * Menghitung persentase karakter dari input pertama yang ada di input kedua
     *
     * @param string $input1
     * @param string $input2
     * @return array ['percentage' => float, 'match_count' => int, 'matched_chars' => array]
     */
    public function calculateSimilarity(string $input1, string $input2): array
    {
        // Ubah ke huruf besar agar case-insensitive
        $input1 = strtoupper($input1);
        $input2 = strtoupper($input2);

        // Ambil karakter unik dari input pertama
        // jika ingin include duplikasi gunakan array_unique

        $uniqueChars = str_split($input1);

        // Hitung karakter yang ada di input kedua
        $countMatch = 0;
        $matchedChars = [];
        foreach ($uniqueChars as $char) {
            if (strpos($input2, $char) !== false) {
                $countMatch++;
                $matchedChars[] = $char;
            }
        }

        // Hitung persentase kemunculan karakter unik dari input pertama di input kedua
        $percentage = (count($uniqueChars) > 0) ? ($countMatch / count($uniqueChars)) * 100 : 0;

        return [
            'percentage' => round($percentage, 2),
            'match_count' => $countMatch,
            'matched_chars' => $matchedChars
        ];
    }
}
