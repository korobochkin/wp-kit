<?php
namespace Korobochkin\WPKit\Services\Translations;

/**
 * Class ThemeTranslations
 */
class ThemeTranslations extends AbstractTranslations
{
    /**
     * @inheritdoc
     */
    public function loadTranslations() {
        $result = load_theme_textdomain(
            $this->textDomain,
            $this->translationsPath
        );

        if (true !== $result) {
            throw new \Exception();
        }

        return $this;
    }
}