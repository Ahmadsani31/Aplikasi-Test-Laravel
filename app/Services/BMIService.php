<?php

namespace App\Services;

class BMIService
{
    public function calculateBMI(float $weight, float $height): float
    {
        return $weight / pow($height, 2); // BMI = Berat (kg) / (Tinggi (m)²)
    }

    public function getBMICategory(float $bmi): string
    {
        if ($bmi < 18.5) {
            return 'Kurus';
        } elseif ($bmi >= 18.5 && $bmi < 24.9) {
            return 'Normal';
        } elseif ($bmi >= 25 && $bmi < 29.9) {
            return 'Gemuk';
        } else {
            return 'Obesitas';
        }
    }

    public function calculateIdealWeight(string $gender, float $height): float
    {
        if ($gender === 'male') {
            return ($height - 100) - (($height - 100) * 0.10);
        } else {
            return ($height - 100) - (($height - 100) * 0.15);
        }
    }
}
