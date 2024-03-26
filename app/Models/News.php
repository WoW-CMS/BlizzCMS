<?php

namespace App\Models;

use App\Entities\Article;
use CodeIgniter\Model;

class News extends Model
{
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Article::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'id',
        'title',
        'slug',
        'content',
        'author_id',
        'category_id',
        'tags',
        'image_url',
        'status',
        'comments_enabled',
        'view'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}