<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsuranesIndexRequest as Request;
use GuzzleHttp\Client as GuzzleHttp;

class InsurancesIndex extends Controller
{
	/**
     * Show 3 random insurances by request.
     *
     * @return Response
     */
	public function __invoke(Request $request)
	{
		$endpoint = config('insurance.endpoint');

		$request = app(GuzzleHttp::class)->request('POST', config('insurance.endpoint'), $this->getData($request));

		$response = json_decode($request->getBody(), 1);

		$items = collect(array_get($response, 'data'));

		$items = $items->filter(function ($item) {
			return $item['anzeige'] == true;
		});

		return [
			'items' => $items->take(3)
		];
	}

	/**
     * @return array
     */
	private function getData($request)
	{
		$data = [
			'Vertrag_Kunde_geburtsdatum' => $request->input('birthdate'),
			'Vertrag_personenkreis_form' => $request->input('range'),
			'Vertrag_tarifgruppe_form' => 0,
			'Vertrag_vn_vorversicherung_form' => $request->input('has_previous'),
			'Vertrag_schadensfrei_form' => $request->input('had_damage')
		];

		$products = config('insurance.products');

		shuffle($products);

		$products = array_slice($products, 0, 10);

		return [
			'headers' => [
				'Content-Type' => 'application/json',
				'Authorization' => config('insurance.bearer')
			],
			'json' => [
				'data' => $data,
				'products' => $products
			]
		];
	}
}