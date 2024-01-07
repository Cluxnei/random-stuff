<?php

namespace App\Jobs;

use App\Services\BufferService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Psr\SimpleCache\InvalidArgumentException;

class PopulateBufferJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // silence is golden
    }

    /**
     * Execute the job.
     * @throws InvalidArgumentException
     */
    public function handle(BufferService $bufferService): void
    {
        $url = 'https://api.open-meteo.com/v1/metno?latitude=59.91&longitude=10.75&hourly=temperature_2m,relative_humidity_2m,dew_point_2m,precipitation,rain,snowfall,pressure_msl,surface_pressure,wind_speed_10m,wind_direction_10m,wind_gusts_10m,shortwave_radiation,direct_radiation,diffuse_radiation,direct_normal_irradiance,terrestrial_radiation&past_days=3';
        $response = Http::get($url);
        $weatherData = $response->json();
        $weatherData = Arr::only($weatherData['hourly'], [
            'temperature_2m',
            'relative_humidity_2m',
            'dew_point_2m',
            'precipitation',
            'rain',
            'snowfall',
            'pressure_msl',
            'surface_pressure',
            'wind_speed_10m',
            'wind_direction_10m',
            'wind_gusts_10m',
            'shortwave_radiation',
            'direct_radiation',
            'diffuse_radiation',
            'direct_normal_irradiance',
            'terrestrial_radiation',
        ]);
        $weatherData = collect($weatherData)
            ->values()
            ->flatten()
            ->filter()
            ->values()
            ->shuffle()
            ->toArray();

        $buffer = [];
        $weatherDataLen = count($weatherData);
        for ($i = 0; $i < $weatherDataLen; $i++) {
            $cantidate = $this->applyRandomTransformations($weatherData[$i], $weatherData, $weatherDataLen);
            $buffer[] = $this->toFloat($cantidate);
        }
        $bufferService->pushToBuffer($buffer);
    }

    private function maybe(): bool
    {
        return mt_rand(1, 10) % 2 === 0;
    }

    private function toFloat(int|float $value): float
    {
        if (is_int($value)) {
            $multiplier = mt_rand() / mt_getrandmax();
            $multiplier *= $this->maybe() ? 1 : -1;
            return $value + $multiplier;
        }
        return $value;
    }

    private function applyRandomTransformations(float|int $value, array $data, int $dataLength): float
    {
        $randomIndex = static fn() => mt_rand(0, $dataLength - 1);
        $randomValue = function () use ($randomIndex, $data) {
            if ($this->maybe()) {
                return $data[$randomIndex()];
            }
            return (mt_rand() / mt_getrandmax()) * mt_rand() * ($this->maybe() ? -1 : 1);
        };
        $transformationsCount = 10;
        if ($this->maybe()) {
            return $value;
        }
        for ($i = 0; $i < $transformationsCount; $i++) {
            for($j = 0; $j < 2; $j++) {
                if ($this->maybe()) {
                    $value *= $randomValue();
                }
            }
            for($j = 0; $j < 2; $j++) {
                if ($this->maybe()) {
                    $value /= $randomValue();
                }
            }
            for($j = 0; $j < 2; $j++) {
                if ($this->maybe()) {
                    $value -= $randomValue();
                }
            }
            for($j = 0; $j < 2; $j++) {
                if ($this->maybe()) {
                    $value += $randomValue();
                }
            }
        }
        return $value;
    }

}
