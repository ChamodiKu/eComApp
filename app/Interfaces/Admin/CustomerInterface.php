<?php

/**
 * Page Title: Customer Admin
 *
 * File Name: CustomerInterface.php
 *
 * Description: Customer details
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

use App\Http\Requests\Admin\Customers\CreateCustomerRequest;
use App\Http\Requests\Admin\Customers\updateCustomerRequest;
use Exception;
use Illuminate\Http\Request;

interface CustomerInterface
{
    /**
     * @return array |        | View all customers data
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
     * View all customers data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function index(Request $request);

    /**
     * @return array |        | Remove customers data
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
     * Remove customers data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function destroy($id);

    /**
     * @return array |        | Status change of customers data
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
     * Status change of customers data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function changeStatus(Request $request, $id);

}
