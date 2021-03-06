<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * @category Piwik
 * @package Piwik
 */
namespace Piwik\DataTable\Filter;

use Piwik\Piwik;
use Piwik\DataTable\Filter\ColumnCallbackAddColumnQuotient;

/**
 * Add a new column to the table which is a percentage based on the value resulting
 * from a callback function with the parameter being another column's value
 *
 * For example in the keywords table, we can create a "nb_visits_percentage" column
 * from the "nb_visits" column that will be nb_visits / $totalValueUsedToComputePercentage
 * You can also specify the precision of the percentage value to be displayed (defaults to 0, eg "11%")
 *
 * Usage:
 *   $nbVisits = API::getInstance()->getVisits($idSite, $period, $date);
 *   $dataTable->queueFilter('ColumnCallbackAddColumnPercentage', array('nb_visits', 'nb_visits_percentage', $nbVisits, 1));
 *
 * @package Piwik
 * @subpackage DataTable
 */
class ColumnCallbackAddColumnPercentage extends ColumnCallbackAddColumnQuotient
{
    /**
     * Formats the given value
     *
     * @param number $value
     * @param number $divisor
     * @return string
     */
    protected function formatValue($value, $divisor)
    {
        return Piwik::getPercentageSafe($value, $divisor, $this->quotientPrecision) . '%';
    }
}
