<?php

namespace App\Http\Controllers;

use App\Services\Exoclick\ExoClickService;
use Illuminate\Http\Request;

class ExoClickController extends Controller
{

    /**
     * @var ExoClickService
     */
    protected $exoClickService;

    /**
     * ExoClickController constructor.
     * @param ExoClickService $exoClickService
     */
    public function __construct(ExoClickService $exoClickService)
    {
        $this->exoClickService = $exoClickService;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $campaigns = $this->exoClickService->getCampaigns();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['msg' => $exception->getMessage()]);
        }
        return view('campaign.index', compact('campaigns'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function createCampaignShow()
    {
        $countries = $this->exoClickService->getCountries();
        $categories = $this->exoClickService->getCategories();
        $advertiserAdTypes = $this->exoClickService->getAdvertiserAdTypes();
        $dailyLimitTypes = $this->exoClickService->getDailyLimitTypes();
        return view('campaign.create', compact('countries', 'categories', 'advertiserAdTypes', 'dailyLimitTypes'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function createCampaign(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'country' => ['required'],
            'category' => ['required'],
            'advertiser_ad_type' => ['required'],
            'total_impressions' => ['nullable', 'numeric', 'min:0'],
            'max_daily_budget' => ['nullable', 'numeric', 'min:0'],
            'daily_limit_type' => ['nullable', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);
        $advertiserAdType = json_decode($validatedData['advertiser_ad_type'], true);
        $mediaStorageTemplate = $advertiserAdType['media_storage_templates'][0];
        $pricingModels = $advertiserAdType['pricing_models_by_media_storage_templates'][$mediaStorageTemplate][0];

        $data = [
            "name" => $validatedData['name'],
            "advertiser_ad_type" => $advertiserAdType['id'],
            "media_storage_template" => $mediaStorageTemplate,
            "countries" => [
                "type" => "targeted",
                "elements" => [
                    [
                        "country" => $validatedData['country'],
                        "regions" => [0]
                    ]
                ]
            ],
            "total_impressions" => $validatedData['total_impressions'],
            "daily_limit_type" => $validatedData['daily_limit_type'],
            "max_daily_budget" => $validatedData['max_daily_budget'],
            "categories" => [
                "type" => "targeted",
                "elements" => $validatedData['category']
            ],
            "pricing" => [
                "model" => $pricingModels['id'],
                "price" => $validatedData['price']
            ],
        ];

        try {
            $this->exoClickService->createCampaign($data);
            $campaigns = $this->exoClickService->getCampaigns();
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors(['msg' => $exception->getMessage()]);
        }
        return view('campaign.index', compact('campaigns'));
    }

}
