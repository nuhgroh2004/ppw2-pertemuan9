<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Buku extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $dates = ['tgl_terbit'];
}
