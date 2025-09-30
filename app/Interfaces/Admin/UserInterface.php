<?php

/**
 * Page Title: User Admin
 *
 * File Name: UserInterface.php
 *
 * Description: User details
 *
 * @package
 * @category Admin
 * @version 1.0.0
 * @since File created date: 30/09/2025
 *
 * @author Chamodi Kulathunga
 *
 * @copyright Copyright © 2025
 */

namespace App\Interfaces\Admin;

use App\Http\Requests\Admin\Users\CreateUserRequest;
use App\Http\Requests\Admin\Users\updateUserRequest;
use Exception;
use Illuminate\Http\Request;

interface UserInterface
{
    /**
     * @return array |        | View all users data
     *
     * @throws Exception
     *
     * @category Admin
     *
     * @var Request $request
     *
     * @author  Chamodi Kulathunga
     * @author  Function created date 30/09/2025
     *
     * View all users data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function index(Request $request);

    /**
     * @return array |        | Store users data
     *
     * @throws Exception
     *
     * @category Admin
     *
     * @var Request $request
     *
     * @author  Chamodi Kulathunga
     * @author  Function created date 30/09/2025
     *
     * Store users data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function create(CreateUserRequest $request);

    /**
     * @return array |        | View the form for editing users data
     *
     * @throws Exception
     *
     * @category Admin
     *
     * @var $id
     *
     * @author  Chamodi Kulathunga
     * @author  Function created date 30/09/2025
     *
     * View the form for editing users data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function updateUi( $id);

    /**
     * @return array |        | Update users data
     *
     * @throws Exception
     *
     * @category Admin
     *
     * @var UpdateUserRequest $request, $id
     *
     * @author  Chamodi Kulathunga
     * @author  Function created date 30/09/2025
     *
     * Update users data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function update(updateUserRequest $request, $id);

    /**
     * @return array |        | Remove users data
     *
     * @throws Exception
     *
     * @category Admin
     *
     * @var $id
     *
     * @author  Chamodi Kulathunga
     * @author  Function created date 30/09/2025
     *
     * Remove users data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function destroy($id);

    /**
     * @return array |        | Status change of users data
     *
     * @throws Exception
     *
     * @category Admin
     *
     * @var Request $request
     *
     * @author  Chamodi Kulathunga
     * @author  Function created date 30/09/2025
     *
     * Status change of users data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function changeStatus(Request $request, $id);

}
