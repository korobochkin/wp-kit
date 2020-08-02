<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Translations;

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

    /**
     * Returns text domain.
     *
     * @return string Text domain.
     */
    public function getTextDomain()
    {
        return $this->textDomain;
    }

    /**
     * Sets text domain.
     *
     * @param string $textDomain Text domain.
     *
     * @return $this For chain calls.
     */
    public function setTextDomain($textDomain)
    {
        $this->textDomain = $textDomain;
        return $this;
    }

    /**
     * Returns path to files (*.mo) with translations.
     *
     * @return string Path to files.
     */
    public function getTranslationsPath()
    {
        return $this->translationsPath;
    }

    /**
     * Sets path to files (*.mo) with translations.
     *
     * @param string $translationsPath Path to files.
     *
     * @return $this For chain calls.
     */
    public function setTranslationsPath($translationsPath)
    {
        $this->translationsPath = $translationsPath;
        return $this;
    }
}
