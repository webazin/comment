<?php

namespace webazin\Comment\Traits;

use webazin\Comment\Models\Comment;
use Illuminate\Database\Eloquent\Model;

trait Commentable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    

    /**
     *
     * @return mix
     */
    public function commentCount()
    {
        return $this->comments()->count('comment');
    }


	/**
	 * @param       $data
	 * @param Model $author
	 *
	 * @return static
	 */
    public function comment($data, Model $author)
    {
        return (new Comment())->createComment($this, $data, $author);
    }

	/**
	 * @param       $data
	 * @param Model $author
	 *
	 * @return static
	 */
    public function commentUnique($data, Model $author )
    {
        return (new Comment())->createUniqueComment($this, $data, $author);
    }

	/**
	 * @param $id
	 * @param $data
	 *
	 * @return mixed
	 */
    public function updateComment($id, $data)
    {
        return (new Comment())->updateComment($id, $data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteComment($id)
    {
        return (new Comment())->deleteComment($id);
    }


    public function getCommentCountAttribute()
    {
        return $this->commentCount();
    }

}
