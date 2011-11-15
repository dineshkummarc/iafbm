<?php

/**
 * Project specific xModelMysql
 */
class iaModelMysql extends xModelMysql {

    /**
     * @param bool True to enable versioning on this model.
     */
    var $versioning = true;

    /**
     * @param array Specifies which fields have to be versioned.
     *              Versions all fields if array is empty.
     */
    var $version_fields = array();

    /**
     * Enhanced get method.
     * Manages versioning.
     */
    function get($rownum=null) {
        // FIXME: TODO:
        // Add 'actif'=true in where clause (only if actif field exists in fields mapping array)
        return parent::get($rownum);
    }

    /**
     * Enhanced post method.
     * Manages versioning.
     */
    function post() {
        if (!$this->versioning) return parent::post();
        // Manages versioning:
        $old_record = xModel::load($this->name, array('id'=>$this->params['id'], 'xjoin'=>array()))->get(0);
        $result = parent::post();
        $this->version('post', $old_record, $result);
        return $result;
    }

    /**
     * Enhanced put method.
     * Manages versioning.
     */
    function put() {
        if (!$this->versioning) return parent::put();
        // Manages versioning
        $result = parent::put();
        $this->version('put', array(), $result);
        return $result;
    }

    /**
     * Enhanced delete method.
     * Manages versioning.
     */
    function delete() {
        // FIXME: TODO:
        // 1) Set 'actif' field to false
        // 2) abord deletion (do not acually delete row)
        return parent::delete();
    }

    /**
     * Returns true if the specified field is versionnable.
     * @param string Field name to be tested.
     * @return boolean True if the given field is versionable, false otherwise.
     */
    protected function is_versionable($field) {
        return $this->versioning && !$this->version_fields || xUtil::filter_keys($this->version_fields, $field);
    }

    /**
     * Creates a version of a record.
     * Compares fields from old and new records provided
     * and saves the modified fields as a version.
     * @param string Name of the performed operation (get, put, post, delete)
     * @param array Old version of the record.
     * @param array New version of the record.
     */
    protected function version($operation=null, $old_record=array(), $result=array()) {
        // Aborts if versioning is disabled
        if (!$this->versioning) return;
        // Determines changes applied to the record
        $record_id = (strtolower($operation) == 'post') ? $this->params['id'] : $result['insertid'];
        $new_record = xModel::load($this->name, array('id'=>$record_id))->get(0);
        $fields = xUtil::array_merge(array_keys($old_record), array_keys($new_record));
        $changes = array();
        foreach ($this->fields_values() as $field => $value) {
            // Prevents versioning undesired fields
            if (!$this->is_versionable($field)) continue;
            // Compares record field values, keeping only modified fields
            if (@$old_record[$field] != @$new_record[$field]) {
                $changes[$field] = array(
                    'old' => @$old_record[$field],
                    'new' => @$new_record[$field]
                );
            }
        }
        // Writes version
        $id_field_name = implode(', ', xUtil::arrize($this->primary));
        $id_field_value = (strtolower($operation) == 'post') ?
            $this->params[$id_field_name] :
            $result['insertid'];
        $version_result = xModel::load('version', array(
            'table_name' => $this->maintable,
            'id_field_name' => $id_field_name,
            'id_field_value' => $id_field_value,
            'model_name' => $this->name,
            'operation' => $operation
        ))->put();
        $version_id = $version_result['insertid'];
        if(!$version_id) throw new xException('Error while creating version');
        // Writes version data
        foreach ($changes as $field => $value) {
            xModel::load('version_data', array(
                'version_id' => $version_id,
                'field_name' => $field,
                'old_value' => $value['old'],
                'new_value' => $value['new']
            ))->put();
        }
    }
}