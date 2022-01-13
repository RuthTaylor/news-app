<?php

namespace Portable\NewsApp;

use PageController;
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\GroupedList;
use SilverStripe\View\ArrayData;

class SearchPageController extends PageController
{
    private static $allowed_actions = [
        'GuardianSearchForm',
        'pinMe'
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
            $request = Controller::curr()->request;
            $searchTerm = $data['Keywords'];

            //filter data
            $filteredResults = GuardianDummy::get()->filter([
                    'Title:PartialMatch' => $searchTerm
                ])->sort('Date DESC');

            //include pinned items
            $session = $request->getSession();
            $pinnedItems = $session->get('PinnedSearchResults');

            $pinnedResults = GuardianDummy::get()->filter([
                'ID' => $pinnedItems
            ])->sort('Date DESC');

            //merge two lists
            $results = new ArrayList();
            $results->merge($filteredResults);
            $results->merge($pinnedResults);

            //remove duplicates
            $results->removeDuplicates('ID');

            //group list for display in template
            $results = GroupedList::create($results);

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

    public function pinMe(HTTPRequest $request)
    {
        $itemID = $request->param('ID');

        if (isset($itemID) && $itemID != null) {
            $session = $request->getSession();
            $pinnedItems = $session->get('PinnedSearchResults');
            
            if ($pinnedItems == null) {
                //if null (i.e. no session yet), reset to empty array.
                $pinnedItems = [];
            }

            //check if item exists in array
            if (in_array($itemID, $pinnedItems)) {
                $pinnedItems = array_diff($pinnedItems, array($itemID));
                $session->set('PinnedSearchResults', $pinnedItems);

                return 'unpin';
            } else {
                array_push($pinnedItems, $itemID);
                $session->set('PinnedSearchResults', $pinnedItems);

                return 'pin';
            }
        }
        return;
    }
}
