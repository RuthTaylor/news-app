<?php

namespace Portable\NewsApp;

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
}
