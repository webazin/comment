<?php

namespace webazin\Comment\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * @var string
     */
    protected $table = 'comments';

    /**
     * @var array
     */
    protected $fillable = ['comments', 'commentable_id' , 'commentable_type' , 'author_id', 'author_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo('');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function author()
    {
        return $this->morphTo('author');
    }

    /**
     * @param Model $commentable
     * @param $data
     * @param Model $author
     *
     * @return static
     */
    public function createComment(Model $commentable, $data, Model $author)
    {
        $Comment = new static();
        $Comment->fill(array_merge($data, [
            'author_id' => $author->id,
            'author_type' => get_class($author),
        ]));

        $commentable->comments()->save($Comment);

        return $Comment;
    }

	/**
	 * @param Model $commentable
	 * @param       $data
	 * @param Model $author
	 *
	 * @return array
	 */
    public function createUniqueComment(Model $commentable, $data, Model $author)
    {
        $Comment = [
            'author_id' => $author->id,
            'author_type' => get_class($author),
            "commentable_id" => $commentable->id,
            "commentable_type" => get_class($commentable),
        ];

        Comment::updateOrCreate($Comment, $data);
        return $Comment;
    }

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function updateComment($id, $data)
    {
        $Comment = static::find($id);
        $Comment->update($data);

        return $Comment;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteComment($id)
    {
        return static::find($id)->delete();
    }
}