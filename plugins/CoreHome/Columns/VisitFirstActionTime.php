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
use Piwik\Tracker\Action;
use Piwik\Tracker\Request;
use Piwik\Tracker;
use Piwik\Tracker\Visitor;

class VisitFirstActionTime extends VisitDimension
{
    protected $fieldName = 'visit_first_action_time';
    protected $fieldType = 'DATETIME NOT NULL';

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
        return Tracker::getDatetimeFromTimestamp($request->getCurrentTimestamp());
    }
}