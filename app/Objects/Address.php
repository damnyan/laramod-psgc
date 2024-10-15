<?php

namespace Modules\PSGC\Objects;

use Modules\PSGC\Enums\Country;
use Modules\PSGC\Models\Barangay;

class Address
{
    public ?string $regionCode = null;
    public ?string $regionName = null;
    public ?string $provinceCode = null;
    public ?string $provinceName = null;
    public ?string $municipalityCode = null;
    public ?string $municipalityName = null;
    public ?string $barangayCode = null;
    public ?string $barangayName = null;

    /**
     * Construct
     *
     * @param Country|null $barangay
     * @param Barangay|null $barangay
     * @param string|null $line_1
     * @param string|null $line_2
     * @param string|null $postalCode
     */
    public function __construct(
        public readonly Country|null $country = null,
        public readonly Barangay|null $barangay = null,
        public readonly string|null $line_1 = null,
        public readonly string|null $line_2 = null,
        public readonly string|null $postalCode = null,
    ) {
        $this->boot();
    }

    /**
     * Boot
     *
     * @return void
     */
    private function boot(): void
    {
        if ($this->barangay instanceof Barangay) {
            $barangay = $this->barangay;
            $this->regionCode = $barangay->region_code;
            $this->regionName = $barangay->region_name;
            $this->provinceCode = $barangay?->province_code;
            $this->provinceName = $barangay?->province_name;
            $this->municipalityCode = $barangay?->municipality_code;
            $this->municipalityName = $barangay?->municipality_name;
            $this->barangayCode = $barangay?->code;
            $this->barangayName = $barangay?->name;
        }
    }

    /**
     * Full address
     *
     * @return string|null
     */
    public function full(): string|null
    {
        $fullAddress = $this->line_1;

        if (!is_null($this->line_2)) {
            $fullAddress .= ', ' . $this->line_2;
        }

        $fullAddress .= ', ' . $this->barangay->full;

        if (!is_null($this->country)) {
            $fullAddress .= ' ' . $this->country->value;
        }

        if (!is_null($this->postalCode)) {
            $fullAddress .= ' ' . $this->postalCode;
        }

        return $fullAddress;
    }

    /**
     * To array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'full_address' => $this->full(),
            'country' => $this->country->value,
            'region_code' => $this->regionCode,
            'region_name' => $this->regionName,
            'province_code' => $this->provinceCode,
            'province_name' => $this->provinceName,
            'municipality_code' => $this->municipalityCode,
            'municipality_name' => $this->municipalityName,
            'barangay_code' => $this->barangayCode,
            'barangay_name' => $this->barangayName,
            'postal_code' => $this->postalCode,
            'line_1' => $this->line_1,
            'line_2' => $this->line_2,
        ];
    }
}
