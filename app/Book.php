<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 * @package App
 *
 * @property string name
 * @property integer id
 */
class Book extends Model
{
    protected $table = 'book';

    protected $fillable = ['name'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    /**
     * @return mixed
     */
    public function validate()
    {
        return \Validator::make($this->getAttributes(), $this->rules());
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:book|string',
        ];
    }

}
