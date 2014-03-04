<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Model;

interface MapperInterface
{

    /**
     * Returns the name of the model class.
     *
     * @return string
     */
    public function getModelClassName();

    /**
     * Retrieves an array populated with the model whose ID matches the one provided.
     *
     * @param $id
     * @return \ArrayObject
     */
    public function findById($id);

    /**
     * Retrieves an array of models that match the provided field criteria.
     *
     * @param string $field
     * @param mixed $value
     * @return \ArrayObject
     */
    public function findByField($field, $value);

    /**
     * Retrieves an array of associated models that match the provided criteria.
     *
     * @param array $criteria
     * @return \ArrayObject
     */
    public function findAll(array $criteria);

    /**
     * @param array $data
     * @return boolean
     */
    public function create(array $data);

    /**
     * @param mixed $id
     * @param array $data
     * @return boolean
     */
    public function update($id, array $data);

    /**
     * @param mixed $id
     * @return boolean
     */
    public function delete($id);

} 