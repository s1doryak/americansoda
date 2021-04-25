<?php

namespace App\Policies;

use App\LtpMessage;

use Crmplease\MaterialAdmin\Policies\Contracts\DatatablePolicyContract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * LtpMessage policy.
 *
 * @package App\Policies
 */
class LtpMessagePolicy implements DatatablePolicyContract
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can list of entities.
	 *
	 * @param Authenticatable $authenticatable
	 * @return boolean
	 */
	public function index(Authenticatable $authenticatable)
	{
        switch (get_class($authenticatable)) {

            default:
                return true;
        }
	}

    /**
	 * Determine whether the user can list of trashed.
	 *
     * @param Authenticatable $authenticatable
     * @return boolean
     */
    public function trashed(Authenticatable $authenticatable)
    {
        switch (get_class($authenticatable)) {

            default:
                return false;
        }
    }

    /**
	 * Determine whether the user can export entities.
	 *
     * @param Authenticatable $authenticatable
     * @return boolean
     */
    public function export(Authenticatable $authenticatable)
    {
        switch (get_class($authenticatable)) {

            default:
                return true;
        }
    }

	/**
	 * Determine whether the user can view action column.
	 *
	 * @param Authenticatable $authenticatable
	 * @return boolean
	 */
	public function action(Authenticatable $authenticatable)
	{
        switch (get_class($authenticatable)) {

            default:
                return false;
        }
	}

	/**
	 * Determine whether the user can show the entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @param LtpMessage $ltpMessage
	 * @return boolean
	 */
	public function view(Authenticatable $authenticatable, LtpMessage $ltpMessage)
	{
        switch (get_class($authenticatable)) {

            default:
                return true;
        }
	}

	/**
	 * Determine whether the user can create entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @return boolean
	 */
	public function create(Authenticatable $authenticatable)
	{
        switch (get_class($authenticatable)) {

            default:
                return false;
        }
	}

	/**
	 * Determine whether the user can update the entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @param LtpMessage $ltpMessage
	 * @return boolean
	 */
	public function update(Authenticatable $authenticatable, LtpMessage $ltpMessage)
	{
        switch (get_class($authenticatable)) {

            default:
                return false;
        }
	}

	/**
	 * Determine whether the user can trash the entity.
	 *
	 * @param Authenticatable $authenticatable
	 * @param LtpMessage $ltpMessage
	 * @return boolean
	 */
	public function trash(Authenticatable $authenticatable, LtpMessage $ltpMessage)
	{
        switch (get_class($authenticatable)) {

            default:
                return false;
        }
	}

    /**
	 * Determine whether the user can restore the entity.
	 *
     * @param Authenticatable $authenticatable
     * @param LtpMessage $ltpMessage
     * @return boolean
     */
    public function restore(Authenticatable $authenticatable, LtpMessage $ltpMessage)
    {
        switch (get_class($authenticatable)) {

            default:
                return false;
        }
    }

    /**
	 * Determine whether the user can destroy the entity.
	 *
     * @param Authenticatable $authenticatable
     * @param LtpMessage $ltpMessage
     * @return boolean
     */
    public function destroy(Authenticatable $authenticatable, LtpMessage $ltpMessage)
    {
        switch (get_class($authenticatable)) {

            default:
                return false;
        }
    }

    //  /**
    //   * @param Authenticatable $authenticatable
    //   * @param LtpMessage $ltpMessage
    //   * @return boolean
    //   */
    //  public function pdf(Authenticatable $authenticatable, LtpMessage $ltpMessage)
    //  {
    //      return true;
    //  }
}
