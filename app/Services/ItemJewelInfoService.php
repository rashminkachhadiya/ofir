<?php

namespace App\Services;

use App\Models\Item;
use App\Models\ItemDiamondInfo;
use App\Models\ItemGemInfo;
use Illuminate\Validation\Validator;

class ItemJewelInfoService
{
    public static function validationRules(): array
    {
        return [
            'diamond_info' => 'nullable|array',
            'diamond_info.*.shape' => 'nullable|string|max:255',
            'diamond_info.*.shape_custom' => 'nullable|string|max:255',
            'diamond_info.*.carat' => 'nullable|string|max:255',
            'diamond_info.*.pcs' => 'nullable|string|max:255',
            'diamond_info.*.colour' => 'nullable|string|max:255',
            'diamond_info.*.cleaerty' => 'nullable|string|max:255',
            'gem_info' => 'nullable|array',
            'gem_info.*.gem' => 'nullable|string|max:255',
            'gem_info.*.shape' => 'nullable|string|max:255',
            'gem_info.*.shape_custom' => 'nullable|string|max:255',
            'gem_info.*.carat' => 'nullable|string|max:255',
            'gem_info.*.colour' => 'nullable|string|max:255',
            'gem_info.*.cleaerty' => 'nullable|string|max:255',
            'gem_info.*.pcs' => 'nullable|string|max:255',
        ];
    }

    public static function configureValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $data = $validator->getData();

            foreach ($data['diamond_info'] ?? [] as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                if (($row['shape'] ?? '') === 'Other' && trim((string) ($row['shape_custom'] ?? '')) === '') {
                    $validator->errors()->add(
                        "diamond_info.{$index}.shape_custom",
                        'Please enter a shape name when Other is selected.'
                    );
                }
            }

