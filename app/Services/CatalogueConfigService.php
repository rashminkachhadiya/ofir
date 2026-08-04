<?php

namespace App\Services;

class CatalogueConfigService
{
    public static function catalogues(): array
    {
        return config('params.catalogue', []);
    }

    public static function defaultStore(): array
    {
        $store = [];

        foreach (array_keys(self::catalogues()) as $key) {
            $store[(string) $key] = '0';
        }

        return $store;
    }

    public static function decodeStore(?string $json): array
    {
        $store = json_decode($json, true);

        return is_array($store) ? $store : [];
    }

    public static function mergeStore(?string $json): array
    {
        return array_merge(self::defaultStore(), self::decodeStore($json));
    }

    public static function hasAccess(?string $json, $catalogueId): bool
    {
        $store = self::decodeStore($json);
        $key = (string) $catalogueId;

        return isset($store[$key]) && $store[$key] == 1;
    }

    public static function catalogueName($catalogueId): ?string
    {
        $catalogues = self::catalogues();
        $key = (string) $catalogueId;

        return $catalogues[$key] ?? $catalogues[$catalogueId] ?? null;
    }

    public static function subCatalogues($catalogueId): array
    {
        $subCatalogues = config('params.' . $catalogueId);

        return is_array($subCatalogues) ? $subCatalogues : [];
    }

    public static function subCatalogueName($catalogueId, $subCatalogueId): ?string
    {
        $subCatalogues = self::subCatalogues($catalogueId);
        $key = (string) $subCatalogueId;

        return $subCatalogues[$key] ?? $subCatalogues[$subCatalogueId] ?? null;
    }

    public static function isValidCatalogue($catalogueId): bool
    {
        return self::catalogueName($catalogueId) !== null;
    }

    public static function isValidSubCatalogue($catalogueId, $subCatalogueId): bool
    {
        return self::subCatalogueName($catalogueId, $subCatalogueId) !== null;
    }

    public static function allSubCatalogueName($subCatalogueId): ?string
    {
        $allSubCat = config('params.allSubCat', []);
        $key = (string) $subCatalogueId;

        return $allSubCat[$key] ?? $allSubCat[$subCatalogueId] ?? null;
    }
}
