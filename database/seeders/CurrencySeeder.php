<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder includes currencies for:
     * - Pakistan (PKR) - PRIMARY/BASE CURRENCY
     * - United States (USD)
     * - Middle East (AED, SAR, KWD, OMR, QAR, BHD)
     * - Europe (EUR, GBP)
     * - Optional markets (INR for India)
     * 
     * All exchange rates are relative to PKR (1 PKR = X foreign currency)
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('currencies')->insert([
            // Pakistani Rupee (Primary Currency - Base)
            [
                'name' => 'Pakistani Rupee',
                'symbol' => '₨',
                'code' => 'PKR',
                'exchange_rate' => 1.000000, // Base currency
                'is_company_currency' => 1, // Set as default company currency
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // US Dollar
            [
                'name' => 'US Dollar',
                'symbol' => '$',
                'code' => 'USD',
                'exchange_rate' => 0.003590, // Approximate rate (1 PKR = 0.00359 USD)
                'is_company_currency' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Euro (Europe - Spain, France, Italy, etc.)
            [
                'name' => 'Euro',
                'symbol' => '€',
                'code' => 'EUR',
                'exchange_rate' => 0.003300, // Approximate rate (1 PKR = 0.0033 EUR)
                'is_company_currency' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // UAE Dirham (Middle East - UAE)
            [
                'name' => 'UAE Dirham',
                'symbol' => 'د.إ',
                'code' => 'AED',
                'exchange_rate' => 0.013200, // Approximate rate (1 PKR = 0.0132 AED)
                'is_company_currency' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Saudi Riyal (Middle East - Saudi Arabia)
            [
                'name' => 'Saudi Riyal',
                'symbol' => 'ر.س',
                'code' => 'SAR',
                'exchange_rate' => 0.013500, // Approximate rate (1 PKR = 0.0135 SAR)
                'is_company_currency' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // British Pound (UK)
            [
                'name' => 'British Pound',
                'symbol' => '£',
                'code' => 'GBP',
                'exchange_rate' => 0.002840, // Approximate rate (1 PKR = 0.00284 GBP)
                'is_company_currency' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Kuwaiti Dinar (Middle East - Kuwait)
            [
                'name' => 'Kuwaiti Dinar',
                'symbol' => 'د.ك',
                'code' => 'KWD',
                'exchange_rate' => 0.001100, // Approximate rate (1 PKR = 0.0011 KWD)
                'is_company_currency' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Omani Rial (Middle East - Oman)
            [
                'name' => 'Omani Rial',
                'symbol' => 'ر.ع.',
                'code' => 'OMR',
                'exchange_rate' => 0.001380, // Approximate rate (1 PKR = 0.00138 OMR)
                'is_company_currency' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Qatari Riyal (Middle East - Qatar)
            [
                'name' => 'Qatari Riyal',
                'symbol' => 'ر.ق',
                'code' => 'QAR',
                'exchange_rate' => 0.013100, // Approximate rate (1 PKR = 0.0131 QAR)
                'is_company_currency' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Bahraini Dinar (Middle East - Bahrain)
            [
                'name' => 'Bahraini Dinar',
                'symbol' => 'د.ب',
                'code' => 'BHD',
                'exchange_rate' => 0.001350, // Approximate rate (1 PKR = 0.00135 BHD)
                'is_company_currency' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            // Indian Rupee (Optional - South Asia)
            [
                'name' => 'Indian Rupee',
                'symbol' => '₹',
                'code' => 'INR',
                'exchange_rate' => 0.298800, // Approximate rate (1 PKR = 0.2988 INR)
                'is_company_currency' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // Add more currencies as needed
        ]);
    }
}
