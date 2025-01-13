<?php

namespace App\Console\Commands;

use App\Imports\MenuImport;
use App\Models\Setting;
use App\Services\BookingService;
use Illuminate\Console\Command;


class ImportMenuCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connect to menu API and import the data';

    /**
     * Execute the console command.
     */
    public function handle(BookingService $bookingService, Setting $setting, MenuImport $menuImport)
    {
        $url = env('API_URL', 'https://staging.yhangry.com/booking/test/set-menus');

        if($setting->apiIsNotImportedYet())
        {
            // Call API and Import Page 1
            $response = $bookingService->callApi($url, 0, null);
            $currentPage = $response['meta']['current_page'];
            $lastPage = $response['meta']['last_page'];
            $this->attempImport($menuImport, $response, $currentPage);


            // Call subsequence pages and Import them introducing sleeping duration
            while($currentPage < $lastPage)
            {
                $url = $response['links']['next'];//next
                $response = $bookingService->callApi($url, 1);

                $currentPage = $response['meta']['current_page'];
                $this->attempImport($menuImport, $response, $currentPage);

                if($currentPage === $lastPage)
                {
                    echo "API data has been imported successfully.\n";
                    $this->setTrueImportedFlag($setting, true);
                }
            }
        }
        else{
            echo "API has already been imported.\n";
        }
    }


    private function attempImport($menuImport, $response, $currentPage)
    {
        try {
            $menuImport->import($response['data']);
            echo "Page $currentPage is imported successfully.\n";
        }
        catch (\Exception $e) {
            echo "There was an error while trying to import on page $currentPage.\n";
        }
    }


    private function setTrueImportedFlag(Setting $setting, bool $flag): Setting
    {
        return $setting->create([
            "api_imported" => $flag,
        ]);
    }
}
