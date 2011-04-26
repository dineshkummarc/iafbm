<?php

class PersonnesController extends iaWebController {

    var $model = 'personne';

    var $query_exclude_fields = array('pays_nom_en');

    function defaultAction() {
        return $this->indexAction();
    }

    function indexAction() {
        $data = array(
            'title' => 'Personnes',
            'id' => 'personnes',
            'url' => '/api/personnes',
            'fields' => xView::load('personnes/extjs/fields')->render(),
            'columns' => xView::load('personnes/extjs/columns')->render(),
            'models' => array(
                xView::load('personnes/extjs/model')->render(),
                xView::load('pays/extjs/model')->render()
            ),
            'model' => 'Personne'

        );
        return xView::load('common/extjs/grid', $data, $this->meta)->render();
    }
}