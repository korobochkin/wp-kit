<?php
namespace Korobochkin\WPKit\Services\Translations;

/**
 * Interface TranslationsInterface
 */
interface TranslationsInterface
{
    /**
     * Load translations.
     *
     * @throws \Exception If translations not loaded.
     *
     * @return $this For chain calls.
     */
    public function loadTranslations();
}