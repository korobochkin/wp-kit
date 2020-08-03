<?php
declare(strict_types=1);

namespace Korobochkin\WPKit\Uninstall;

use Korobochkin\WPKit\Cron\CronEventInterface;
use Korobochkin\WPKit\Options\OptionInterface;
use Korobochkin\WPKit\PostMeta\PostMetaInterface;
use Korobochkin\WPKit\TermMeta\TermMetaInterface;
use Korobochkin\WPKit\Transients\TransientInterface;
use Korobochkin\WPKit\Utils\WordPressFeatures;

/**
 * Class Uninstall delete everything data used by your product.
 */
class Uninstall implements UninstallInterface
{
    /**
     * @var CronEventInterface[]
     */
    protected $cronEvents;

    /**
     * @var OptionInterface[]
     */
    protected $options;

    /**
     * @var PostMetaInterface[]
     */
    protected $postMetas;

    /**
     * @var TermMetaInterface[]
     */
    protected $termMetas;

    /**
     * @var TransientInterface[]
     */
    protected $transients;

    /**
     * @var bool If true any exceptions and errors will omitted and service continue it execution.
     */
    protected $suppressExceptions = false;

    /**
     * Returns all cron events.
     *
     * @return CronEventInterface[]
     */
    public function getCronEvents()
    {
        return $this->cronEvents;
    }

    /**
     * Sets all cron events.
     *
     * @param CronEventInterface[] $cronEvents
     *
     * @return $this For chain calls.
     */
    public function setCronEvents($cronEvents)
    {
        $this->cronEvents = $cronEvents;
        return $this;
    }

    /**
     * Returns all options.
     *
     * @return OptionInterface[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets all options.
     *
     * @param OptionInterface[] $options
     *
     * @return $this For chain calls.
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Returns all post metas.
     *
     * @return PostMetaInterface[]
     */
    public function getPostMetas()
    {
        return $this->postMetas;
    }

    /**
     * Sets all post metas.
     *
     * @param PostMetaInterface[] $postMetas
     *
     * @return $this For chain calls.
     */
    public function setPostMetas($postMetas)
    {
        $this->postMetas = $postMetas;
        return $this;
    }

    /**
     * Returns all term metas.
     *
     * @return TermMetaInterface[]
     */
    public function getTermMetas()
    {
        return $this->termMetas;
    }

    /**
     * Sets all term metas.
     *
     * @param TermMetaInterface[] $termMetas
     *
     * @return $this For chain calls.
     */
    public function setTermMetas($termMetas)
    {
        $this->termMetas = $termMetas;
        return $this;
    }

    /**
     * Returns all transients.
     *
     * @return TransientInterface[]
     */
    public function getTransients()
    {
        return $this->transients;
    }

    /**
     * Sets all transients.
     *
     * @param TransientInterface[] $transients
     *
     * @return $this For chain calls.
     */
    public function setTransients($transients)
    {
        $this->transients = $transients;
        return $this;
    }

    /**
     * @return bool True mean skipping errors.
     */
    public function isSuppressExceptions()
    {
        return $this->suppressExceptions;
    }

    /**
     * @param bool $suppressExceptions
     *
     * @return $this For chain calls.
     */
    public function setSuppressExceptions($suppressExceptions)
    {
        $this->suppressExceptions = $suppressExceptions;
        return $this;
    }

    /**
     * Runs all uninstall methods and removes everything.
     *
     * @throws \Exception If suppress exceptions is not enabled.
     *
     * @see deleteCronEvents()
     * @see deleteOptions()
     * @see deletePostMetas()
     * @see deleteTermMetas()
     * @see deleteTransients()
     * @see flushAfterRun()
     *
     * @return $this For chain calls.
     */
    public function run()
    {
        $this
            ->deleteCronEvents()
            ->deleteOptions()
            ->deletePostMetas()
            ->deleteTransients();

        if (WordPressFeatures::isTermsMetaSupported()) {
            $this->deleteTermMetas();
        }

        $this->flushAfterRun();

        return $this;
    }

    /**
     * Flush object cache after remove everything.
     *
     * @throws \Exception If suppress exceptions is not enabled.
     *
     * @return $this For chain calls.
     */
    public function flushAfterRun()
    {
        try {
            wp_cache_flush();
        } catch (\Exception $exception) {
            if (!$this->isSuppressExceptions()) {
                throw $exception;
            }
        }
        return $this;
    }

    /**
     * Delete all cron events.
     *
     * @throws \Exception Different exceptions in case of error.
     *
     * @return $this For chain calls.
     */
    public function deleteCronEvents()
    {
        foreach ($this->cronEvents as $event) {
            try {
                $event->unScheduleAll();
            } catch (\Exception $exception) {
                if (!$this->isSuppressExceptions()) {
                    throw $exception;
                }
            }
        }
        return $this;
    }

    /**
     * Delete all options.
     *
     * @throws \Exception Different exceptions in case of error.
     *
     * @return $this For chain calls.
     */
    public function deleteOptions()
    {
        foreach ($this->options as $option) {
            try {
                $option->delete();
            } catch (\Exception $exception) {
                if (!$this->isSuppressExceptions()) {
                    throw $exception;
                }
            }
        }
        return $this;
    }

    /**
     * Delete all post metas.
     *
     * @throws \Exception Different exceptions in case of error.
     *
     * @return $this For chain calls.
     */
    public function deletePostMetas()
    {
        /**
         * @var $wpdb \wpdb
         */
        global $wpdb;

        $queryTemplate = "
            DELETE
              
            FROM {$wpdb->postmeta}
            
            WHERE meta_key = %s
            ";

        foreach ($this->postMetas as $postMeta) {
            try {
                $query = $wpdb->prepare(
                    $queryTemplate,
                    $postMeta->getName()
                );
                $wpdb->get_results($query);
            } catch (\Exception $exception) {
                if (!$this->isSuppressExceptions()) {
                    throw $exception;
                }
            }
        }

        return $this;
    }

    /**
     * Delete all term metas.
     *
     * @throws \Exception Different exceptions in case of error.
     *
     * @return $this For chain calls.
     */
    public function deleteTermMetas()
    {
        /**
         * @var $wpdb \wpdb
         */
        global $wpdb;

        $queryTemplate = "
            DELETE
              
            FROM {$wpdb->termmeta}
            
            WHERE meta_key = %s
            ";

        foreach ($this->termMetas as $termMeta) {
            try {
                $query = $wpdb->prepare(
                    $queryTemplate,
                    $termMeta->getName()
                );
                $wpdb->get_results($query);
            } catch (\Exception $exception) {
                if (!$this->isSuppressExceptions()) {
                    throw $exception;
                }
            }
        }

        return $this;
    }

    /**
     * Delete all transients.
     *
     * @throws \Exception Different exceptions in case of error.
     *
     * @return $this For chain calls.
     */
    public function deleteTransients()
    {
        foreach ($this->transients as $transient) {
            try {
                $transient->delete();
            } catch (\Exception $exception) {
                if (!$this->isSuppressExceptions()) {
                    throw $exception;
                }
            }
        }
        return $this;
    }
}
