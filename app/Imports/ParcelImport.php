<?php

namespace App\Imports;

use App\Enums\ParcelStatus;
use App\Enums\DeliveryType;
use App\Enums\DeliveryTime;
use App\Enums\Status;
use App\Models\Backend\DeliveryCharge;
use App\Models\Backend\Merchant;
use App\Models\Backend\MerchantDeliveryCharge;
use App\Models\Backend\Packaging;
use App\Models\Backend\Parcel;
use App\Models\MerchantShops;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;

class ParcelImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use Importable;

    public function model(array $row)
    {
        /** ---------- Merchant Load ---------- **/
        $merchant = isset($row['merchant_id']) && $row['merchant_id']
            ? Merchant::find($row['merchant_id'])
            : Merchant::where('user_id', Auth::id())->first();

        if (!$merchant) {
            return null;
        }

        /** ---------- Merchant or Admin Logic ---------- **/
        if (Auth::user()->merchant) {

            $merchantShop = MerchantShops::where([
                'merchant_id' => $merchant->id,
                'default_shop' => Status::ACTIVE
            ])->first();

            $category_id     = 1;
            $delivery_type_id = 2;
            $liquid_fragile  = null;
            $packaging_id    = null;

            $shop_id        = $merchantShop->id ?? null;
            $pickup_phone   = $merchantShop->contact_no ?? null;
            $pickup_address = $merchantShop->address ?? null;
            $pickup_lat     = $merchantShop->merchant_lat ?? null;
            $pickup_long    = $merchantShop->merchant_long ?? null;

        } else {

            $category_id     = $row['category_id'];
            $delivery_type_id = $row['delivery_type_id'];
            $liquid_fragile  = $row['liquid_fragile'] ?? null;
            $packaging_id    = $row['packaging_id'] ?? null;
            $shop_id         = $row['shop_id'];

            $pickup_phone    = $row['pickup_phone'];
            $pickup_address  = $row['pickup_address'];
            $pickup_lat      = $row['pickup_lat'];
            $pickup_long     = $row['pickup_long'];
        }

        /** ---------- Delivery Charges ---------- **/
        $deliveryChargeAmount = $this->deliveryCharge(
            $merchant->id, $category_id, $row['weight'], $delivery_type_id
        );

        $codData = $this->codCharge($merchant, $row['cash_collection'], $delivery_type_id);
        $codAmount         = $codData['codAmount'];
        $merchantCodCharge = $codData['merchantCodCharge'];

        /** ---------- Packaging + Fragile ---------- **/
        $packagingAmount = $packaging_id
            ? (Packaging::find($packaging_id)->price ?? 0)
            : 0;

        $liquidFragileAmount = $liquid_fragile
            ? SettingHelper('fragile_liquid_charge')
            : 0;

        /** ---------- VAT + Total ---------- **/
        $vat = $merchant->vat ?? 0;

        $totalParcelAmount = (
            $deliveryChargeAmount +
            $codAmount +
            $packagingAmount +
            $liquidFragileAmount
        );

        $vatAmount = $this->percentage($totalParcelAmount, $vat);

        $currentPayable = ($row['cash_collection'] - $totalParcelAmount) - $vatAmount;

        /** ---------- Pickup + Delivery Dates ---------- **/
        $deliveryTime = $this->deliveryTimeCalc($delivery_type_id);

        /** ---------- Final Insert Array ---------- **/
        return Parcel::create([
            'merchant_id'        => $merchant->id,
            'first_hub_id'       => $merchant->user->hub_id,
            'hub_id'             => $merchant->user->hub_id,
            'category_id'        => $category_id,
            'weight'             => $row['weight'],
            'invoice_no'         => $row['invoice_no'],
            'cash_collection'    => $row['cash_collection'],
            'selling_price'      => $row['selling_price'],
            'merchant_shop_id'   => $shop_id,
            'pickup_phone'       => $pickup_phone,
            'pickup_address'     => $pickup_address,
            'pickup_lat'         => $pickup_lat,
            'pickup_long'        => $pickup_long,
            'customer_name'      => $row['customer_name'],
            'customer_phone'     => $row['customer_phone'],
            'customer_address'   => $row['customer_address'],
            'customer_lat'       => $row['customer_lat'],
            'customer_long'      => $row['customer_long'],
            'delivery_type_id'   => $delivery_type_id,
            'pickup_date'        => $deliveryTime['pickup'],
            'delivery_date'      => $deliveryTime['delivery'],
            'vat'                => $vat,
            'vat_amount'         => $vatAmount,
            'delivery_charge'    => $deliveryChargeAmount,
            'cod_charge'         => $merchantCodCharge,
            'cod_amount'         => $codAmount,
            'total_delivery_amount' => $totalParcelAmount,
            'current_payable'    => $currentPayable,
            'tracking_id'        => $this->RandomTrackingID(),
            'note'               => $row['note'] ?? null,
            'packaging_id'       => $packaging_id,
            'packaging_amount'   => $packagingAmount,
            'liquid_fragile_amount' => $liquidFragileAmount,
            'status'             => ParcelStatus::PENDING,
        ]);
    }

    /** ---------- Validation Rules ---------- **/
    public function rules(): array
    {
        $forAdmin = !Auth::user()->merchant;

        return [
            'shop_id'           => $forAdmin ? ['required', 'numeric'] : ['numeric'],
            'cash_collection'   => ['required', 'numeric'],
            'category_id'       => $forAdmin ? ['required', 'numeric'] : ['numeric'],
            'delivery_type_id'  => $forAdmin ? ['required', 'numeric'] : ['numeric'],
            'customer_name'     => ['required', 'string', 'max:191'],
            'customer_address'  => ['required', 'string', 'max:191'],
        ];
    }

    /** ---------- Helpers ---------- **/
    private function deliveryTimeCalc($delivery_type_id)
    {
        $hour = date('H');

        switch ($delivery_type_id) {
            case DeliveryType::SAMEDAY:
                return [
                    'pickup' => date('Y-m-d'),
                    'delivery' => date('Y-m-d')
                ];
            case DeliveryType::NEXTDAY:
                return [
                    'pickup' => date('Y-m-d'),
                    'delivery' => date('Y-m-d', strtotime('+1 day'))
                ];
            case DeliveryType::SUBCITY:
                return [
                    'pickup' => date('Y-m-d'),
                    'delivery' => date('Y-m-d', strtotime('+' . DeliveryTime::SUBCITY . ' day'))
                ];
            case DeliveryType::OUTSIDECITY:
                return [
                    'pickup' => date('Y-m-d'),
                    'delivery' => date('Y-m-d', strtotime('+' . DeliveryTime::OUTSIDECITY . ' day'))
                ];
            default:
                return [
                    'pickup' => date('Y-m-d'),
                    'delivery' => date('Y-m-d')
                ];
        }
    }

    public function RandomTrackingID()
    {
        return Str::upper(settings()->par_track_prefix) . random_int(11111111, 99999999);
    }

    private function deliveryCharge($merchant_id, $category_id, $weight, $delivery_type_id)
    {
        $charges = MerchantDeliveryCharge::where([
            'merchant_id' => $merchant_id,
            'category_id' => $category_id,
            'weight' => $weight
        ])->first();

        if (!$charges) {
            $charges = DeliveryCharge::where(['category_id' => $category_id])->first();
        }

        if (!$charges) return 0;

        return match ($delivery_type_id) {
            1 => $charges->same_day,
            2 => $charges->next_day,
            3 => $charges->sub_city,
            4 => $charges->outside_city,
            default => 0,
        };
    }

    private function codCharge($merchant, $cash_collection, $delivery_type_id)
    {
        $map = [
            1 => 'inside_city',
            2 => 'inside_city',
            3 => 'sub_city',
            4 => 'outside_city'
        ];

        if (!isset($map[$delivery_type_id])) {
            return ['merchantCodCharge' => 0, 'codAmount' => 0];
        }

        $rate = $merchant->cod_charges[$map[$delivery_type_id]] ?? 0;

        return [
            'merchantCodCharge' => $rate,
            'codAmount' => $this->percentage($cash_collection, $rate)
        ];
    }

    private function percentage($amount, $percent)
    {
        return ($amount * $percent) / 100;
    }
}
