<?php 

namespace App\Enums;

enum Status: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';
    case Trash = 'trash';
    case Deleted = 'deleted';
}