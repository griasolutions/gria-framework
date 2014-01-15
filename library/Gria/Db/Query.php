<?php

namespace Gria\Db;

class Query
{

	const QUERY_SELECT = 'select';
	const QUERY_INSERT = 'insert';
	const QUERY_UPDATE = 'update';
	const QUERY_DELETE = 'delete';

	/** @var string */
	private $_type;

	/** @var array */
	private $_fields = array();

	/** @var array */
	private $_data = array();

	/** @var array */
	private $_where = array();

	/** @var string */
	private $_table;

	/** @var int */
	private $_offset;

	/** @var int */
	private $_limit;

	/** @var string */
	private $_fetchClassName;

	/** @var string */
	private $_sql;

	public function __construct($type)
	{
		$this->setType($type);
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->getSql();
	}

	/**
	 * @param string $type
	 */
	public function setType($type)
	{
		$this->_type = $type;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->_type;
	}

	/**
	 * @param array $data
	 * @return $this
	 */
	public function setData($data)
	{
		$this->_data = $data;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getData()
	{
		return $this->_data;
	}

	/**
	 * @param array $fields
	 * @return $this
	 */
	public function setFields($fields)
	{
		$this->_fields = $fields;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getFields()
	{
		return $this->_fields;
	}

	/**
	 * @param array $where
	 * @return $this
	 */
	public function setWhere($where)
	{
		$this->_where = $where;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getWhere()
	{
		return $this->_where;
	}

	/**
	 * @param string $table
	 * @return $this
	 */
	public function setTable($table)
	{
		$this->_table = $table;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTable()
	{
		return $this->_table;
	}

	/**
	 * @param int $limit
	 * @return $this
	 */
	public function setLimit($limit)
	{
		$this->_limit = $limit;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getLimit()
	{
		return $this->_limit;
	}

	/**
	 * @param int $offset
	 * @return $this
	 */
	public function setOffset($offset)
	{
		$this->_offset = $offset;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getOffset()
	{
		return $this->_offset;
	}

	/**
	 * @param string $string
	 * @return $this
	 */
	public function setFetchClassName($string)
	{
		$this->_fetchClassName = $string;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFetchClassName()
	{
		return $this->_fetchClassName;
	}

	/**
	 * @return string
	 */
	public function getSql()
	{
		if (!$this->_sql) {
			$type = $this->getType();
			$method = '_build' . ucfirst($type) . 'SqlArray';
			$sqlArray = $this->$method();
			$this->_sql = implode(' ', $sqlArray);
		}

		return $this->_sql;
	}

	public function execute()
	{
		if ($fetchClassName) {
			$statement = new \PDOStatement($sql, \PDO::FETCH_CLASS, $fetchClassName);
		} else {
			$statement = new \PDOStatement($sql);
		}
		if ($where) {
			$statement = $this->_bindParamArray($statement, $where);
		}


		$statement = $this->_bindParamArray(new \PDOStatement($this->getSql()), $this->getData());

		return $statement->execute();
	}

	private function _buildSelectSqlArray()
	{
		$sql[] = strtoupper(self::QUERY_SELECT);
		$sql[] = implode(', ', $this->getFields());
		$sql[] = 'FROM';
		$sql[] = $this->getTable();
		$sql[] = $this->_buildWhereClauseSql();
		if ($this->getLimit()) {
			$sql[] = 'LIMIT ' . $this->getLimit();
		}
		if ($this->getOffset()) {
			$sql[] = 'OFFSET ' . $this->getOffset();
		}

		return $sql;
	}

	private function _buildInsertSqlArray()
	{
		$sql[] = strtoupper(self::QUERY_INSERT);
		$sql[] = 'INTO';
		$sql[] = $this->getTable();
		$sql[] = '(' . implode(', ', array_keys($this->getData())) . ')';
		$sql[] = 'VALUES';
		$sql[] = '(:' . implode(', :', array_keys($this->getData())) . ')';

		return $sql;
	}

	private function _buildUpdateSqlArray()
	{
		$sql[] = strtoupper(self::QUERY_UPDATE);
		$sql[] = $this->getTable();
		$sql[] = 'SET';
		$sql[] = implode(', ', array_map(function ($value) {
			return $value . ' = :' . $value;
		}, array_keys($this->getData())));
		$sql[] = $this->_buildWhereClauseSql();

		return $sql;
	}

	private function _buildDeleteSqlArray()
	{
		$sql[] = strtoupper(self::QUERY_DELETE);
		$sql[] = 'FROM';
		$sql[] = $this->getTable();
		$sql[] = $this->_buildWhereClauseSql();

		return $sql;
	}

	private function _buildWhereClauseSql()
	{
		$sql = 'WHERE ';
		$setStatements = array_map(function ($value) {
			return $value . ' = :' . $value;
		}, array_keys($this->getWhere()));
		switch ($this->getType()) {
			case self::QUERY_SELECT:
			case self::QUERY_DELETE:
				$glue = ' AND ';
				break;
			case self::QUERY_UPDATE:
				$glue = ',';
				break;
			default:
				throw new Exception('Invalid query');
		}
		$sql .= implode($glue, $setStatements);

		return $sql;
	}

	/**
	 * @param \PDOStatement $statement
	 * @param array $data
	 * @return \PDOStatement
	 */
	private function _bindParamArray(\PDOStatement $statement, array $data)
	{
		foreach ($data as $field => $value) {
			$statement->bindParam(':' . $field, $value);
		}

		return $statement;
	}

}