            foreach ($data['gem_info'] ?? [] as $index => $row) {
                if (!is_array($row)) {
                    continue;
                }

                if (($row['shape'] ?? '') === 'Other' && trim((string) ($row['shape_custom'] ?? '')) === '') {
                    $validator->errors()->add(
                        "gem_info.{$index}.shape_custom",
                        'Please enter a shape name when Other is selected.'
                    );
                }
            }
        });
    }

    public static function diamondRowsForForm(Item $item): array
    {
        $rows = old('diamond_info');

        if ($rows !== null) {
            return self::ensureAtLeastOneRow($rows);
        }

        $item->loadMissing('diamondInfos');

        if ($item->diamondInfos->isNotEmpty()) {
            return $item->diamondInfos->map(function (ItemDiamondInfo $info) {
                return [
                    'shape' => $info->shape,
                    'carat' => $info->carat,
                    'pcs' => $info->pcs,
                    'colour' => $info->colour,
                    'cleaerty' => $info->cleaerty,
                ];
            })->values()->all();
        }

        if (self::legacyDiamondHasData($item)) {
            return [[
                'shape' => $item->diamond_shape,
                'carat' => $item->diamond_carat,
                'pcs' => $item->diamond_pcs,
                'colour' => $item->diamond_colour,
                'cleaerty' => $item->diamond_cleaerty,
            ]];
        }

        return [[]];
    }

    public static function gemRowsForForm(Item $item): array
    {
        $rows = old('gem_info');

        if ($rows !== null) {
            return self::ensureAtLeastOneRow($rows);
        }

        $item->loadMissing('gemInfos');

        if ($item->gemInfos->isNotEmpty()) {
            return $item->gemInfos->map(function (ItemGemInfo $info) {
                return [
                    'gem' => $info->gem,
                    'shape' => $info->shape,
                    'carat' => $info->carat,
                    'colour' => $info->colour,
                    'cleaerty' => $info->cleaerty,
                    'pcs' => $info->pcs,
                ];
            })->values()->all();
        }

        if (self::legacyGemHasData($item)) {
            return [[
                'gem' => $item->gem,
                'shape' => $item->shape,
                'carat' => $item->carat,
                'colour' => $item->colour,
                'cleaerty' => $item->cleaerty,
                'pcs' => $item->pcs,
            ]];
        }

        return [[]];
    }

    public static function displayDiamondRows(Item $item): array
    {
        $item->loadMissing('diamondInfos');

        if ($item->diamondInfos->isNotEmpty()) {
            return self::filterRows(
                $item->diamondInfos->map(function (ItemDiamondInfo $info) {
                    return [
                        'shape' => $info->shape,
                        'carat' => $info->carat,
                        'pcs' => $info->pcs,
                        'colour' => $info->colour,
                        'cleaerty' => $info->cleaerty,
                    ];
                })->values()->all(),
                ['shape', 'carat', 'pcs', 'colour', 'cleaerty']
            );
        }

        if (self::legacyDiamondHasData($item)) {
            return [[
                'shape' => $item->diamond_shape,
                'carat' => $item->diamond_carat,
                'pcs' => $item->diamond_pcs,
                'colour' => $item->diamond_colour,
                'cleaerty' => $item->diamond_cleaerty,
            ]];
        }

        return [];
    }

    public static function displayGemRows(Item $item): array
    {
        $item->loadMissing('gemInfos');

        if ($item->gemInfos->isNotEmpty()) {
            return self::filterRows(
                $item->gemInfos->map(function (ItemGemInfo $info) {
                    return [
                        'gem' => $info->gem,
                        'shape' => $info->shape,
                        'carat' => $info->carat,
                        'colour' => $info->colour,
                        'cleaerty' => $info->cleaerty,
                        'pcs' => $info->pcs,
                    ];
                })->values()->all(),
                ['gem', 'shape', 'carat', 'colour', 'cleaerty', 'pcs']
            );
        }

        if (self::legacyGemHasData($item)) {
            return [[
                'gem' => $item->gem,
                'shape' => $item->shape,
                'carat' => $item->carat,
                'colour' => $item->colour,
                'cleaerty' => $item->cleaerty,
                'pcs' => $item->pcs,
            ]];
        }

        return [];
    }

    public static function firstGemRowForCart(Item $item): array
    {
        $rows = self::displayGemRows($item);

        return $rows[0] ?? [];
    }

    public static function syncDiamondInfos(Item $item, ?array $rows): void
    {
        $item->diamondInfos()->delete();

        $sortOrder = 0;
        foreach (self::filterRows($rows, ['shape', 'carat', 'pcs', 'colour', 'cleaerty']) as $row) {
            $item->diamondInfos()->create([
                'shape' => self::resolveShape($row['shape'] ?? null, $row['shape_custom'] ?? null),
                'carat' => $row['carat'] ?? null,
                'pcs' => $row['pcs'] ?? null,
                'colour' => $row['colour'] ?? null,
                'cleaerty' => $row['cleaerty'] ?? null,
                'sort_order' => $sortOrder++,
            ]);
        }

        self::syncLegacyDiamondColumns($item);
    }

    public static function syncGemInfos(Item $item, ?array $rows): void
    {
        $item->gemInfos()->delete();

        $sortOrder = 0;
        foreach (self::filterRows($rows, ['gem', 'shape', 'carat', 'colour', 'cleaerty', 'pcs']) as $row) {
            $item->gemInfos()->create([
                'gem' => $row['gem'] ?? null,
                'shape' => self::resolveShape($row['shape'] ?? null, $row['shape_custom'] ?? null),
                'carat' => $row['carat'] ?? null,
                'colour' => $row['colour'] ?? null,
                'cleaerty' => $row['cleaerty'] ?? null,
                'pcs' => $row['pcs'] ?? null,
                'sort_order' => $sortOrder++,
            ]);
        }

        self::syncLegacyGemColumns($item);
    }

    public static function copyJewelInfos(Item $source, Item $target): void
    {
        $source->loadMissing(['diamondInfos', 'gemInfos']);

        if ($source->diamondInfos->isNotEmpty()) {
            foreach ($source->diamondInfos as $info) {
                $target->diamondInfos()->create($info->only([
                    'shape', 'carat', 'pcs', 'colour', 'cleaerty', 'sort_order',
                ]));
            }
        } elseif (self::legacyDiamondHasData($source)) {
            $target->diamondInfos()->create([
                'shape' => $source->diamond_shape,
                'carat' => $source->diamond_carat,
                'pcs' => $source->diamond_pcs,
                'colour' => $source->diamond_colour,
                'cleaerty' => $source->diamond_cleaerty,
                'sort_order' => 0,
            ]);
        }

        if ($source->gemInfos->isNotEmpty()) {
            foreach ($source->gemInfos as $info) {
                $target->gemInfos()->create($info->only([
                    'gem', 'shape', 'carat', 'colour', 'cleaerty', 'pcs', 'sort_order',
                ]));
            }
        } elseif (self::legacyGemHasData($source)) {
            $target->gemInfos()->create([
                'gem' => $source->gem,
                'shape' => $source->shape,
                'carat' => $source->carat,
                'colour' => $source->colour,
                'cleaerty' => $source->cleaerty,
                'pcs' => $source->pcs,
                'sort_order' => 0,
            ]);
        }

        self::syncLegacyDiamondColumns($target);
        self::syncLegacyGemColumns($target);
    }

    private static function resolveShape(?string $shape, ?string $shapeCustom): ?string
    {
        if ($shape === 'Other') {
            $custom = trim((string) $shapeCustom);

            return $custom !== '' ? $custom : null;
        }

        return $shape ?: null;
    }

    private static function filterRows(?array $rows, array $fields): array
    {
        if (empty($rows)) {
            return [];
        }

        $filtered = [];

        foreach ($rows as $row) {
            if (!is_array($row) || self::rowIsEmpty($row, $fields)) {
                continue;
            }

            $filtered[] = $row;
        }

        return $filtered;
    }

    private static function rowIsEmpty(array $row, array $fields): bool
    {
        foreach ($fields as $field) {
            if (!empty($row[$field])) {
                return false;
            }
        }

        return true;
    }

    private static function ensureAtLeastOneRow(array $rows): array
    {
        return empty($rows) ? [[]] : array_values($rows);
    }

    private static function legacyDiamondHasData(Item $item): bool
    {
        return !empty($item->diamond_shape)
            || !empty($item->diamond_carat)
            || !empty($item->diamond_pcs)
            || !empty($item->diamond_colour)
            || !empty($item->diamond_cleaerty);
    }

    private static function legacyGemHasData(Item $item): bool
    {
        return !empty($item->gem)
            || !empty($item->shape)
            || !empty($item->carat)
            || !empty($item->colour)
            || !empty($item->cleaerty)
            || !empty($item->pcs);
    }

    private static function syncLegacyDiamondColumns(Item $item): void
    {
        $first = $item->diamondInfos()->orderBy('sort_order')->first();

        $item->diamond_shape = $first->shape ?? null;
        $item->diamond_carat = $first->carat ?? null;
        $item->diamond_pcs = $first->pcs ?? null;
        $item->diamond_colour = $first->colour ?? null;
        $item->diamond_cleaerty = $first->cleaerty ?? null;
    }

    private static function syncLegacyGemColumns(Item $item): void
    {
        $first = $item->gemInfos()->orderBy('sort_order')->first();

        $item->gem = $first->gem ?? null;
        $item->shape = $first->shape ?? null;
        $item->carat = $first->carat ?? null;
        $item->colour = $first->colour ?? null;
        $item->cleaerty = $first->cleaerty ?? null;
        $item->pcs = $first->pcs ?? null;
    }
}
