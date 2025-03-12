<?php

namespace App\Http\Controllers;

use App\Http\Requests\TextComparisonRequest;
use App\Models\TextComparison;
use App\Services\TextComparisonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TextComparisonController extends Controller
{
    protected $textComparisonService;

    public function __construct(TextComparisonService $textComparisonService)
    {
        $this->textComparisonService = $textComparisonService;
    }
    public function index(Request $request)
    {
        $perPage = 5;
        $textComparison = TextComparison::query()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        return view('pages.text-comparison', [
            'pageTitle' => 'Text Comparison',
        ], compact('textComparison'))
            ->with('i', ($request->input('page', 1) - 1) * $perPage);
    }

    public function compareTexts(TextComparisonRequest $request)
    {

        try {
            $result = $this->textComparisonService->calculateSimilarity($request->input1, $request->input2);
            TextComparison::create([
                'user_id' => Auth::user()->id,
                'input1' => $request->input1,
                'input2' => $request->input2,
                'percentage' => $result['percentage'],
                'match_count' => $result['match_count'],
                'matched_chars' => implode(",", $result['matched_chars']),
            ]);

            return response()->json(['param' => true, 'message' => 'Successfully']);
        } catch (\Exception $err) {
            return response()->json(['param' => false, 'message' => $err->getMessage()]);
        }
    }
}
