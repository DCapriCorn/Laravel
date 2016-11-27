<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Author
 * @package App
 *
 * @property string name
 * @property integer id
 */
class Author extends Model
{
    protected $table = 'author';

    protected $fillable = ['name'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book()
    {
        return $this->hasMany('App\Book');
    }

    /**
     * @return \Illuminate\Validation\Validator
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
            'name' => 'required|unique:author|string',
        ];
    }
}
