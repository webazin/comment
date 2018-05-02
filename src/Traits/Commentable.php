<?php

namespace webazin\Comment\Traits;

use Ghanem\comment\Models\comment;
use Illuminate\Database\Eloquent\Model;

trait Commentable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(comment::class, 'commentable');
    }
    

    /**
     *
     * @return mix
     */
    public function commentCount()
    {
        return $this->comments()->sum('comment');
    }


	/**
	 * @param       $data
	 * @param Model $author
	 *
	 * @return static
	 */
    public function comment($data, Model $author)
    {
        return (new comment())->createComment($this, $data, $author);
    }

	/**
	 * @param       $data
	 * @param Model $author
	 *
	 * @return static
	 */
    public function commentUnique($data, Model $author)
    {
        return (new comment())->createUniqueComment($this, $data, $author);
    }

	/**
	 * @param $id
	 * @param $data
	 *
	 * @return mixed
	 */
    public function updateComment($id, $data)
    {
        return (new comment())->updateComment($id, $data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteComment($id)
    {
        return (new comment())->deleteComment($id);
    }


    public function getCommentCountAttribute()
    {
        return $this->commentCount();
    }

}
