<?php

class CommissionEtatModel extends iaModelMysql {

    var $table = 'commissions_etats';

    var $versioning = false;

    var $mapping = array(
        'id' => 'id',
        'nom' => 'nom',
        'description' => 'description'
    );

    var $primary = array('id');

    var $order_by = array('nom');

    var $validation = array(
        'nom' => array(
            'mandatory'
        )
    );
}
