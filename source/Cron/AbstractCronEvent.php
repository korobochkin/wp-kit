<?php
namespace Korobochkin\WPKit\Cron;

abstract class AbstractCronEvent extends AbstractCronSingleEvent {

	use Traits\RecurrenceTrait;
}
