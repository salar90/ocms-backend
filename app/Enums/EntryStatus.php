<?php 

namespace App\Enums;

enum EntryStatus : string
{
    case Draft = 'draft';
    case Published = 'published';
    case Published = 'rejected';
    case Archived = 'archived';
} 