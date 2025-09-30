<?php

/**
 * Page Title: Product Admin
 *
 * File Name: ProductInterface.php
 *
 * Description: Product details
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

use App\Http\Requests\Admin\Products\CreateProductRequest;
use App\Http\Requests\Admin\Products\updateProductRequest;
use Exception;
use Illuminate\Http\Request;

interface ProductInterface
{
    /**
     * @return array |        | View all products data
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
     * View all products data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function index(Request $request);

    /**
     * @return array |        | Store products data
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
     * Store products data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function create(CreateProductRequest $request);

    /**
     * @return array |        | View the form for editing products data
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
     * View the form for editing products data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function updateUi( $id);

    /**
     * @return array |        | Update products data
     *
     * @throws Exception
     *
     * @category Admin
     *
     * @var UpdateProductRequest $request, $id
     *
     * @author  Chamodi Kulathunga
     * @author  Function created date 30/09/2025
     *
     * Update products data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function update(updateProductRequest $request, $id);

    /**
     * @return array |        | Remove products data
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
     * Remove products data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function destroy($id);

    /**
     * @return array |        | Status change of products data
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
     * Status change of products data
     *
     * @uses
     *
     * @version 1.0.0
     *
     * @since 30/09/2025
     */
    public function changeStatus(Request $request, $id);

}
