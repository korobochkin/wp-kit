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
        $result = load_plugin_textdomain(
            $this->textDomain,
            false,
            $this->translationsPath
        );

        if (true !== $result) {
            throw new \Exception();
        }

        return $this;
    }
}
