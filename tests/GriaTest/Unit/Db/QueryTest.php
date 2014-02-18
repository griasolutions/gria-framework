<?php
/**
 * Created by IntelliJ IDEA.
 * User: gfisher
 * Date: 1/10/14
 * Time: 12:06 AM
 */

namespace GriaTest\Unit\Db;

use \Gria\Db;

class QueryTest extends \PHPUnit_Framework_TestCase
{

	public function setUp()
	{

	}

	public function testSelectSql()
	{
		$expected = 'SELECT * FROM test WHERE mine = :mine';
		$sql = (new Db\Query(Db\Query::QUERY_SELECT))
			->setFields(array('*'))
			->setTable('test')
			->setWhere(array('mine' => 'awesome'))
			->getSql();
		$this->assertEquals($expected, $sql);
	}

	public function testInsertSql()
	{
		$expected = 'INSERT INTO test (a, b) VALUES (:a, :b)';
		$sql = (new Db\Query(Db\Query::QUERY_INSERT))
			->setTable('test')
			->setData(array('a' => 1, 'b' => 2))
			->getSql();
		$this->assertEquals($expected, $sql);
	}

	public function testUpdateSql()
	{
		$expected = 'UPDATE test SET a = :a, b = :b, c = :c WHERE id = :id';
		$sql = (new Db\Query(Db\Query::QUERY_UPDATE))
			->setTable('test')
			->setData(array('a' => 1, 'b' => 2, 'c' => 3))
			->setWhere(array('id' => 999))
			->getSql();
		$this->assertEquals($expected, $sql);
	}

	public function testDeleteSql()
	{
		$expected = 'DELETE FROM test WHERE mine = :mine AND yours = :yours';
		$sql = (new Db\Query(Db\Query::QUERY_DELETE))
			->setTable('test')
			->setWhere(array('mine' => 1, 'yours' => 2))
			->getSql();
		$this->assertEquals($expected, $sql);
	}


} 