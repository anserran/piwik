<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\CoreHome\Columns;

use Piwik\Plugin\VisitDimension;
use Piwik\Plugins\CoreHome\Segment;
use Piwik\Tracker\Action;
use Piwik\Tracker\Request;
use Piwik\Tracker\Visitor;

class VisitorDaysSinceOrder extends VisitDimension
{
    protected $fieldName = 'visitor_days_since_order';
    protected $fieldType = 'SMALLINT(5) UNSIGNED NOT NULL';

    protected function init()
    {
        $segment = new Segment();
        $segment->setSegment('daysSinceLastEcommerceOrder');
        $segment->setName('General_DaysSinceLastEcommerceOrder');
        $segment->setType(Segment::TYPE_METRIC);

        $this->addSegment($segment);
    }

    public function getName()
    {
        return '';
    }

    /**
     * @param Request $request
     * @param Visitor $visitor
     * @param Action|null $action
     * @return mixed
     */
    public function onNewVisit(Request $request, Visitor $visitor, $action)
    {
        $daysSinceLastOrder = $request->getDaysSinceLastOrder();

        if ($daysSinceLastOrder === false) {
            $daysSinceLastOrder = 0;
        }

        return $daysSinceLastOrder;
    }

    /**
     * @param Request $request
     * @param Visitor $visitor
     * @param Action|null $action
     * @return mixed
     */
    public function onRecordGoal(Request $request, Visitor $visitor, $action)
    {
        return $visitor->getVisitorColumn($this->fieldName);
    }
}