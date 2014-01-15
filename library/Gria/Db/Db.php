<?php
/**
 * This file is part of the Gria library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Db;

class Db
{

	/** @var \Gria\Db\Db */
	private static $_instance;

	/** @var string */
	private static $_dsn;

	/** @var \PDO */
	private $_db;

	/**
	 * @return \Gria\Db\Db
	 */
	public static function getInstance()
	{
		if (!self::$_instance) {
			$className = __CLASS__;
			self::$_instance = new $className;
		}

		return self::$_instance;
	}

	/**
	 * @param string $dsn
	 */
	public static function setDsn($dsn)
	{
		self::$_dsn = $dsn;
	}

	/**
	 * @return string
	 */
	public static function getDsn()
	{
		return self::$_dsn;
	}

	/**
	 * @param string $method
	 * @param array $arguments
	 * @throws \Gria\Db\Exception
	 */
	public function __call($method, array $arguments)
	{
		try {
			call_user_func_array(array($this->_db, $method), $arguments);
		} catch (\Exception $ex) {
			throw new Exception($ex->getMessage(), 500, $ex);
		}
	}

	public function select($tableName, $fields, array $where = array(), $fetchClassName = '')
	{
		return (new Query(Query::QUERY_SELECT))
			->setFrom($tableName)
			->setFields($fields)
			->setWhere($where)
			->setFetchClassName($fetchClassName)
			->execute();
	}

	public function create($tableName, array $data)
	{
		$this->_db->beginTransaction();
		try {
			$result = (new Query(Query::QUERY_INSERT))
				->setTable($tableName)
				->setData($data)
				->execute();
		} catch (\Exception $ex) {
			$this->_db->rollBack();

			return false;
		}
		$this->_db->commit();

		return $result;
	}

	public function update($tableName, array $data, array $where = array())
	{
		$this->_db->beginTransaction();
		try {
			$result = (new Query(Query::QUERY_UPDATE))
				->setTable($tableName)
				->setData($data)
				->setWhere($where)
				->execute();
		} catch (\Exception $ex) {
			$this->_db->rollBack();

			return false;
		}
		$this->_db->commit();

		return $result;
	}

	public function delete($tableName, array $where)
	{
		$this->_db->beginTransaction();
		try {
			$result = (new Query(Query::QUERY_DELETE))
				->setTable($tableName)
				->setWhere($where)
				->execute();
		} catch (\Exception $ex) {
			$this->_db->rollBack();

			return false;
		}
		$this->_db->commit();

		return $result;
	}

	/**
	 * @throws \Gria\Db\Exception
	 */
	private function __construct()
	{
		try {
			$this->_db = new \PDO(self::getDsn());
		} catch (\Exception $ex) {
			throw new Exception($ex->getMessage());
		}
	}

} 