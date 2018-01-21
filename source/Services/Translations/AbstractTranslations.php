<?php
namespace Korobochkin\WPKit\Services\Translations;

/**
 * Class Translations
 */
abstract class AbstractTranslations implements TranslationsInterface
{
    /**
     * @var string Your text domain.
     */
    protected $textDomain;

    /**
     * @var string Path to folder with translations.
     */
    protected $translationsPath;

    /**
     * Translations constructor.
     *
     * @param string $textDomain
     * @param string $translationsPath
     */
    public function __construct($textDomain, $translationsPath)
    {
        $this->textDomain       = $textDomain;
        $this->translationsPath = $translationsPath;
    }
}
