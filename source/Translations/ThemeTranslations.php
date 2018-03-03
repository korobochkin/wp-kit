<?php
namespace Korobochkin\WPKit\Translations;

/**
 * Class ThemeTranslations
 */
class ThemeTranslations extends AbstractTranslations
{
    /**
     * @inheritdoc
     */
    public function loadTranslations()
    {
        load_theme_textdomain(
            $this->textDomain,
            $this->translationsPath
        );

        return $this;
    }
}
