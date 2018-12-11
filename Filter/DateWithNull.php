<?php

namespace Kanboard\Plugin\Creecros_Filter_Pack\Filter;

use Kanboard\Core\Filter\FilterInterface;
use Kanboard\Filter\BaseFilter;
use Kanboard\Model\TaskModel;
use PicoDb\Database;
use PicoDb\Table;

class DateWithNull extends BaseFilter implements FilterInterface
{

    private $db;
protected $dateParser;
    /**
     * Current user id
     *
     * @access private
     * @var int
     */
    private $currentUserId = 0;

    /**
     * Set current user id
     *
     * @access public
     * @param  integer $userId
     * @return TaskAssigneeFilter
     */
    public function setCurrentUserId($userId)
    {
        $this->currentUserId = $userId;
        return $this;
    }

        public function setDatabase(Database $db)
    {
        $this->db = $db;
        return $this;
    }
        /**
     * Get search attribute
     *
     * @access public
     * @return string[]
     */
    public function getAttributes()
    {
        return array('due_with_null');
    }

    /**
     * Apply filter
     *
     * @access public
     * @return string
     */
    public function apply()
    {

$method = $this->parseOperator();
$timestamp = $this->dateParser->getTimestampFromIsoFormat($this->value);
error_log("Methode = " . $method);
error_log("timestamp = " . $this->getTimestampFromOperator($method, $timestamp));
            if ($method !== '') { $duedate = $this->db
                ->table(self::TABLE)
                ->beginOr()
                ->eq('date_due', 0)
                ->$method('date_due', $this->getTimestampFromOperator($method, $timestamp))
                ->closeOr()
                ->findAllByColumn('id');
            } 
        
        if (isset($duedate) && !empty($duedate)) { return $this->query->in(TaskModel::TABLE.'.id', $duedate); } else { return $this->query->in(TaskModel::TABLE.'.id', [0]); }
    
            }

    }

/**
     * Parse operator in the input string
     *
     * @access protected
     * @return string
     */
    protected function parseOperator()
    {
        $operators = array(
            '<=' => 'lte',
            '>=' => 'gte',
            '<' => 'lt',
            '>' => 'gt',
        );

        foreach ($operators as $operator => $method) {
            if (strpos($this->value, $operator) === 0) {
                $this->value = substr($this->value, strlen($operator));
                return $method;
            }
        }

        return '';
    }
/**
     * Get timestamp from the operator
     *
     * @access public
     * @param  string  $method
     * @param  integer $timestamp
     * @return integer
     */
    protected function getTimestampFromOperator($method, $timestamp)
    {
        switch ($method) {
            case 'lte':
                return $timestamp + 86399;
            case 'lt':
                return $timestamp;
            case 'gte':
                return $timestamp;
            case 'gt':
                return $timestamp + 86400;
        }

        return $timestamp;
    }
    public function setDateParser(DateParser $dateParser)
    {
        $this->dateParser = $dateParser;
        return $this;
    }
}
