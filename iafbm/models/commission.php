<?php

class CommissionModel extends iaModelMysql {

    var $table = 'commissions';

    var $mapping = array(
        'id' => 'id',
        'commission_type_id' => 'commission_type_id',
        'commission_etat_id' => 'commission_etat_id',
        'section_id' => 'section_id',
        'termine' => 'termine',
        'nom' => 'nom',
        'commentaire' => 'commentaire',
        'actif' => 'actif',
        'created' => 'created',
        'modified' => 'modified'
    );

    var $primary = array('id');

    var $joins = array(
        'commission_type' => 'LEFT JOIN commissions_types ON (commissions.commission_type_id = commissions_types.id)',
        'commission_etat' => 'LEFT JOIN commissions_etats ON (commissions.commission_etat_id = commissions_etats.id)',
        'section' => 'LEFT JOIN sections ON (commissions.section_id = sections.id)',
        'commission_membre' => 'LEFT JOIN commissions_membres ON (commissions.id = commissions_membres.commission_id)',
        'commission_fonction' => 'LEFT JOIN commissions_fonctions ON (commissions_membres.commission_fonction_id = commissions_fonctions.id)'
    );

    var $join = array('commission_type');

    var $validation = array(
        'nom' => array(
            'mandatory'
        ),
/*
        'end' => array(
            'mandatory',
            'datetime'
        ),
        'zip' => array(
            'mandatory',
            'integer',
            'minlength' => array('length'=>4),
            'maxlength' => array('length'=>4)
        ),
        'location' => array(
            'mandatory'
        ),
        'distance' => array(
            'mandatory',
            'integer',
            'minvalue' => array('length'=>0)
        ),
        'profile' => array(
            'mandatory',
            'integer'
        ),
*/
    );
}
