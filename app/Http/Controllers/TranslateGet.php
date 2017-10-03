<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslateRequest as Request;
use ChrisKonnertz\DeepLy\DeepLy;

class TranslateGet extends Controller
{
	/**
     *
     * @return Response
     */
	public function __invoke(Request $request)
	{
		$deepLy = new DeepLy();

		$from = $request->input('from') !== 'auto' ? $request->input('from') : $deepLy->detectLanguage('Hello world!');

		$to = $request->input('to');

		$text = $request->input('text');

		$translation = $deepLy->translate($text, $to, $from);

		return [
			'data' => compact('translation', 'from', 'to', 'text')
		];
	}
}