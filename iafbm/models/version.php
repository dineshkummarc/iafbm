<?php
/**
 * This model stores tables write activity
 * @note This Model does not extends iaModelMysql because wo do not want to version history
 */
class VersionModel extends xModelMysql {

    var $table = 'versions';

    var $mapping = array(
        'id' => 'id',
        'created' => 'created',
        'modified' => 'modified',
        'table_name' => 'table_name',
        'id_field_name' => 'id_field_name',
        'id_field_value' => 'id_field_value',
        'model_name' => 'model_name',
        'operation' => 'operation'
    );

    var $primary = array('id');

    var $validation = array();
}
