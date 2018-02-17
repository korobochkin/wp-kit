<?php
namespace Korobochkin\WPKit\Services\Translations;

/**
 * Class PluginTranslations
 */
class PluginTranslations extends AbstractTranslations
{
    /**
     * @inheritdoc
     */
    public function loadTranslations()
    {
        load_plugin_textdomain(
            $this->textDomain,
            false,
            $this->translationsPath
        );

        return $this;
    }
}
