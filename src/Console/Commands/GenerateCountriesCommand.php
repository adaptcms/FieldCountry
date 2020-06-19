<?php

namespace Adaptcms\FieldCountry\Console\Commands;

use Illuminate\Console\Command;

use Storage;

class GenerateCountriesCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'field-country:generate';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Generate JSON file for list of countries.';

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    // get list of countries
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://restcountries.eu/rest/v2/all');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);

    $countries = json_decode($result);

    $data = [];
    foreach ($countries as $country) {
      $name = $country->name;

      $data[] = $name;
    }

    // format JSON data
    $contents = json_encode($data);

    // save JSON file
    Storage::disk('packages')->put('Adaptcms/FieldCountry/countries.json', $contents);
  }
}
