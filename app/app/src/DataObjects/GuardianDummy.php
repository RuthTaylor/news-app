<?php

namespace Portable\NewsApp;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\DataObject;

class GuardianDummy extends DataObject
{
    private static $table_name = 'GuardianDummy';

    private static $db = [
        'Title' => 'Text',
        'URL' => 'Text',
        'Date' => 'Date',
        'Section' => 'Text',
    ];

    //
    //I'd normally add the following info too.
    //Not bothering cos this is a proof of concept and CMS management of this isn't necessary at this time.
    //
    //Summary fields
    //Field labels
    //CMS Fields etc.
    
    /**
    * Returns the first letter of the "Section", used for grouping.
    * @return string
    */
    public function getSectionFirstLetter()
    {
        return $this->Section[0];
    }

    public function IsPinned()
    {
        $request = Injector::inst()->get(HTTPRequest::class);
        $session = $request->getSession();

        $pinnedIds = $session->get('PinnedSearchResults');

        if ($pinnedIds != null && in_array($this->ID, $pinnedIds)) {
            return true;
        }
        return false;
    }
}
