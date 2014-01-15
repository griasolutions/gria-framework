<?php
/**
 * This file is part of the Gria library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Model;

use \Gria\Db;
use \ICanBoogie\Inflector;

abstract class MapperAbstract implements MapperInterface
{

	/** @var \PDO */
	private $_db;

	/** @var string */
	private $_tableName;

	/** @var string */
	private $_modelClassName;

	/**
	 * @inheritdoc
	 */
	public function __construct(Db\Db $db)
	{
		$this->_db = $db;
		if (!preg_match('/([\w]+)Mapper/', get_called_class(), $matches)) {
			throw new InvalidModelException(sprintf('%s is an invalid model name', get_called_class()));
		}
		$modelName = $matches[0];
		$this->_tableName = Inflector::get()->pluralize(strtolower($modelName));
		$this->_modelClassName = '\Application\Model\\' . $modelName ;
	}

	/**
	 * @inheritdoc
	 */
	public function getDb()
	{
		return $this->_db;
	}

	/**
	 * @inheritdoc
	 */
	public function getModelClassName()
	{
		return $this->_modelClassName;
	}

	/**
	 * @inheritdoc
	 */
	public function getTableName()
	{
		return $this->_tableName;
	}

	/**
	 * @inheritdoc
	 */
	public function findAll($offset = 0, $limit = 0)
	{
		return $this->getDb()->select($this->getTableName(), '*');
	}

	/**
	 * @inheritdoc
	 */
	public function findById($id)
	{
		return $this->findByField('id', $id);
	}

	/**
	 * @inheritdoc
	 */
	public function findByField($field, $value)
	{
		return $this->getDb()->select($this->getTableName(), '*', array($field => $value));
	}

	/**
	 * @inheritdoc
	 */
	public function create(array $data)
	{
		$this->getDb()->create($this->getTableName(), $data);
	}

	/**
	 * @inheritdoc
	 */
	public function update($id, array $data)
	{
		return $this->getDb()->update($this->getTableName(), $id, $data);
	}

	/**
	 * @inheritdoc
	 */
	public function delete($id)
	{
		$this->getDb()->delete($this->getTableName(), array('id' => $id));
		/*
		$sql = 'DELETE FROM ' . $this->getTableName() . ' WHERE id = :id';

		return (new \PDOStatement($sql))->execute();
		*/
	}

} 