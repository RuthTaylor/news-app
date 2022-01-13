<?php

namespace Portable\NewsApp;

use Page;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;

class SearchPage extends Page
{
    public function HasPinnedResults()
    {
        $request = Injector::inst()->get(HTTPRequest::class);
        $session = $request->getSession();
        $pinnedItems = $session->get('PinnedSearchResults');
        
        if ($pinnedItems == null) {
            return false;
        }
        return true;
    }
}
