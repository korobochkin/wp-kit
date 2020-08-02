<?php
declare(strict_types=1);

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
