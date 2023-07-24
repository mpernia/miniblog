<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="MiniBlog API",
 *      description="MiniBlog API documentation",
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      },
 *      @OA\Contact(
 *          email="contact@maikel-enrique-pernia-matos.com"
 *      ),
 *      @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *
 * @OA\Server(
 *      url="http://localhost:9000/api/v1",
 *      description="MiniBlog API Server"
 * )
 *
 *
 *
 */

class BackendController extends Controller
{

}
