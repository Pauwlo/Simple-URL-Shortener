<?php

namespace App\Models;

use App\Exceptions\ModelException;
use Carbon\Carbon;
use InvalidArgumentException;

abstract class Model
{
    /**
     * Create a new model instance.
     * 
     * @param null|int $id
     * @param null|\Carbon\Carbon $createdAt
     * @param null|\Carbon\Carbon $updatedAt
     * @return void
     */
    public function __construct(
        /**
         * The model ID.
         * 
         * @var null|int
         */
        private ?int $id = null,

        /**
         * The model creation date.
         *
         * @var null|\Carbon\Carbon
         */
        private ?Carbon $createdAt = null,

        /**
         * The model update date.
         *
         * @var null|\Carbon\Carbon
         */
        private ?Carbon $updatedAt = null
    ) {
        if (!$createdAt) {
            $this->setCreatedAt(Carbon::now());
        }
    }

    /**
     * Get the model ID.
     * 
     * @return null|int
     */
    public function getID(): null|int
    {
        return $this->id;
    }

    /**
     * Set the model ID.
     * 
     * @param int $id
     * @return \App\Models\Model
     * 
     * @throws \App\Exceptions\ModelException
     */
    public function setID(int $id): Model
    {
        if ($this->id) {
            throw new ModelException('A model ID cannot be changed.');
        }

        $this->id = $id;

        return $this->touch();
    }

    /**
     * Get the model creation date.
     * 
     * @return \Carbon\Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * Set the model creation date.
     * 
     * @param \Carbon\Carbon $createdAt
     * @return \App\Models\Model
     */
    public function setCreatedAt(Carbon $createdAt): Model
    {
        $this->createdAt = $createdAt;

        return $this->touch();
    }

    /**
     * Get the model update timestamp.
     * 
     * @return \Carbon\Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    /**
     * Set the model update timestamp.
     * 
     * @param \Carbon\Carbon $updatedAt
     * @return \App\Models\Model
     * 
     * @throws \InvalidArgumentException
     */
    public function setUpdatedAt(Carbon $updatedAt): Model
    {
        if ($updatedAt < $this->createdAt) {
            throw new InvalidArgumentException('The model update timestamp cannot be earlier than its creation timestamp.');
        }

        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Refresh the model update date.
     * 
     * @return \App\Models\Model
     */
    public function touch(): Model
    {
        $this->updatedAt = Carbon::now();

        return $this;
    }
}
