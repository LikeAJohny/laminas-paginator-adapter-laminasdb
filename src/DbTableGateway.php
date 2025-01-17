<?php

declare(strict_types=1);

namespace Laminas\Paginator\Adapter\LaminasDb;

use Closure;
use Laminas\Db\Sql\Having;
use Laminas\Db\Sql\Where;
use Laminas\Db\TableGateway\AbstractTableGateway;

class DbTableGateway extends DbSelect
{
    /**
     * Constructs instance.
     *
     * @param null|Where|Closure|string|array  $where
     * @param null|string|array                $order
     * @param null|string|array                $group
     * @param null|Having|Closure|string|array $having
     */
    public function __construct(
        AbstractTableGateway $tableGateway,
        $where = null,
        $order = null,
        $group = null,
        $having = null
    ) {
        $sql    = $tableGateway->getSql();
        $select = $sql->select();
        if ($where) {
            $select->where($where);
        }
        if ($order) {
            $select->order($order);
        }
        if ($group) {
            $select->group($group);
        }
        if ($having) {
            $select->having($having);
        }

        $resultSetPrototype = $tableGateway->getResultSetPrototype();
        parent::__construct($select, $sql, $resultSetPrototype);
    }
}
