<?php

namespace App\Http\Controllers;

use App\Http\Requests\BMIRequest;
use App\Models\BMICalculator;
use App\Services\BMIService;
use Illuminate\Http\Request;

class BMICalculatorController extends Controller
{
    protected $bmiService;
    public function __construct(BMIService $bmiService)
    {
        $this->bmiService = $bmiService;
    }
    //
    public function index()
    {
        $bmi = BMICalculator::query()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('pages.bmi-calculator', [
            'pageTitle' => 'BMI Calculator Ideal',
        ], compact('bmi'));
    }

    public function calculate(BMIRequest $request)
    {
        $name = $request->name;
        $gender = $request->gender;
        $weight = $request->weight;
        $height = $request->height / 100; // Konversi ke meter
        try {
            // Gunakan BMIService untuk perhitungan
            $bmi = $this->bmiService->calculateBMI($weight, $height);
            $category = $this->bmiService->getBMICategory($bmi);
            $ideal_weight = $this->bmiService->calculateIdealWeight($gender, $request->height);

            BMICalculator::create([
                'name' => $name,
                'gender' => $gender,
                'weight' => $weight,
                'height' => $request->height,
                'bmi' => $bmi,
                'category' => $category,
                'ideal_weight' => $ideal_weight
            ]);
            return response()->json(['param' => true, 'message' => 'Successfully']);
        } catch (\Exception $err) {
            return response()->json(['param' => false, 'message' => $err->getMessage()]);
        }
    }
}
