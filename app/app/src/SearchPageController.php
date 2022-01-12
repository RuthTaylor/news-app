<?php

namespace Portable\NewsApp;

use PageController;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\GroupedList;
use SilverStripe\View\ArrayData;

class SearchPageController extends PageController
{
    private static $allowed_actions = [
        'GuardianSearchForm',
    ];

    protected function init()
    {
        parent::init();
    }

    public function GuardianSearchForm()
    {
        $fields = new FieldList(
            TextField::create('Keywords', 'Find what you\'re looking for.')
        );

        $actions = new FieldList(
            FormAction::create('searchDummyData')->setTitle('Go')->setUseButtonTag(true)
        );

        $form = new Form(
            $this,
            'GuardianSearchForm',
            $fields,
            $actions
        );

        $form
            ->addExtraClass('searchForm');

        return $form;
    }

    public function searchDummyData($data, Form $form)
    {
        if (isset($data) && $data != null) {
            $searchTerm = $data['Keywords'];

            //filter data
            $results = GuardianDummy::get()->filter([
                    'Title:PartialMatch' => $searchTerm
                ])->sort('Date DESC');

            //group list for display in template
            $results = GroupedList::create($results);

            $request = Controller::curr()->request;

            //check if ajax call
            if ($request->isAjax()) {
                return $this->customise(new ArrayData([
                    'HasSearched' => true,
                    'Results' => $results
                ]))->renderWith('SearchResults');
            } else {
                //else return data as normal
                return $this->customise([
                    'HasSearched' => true,
                    'Results' => $results
                ]);
            }
        }
    }
}
