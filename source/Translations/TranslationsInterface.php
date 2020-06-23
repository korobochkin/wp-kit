<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Translations;

/**
 * Interface TranslationsInterface
 */
interface TranslationsInterface
{
    /**
     * Load translations.
     *
     * @return $this For chain calls.
     */
    public function loadTranslations();
}
