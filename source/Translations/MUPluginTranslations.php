<?php
namespace Korobochkin\WPKit\Translations;

class MUPluginTranslations extends AbstractTranslations
{
    /**
     * @inheritdoc
     */
    public function loadTranslations()
    {
        load_muplugin_textdomain($this->textDomain, $this->translationsPath);
        return $this;
    }
}
