<?php

namespace App\Models;

use Carbon\Carbon;
use InvalidArgumentException;

class Redirection extends Model
{
    /**
     * Create a new redirection.
     * 
     * @param string $name
     * @param string $destination
     * @param int $accessCount
     * @param \Carbon\Carbon $accessedAt
     * @return void
     */
    public function __construct(
        /**
         * The redirection identifier.
         *
         * @var string
         */
        private string $name,

        /**
         * The redirection destination.
         *
         * @var string
         */
        private string $destination,

        /**
         * The number of times the redirection was resolved.
         *
         * @var int
         */
        private int $accessCount = 0,

        /**
         * The last time the redirection was resolved.
         *
         * @var null|\Carbon\Carbon
         */
        private ?Carbon $accessedAt = null
    ) {
        parent::__construct();
    }

    /**
     * Get the redirection name.
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the redirection name.
     * 
     * @param string $name
     * @return \App\Models\Redirection
     */
    public function setName(string $name): Redirection
    {
        $this->name = $name;

        return $this->touch();
    }

    /**
     * Get the redirection destination.
     * 
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * Set the redirection destination.
     * 
     * @param string $destination
     * @return \App\Models\Redirection
     */
    public function setDestination(string $destination): Redirection
    {
        $this->destination = $destination;

        return $this->touch();
    }

    /**
     * Get the number of times the redirection was resolved.
     * 
     * @return int
     */
    public function getAccessCount(): int
    {
        return $this->accessCount;
    }

    /**
     * Set the number of times the redirection was resolved.
     * 
     * @param int $accessCount
     * @return \App\Models\Redirection
     */
    public function setAccessCount(string $accessCount): Redirection
    {
        $this->accessCount = $accessCount;

        return $this->touch();
    }

    /**
     * Increment the number of times the redirection was resolved.
     * 
     * @param int $value
     * @return \App\Models\Redirection
     */
    public function incrementAccessCount(int $value = 1): Redirection
    {
        $this->accessCount += $value;

        return $this->touch();
    }

    /**
     * Get the last time the redirection was resolved.
     * 
     * @return \Carbon\Carbon
     */
    public function getAccessedAt(): Carbon
    {
        return $this->accessedAt;
    }

    /**
     * Set the last time the redirection was resolved.
     * 
     * @param \Carbon\Carbon $accessedAt
     * @return \App\Models\Redirection
     * 
     * @throws \InvalidArgumentException
     */
    public function setAccessedAt(Carbon $accessedAt): Redirection
    {
        if ($accessedAt < $this->getCreatedAt()) {
            throw new InvalidArgumentException('The redirection last accessed timestamp cannot be earlier than its creation timestamp.');
        }

        $this->accessedAt = $accessedAt;

        return $this->touch();
    }

    /**
     * Refresh the last time the redirection was resolved.
     * 
     * @return \App\Models\Redirection
     */
    public function touchAccessedDate(): Redirection
    {
        return $this->setAccessedAt(Carbon::now());
    }

    /**
     * Touch the redirection and return its destination.
     * 
     * @return string
     */
    public function resolve(): string
    {
        $this->incrementAccessCount();
        $this->touchAccessedDate();

        return $this->getDestination();
    }
}
